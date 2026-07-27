<?php 
require_once '../vendor/autoload.php';

use chillerlan\QRCode\QRCode;

$qrcode=(new QRCode)->render('https://google.com', './qr_google.svg'); // save to file

$username = 'testuser';
$plate = 'ABC123';
$datestart = date('Y-m-d H:i:s');
$dateend = date('Y-m-d H:i:s', strtotime('+1 hour'));
$qrCodeData = "Username: $username\nPlate: $plate\nStart: $datestart\nEnd: $dateend";

$qrcode=(new QRCode)->render($qrCodeData, './visitor_qr.svg'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>QR Code for Visitor</h1>
    <img width="300" height="300" src="./visitor_qr.svg" alt="Visitor QR Code">
    
</body>
</html>
