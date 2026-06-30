<?php 
include 'data_connect.php';

if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    $id = $_GET['id'];
    $qry = "DELETE FROM product WHERE id = $id";
    $conn->query($qry);
    echo "<script>alert('Product deleted successfully');
        window.location.href='inventory.php'
    </script>";
}

if (isset($_GET['search'])){
    $qry="SELECT * FROM product WHERE p_name LIKE '%".$_GET['search']."%'";
    $sttr=$conn->query($qry);
    $num_rows=$sttr->num_rows;
}else{
    $qry="SELECT * FROM product";
    $sttr=$conn->query($qry);
    $num_rows=$sttr->num_rows;
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
    <form action="" method="get">
        <input type="text" name="search" placeholder="search product">
        <button type="submit">search</button>
    </form>
    

    <a href="add_inventory.php">Add product</a>
    <table>
        <thead>
            <th>p_name</th>
            <th>quantity</th>
            <th>insert_date</th>
        </thead>
        <tbody>
            <?php while($row=$sttr->fetch_assoc()){ ?>
                <tr>
                <td><?=$row['p_name']?></td>
                <td><?=$row['quantity']?></td>
                <td><?=$row['insert_date']?></td>
                <td><a href="edit_inventory.php?id=<?=$row['id']?>">Edit</a></td>
                <td><a href="inventory.php?action=delete&id=<?=$row['id']?>">Delete</a></td>
                
                </tr>
            <?php } ?>      
        </tbody>
    </table>
</body>
</html>