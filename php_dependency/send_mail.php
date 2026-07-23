<?php 
use PHPMailer\PHPMailer\PHPMailer;
require '../vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Set headers
    $headers = "From: admin";
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
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;
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
    <h1>Send Email</h1>
    <form action="send_mail.php" method="post">
        <label for="to">To:</label>
        <input type="email" id="to" name="to" required><br><br>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required><br><br>

        <label for="message">Message:</label>
        <textarea id="message" cols="40" rows="10" name="message" required></textarea><br><br>

        <input type="submit" value="Send Email">
    </form>
</body>
</html>