<?php include("header.php"); 
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}


?>

 

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Manage product</h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <button onclick="window.location.href='addProduct.php'" class="btn-add" type="button">Add Product</button>
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Price (RM)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qry = "SELECT * FROM products";
                    $result = $conn->query($qry);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['sku']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . number_format($row['price'], 2) . "</td>";
                            echo "<td><a href='editProduct.php?id=" . urlencode($row['id']) . "' class='btn-edit'>Edit</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No products found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>