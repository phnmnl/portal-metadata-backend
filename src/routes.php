<?php

$container = $app->getContainer();

// Set up API URL prefix path
$apiPathPrefix = $container->get('settings')['api']['path'].'/'.$container->get('settings')['api']['version'];

// Default main page
$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Default Page '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

// Helper functions
require __DIR__ . '/../src/share/helper.php';

//require __DIR__ . '/../src/share/rateLimit.php';

// Register routes
require __DIR__ . '/../src/controller/InstitutionController.php';
require __DIR__ . '/../src/controller/ExhibitionController.php';
require __DIR__ . '/../src/controller/CulturalObjectController.php';
require __DIR__ . '/../src/controller/MediaObjectController.php';
require __DIR__ . '/../src/controller/AssociatedMediaObjectController.php';
require __DIR__ . '/../src/controller/CollectionController.php';
require __DIR__ . '/../src/controller/MetadataController.php';


