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

$app->get($apiPathPrefix.'/metadata/{id}', function ($request, $response) {
    $id = $request->getAttribute('id');

    $service = new MetadataService();

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->get($id));

});



$app->post($apiPathPrefix.'/metadata', function ($request, $response) {

    $parsedBody = $request->getParsedBody();
    $service = new MetadataService();

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->create($parsedBody));
});



$app->put($apiPathPrefix.'/metadata', function ($request, $response) {
    $parsedBody = $request->getParsedBody();
    $service = new MetadataService();

    return $response->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->update($parsedBody));
});


$app->delete($apiPathPrefix.'/metadata/{id}', function ($request, $response) {
    $id = $request->getAttribute('id');

    $service = new MetadataService();

    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson($service->remove($id));
});