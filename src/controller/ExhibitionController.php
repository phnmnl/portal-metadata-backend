<?php
// Register routes
require __DIR__ . '/../service/ExhibitionService.php';

/**
 * @api {get} /exhibition/:Exid Request Exhibition information
 * @apiName GetExhibition
 * @apiGroup Exhibition
 *
 * @apiPermission none
 *
 * @apiParam {String} Exid Exhibition unique id.
 *
 * @apiSuccess {Integer} Exid the id of the Exhibition
 * @apiSuccess {String} Exhibitionname Name of the Exhibition
 * @apiSuccess {String} Objecttitle Object Title of the Exhibition
 * @apiSuccess {String} Culturalgroup Cultural Group of the Exhibition
 * @apiError 404 The <code>Exid</code> of the Exhibition was not found.
 */

$app->get($apiPathPrefix.'/exhibition/{Exid}', function ($request, $response) {
    $id = $request->getAttribute('Exid');

    $service = new ExhibitionService();

    return $response->withJson($service->get($id));
});

/**
 * @api {post} /exhibition Create a new Exhibition
 * @apiName  postExhibition
 * @apiGroup Exhibition
 *
 * @apiPermission authenticated users
 *
 * @apiParam {json} Exhibition pass key value pairs for Exhibition object in payload
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "Exhibition": {"Exid":43,"Exhibitionname":"Mende Song","Objecttitle":"Mende song","Culturalgroup":"Mende"}
 *     }
 *
 * @apiSuccess {Integer} Exid the id of the Exhibition
 * @apiSuccess {String} Exhibitionname Name of the Exhibition
 * @apiSuccess {String} Objecttitle Object Title of the Exhibition
 * @apiSuccess {String} Culturalgroup Cultural Group of the Exhibition
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 409 Duplicated <code>Exid</code>.
 */

$app->post($apiPathPrefix.'/exhibition', function ($request, $response) {

    $parsedBody = $request->getParsedBody();
    $service = new ExhibitionService();

    return $response->withJson($service->create($parsedBody));
});

/**
 * @api {put} /exhibition Update Exhibition information
 * @apiName putExhibition
 * @apiGroup Exhibition
 * @apiPermission authenticated users
 * @apiParam {json} Exhibition pass key value pairs for Exhibition object in payload
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *       "Exhibition": {"Exhibitionname":"British Library","Exhibitionurl":"http:\/\/www.bl.uk\/"}
 *     }
 *
 * @apiSuccess {Integer} Exid the id of the Exhibition
 * @apiSuccess {String} Exhibitionname Name of the Exhibition
 * @apiSuccess {String} Objecttitle Object Title of the Exhibition
 * @apiSuccess {String} Culturalgroup Cultural Group of the Exhibition
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 404 The <code>Exhibitionname</code> of the Exhibition was not found.
 */

$app->put($apiPathPrefix.'/exhibition', function ($request, $response) {
    $parsedBody = $request->getParsedBody();
    $service = new ExhibitionService();

    return $response->withJson($service->update($parsedBody));
});

/**
 * @api {delete} /exhibition/:Exid Delete Exhibition information
 * @apiName deleteExhibition
 * @apiGroup Exhibition
 * @apiPermission authenticated users
 * @apiParam {String} Exid Exhibition unique name.
 *
 * @apiSuccess {Integer} Exid the id of the Exhibition
 * @apiSuccess {String} Exhibitionname Name of the Exhibition
 * @apiSuccess {String} Objecttitle Object Title of the Exhibition
 * @apiSuccess {String} Culturalgroup Cultural Group of the Exhibition
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 404 The <code>Exhibitionname</code> of the Exhibition was not found.
 */

$app->delete($apiPathPrefix.'/exhibition/{Exid}', function ($request, $response) {
    $id = $request->getAttribute('Exid');

    $service = new ExhibitionService();

    return $response->withJson($service->remove($id));
});