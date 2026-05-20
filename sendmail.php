<?php 
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPDebug = 2; // Enable debug output
    $mail->SMTPAuth = true;
    $mail->Username = 'lyping0526@gmail.com';
    $mail->Password = 'mkavuonupbpgfuse';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('lyping0526@gmail.com', 'Ly Ping');
    $mail->addAddress($email);
    $mail->Subject = 'Business Proposal';
    $mail->Body = ' Dear Sir/Madam, asdasdasfaijhasudhuhuahugduyagdgaysgd';
    if($mail->send()) {
        echo 'Email sent successfully';
    } else {
        echo 'Email sending failed: ' . $mail->ErrorInfo;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Send Mail</h1>
<form action="sendmail.php" method="post">
    <input type="text" name="email" id="email" placeholder="Enter email">
    <button type="submit">Send Mail</button>
</form>
    
</body>
</html>