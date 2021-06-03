<?php
$ALLOWED_IP = '';
$clientIp = $_SERVER['REMOTE_ADDR'];
if($clientIp != $ALLOWED_IP && false){
    http_response_code(401);
    die('Unauthorized');
    return;
}

$method = $_SERVER['REQUEST_METHOD'];
if($method != 'GET' && $method != 'POST') die();

require_once './settings.php';
require_once './helpers.php';

if($method == 'GET'){
    $settings = getSettings();
    respond($settings);
}else if($method == 'POST'){
    $data = json_decode(file_get_contents('php://input'), true);
    putSettings($data);
    respond(array());
}