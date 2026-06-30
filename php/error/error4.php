<?php 

if(isset($_GET['id']) && !empty($_GET['id'])){
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


?>