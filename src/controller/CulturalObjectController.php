<?php
// Register routes
require __DIR__ . '/../service/CulturalObjectService.php';

/**
 * @api {get} /culturalobject/:Coid Request CulturalObject information
 * @apiName GetCulturalObject
 * @apiGroup CulturalObject
 *
 * @apiPermission none
 *
 * @apiParam {String} Coid CulturalObject unique id.
 *
 * @apiSuccess {Integer} Coid the id of the CulturalObject
 * @apiSuccess {String} AccessionNumber Accession number of the CulturalObject
 * @apiSuccess {String} ObjectType Type of the CulturalObject
 * @apiSuccess {String} Object Object of the CulturalObject
 * @apiSuccess {String} Description Description of the CulturalObject
 * @apiSuccess {String} Materials Materials of the CulturalObject
 * @apiSuccess {String} CulturalGroup Cultural Group of the CulturalObject
 * @apiSuccess {String} Dimensions Dimensions of the CulturalObject
 * @apiSuccess {String} ProductionDate Production Date of the CulturalObject
 * @apiSuccess {String} AssociatedPlaces Associated Places of the CulturalObject
 * @apiSuccess {String} AssociatedPeople Associated People of the CulturalObject
 * @apiSuccess {String} FkIid Institution Name where the CulturalObject belongs to
 * @apiSuccess {Integer} FkExid Exhibition Id of the CulturalObject
 * @apiError 404 The <code>Coid</code> of the CulturalObject was not found.
 */

$app->get($apiPathPrefix.'/culturalobject/{Coid}', function ($request, $response) {
    $id = $request->getAttribute('Coid');

    $service = new CulturalObjectService();

    return $response->withJson($service->get($id));
});

/**
 * @api {post} /culturalobject Create a new CulturalObject
 * @apiName  postCulturalObject
 * @apiGroup CulturalObject
 *
 * @apiPermission authenticated users
 *
 * @apiParam {json} CulturalObject pass key value pairs for CulturalObject object in payload
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "CulturalObject": {"Accessionnumber":"SLNM.1946.01.02","Objecttype":"Masks, headdresses","Object":"Sowei Mask","Description":"Carved wooden helmet mask used by the exclusively female Sande (Mende)  or  Bondo\/Bundu (Temne) societies. The mask is traditionally worn by a high-ranking member of the society, the  dancing sowei , known as the  ndoli jowei  among the Mende or  a-Nowo  among the Temne. Worn with a raffia costume, the masks typically have a polished black finish, with neck rings, elaborate coiffure and dignified facial expression. The mask is thought to represent conceptions of idealised womanhood. This example resembles Sherbro-Bullom types, from the turn of the 20th century. It has a high vertical forehead, and a chequered hairstyle.","Materials":"Wood","Culturalgroup":"Unknown","Dimensions":"Unknown","Productiondate":"Pre 1946","Associatedplaces":"Unknown","Associatedpeople":"Unknown","FkIid":"Sierra Leone National Museum","FkExid":1}
 *     }
 *
 * @apiSuccess {Integer} Coid the id of the CulturalObject
 * @apiSuccess {String} AccessionNumber Accession number of the CulturalObject
 * @apiSuccess {String} ObjectType Type of the CulturalObject
 * @apiSuccess {String} Object Object of the CulturalObject
 * @apiSuccess {String} Description Description of the CulturalObject
 * @apiSuccess {String} Materials Materials of the CulturalObject
 * @apiSuccess {String} CulturalGroup Cultural Group of the CulturalObject
 * @apiSuccess {String} Dimensions Dimensions of the CulturalObject
 * @apiSuccess {String} ProductionDate Production Date of the CulturalObject
 * @apiSuccess {String} AssociatedPlaces Associated Places of the CulturalObject
 * @apiSuccess {String} AssociatedPeople Associated People of the CulturalObject
 * @apiSuccess {String} FkIid Institution Name where the CulturalObject belongs to
 * @apiSuccess {Integer} FkExid Exhibition Id of the CulturalObject
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 409 Duplicated <code>Coid</code>.
 */

$app->post($apiPathPrefix.'/culturalobject', function ($request, $response) {

    $parsedBody = $request->getParsedBody();
    $service = new CulturalObjectService();

    return $response->withJson($service->create($parsedBody));
});

/**
 * @api {put} /culturalobject Update CulturalObject information
 * @apiName putCulturalObject
 * @apiGroup CulturalObject
 * @apiPermission authenticated users
 * @apiParam {json} CulturalObject pass key value pairs for CulturalObject object in payload
 *
 * @apiParamExample {json} Request-Example:
 *     {
 *          "CulturalObject": {"Coid":66666,"Accessionnumber":"SLNM.1946.01.02","Objecttype":"Masks, headdresses","Object":"Sowei Mask","Description":"Carved wooden helmet mask used by the exclusively female Sande (Mende)  or  Bondo\/Bundu (Temne) societies. The mask is traditionally worn by a high-ranking member of the society, the  dancing sowei , known as the  ndoli jowei  among the Mende or  a-Nowo  among the Temne. Worn with a raffia costume, the masks typically have a polished black finish, with neck rings, elaborate coiffure and dignified facial expression. The mask is thought to represent conceptions of idealised womanhood. This example resembles Sherbro-Bullom types, from the turn of the 20th century. It has a high vertical forehead, and a chequered hairstyle.","Materials":"Wood","Culturalgroup":"Unknown","Dimensions":"Unknown","Productiondate":"Pre 1946","Associatedplaces":"Unknown","Associatedpeople":"Unknown","FkIid":"Sierra Leone National Museum","FkExid":1}
 *     }
 *
 * @apiSuccess {Integer} Coid the id of the CulturalObject
 * @apiSuccess {String} AccessionNumber Accession number of the CulturalObject
 * @apiSuccess {String} ObjectType Type of the CulturalObject
 * @apiSuccess {String} Object Object of the CulturalObject
 * @apiSuccess {String} Description Description of the CulturalObject
 * @apiSuccess {String} Materials Materials of the CulturalObject
 * @apiSuccess {String} CulturalGroup Cultural Group of the CulturalObject
 * @apiSuccess {String} Dimensions Dimensions of the CulturalObject
 * @apiSuccess {String} ProductionDate Production Date of the CulturalObject
 * @apiSuccess {String} AssociatedPlaces Associated Places of the CulturalObject
 * @apiSuccess {String} AssociatedPeople Associated People of the CulturalObject
 * @apiSuccess {String} FkIid Institution Name where the CulturalObject belongs to
 * @apiSuccess {Integer} FkExid Exhibition Id of the CulturalObject
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 404 The <code>Coid</code> of the CulturalObject was not found.
 */

$app->put($apiPathPrefix.'/culturalobject', function ($request, $response) {
    $parsedBody = $request->getParsedBody();
    $service = new CulturalObjectService();

    return $response->withJson($service->update($parsedBody));
});

/**
 * @api {delete} /culturalobject/:Coid Delete CulturalObject information
 * @apiName deleteCulturalObject
 * @apiGroup CulturalObject
 * @apiPermission authenticated users
 * @apiParam {String} Coid CulturalObject unique name.
 *
 * @apiSuccess {Integer} Coid the id of the CulturalObject
 * @apiSuccess {String} AccessionNumber Accession number of the CulturalObject
 * @apiSuccess {String} ObjectType Type of the CulturalObject
 * @apiSuccess {String} Object Object of the CulturalObject
 * @apiSuccess {String} Description Description of the CulturalObject
 * @apiSuccess {String} Materials Materials of the CulturalObject
 * @apiSuccess {String} CulturalGroup Cultural Group of the CulturalObject
 * @apiSuccess {String} Dimensions Dimensions of the CulturalObject
 * @apiSuccess {String} ProductionDate Production Date of the CulturalObject
 * @apiSuccess {String} AssociatedPlaces Associated Places of the CulturalObject
 * @apiSuccess {String} AssociatedPeople Associated People of the CulturalObject
 * @apiSuccess {String} FkIid Institution Name where the CulturalObject belongs to
 * @apiSuccess {Integer} FkExid Exhibition Id of the CulturalObject
 * @apiError 401 Only authenticated users can access the data.
 * @apiError 404 The <code>Coid</code> of the CulturalObject was not found.
 */

$app->delete($apiPathPrefix.'/culturalobject/{Coid}', function ($request, $response) {
    $id = $request->getAttribute('Coid');

    $service = new CulturalObjectService();

    return $response->withJson($service->remove($id));
});