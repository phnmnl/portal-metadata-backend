<?php
// Register routes
require __DIR__ . '/../service/AssociatedMediaObjectService.php';

/**
 * @api {get} /associatedmediaobject/:Amoid Request AssociatedMediaObject information
 * @apiName GetAssociatedMediaObject
 * @apiGroup AssociatedMediaObject
 *
 * @apiPermission none
 *
 * @apiParam {String} Amoid AssociatedMediaObject unique id.
 *
 * @apiSuccess {Integer} Amoid the id of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaFileName  File name of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaTitle  Title of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaDescription Description of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaType Type of the AssociatedMediaObject
 * @apiSuccess {String} FkCoid Cultural Object Id where the AssociatedMediaObject belongs to
 * @apiError 404 The <code>Amoid</code> of the AssociatedMediaObject was not found.
 */

$app->get($apiPathPrefix.'/associatedmediaobject/{Amoid}', function ($request, $response) {
    $id = $request->getAttribute('Amoid');

    $service = new AssociatedMediaObjectService();

    return $response->withJson($service->get($id));
});

/**
 * @api {post} /associatedmediaobject Create a new AssociatedMediaObject
 * @apiName  postAssociatedMediaObject
 * @apiGroup AssociatedMediaObject
 *
 * @apiPermission authenticated users
 *
 * @apiParam {json} AssociatedMediaObject pass key value pairs for AssociatedMediaObject object in payload
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "AssociatedMediaObject": {"Associatedmediafilename":"Sowrrrei","Associatedmediatitle":"No Data","Associatedmediadescription":"No Data","Associatedmediatype":"Video","FkCoid":1}
 *     }
 *
 * @apiSuccess {Integer} Amoid the id of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaFileName  File name of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaTitle  Title of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaDescription Description of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaType Type of the AssociatedMediaObject
 * @apiSuccess {String} FkCoid Cultural Object Id where the AssociatedMediaObject belongs to
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 409 Duplicated <code>Amoid</code>.
 */

$app->post($apiPathPrefix.'/associatedmediaobject', function ($request, $response) {

    $parsedBody = $request->getParsedBody();
    $service = new AssociatedMediaObjectService();

    return $response->withJson($service->create($parsedBody));
});

/**
 * @api {put} /associatedmediaobject Update AssociatedMediaObject information
 * @apiName putAssociatedMediaObject
 * @apiGroup AssociatedMediaObject
 * @apiPermission authenticated users
 * @apiParam {json} AssociatedMediaObject pass key value pairs for AssociatedMediaObject object in payload
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "AssociatedMediaObject": {"Amoid":14369,"Associatedmediafilename":"Sowrrrei","Associatedmediatitle":"No Data","Associatedmediadescription":"No Data","Associatedmediatype":"Video","FkCoid":1}
 *     }
 *
 * @apiSuccess {Integer} Amoid the id of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaFileName  File name of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaTitle  Title of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaDescription Description of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaType Type of the AssociatedMediaObject
 * @apiSuccess {String} FkCoid Cultural Object Id where the AssociatedMediaObject belongs to
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 404 The <code>Amoid</code> of the AssociatedMediaObject was not found.
 */

$app->put($apiPathPrefix.'/associatedmediaobject', function ($request, $response) {
    $parsedBody = $request->getParsedBody();
    $service = new AssociatedMediaObjectService();

    return $response->withJson($service->update($parsedBody));
});

/**
 * @api {delete} /associatedmediaobject/:Amoid Delete AssociatedMediaObject information
 * @apiName deleteAssociatedMediaObject
 * @apiGroup AssociatedMediaObject
 * @apiPermission authenticated users
 * @apiParam {String} Amoid AssociatedMediaObject unique name.
 *
 * @apiSuccess {Integer} Amoid the id of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaFileName  File name of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaTitle  Title of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaDescription Description of the AssociatedMediaObject
 * @apiSuccess {String} AssociatedMediaType Type of the AssociatedMediaObject
 * @apiSuccess {String} FkCoid Cultural Object Id where the AssociatedMediaObject belongs to
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 404 The <code>Amoid</code> of the AssociatedMediaObject was not found.
 */

$app->delete($apiPathPrefix.'/associatedmediaobject/{Amoid}', function ($request, $response) {
    $id = $request->getAttribute('Amoid');

    $service = new AssociatedMediaObjectService();

    return $response->withJson($service->remove($id));
});