<?php
//require __DIR__ . '/../share/rateLimit.php';

// Register routes
require __DIR__ . '/../service/CollectionService.php';

/**
 * @api {get} /collection Request Collection information
 * @apiName GetCollection
 * @apiGroup Collection
 *
 * @apiPermission none
 *
 * @apiParam {String} [type] Filter by Object Type
 * @apiParam {String} [material] Filter by Materials
 * @apiParam {String} [institution] Filter by Institution
 * @apiParam {String} [group] Filter by Culture group
 * @apiParam {String} [keyword] Filter by Keyword
 * @apiParam {String} [exhibition] Filter by Exhibition Id
 *
 * @apiSuccess {Integer} Size Size of the collection
 * @apiSuccess {Array} Collection A collection of culturalobjects
 */

$app->get($apiPathPrefix.'/collection', function ($request, $response) {

    $queryArray = $request->getQueryParams();

    $service = new CollectionService();

    return $response->withJson($service->filterBy($queryArray));
});

/**
 * @api {get} /collection/:Coid/mediaobject Request mediaobject information based on Coid
 * @apiName GetMediaObjectByCoid
 * @apiGroup Collection
 *
 * @apiPermission none
 *
 * @apiParam {String} Coid Filter by Coid
 *
 * @apiSuccess {Integer} Size Size of the collection
 * @apiSuccess {Array} Collection A collection of mediaobject
 */
$app->get($apiPathPrefix.'/collection/{Coid}/mediaobject', function ($request, $response) {

    $id = $request->getAttribute('Coid');

    $service = new CollectionService();

    return $response->withJson($service->getMediaObjectByCoid($id));
});

/**
 * @api {get} /collection/:Coid/associatedmediaobject Request associatedmediaobject information based on Coid
 * @apiName GetAssociatedMediaObjectByCoid
 * @apiGroup Collection
 *
 * @apiPermission none
 *
 * @apiParam {String} Coid Filter by Coid
 *
 * @apiSuccess {Integer} Size Size of the collection
 * @apiSuccess {Array} Collection A collection of associatedmediaobject
 */
$app->get($apiPathPrefix.'/collection/{Coid}/associatedmediaobject', function ($request, $response) {

    $id = $request->getAttribute('Coid');

    $service = new CollectionService();

    return $response->withJson($service->getAssociatedMediaObjectByCoid($id));
});