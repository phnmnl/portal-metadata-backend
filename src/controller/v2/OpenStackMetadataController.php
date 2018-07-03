<?php

// include required service
require_once __DIR__ . '/../../service/OpenStackMetadataService.php';

// API endpoint prefix
$PREFIX = "";

/**
 *
 */
$app->post(buildPath($PREFIX, '/providers/openstack/authenticate'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get('OpenStackMetadataService');

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
$app->post(buildPath($PREFIX, '/providers/openstack/flavors'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get('OpenStackMetadataService');

    // reqd parameters
    $parsedBody = $request->getParsedBody();
    $logger->debug("Parsed body" . json_encode($parsedBody));

    $authenticationToken = $service->authenticate($parsedBody);

    $token = $authenticationToken["authToken"];
    $logger->debug("Token param: " . $token);

    $data = $service->getFlavors($authenticationToken);

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, $data);
});


/**
 *
 */
$app->post(buildPath($PREFIX, '/providers/openstack/external-networks'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get('OpenStackMetadataService');

    // reqd parameters
    $parsedBody = $request->getParsedBody();
    $logger->debug("Parsed body" . json_encode($parsedBody));

    $authenticationToken = $service->authenticate($parsedBody);

    $token = $authenticationToken["authToken"];
    $logger->debug("Token param: " . $token);

    $data = $service->getExternalNetworks($authenticationToken);

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, $data);
});


/**
 *
 */
$app->post(buildPath($PREFIX, '/providers/openstack/ip-pools'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get('OpenStackMetadataService');

    // reqd parameters
    $parsedBody = $request->getParsedBody();
    $logger->debug("Parsed body" . json_encode($parsedBody));

    $authenticationToken = $service->authenticate($parsedBody);

    $token = $authenticationToken["authToken"];
    $logger->debug("Token param: " . $token);

    $data = $service->getIpPools($authenticationToken);

    // prepare response object
    return APIControllerResponseHandler::handleResponse($response, $data);
});