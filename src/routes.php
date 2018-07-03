<?php

// Default main page
$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Default Page '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

// Helper functions
require_once __DIR__ . '/../src/share/helper.php';
require_once __DIR__ . '/../src/share/jenkinsReport.php';
require_once __DIR__ . '/../src/service/UserDeploymentsServiceException.php';
require_once __DIR__ . '/../src/service/ServiceException.php';
require_once __DIR__ . '/../src/service/ServiceAuthorizationException.php';
require_once __DIR__ . '/../src/controller/v2/APIControllerResponseHandler.php';

// Register routes
require __DIR__ . '/../src/controller/v2/APIController.php';