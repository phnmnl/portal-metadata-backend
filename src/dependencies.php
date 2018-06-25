<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    // logger settings
    $settings = $c->get('settings')['logger'];
    // Instantiate the global logger
    $logger = new Monolog\Logger($settings['name']);
    // Use the application settings
    $handler = new Monolog\Handler\ErrorLogHandler();
    $handler->setLevel($settings['level']);
    $logger->pushHandler($handler);

//    Uncomment to enable a different log format
//    $output = "%datetime% [%level_name%]: %message% %context% %extra%\n";
//    $formatter = new Monolog\Formatter\LineFormatter($output);
//    $handler->setFormatter($formatter);

    // Enable persistent logs
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// MetadataService
$container['UserDeploymentsService'] = function ($c) {
    $settings = $c->get('settings');
    return new UserDeploymentsService($c['logger'], $settings["galaxy"]["url"], $settings["galaxy"]["api_key"]);
};


// Set the default ErrorHandler
$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        $c['logger']->debug("Handling error with custom phpErrorHandler");

        if ($exception instanceof MetadataServiceException) {
            $c['logger']->debug("instance of MetadataServiceException");
            return $c['response']->withJson($exception->toArray(), $exception->getCode());
        } else
            return $c['response']->withJson(
                array(
                    "code" => $exception->getCode(),
                    "message" => $exception->getMessage(),
                    "trace" => $exception->getTrace()
                ), $exception->getCode()
            );
    };
};