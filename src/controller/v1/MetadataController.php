<?php
// Register routes
require __DIR__ . '/../service/MetadataService.php';

/**
 * @api {get} /metadata Request Metadata information
 * @apiName GetMetadata
 * @apiGroup Metadata
 *
 * @apiPermission none
 *
 * @apiParam {String} [id] Id of metadata
 *
 * @apiSuccess {Id} Id of metadata
 * @apiSuccess {Boolean} Is Term and Condition agreed?
 */

$app->get($apiPathPrefix . '/metadata/getJenkinsReport', function ($request, $response) {

    $service = $this->get('StatisticsService');

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->getJenkinsReport());

});

$app->get($apiPathPrefix . '/metadata/getGoogleKey', function ($request, $response) {

    $service = $this->get('StatisticsService');

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->getGoogleKey());

});

$app->get(/**
 * @param $request
 * @param $response
 * @return mixed
 */
    $apiPathPrefix . '/metadata', function ($request, $response) {
    $query = $request->getQueryParams();

    $logger = $this->get("logger");
    $logger->debug("Query: " . json_encode($query));

    $service = $this->get('StatisticsService');

    $data = null;
    if(isset($query["id"]))
        $data = $service->findById($query["id"]);
    elseif(isset($query["ids"]))
        $data = $service->findByIds(explode(",", $query["ids"]));
    else
        $data = $service->find($query);

    if(empty($data))
        $data = false;

    $logger->debug("The result: " . json_encode($data));

    return $response
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withJson($data);
});


$app->get($apiPathPrefix . '/metadata/{id}', function ($request, $response) {
    $id = $request->getAttribute('id');

    $service = $this->get('StatisticsService');

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->get($id));

});

$app->post($apiPathPrefix . '/metadata/createGalaxyUser', function ($request, $response) {

    $parsedBody = $request->getParsedBody();
    $service = $this->get('StatisticsService');
    return $response->withJson($service->createGalaxyUser($parsedBody));

});

$app->post($apiPathPrefix . '/metadata', function ($request, $response) {

    $parsedBody = $request->getParsedBody();
    $service = $this->get('StatisticsService');

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->create($parsedBody));
});


$app->put($apiPathPrefix . '/metadata', function ($request, $response) {
    $parsedBody = $request->getParsedBody();
    $service = $this->get('StatisticsService');

    return $response->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->update($parsedBody));
});


$app->delete($apiPathPrefix . '/metadata/{id}', function ($request, $response) {
    $id = $request->getAttribute('id');

    $service = $this->get('StatisticsService');

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->remove($id));
});