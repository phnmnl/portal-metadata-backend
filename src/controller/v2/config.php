<?php

// API version
$API_VERSION = "v2";

// Set up API URL prefix path
$container = $app->getContainer();

// register prefix for the API endpoint
$apiPathPrefix = $container->get('settings')['api']['path'] . '/' . $API_VERSION;

// reference to the global logger
$logger = $container->get("logger");

/**
 * Utility function which builds the absolute path for a given query.
 *
 * @param $prefix string path prefix of the query
 * @param $path string relative path of the query
 * @return string absolute path of the query (API Prefix + Query Prefix + Relative PATH)
 */
function buildPath($prefix, $path)
{
    global $apiPathPrefix, $logger;
//    $logger->info("PATH: " . $apiPathPrefix . $prefix . $path);
    return $apiPathPrefix . $prefix . $path;
}