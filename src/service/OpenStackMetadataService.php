<?php


class OpenStackMetadataService
{

    private $logger;
    private $TOKEN_FIELD = "authToken";

    public function __construct(Monolog\Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $credentials
     * @return mixed
     * @throws ServiceAuthorizationException
     * @throws ServiceException
     */
    public function authenticate($credentials)
    {
        if (isset($credentials["OS_TENANT_NAME"]) || isset($credentials["OS_TENANT_ID"]))
            return $this->authenticateV2($credentials);
        return $this->authenticateV3($credentials);
    }


    /**
     * @param $credentials
     * @return mixed
     * @throws ServiceAuthorizationException
     * @throws ServiceException
     */
    public function authenticateV2($credentials)
    {
        /* For V2 the API seems to require:
         *   - OS_AUTH_URL
         *   - OS_USERNAME
         *   - OS_PASSWORD
         * Plus one of OS_TENANT_ID or OS_TENANT_NAME.
         * In our tests with Embassy cloud, if both of the latter parts are missing
         * we don't get a real authentication error but something about an empty catalog.
         */
        foreach (["OS_AUTH_URL", "OS_USERNAME", "OS_PASSWORD"] as $key) {
            if (!isset($credentials[$key]))
                throw new ServiceAuthorizationException("Credentials doesn't contain '$key' property");
        }
        if ( (!isset($credentials["OS_TENANT_NAME"]) || empty($credentials["OS_TENANT_NAME"])) && 
             (!isset($credentials["OS_TENANT_ID"]) || empty($credentials["OS_TENANT_ID"])) )
                throw new ServiceAuthorizationException("At least one of OS_TENANT_ID and OS_TENANT_NAME is required for authentication ");

        $requestParameters = [
            "auth" => [
                "passwordCredentials" => [
                    "username" => $credentials["OS_USERNAME"], "password" => $credentials["OS_PASSWORD"]
                ]
            ]
        ];
        if (isset($credentials["OS_TENANT_ID"]))
            $requestParameters["auth"]["tenantId"] = $credentials["OS_TENANT_ID"];
        if (isset($credentials["OS_TENANT_NAME"]))
            $requestParameters["auth"]["tenantName"] = $credentials["OS_TENANT_NAME"];

        $OS_AUTH_URL = rtrim($credentials["OS_AUTH_URL"], "/") . "/tokens";
        return $this->setTokenV2($this->toPostRequest($OS_AUTH_URL, $requestParameters));
    }

    private function setTokenV2($result)
    {
        $target_token_id = "authToken";
        $result["data"][$target_token_id] = $result["data"]["access"]["token"]["id"];
        $result["data"]["version"] = 2;
        $this->logger->debug("TOKEN: " . $result["data"][$target_token_id]);
        return $result["data"];
    }

    /**
     * @param $credentials
     * @return mixed
     * @throws ServiceAuthorizationException
     * @throws ServiceException
     */
    public function authenticateV3($credentials)
    {
        /* For V3 the API seems to require:
         *   - OS_AUTH_URL
         *   - OS_USERNAME
         *   - OS_PASSWORD
         *   - OS_USER_DOMAIN_NAME
         * Plus one of OS_PROJECT_ID or OS_PROJECT_NAME.
         *
         * According to the API documentation, it is possible to authenticate without a PROJECT
         * (a request with a 'scope' object is legitimate).  However, none of the openstack
         * clouds we tested against authenticated users successfully without this.
         */
        foreach (["OS_AUTH_URL", "OS_USERNAME", "OS_PASSWORD", "OS_USER_DOMAIN_NAME"] as $key) {
            if (!isset($credentials[$key]) || empty($credentials[$key]))
                throw new ServiceAuthorizationException("Credentials doesn't contain '$key' property");
        }
        if ( (!isset($credentials["OS_PROJECT_NAME"]) || empty($credentials["OS_PROJECT_NAME"])) && 
             (!isset($credentials["OS_PROJECT_ID"]) || empty($credentials["OS_PROJECT_ID"])) )
                throw new ServiceAuthorizationException("At least one of OS_PROJECT_ID and OS_PROJECT_NAME is required for authentication ");

        $requestParameters = array(
            "auth" => array(
                "identity" => array(
                    "methods" => [
                        "password"
                    ],
                    "password" => array(
                        "user" => array(
                            "domain" => array(
                                "name" => $credentials["OS_USER_DOMAIN_NAME"]
                            ),
                            "name" => $credentials["OS_USERNAME"],
                            "password" => $credentials["OS_PASSWORD"]
                        )
                    )
                ),
                "scope" => array(
                    "project" => array(
                        "domain" => array(
                            "name" => $credentials["OS_USER_DOMAIN_NAME"]
                        )
                    )
                )
            )
        );
        if (isset($credentials["OS_PROJECT_ID"]))
            $requestParameters["auth"]["scope"]["project"]["id"] = $credentials["OS_PROJECT_ID"];
        if (isset($credentials["OS_PROJECT_NAME"]))
            $requestParameters["auth"]["scope"]["project"]["name"] = $credentials["OS_PROJECT_NAME"];

        $OS_AUTH_URL = rtrim($credentials["OS_AUTH_URL"], "/") . "/auth/tokens?catalog";

        return $this->setTokenV3($this->toPostRequest($OS_AUTH_URL, $requestParameters));
    }

    private function setTokenV3($result)
    {
        $source_token_id = "X-Subject-Token";
        $target_token_id = "authToken";
        preg_match("/($source_token_id:)\s*([^\s]+)[\s]/i", $result["headers"], $matches);
        if (isset($matches) && count($matches) == 3) {
            $result["data"][$target_token_id] = $matches[2];
            $result["data"]["version"] = 3;
            $this->logger->debug("TOKEN: " . $result["data"][$target_token_id]);
            return $result["data"];
        }
        return $result;
    }


    /**
     * @param $url
     * @param $bodyParams
     * @return array
     * @throws ServiceAuthorizationException
     * @throws ServiceException
     */
    private function toPostRequest($url, $bodyParams)
    {
        $this->logger->debug("URL: " . $url);
        $bodyParamsEncoded = json_encode($bodyParams);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, count($bodyParams));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyParamsEncoded);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($bodyParamsEncoded))
        );
        $result = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlHeaderSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        curl_close($ch);

        // process response
        $rawBody = trim(mb_substr($result, $curlHeaderSize));
        $rawHeader = trim(mb_substr($result, 0, $curlHeaderSize));
        $this->logger->debug("Raw headers: " . $rawHeader);
        $data = json_decode($rawBody, true);
        $this->logger->debug("Decoded body");

        // check the status code of the response
        $this->logger->debug("ERROR CODE: $statusCode");
        if ($statusCode === 401)
            throw new ServiceAuthorizationException($data["error"]["message"], $result);
        else if (!in_array($statusCode, [200, 201]))
            throw new ServiceException(
                (isset($data["error"]) && isset($data["error"]["message"]))
                    ? $data["error"]["message"] : $result, $statusCode, $result);

        // return the token if the statusCode is 200
        return array(
            "data" => $data,
            "headers" => $rawHeader,
            "statusCode" => $statusCode
        );
    }


    /**
     * @param $authenticationToken
     * @return mixed
     * @throws Exception
     */
    private function getCatalag($authenticationToken)
    {
        if (!isset($authenticationToken) || !isset($authenticationToken["version"]))
            throw new Exception("Invalid Authentication configuration");
        $version = $authenticationToken["version"];
        if ($version == 2)
            return $authenticationToken["access"]["serviceCatalog"];
        return $authenticationToken["token"]["catalog"];
    }

    private function getPublicEndPoint($catalog, $serviceName)
    {
        foreach ($catalog as $service) {
            if ($service["name"] === $serviceName) {
                foreach ($service["endpoints"] as $endpoint) {
                    if (isset($endpoint["publicURL"]))
                        return $endpoint["publicURL"];
                    if (isset($endpoint["interface"]) && $endpoint["interface"] === "public")
                        return $endpoint["url"];
                }
            }
        }
        return null;
    }


    /**
     * @param $authenticationToken
     * @return mixed
     * @throws Exception
     */
    public function getFlavors($authenticationToken)
    {
        return $this->doGet(
            $this->buildUrl($this->getComputeEndPoint($authenticationToken), 'flavors'),
            $authenticationToken[$this->TOKEN_FIELD]
        );
    }

    /**
     * @param $authenticationToken
     * @return mixed
     * @throws Exception
     */
    public function getExternalNetworks($authenticationToken)
    {
        return $this->doGet(
            $this->buildUrl($this->getComputeEndPoint($authenticationToken),
                'os-networks?router:external=true&fields=name'),
            $authenticationToken[$this->TOKEN_FIELD]
        );
    }

    public function getIpPools($authenticationToken)
    {
        return $this->doGet(
            $this->buildUrl($this->getComputeEndPoint($authenticationToken),
                'os-floating-ip-pools'),
            $authenticationToken[$this->TOKEN_FIELD]
        );
    }


    /**
     * @param $authenticationToken
     * @return null
     * @throws Exception
     */
    private function getComputeEndPoint($authenticationToken)
    {
        return $this->getEndPoint($authenticationToken, "nova");
    }

    /**
     * @param $authenticationToken
     * @return null
     * @throws Exception
     */
    private function getNetworkPoint($authenticationToken)
    {
        return $this->getEndPoint($authenticationToken, "neutron") . 'v2.0/';
    }

    /**
     * @param $authenticationToken
     * @return null
     * @throws Exception
     */
    private function getEndPoint($authenticationToken, $type = "nova")
    {
        $catalog = $this->getCatalag($authenticationToken);
        $this->logger->debug("Found Catalog: " . json_encode($catalog));
        $endPoint = $this->getPublicEndPoint($catalog, $type);
        $this->logger->debug("Found EndPoint: " . $endPoint);
        // Append '/'
        if (substr($endPoint, -1) != '/')
            $endPoint .= '/';
        return $endPoint;
    }


    private function doGet($url, $token, $queyParams = null)
    {
        $this->logger->debug("URL: " . $url);

        $headers[] = "X-Auth-Token: $token";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $this->logger->debug($result);
        curl_close($ch);
        return json_decode($result, true);
    }

    private function buildUrl(...$parts)
    {
        $result = null;
        foreach ($parts as $part) {
            if ($result) $result .= '/';
            $result .= rtrim($part, "/");
        }
        return $result;
    }
}
