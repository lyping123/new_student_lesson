<?php 
include 'db.php';
require_once '../vendor/autoload.php';

use chillerlan\QRCode\QRCode;

if(isset($_POST["generate_qr"])){
    
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $datestart = $_POST['datestart'];
    $token = bin2hex(random_bytes(32));

    $qrCodeData="http://localhost:8080/visitor.php?token=" . $token;
    $qrcode=(new QRCode)->render($qrCodeData, './visitor_qr.svg');

    $qry=$conn->prepare("INSERT INTO visitor(username, contact_number, checkin_date, token) VALUES (?, ?, ?, ?)");
    $qry->bind_param("ssss", $username, $contact, $datestart, $token);
    $qry->execute();
    if($qry->affected_rows > 0) {
        echo "Visitor added successfully.";
        header("Location: visitor.php");
    } else {
        echo "Error adding visitor: " . $qry->error;
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
    <form action="add_visitor.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="plate">Contact number:</label>
        <input type="text" id="Contact" name="contact" required><br><br>

        <label for="datestart">Checkin time:</label>
        <input type="datetime-local" id="datestart" name="datestart" required><br><br>

        <input type="submit" name="generate_qr" value="Generate QR Code">

    </form>
    
</body>
</html>