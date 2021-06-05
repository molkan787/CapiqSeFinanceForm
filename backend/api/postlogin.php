<?php

session_start();

require_once './api.php';
require_once './sigingService.php';

$status = $_GET['status'];
$code = $_GET['code'];
$internalRedirect = urldecode($_GET['internalRedirect']);

if($status == 'accepted'){
    $data = authenticateWithAuthorizationCode($code);
    $accessToken = $data->accessToken;
    // $name = $data->me->name;
    // $name = urlencode(base64_encode($name));
    $_SESSION['user_accessToken'] = $accessToken;
    header('location: ' . $internalRedirect . '&status=done&uat=' . $accessToken);
    return;
}

header('location: ' . $internalRedirect . '&status=declined_or_error');