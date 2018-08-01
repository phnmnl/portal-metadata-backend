<?php

// include required service
require_once __DIR__ . '/../../service/AwsMetadataService.php';

// API endpoint prefix
$PREFIX = "";

/**
 *
 */
$app->post(buildPath($PREFIX, '/providers/aws/authenticate'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');

    // get the service
    $service = $this->get("AwsMetadataService");

    // reqd parameters
    $parsedBody = $request->getParsedBody();
    //$logger->debug("Parsed body" . json_encode($parsedBody));
    $logger->debug("Parsed body -- omitted");

    $data = $service->authenticate($parsedBody);

    $logger->debug("Service request OK");

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, $data);
});


/**
 *
 */
$app->get(/**
 * @param $request
 * @param $response
 */
    buildPath($PREFIX, '/providers/aws/regions'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get("AwsMetadataService");

    // reqd parameters
    $parsedBody = $request->getParsedBody();
    $logger->debug("Parsed body" . json_encode($parsedBody));

    // get zones
    $data = $service->getRegions($parsedBody);

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, $data);
});


/**
 *
 */
$app->get(buildPath($PREFIX, '/providers/aws/zones'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get("AwsMetadataService");

    // reqd parameters
    $parsedBody = $request->getParsedBody();
    $logger->debug("Parsed body" . json_encode($parsedBody));

    // get zones
    $data = $service->getZones($parsedBody);

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, $data);
});


/**
 *
 */
$app->get(buildPath($PREFIX, '/providers/aws/flavors'), function ($request, $response) {
    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get("AwsMetadataService");

    // reqd parameters
    $parsedBody = $request->getParsedBody();
    $logger->debug("Parsed body" . json_encode($parsedBody));

    // get flavors
    $data = $service->getFlavors($parsedBody);

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, $data);
});
