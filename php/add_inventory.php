<?php 
include 'data_connect.php';

if(isset($_POST['submit'])){
    $p_name = $_POST['p_name'];
    $quantity = $_POST['quantity'];
    $insert_date = $_POST['insert_date'];

    $qry = "INSERT INTO product (p_name, quantity, insert_date) VALUES ('$p_name', '$quantity', '$insert_date')";
    $conn->query($qry);
    echo "<script>alert('add product successfully');
        window.location.href='inventory.php'
    </script>";
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
    <form action="" method="post">
        <label>p_name</label>
        <input type="text" name="p_name">
        <label>quantity</label>
        <input type="text" name="quantity">
        <label>Insert date</label>
        <input type="date" name="insert_date">
        <button type="submit" name="submit">submit</button>
    </form>
    
</body>
</html>