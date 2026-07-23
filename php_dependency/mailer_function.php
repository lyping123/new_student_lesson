<?php 

use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';

function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPDebug = 0; // Enable debug output
    $mail->SMTPAuth = true;
    $mail->Username = 'lyping0526@gmail.com';
    $mail->Password = 'mkavuonupbpgfuse';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('lyping0526@gmail.com', 'Ly Ping');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;

    return $mail->send();
}
