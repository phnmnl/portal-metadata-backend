<?php
if(!isset($_SESSION))
{
    session_start();
}

if(!isset($_SESSION['REQUESTS']))
{
    $_SESSION['REQUESTS'] = 0;
}

if (isset($_SESSION['LAST_REQUEST']) && isset($_SESSION['REQUESTS'])) {
    $timeLimit = 5; // in seconds
    $totalRequest = 3;

    $request = ++$_SESSION['REQUESTS'];
    $last = strtotime($_SESSION['LAST_REQUEST']);
    $current = strtotime(date("Y-m-d h:i:s"));
    $time =  abs($last - $current);
    if ($time <= $timeLimit && $request >= $totalRequest) {

        header('Content-Type: application/json');
        $data = helper::getError(429, 'API request limit reached.');
        die(json_encode($data));
    }
    if ($time >= $timeLimit) {
        $_SESSION['REQUESTS'] = 0;
    }
}

$_SESSION['LAST_REQUEST'] = date("Y-m-d h:i:s");