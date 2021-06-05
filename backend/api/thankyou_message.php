<?php

if($_SERVER['REQUEST_METHOD'] != 'POST'){ die(); }

require_once './settings.php';
require_once './textService.php';

$data = json_decode(file_get_contents('php://input'), true);

$settings = getSettings();
$accNum = $settings['payment_account_number'];
$textHTML = getThankyouMessage($data, $accNum);

echo $textHTML;