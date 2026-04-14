<?php include("header.php"); ?>


<div class="container">
    <div class="card">
        <div class="card-header">
<<<<<<< HEAD
            <h2>Manage User</h2>
        </div>
        <div class="card-body">
            <p>>Admin can manage user here</p>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $qry = $conn->prepare("SELECT id, username, email FROM users");
                $qry->execute();
                $result = $qry->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td><a href='editUser.php?id=" . urlencode($row['id']) . "' class='btn-edit'>Edit</a> 
                              <a href='deleteUser.php?id=" . urlencode($row['id']) . "' class='btn-delete' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div> 
=======
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

>>>>>>> main
<?php include("footer.php"); ?>