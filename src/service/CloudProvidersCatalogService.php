<?php


class CloudProvidersCatalogService
{
    private $logger;
    private $settings;

    /**
     * OpenStackProvidersCatalogService constructor.
     * @param \Monolog\Logger $logger
     * @param array $settings
     */
    public function __construct(Monolog\Logger $logger, $settings = array())
    {
        $this->logger = $logger;
        $this->settings = $settings;
    }

    /**
     * @return array
     * @throws ServiceException
     */
    public function getCatalog()
    {
        $result = array();
        $base_folder = $this->getProvidersBaseFolder();
        $this->logger->debug("Scanning folder: $base_folder");
        if (!file_exists($base_folder))
            throw new ServiceException("Unable to find folder containing providers settings");
        $list = scandir($base_folder);

        foreach ($list as $f) {
            if (!$this->startsWith($f, ".")) {
                $this->logger->debug("Folder: $f");
                $data = $this->getData($f, $base_folder);
                array_push($result, $data);
            }
        }
        return $result;
    }

    /**
     * @param $provider_name
     * @return mixed
     * @throws ServiceException
     */
    public function getProviderInfo($provider_name)
    {
        $folder = $this->getProviderDataFolder($provider_name);
        $this->logger->debug("Provider info folder: $folder");
        if (!file_exists($folder))
            throw new ServiceException("Unable to find settings of the '$provider_name' provider!");
        return $this->getData($provider_name);
    }

    /**
     * @param $provider_name
     * @return mixed
     * @throws ServiceException
     */
    public function getProviderLogo($provider_name)
    {
        $info = $this->getProviderInfo($provider_name);
        if (!$info || !isset($info["logo"]))
            throw new ServiceException("Unable to find the logo for '$provider_name' provider!");
        return $this->getProviderDataFolder($provider_name) . '/' . $info['logo']["path"];
    }

    /**
     * @param $provider_name
     * @return mixed
     * @throws ServiceException
     */
    public function getProviderCredentials($provider_name)
    {
        return $this->getProviderInfo($provider_name)["credential"]["rcFile"];
    }

    /**
     * @param $provider_name
     * @return string
     */
    private function getProviderDataFolder($provider_name, $base_folder = null)
    {
        if (!isset($base_folder))
            $base_folder = $this->getProvidersBaseFolder();
        $this->logger->debug("Scanning folder: $base_folder");
        return "$base_folder/$provider_name";
    }

    /**
     * @param $id
     * @param $base_folder
     * @return mixed
     * @throws ServiceException
     */
    private function getData($id, $base_folder = null)
    {
        $folder = $this->getProviderDataFolder($id, $base_folder);
        if (!file_exists($folder))
            throw new ServiceException("Folder $folder doesn't exist");
        $str = file_get_contents("$folder/info.json");
        $data = json_decode($str, true);
        $data['id'] = $id;
        $this->logger->debug("Credential path: " . $data["credential"]["path"]);
        $rcFile = $this->readCredentialFile($id, $data);
        $data['credential'] = array(
            "rc_file" => $rcFile
        );
        return $data;
    }

    /**
     * @param $provider_name
     * @param $info
     * @return bool|string
     * @throws ServiceException
     */
    private function readCredentialFile($provider_name, $info)
    {
//        if (!isset($info["credential"]) || !isset($info["credential"]["path"]))
//            throw new ServiceException("Unable to find the path of the credential file");
        $credentials_file = $this->getProviderDataFolder($provider_name) . '/' . $info['credential']["path"];
        $this->logger->debug("Checking credentials file: $credentials_file");
        if (!file_exists($credentials_file))
            throw new \Propel\Runtime\Exception\FileNotFoundException();
        return file_get_contents($credentials_file);
    }


    /**
     * @return mixed
     */
    private function getProvidersBaseFolder()
    {
        return $this->settings["providers"]["folder"];
    }

    /**
     * @param $haystack
     * @param $needle
     * @return bool
     */
    private function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

}