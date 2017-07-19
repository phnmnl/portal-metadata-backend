<?php
// Register routes
require __DIR__ . '/../service/InstitutionService.php';

/**
 * @api {get} /institution/:Institutionname Request Institution information
 * @apiName GetInstitution
 * @apiGroup Institution
 *
 * @apiPermission none
 *
 * @apiParam {String} Institutionname Institution unique name.
 *
 * @apiSuccess {String} Institutionname Name of the Institution
 * @apiSuccess {String} Institutionurl URL of the Institution
 * @apiError 404 The <code>Institutionname</code> of the Institution was not found.
 */

$app->get($apiPathPrefix.'/institution/{Institutionname}', function ($request, $response) {
    $id = $request->getAttribute('Institutionname');

    $service = new InstitutionService();

    return $response->withJson($service->get($id));
});

/**
 * @api {post} /institution Create a new Institution
 * @apiName  postInstitution
 * @apiGroup Institution
 *
 * @apiPermission authenticated users
 *
 * @apiParam {json} Institution pass key value pairs for Institution object in payload
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *       "Institution": {"Institutionname":"British Library","Institutionurl":"http:\/\/www.bl.uk\/"}
 *     }
 *
 * @apiSuccess {String} Institutionname Name of the Institution
 * @apiSuccess {String} Institutionurl URL of the Institution
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 409 Duplicated <code>Institutionname</code>.
 */

$app->post($apiPathPrefix.'/institution', function ($request, $response) {

    $parsedBody = $request->getParsedBody();
    $service = new InstitutionService();

    return $response->withJson($service->create($parsedBody));
});

/**
 * @api {put} /institution/:Institutionname Update Institution information
 * @apiName putInstitution
 * @apiGroup Institution
 * @apiPermission authenticated users
 * @apiParam {json} Institution pass key value pairs for Institution object in payload
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *       "Institution": {"Institutionname":"British Library","Institutionurl":"http:\/\/www.bl.uk\/"}
 *     }
 *
 * @apiSuccess {String} Institutionname Name of the Institution
 * @apiSuccess {String} Institutionurl URL of the Institution
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 404 The <code>Institutionname</code> of the Institution was not found.
 */

$app->put($apiPathPrefix.'/institution', function ($request, $response) {
    $parsedBody = $request->getParsedBody();
    $service = new InstitutionService();

    return $response->withJson($service->update($parsedBody));
});

/**
 * @api {delete} /institution/:Institutionname Delete Institution information
 * @apiName deleteInstitution
 * @apiGroup Institution
 * @apiPermission authenticated users
 * @apiParam {String} Institutionname Institution unique name.
 *
 * @apiSuccess {String} Institutionname Name of the Institution
 * @apiSuccess {String} Institutionurl URL of the Institution
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 404 The <code>Institutionname</code> of the Institution was not found.
 */

$app->delete($apiPathPrefix.'/institution/{Institutionname}', function ($request, $response) {
    $id = $request->getAttribute('Institutionname');

    $service = new InstitutionService();

    return $response->withJson($service->remove($id));
});