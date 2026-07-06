<?php 

$server = "localhost";
$username = "root";
$password = "1234";
$database = "ecommerce";

$conn = new mysqli($server, $username, $password, $database,3307);


if($_SERVER["REQUEST_METHOD"]=="GET"){
    $qry=$conn->prepare("SELECT * FROM products");
    $qry->execute();
    $result=$qry->get_result();
    $json=json_encode($result->fetch_all(MYSQLI_ASSOC));
    echo $json;
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['add_product'])){
    $sku=$_POST['sku'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];
    
    $qry=$conn->prepare("INSERT INTO products (sku, price,quantity) VALUES (?, ?, ?)");
    $qry->bind_param("sdd", $sku, $price, $qty);
    $qry->execute();
    echo json_encode(["message" => "Product added successfully"]);
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['update_product'])){
    $sku=$_POST['sku'];
    $price=$_POST['price'];
    $qty=$_POST['qty'];
    $id=$_POST['id'];
    $qry=$conn->prepare("UPDATE products SET sku=?, price=?, quantity=? WHERE id=?");
    $qry->bind_param("sdii", $sku, $price, $qty, $id);
    $qry->execute();
    echo json_encode(["message" => "Product updated successfully"]);
}

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['delete_product'])){
    $id=$_POST['id'];
    $qry=$conn->prepare("DELETE FROM products WHERE id=?");
    $qry->bind_param("i", $id);
    $qry->execute();
    echo json_encode(["message" => "Product deleted successfully"]);
}

?>