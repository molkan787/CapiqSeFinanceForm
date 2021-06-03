<?php

if($_SERVER['REQUEST_METHOD'] != 'POST'){ die(); }

require_once './generateFormPdf.php';
require_once './api.php';
require_once './emailSender.php';

$data = json_decode(file_get_contents('php://input'), true);

$output = generateFormPdf($data);
$rnd = time() . generateRandomString(6);
// $filename = __DIR__ . '/../files/form_' . $rnd . '.pdf';
$filename = 'form.pdf';
file_put_contents($filename, $output);

// sendPdf($filename, $data['e_post']);

respond(array());