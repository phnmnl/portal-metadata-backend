<?php

// include required service
require_once __DIR__ . '/../../service/GoogleCloudMetadataService.php';

// API endpoint prefix
$PREFIX = "";

/**
 *
 */
$app->post(buildPath($PREFIX, '/providers/gcp/authenticate'), function ($request, $response) {


    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get("GoogleCloudMetadataService");

    // reqd parameters
    $parsedBody = $request->getParsedBody();
    $logger->debug("Parsed body" . json_encode($parsedBody));

    $data = $service->authenticate($parsedBody);

    $logger->debug("Service request OK");

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, $data);


});


/**
 *
 */
$app->post(buildPath($PREFIX, '/providers/gcp/regions'), function ($request, $response) {


    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get("GoogleCloudMetadataService");

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
$app->post(buildPath($PREFIX, '/providers/gcp/zones'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get("GoogleCloudMetadataService");

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
$app->post(buildPath($PREFIX, '/providers/gcp/flavors'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get("GoogleCloudMetadataService");

    // reqd parameters
    $parsedBody = $request->getParsedBody();
    $logger->debug("Parsed body" . json_encode($parsedBody));

    // get flavors
    $data = $service->getFlavors($parsedBody);

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, $data);
});
