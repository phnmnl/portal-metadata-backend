<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($container) {
    $settings = $container->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($container) {
    // logger settings
    $settings = $container->get('settings')['logger'];
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
$container['UserDeploymentsService'] = function ($container) {
    $settings = $container->get('settings');
    return new UserDeploymentsService($container['logger'], $settings["galaxy"]["url"], $settings["galaxy"]["api_key"]);
};

$container['CloudProviderMetadataService'] = function ($container) {
    return new CloudProviderMetadataService($container['logger']);
};

$container['OpenStackMetadataService'] = function ($container) {
    return new OpenStackMetadataService($container['logger']);
};

$container['GoogleCloudMetadataService'] = function ($container) {
    return new GoogleCloudMetadataService($container['logger']);
};

$container['AwsMetadataService'] = function ($container) {
    return new AwsMetadataService($container['logger']);
};

$container['CloudProvidersCatalogService'] = function ($container) {
    return new CloudProvidersCatalogService($container['logger'], $container->get('settings'));
};


// Set the default ErrorHandler
$container['errorHandler'] = function ($container) {
    return new APIControllerResponseHandler($container);
//    return function ($request, $response, $exception) use ($container) {
//        return $response->withStatus(401);
////        return APIControllerResponseHandler::handleException($request, $response, $container, $exception);
//    };
};