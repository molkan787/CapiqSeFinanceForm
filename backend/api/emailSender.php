<?php
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;


function sendPdf($pdfFilename, $replyTo){
    $mail = new PHPMailer(true);
    $mail->setFrom('invest@capiq.se', 'Capiq.se');
    // $mail->addAddress('invest@capiq.se');
    $mail->addAddress('worw787@gmail.com');
    $mail->addReplyTo($replyTo);

    $mail->addAttachment($pdfFilename, 'form.pdf');

    $mail->Subject = 'New Form Submited';
    $mail->Body    = 'The form is attached as PDF file';
    $mail->AltBody = 'The form is attached as PDF file';

    $mail->send();
}