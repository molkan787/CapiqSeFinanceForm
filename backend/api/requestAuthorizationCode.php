<?php

if($_SERVER['REQUEST_METHOD'] != 'POST'){ die(); }

require_once './api.php';
require_once './sigingService.php';

$data = json_decode(file_get_contents('php://input'), true);
$internalRedirect = $data['internalRedirect'];

$loginUrl = requestAuthorizationCode($internalRedirect);

respond(array(
    'loginUrl' => $loginUrl
));