<?php

// include sub routes
require __DIR__ . '/OpenStackMetadataController.php';
require __DIR__ . '/GoogleCloudMetadataController.php';
require __DIR__ . '/AwsMetadataController.php';

// API endpoint prefix
$PREFIX = "";

$app->get(buildPath($PREFIX, '/providers'), function ($request, $response) {
    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withJson(array("providers" => ["aws", "openstack", "gpc"]));
});
