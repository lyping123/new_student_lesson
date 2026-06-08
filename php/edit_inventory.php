<?php 
include 'data_connect.php';

if(isset($_POST['submit'])){
    $id=$_GET['id'];
    $p_name = $_POST['p_name'];
    $quantity = $_POST['quantity'];
    $insert_date = $_POST['insert_date'];

    $qry="UPDATE product SET p_name='$p_name', quantity='$quantity', insert_date='$insert_date' WHERE id=$id";
    $conn->query($qry);
    echo "<script>alert('Product updated successfully');
        window.location.href='inventory.php'
    </script>";
}

$id=$_GET['id'];
$qry="SELECT * FROM product WHERE id=$id";
$sttr=$conn->query($qry);
$row=$sttr->fetch_assoc();

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
        <input type="text" name="p_name" value="<?=$row['p_name']?>">
        <label>quantity</label>
        <input type="text" name="quantity" value="<?=$row['quantity']?>">
        <label>Insert date</label>
        <input type="date" name="insert_date" value="<?=$row['insert_date']?>">
        <button type="submit" name="submit">submit</button>
    </form>
    <a href="inventory.php">Go back</a>
    
</body>
</html>