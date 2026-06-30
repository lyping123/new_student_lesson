<?php 
include 'db.php';

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
           
            while($row=$result->fetch_assoc()){ ?>
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