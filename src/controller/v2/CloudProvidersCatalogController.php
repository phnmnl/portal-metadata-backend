<?php

// include required service
require_once __DIR__ . '/../../service/CloudProvidersCatalogService.php';

// include utilities
require_once __DIR__ . '/utilities.php';

// API endpoint prefix
$PREFIX = "";

/**
 *
 */
$app->get(buildPath($PREFIX, '/providers/catalog'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get('CloudProvidersCatalogService');

    // reqd parameters
//    $parsedBody = $request->getParsedBody();
//    $logger->debug("Parsed body" . json_encode($parsedBody));

    // get catalog of providers
    $data = $service->getCatalog();

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, updatePaths($data));
});


/**
 *
 */
$app->get(buildPath($PREFIX, '/providers/catalog/{name}'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get('CloudProvidersCatalogService');

    // read provider nane
    $name = $request->getAttribute('name');

    $this->logger->debug($request->getUri()->getPath());

    // get catalog of providers
    $data = $service->getProviderInfo($name);

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, updatePath($data));
});


/**
 *
 */
$app->get(buildPath($PREFIX, '/providers/catalog/{name}/logo'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get('CloudProvidersCatalogService');

    // read provider nane
    $name = $request->getAttribute('name');

    // get catalog of providers
    $data = $service->getProviderLogo($name);

    // prepare response object
    return APIControllerResponseHandler::sendImage($response, file_get_contents($data));
});

/**
 *
 */
$app->get(buildPath($PREFIX, '/providers/catalog/{name}/credentials'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get('CloudProvidersCatalogService');

    // read provider nane
    $name = $request->getAttribute('name');

    // get catalog of providers
    $data = $service->getProviderCredentials($name);

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, $data);
});


