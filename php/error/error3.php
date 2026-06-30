<?php 
include 'db.php';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $qry=$conn->prepare("DELETE FROM products WHERE id=?");
    $qry->bind_param("i",$id);
    if($qry->execute()){
        echo "<script>alert('Product deleted successfully');
        window.location.href='product.php';
        </script>";
    } else {
            echo "<script>alert('Failed to delete product');
            window.location.href='product.php';
            </script>";
        }
    }


$qry="SELECT * FROM products";
$result=$conn->query($qry);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            <?php 
           
            while($row=$result->fetch_assoc()) { ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['sku']?></td>
                    <td><?=$row['price']?></td>
                    <td><?=$row['quantity']?></td>
                    <td><?=$row['date_created']?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
</body>
</html>