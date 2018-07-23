<?php

class APIControllerResponseHandler
{


    private $container;

    /**
     * APIControllerResponseHandler constructor.
     * @param $container
     */
    public function __construct(\Psr\Container\ContainerInterface $container)
    {
        $this->container = $container;
    }


    /**
     * @param \Slim\Http\Response $response
     * @param $data
     * @return \Slim\Http\Response
     */
    public static function handleResponse(\Slim\Http\Response $response, $data)
    {
        return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withJson(array("data" => $data));
    }

    /**
     * @param \Slim\Http\Response $response
     * @param $image
     * @return \Slim\Http\Response
     */
    public static function sendImage(\Slim\Http\Response $response, $image)
    {
        $response->write($image);
        return $response->withHeader('Content-Type', FILEINFO_MIME_TYPE);
    }


    /**
     * @param $request
     * @param $response
     * @param $exception
     * @return mixed
     */
    public function __invoke(\Slim\Http\Request $request, \Slim\Http\Response $response, Exception $exception)
    {
        $settings = $this->container->get('settings');
        $logger = $this->container->get('logger');

        $logger->debug("Error message: " . $exception->getMessage() . " [code: " . $exception->getCode() . "]");

        if ($exception instanceof UserDeploymentsServiceException) {
            $logger->debug("instance of MetadataServiceException");
            return $response->withJson($exception->toArray(), $exception->getCode());
        } else {
            $code = self::isValidCode($exception->getCode()) ? $exception->getCode() : 500;
            if ($exception instanceof ServiceAuthorizationException) {
                $code = 401;
                $logger->debug("ServiceAuthorizationException detected!!!");
            }

            // prepare the error object
            $error = APIControllerResponseHandler::getError($exception);
            $logger->debug("Error: " . json_encode($error));

            return $response
                ->withStatus($code)
                ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withJson(array("error" => $error));
        }
    }


    /**
     * @param Exception $exception
     * @param null $settings
     * @return array
     */
    private static function getError(Exception $exception, $settings = null)
    {
        $result = array(
            "code" => $exception->getCode(),
            "message" => $exception->getMessage()
        );
        if ($settings && $settings['logger']['debug'])
            $result["trace"] = $exception->getTraceAsString();
        return $result;
    }

    /**
     * @var array HTTP valid status codes
     */
    private static $codes = [
        "100", "101",
        "200", "201", "202", "203", "204", "205", "206",
        "300", "301", "302", "303", "304", "305", "306", "307",
        "400", "401", "402", "403", "404", "405", "406", "407", "408",
        "409", "410", "411", "412", "413", "414", "415", "416", "417",
        "500", "501", "502", "503", "504", "505"];

    /**
     * @param $code
     * @return bool
     */
    private static function isValidCode($code)
    {
        return !empty($code) && in_array($code, self::$codes);
    }
}