<?php
// Register routes
require __DIR__ . '/../service/MediaObjectService.php';

/**
 * @api {get} /mediaobject/:Moid Request MediaObject information
 * @apiName GetMediaObject
 * @apiGroup MediaObject
 *
 * @apiPermission none
 *
 * @apiParam {String} Moid MediaObject unique id.
 *
 * @apiSuccess {Integer} Moid the id of the MediaObject
 * @apiSuccess {String} MediaFileName  File name of the MediaObject
 * @apiSuccess {String} MediaTitle  Title of the MediaObject
 * @apiSuccess {String} MediaDescription Description of the MediaObject
 * @apiSuccess {String} MediaType Type of the MediaObject
 * @apiSuccess {String} FkCoid Cultural Object Id where the MediaObject belongs to
 * @apiError 404 The <code>Moid</code> of the MediaObject was not found.
 */

$app->get($apiPathPrefix.'/mediaobject/{Moid}', function ($request, $response) {
    $id = $request->getAttribute('Moid');

    $service = new MediaObjectService();

    return $response->withJson($service->get($id));
});

/**
 * @api {post} /mediaobject Create a new MediaObject
 * @apiName  postMediaObject
 * @apiGroup MediaObject
 *
 * @apiPermission authenticated users
 *
 * @apiParam {json} MediaObject pass key value pairs for MediaObject object in payload
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "MediaObject": {"Mediafilename":"SLNM.1946.01.02.pic1","Mediatitle":"No Data","Mediadescription":"No Data","Mediatype":"Image","FkCoid":1}
 *     }
 *
 * @apiSuccess {Integer} Moid the id of the MediaObject
 * @apiSuccess {String} MediaFileName  File name of the MediaObject
 * @apiSuccess {String} MediaTitle  Title of the MediaObject
 * @apiSuccess {String} MediaDescription Description of the MediaObject
 * @apiSuccess {String} MediaType Type of the MediaObject
 * @apiSuccess {String} FkCoid Cultural Object Id where the MediaObject belongs to
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 409 Duplicated <code>Moid</code>.
 */

$app->post($apiPathPrefix.'/mediaobject', function ($request, $response) {

    $parsedBody = $request->getParsedBody();
    $service = new MediaObjectService();

    return $response->withJson($service->create($parsedBody));
});

/**
 * @api {put} /mediaobject Update MediaObject information
 * @apiName putMediaObject
 * @apiGroup MediaObject
 * @apiPermission authenticated users
 * @apiParam {json} MediaObject pass key value pairs for MediaObject object in payload
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "MediaObject": {"Moid": 14370,"Mediafilename": "SLNM.1946.01.02.pic1","Mediatitle": "No Data","Mediadescription": "No Data","Mediatype": "Image","FkCoid": 1}
 *     }
 *
 * @apiSuccess {Integer} Moid the id of the MediaObject
 * @apiSuccess {String} MediaFileName  File name of the MediaObject
 * @apiSuccess {String} MediaTitle  Title of the MediaObject
 * @apiSuccess {String} MediaDescription Description of the MediaObject
 * @apiSuccess {String} MediaType Type of the MediaObject
 * @apiSuccess {String} FkCoid Cultural Object Id where the MediaObject belongs to
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 404 The <code>Moid</code> of the MediaObject was not found.
 */

$app->put($apiPathPrefix.'/mediaobject', function ($request, $response) {
    $parsedBody = $request->getParsedBody();
    $service = new MediaObjectService();

    return $response->withJson($service->update($parsedBody));
});

/**
 * @api {delete} /mediaobject/:Moid Delete MediaObject information
 * @apiName deleteMediaObject
 * @apiGroup MediaObject
 * @apiPermission authenticated users
 * @apiParam {String} Moid MediaObject unique name.
 *
 * @apiSuccess {Integer} Moid the id of the MediaObject
 * @apiSuccess {String} MediaFileName  File name of the MediaObject
 * @apiSuccess {String} MediaTitle  Title of the MediaObject
 * @apiSuccess {String} MediaDescription Description of the MediaObject
 * @apiSuccess {String} MediaType Type of the MediaObject
 * @apiSuccess {String} FkCoid Cultural Object Id where the MediaObject belongs to
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 404 The <code>Moid</code> of the MediaObject was not found.
 */

$app->delete($apiPathPrefix.'/mediaobject/{Moid}', function ($request, $response) {
    $id = $request->getAttribute('Moid');

    $service = new MediaObjectService();

    return $response->withJson($service->remove($id));
});