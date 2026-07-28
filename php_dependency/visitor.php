<?php 
include 'db.php';
if(isset($_GET['token'])){
    $token = $_GET['token'];
    $qry = $conn->prepare("SELECT * FROM visitor WHERE token = ?");
    $qry->bind_param("s", $token);
    $qry->execute();
    $result = $qry->get_result();
    if($result->num_rows > 0){
        echo "Check-in successful.";
    } else {
        echo "Invalid token.";
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
    <img width="300" height="300" src="./visitor_qr.svg" alt="Visitor QR Code">
    
</body>
</html>