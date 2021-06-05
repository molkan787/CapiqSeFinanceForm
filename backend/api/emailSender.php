<?php
require_once '../vendor/autoload.php';
require_once './textService.php';

use PHPMailer\PHPMailer\PHPMailer;


function sendPdf($pdfFilename, $replyTo){
    $mail = new PHPMailer(true);
    $mail->setFrom('invest@capiq.se', 'Capiq.se');
    $mail->addAddress('invest@capiq.se');
    $mail->addReplyTo($replyTo);

    $mail->addAttachment($pdfFilename, 'form.pdf');

    $mail->Subject = 'New Form Submited';
    $mail->Body    = 'The form is attached as PDF file';
    $mail->AltBody = 'The form is attached as PDF file';

    $mail->send();
}

function sendThankyouMessage($info, $userEmail){
    global $settings;
    $message = getThankyouMessage($info, $settings['payment_account_number']);
    $mail = new PHPMailer(true);
    $mail->setFrom('invest@capiq.se', 'Capiq.se');
    $mail->addAddress($userEmail);
    $mail->addReplyTo('invest@capiq.se');
    
    $mail->Subject = 'Thank you for your interest in our shares';
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();
}