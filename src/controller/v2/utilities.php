<?php


/** Utility functions to update the URL to get provider logos */
function updatePaths($data)
{
    foreach ($data as &$datum) {
        updatePath($datum);
    }
    return $data;
}

function updatePath(&$datum)
{
    global $app;
    $datum["logo"]["path"] = $app->getContainer()->get('settings')["api"]["path"] . "/v2/providers/catalog/" . $datum['id'] . "/logo";
    return $datum;
}