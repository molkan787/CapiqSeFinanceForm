<?php

if($_SERVER['REQUEST_METHOD'] != 'POST'){ die(); }

require_once './generateFormPdf.php';
require_once './api.php';
require_once './emailSender.php';
require_once './sigingService.php';

$data = json_decode(file_get_contents('php://input'), true);

$accessToken = $data['uat'];
$offerId = $data['offerId'];
$units = $data['units'];
$userEmail = $data['e_post'];
$info = $data['info'];



$statusCode = subscribeToInvestmentProposal($accessToken, $offerId, $units);

if($statusCode == 'OK'){
    global $data;
    $output = generateFormPdf($data);
    $rnd = time() . generateRandomString(6);
    $filename = __DIR__ . '/../files/form_' . $rnd . '.pdf';
    // $filename = 'form.pdf';
    file_put_contents($filename, $output);
    // sendPdf($filename, $userEmail);
    // sendThankyouMessage($info, $userEmail);
}

respond(array(
    'statusCode' => $statusCode
));