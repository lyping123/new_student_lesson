<?php 
include('header.php'); 

if(isset($_GET['action']) && $_GET['action']=="delete" && isset($_GET['id'])){
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

$qry=$conn->prepare("SELECT * FROM products");
$qry->execute();
$result=$qry->get_result();

?>

<div class="product-container">
    <div class="header">
        <div class="title">Product List</div>
        <button onclick="window.location.href='add_product.php'" class="btn-add">+ Add Product</button>
    </div>

    <div class="card">
        <div class="search-box">
            <input type="text" placeholder="Search product...">
        </div>
    </div>

    <table>
        <thead>
            <tr>
            <th>ID</th>
            <th>SKU</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Date Created</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row=$result->fetch_assoc()){ ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['sku']?></td>
                    <td><?=$row['price']?></td>
                    <td><?=$row['quantity']?></td>
                    <td><?=$row['date_created']?></td>
                  
                    <td>
                        <a href="edit_product.php?id=<?=$row['id']?>" class="btn btn-success">Edit</a>
                        <a href="product.php?action=delete&id=<?=$row['id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
</div>

<?php include('footer.php'); ?>