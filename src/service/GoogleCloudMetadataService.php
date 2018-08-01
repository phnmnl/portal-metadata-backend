<?php


class GoogleCloudMetadataService
{

    private $logger;
    private $TOKEN_FIELD = "authToken";

    public function __construct(Monolog\Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $credentials
     * @return Google_Client
     * @throws Google_Exception
     * @throws ServiceAuthorizationException
     */
    private function configClient($credentials)
    {
        foreach (["type", "project_id", "private_key_id", "client_email", "client_id",
                     "auth_uri", "token_uri", "auth_provider_x509_cert_url", "client_x509_cert_url"] as $key) {
            if (!isset($credentials[$key]))
                throw new ServiceAuthorizationException("Undefined '$key' on credentials");
        }
        $client = new Google_Client();
        $client->setAuthConfig($credentials);
        $client->addScope(Google_Service_Compute::COMPUTE);
        $client->addScope(Google_Service_Compute::CLOUD_PLATFORM);
        return $client;
    }

    /**
     * @param $credentials
     * @return array
     * @throws ServiceAuthorizationException
     * @throws ServiceException
     */
    public function authenticate($credentials)
    {
        try {
            $this->getZones($credentials);
            return array("Authentication" => "OK");
        } catch (Exception $e) {
            throw new ServiceAuthorizationException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param $credentials
     * @return Google_Service_Compute_RegionList
     * @throws ServiceException
     */
    public function getRegions($credentials)
    {
        try {
            $client = $this->configClient($credentials);
            $projectId = $credentials["project_id"];
            $compute = new Google_Service_Compute($client);
            return $compute->regions->listRegions($projectId);
        } catch (Google_Exception $e) {
            throw $this->handleException($e);
        }
    }

    /**
     * @param $credentials
     * @return Google_Service_Compute_ZoneList
     * @throws ServiceAuthorizationException
     * @throws ServiceException
     */
    public function getZones($credentials)
    {
        try {
            $client = $this->configClient($credentials);
            $projectId = $credentials["project_id"];
            $compute = new Google_Service_Compute($client);
            return $compute->zones->listZones($projectId);
        } catch (Google_Exception $e) {
            throw $this->handleException($e);
        }
    }

    /**
     * @param $credentials
     * @param string $zone
     * @return Google_Service_Compute_MachineTypeList
     * @throws ServiceAuthorizationException
     * @throws ServiceException
     */
    public function getFlavors($credentials, $zone = "europe-north1-a")
    {
        try {
            $client = $this->configClient($credentials);
            $projectId = $credentials["project_id"];
            $compute = new Google_Service_Compute($client);
            return $compute->machineTypes->listMachineTypes($projectId, $zone);
        } catch (Google_Exception $e) {
            throw $this->handleException($e);
        }
    }

    /**
     * @param Exception $e
     * @return ServiceAuthorizationException|ServiceException
     */
    private function handleException(Exception $e)
    {
        $this->logger->debug("ERROR---->: " . $e->getMessage());
        $code = $e->getCode();
        $message = $e->getMessage();
        try {
            $error = json_decode($e->getMessage(), true);
            if (isset($error["error"])) $error = $error["error"];
            $code = $error["code"];
            $message = $error["message"];
            print_r($error);
        } catch (Exception $x) {
        }
        if ($code === 401)
            return new ServiceAuthorizationException($message, null, $e);
        return new ServiceException($message, $code, null, $e);
    }
}