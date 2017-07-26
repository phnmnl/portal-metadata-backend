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


// Register routes
require __DIR__ . '/../src/controller/MetadataController.php';