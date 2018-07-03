<?php


class AwsMetadataService
{

    private $logger;

    public function __construct(Monolog\Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $credentials
     * @return \Aws\Ec2\Ec2Client
     * @throws ServiceAuthorizationException
     */
    private function getEc2Client($credentials)
    {
        if (!isset($credentials["AWS_ACCESS_KEY_ID"]))
            throw new ServiceAuthorizationException("AWS_ACCESS_KEY_ID not defined!");
        if(!isset($credentials["AWS_SECRET_ACCESS_KEY"]))
            throw new ServiceAuthorizationException("AWS_SECRET_ACCESS_KEY not defined!");
        putenv("AWS_ACCESS_KEY_ID=" . $credentials["AWS_ACCESS_KEY_ID"]);
        putenv("AWS_SECRET_ACCESS_KEY=" . $credentials["AWS_SECRET_ACCESS_KEY"]);
        $ec2Client = new \Aws\Ec2\Ec2Client([
            'region' => 'us-west-2',
            'version' => 'latest'
        ]);
        return $ec2Client;
    }

    /**
     * @param \Aws\Ec2\Exception\Ec2Exception $e
     * @return bool
     */
    private function isAuthError(\Aws\Ec2\Exception\Ec2Exception $e)
    {
        return strcmp($e->getAwsErrorCode(), "AuthFailure") === 0;
    }


    /**
     * @param $credentials
     * @return array
     * @throws ServiceAuthorizationException
     * @throws ServiceException
     */
    public function authenticate($credentials)
    {
        return $this->getRegions($credentials);
    }

    /**
     * @param $credentials
     * @return array
     * @throws ServiceAuthorizationException
     * @throws ServiceException
     */
    public function getRegions($credentials)
    {
        try {
            $ec2Client = $this->getEc2Client($credentials);
            return $ec2Client->describeRegions()->toArray();
        } catch (\Aws\Ec2\Exception\Ec2Exception $e) {
            $this->logger->error($e->getAwsErrorType() . " -- " . $e->getAwsErrorCode() . " ... " . $e->getAwsErrorMessage());
            if ($this->isAuthError($e)) {
                throw new ServiceAuthorizationException($e->getMessage(), $e->getTransferInfo(), $e);
            }
            throw new ServiceException($e->getMessage(), $e->getTransferInfo(), $e);
        }
    }

    /**
     * @param $credentials
     * @return array
     * @throws ServiceAuthorizationException
     * @throws ServiceException
     */
    public function getZones($credentials)
    {
        try {
            $ec2Client = $this->getEc2Client($credentials);
            return $ec2Client->describeAvailabilityZones()->toArray();
        } catch (\Aws\Ec2\Exception\Ec2Exception $e) {
            if ($this->isAuthError($e))
                throw new ServiceAuthorizationException($e->getMessage(), $e->getTransferInfo(), $e);
            throw new ServiceException($e->getMessage(), $e->getTransferInfo(), $e);
        }
    }

    /**
     * @param $credentials
     * @return bool|string
     * @throws ServiceException
     */
    public function getFlavors($credentials)
    {
        try {
            return json_decode(file_get_contents(__DIR__ . '/AwsInstanceTypes.json'));
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage(), null, $e);
        }
    }
}