<?php
// include API configuration
require_once __DIR__ . '/config.php';
// include required service
require_once __DIR__ . '/../../service/StatisticsService.php';

// API endpoint prefix
$PREFIX = "/statistics";


/**
 *
 */
$app->get(buildPath($PREFIX, '/jenkins-report'), function ($request, $response) {

    $service = $this->get('StatisticsService');

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->getJenkinsReport());

});

/**
 *
 */
$app->get(buildPath($PREFIX, '/google-key'), function ($request, $response) {

    $service = $this->get('StatisticsService');

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->getGoogleKey());

});


/**
 *
 */
$app->get(buildPath($PREFIX, '/test'), function ($request, $response) {

    $service = $this->get('StatisticsService');

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson(array("prova" => "ok"));

});


/**
 * Add a new user
 */
$app->post(buildPath($PREFIX, '/users'), function ($request, $response) {

    $logger = $this->get('logger');

    $parsedBody = $request->getParsedBody();
    $logger->info("Parsed body", $parsedBody);
    $service = $this->get('StatisticsService');

    $data = $service->createUser($parsedBody);

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($data);
});


/**
 * Add a new user
 */
$app->delete(buildPath($PREFIX, '/users/{id}'), function ($request, $response) {

    $logger = $this->get('logger');

    $id = $request->getAttribute('id');
    $logger->debug("ID of the user to delete: " . $id);

    $service = $this->get('StatisticsService');
    $result = $service->deleteUser($id);
    $logger->debug("Result: " . json_encode($result));

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($result);
});


/**
 * Update an existing user
 */
$app->put(buildPath($PREFIX, '/users/{id}'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get('StatisticsService');

    $logger->debug("Function update from the controller....");

    // reqd parameters
    $id = $request->getAttribute('id');
    $parsedBody = $request->getParsedBody();
    $logger->debug("ID of the user to delete: " . $id);
    $logger->debug("Parsed body", $parsedBody);

    // update
    $data = $service->updateUser($id, $parsedBody);

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($data);
});


$app->get(buildPath($PREFIX, '/users/{id}/deployments'), function ($request, $response) {

    $logger = $this->get('logger');
    $service = $this->get('StatisticsService');

    // reqd parameters
    $id = $request->getAttribute('id');
    $logger->debug("ID of the user: " . $id);

    $data = $service->getUserDeployments($id);
    $logger->debug("Result: " . json_encode($data));

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($data);
});

$app->get(buildPath($PREFIX, '/users/{id}/deployments/{reference}'), function ($request, $response) {

    $logger = $this->get('logger');
    $service = $this->get('StatisticsService');

    // reqd parameters
    $id = $request->getAttribute('id');
    $reference = $request->getAttribute('reference');
    $logger->debug("User ID: " . $id);
    $logger->debug("Deployment Reference: " . $reference);

    $data = $service->getUserDeployment($id, $reference);
    $logger->debug("Result: " . json_encode($data));

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($data);
});


/**
 * Add a new deployment
 */
$app->post(buildPath($PREFIX, '/users/{id}/deployments'), function ($request, $response) {

    $logger = $this->get('logger');
    $service = $this->get('StatisticsService');

    // reqd parameters
    $id = $request->getAttribute('id');
    $parsedBody = $request->getParsedBody();
    $logger->debug("ID of the user to delete: " . $id);
    $logger->debug("Parsed body", $parsedBody);


    $data = $service->createDeployment($id, $parsedBody);

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($data);
});


$app->put(buildPath($PREFIX, '/users/{id}/deployments/{reference}'), function ($request, $response) {

    // get the logger
    $logger = $this->get('logger');
    // get the service
    $service = $this->get('StatisticsService');

    $logger->debug("Function update from the controller....");

    // reqd parameters
    $id = $request->getAttribute('id');
    $reference = $request->getAttribute('reference');
    $parsedBody = $request->getParsedBody();
    $logger->debug("ID of the deployment user: " . $id);
    $logger->debug("ID of the deployment: " . $reference);
    $logger->debug("Parsed body", $parsedBody);

    // update
    $data = $service->updateDeployment($id, $reference, $parsedBody);

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($data);
});


/**
 * Add a new user
 */
$app->delete(buildPath($PREFIX, '/users/{id}/deployments/{reference}'), function ($request, $response) {

    $logger = $this->get('logger');

    $id = $request->getAttribute('id');
    $reference = $request->getAttribute('reference');
    $logger->debug("ID of the deployment user: " . $id);
    $logger->debug("ID of the deployment: " . $reference);

    $service = $this->get('StatisticsService');
    $result = $service->deleteDeployment($id, $reference);
    $logger->debug("Result: " . json_encode($result));

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($result);
});