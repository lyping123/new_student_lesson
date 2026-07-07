<?php include('header.php'); ?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Dashboard</h1>
        <p>Welcome back, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>!</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <?php
        // Total Products
        $productsQuery = $conn->prepare("SELECT COUNT(*) as total FROM products");
        $productsQuery->execute();
        $productsResult = $productsQuery->get_result();
        $productsData = $productsResult->fetch_assoc();
        $totalProducts = $productsData['total'];

        // Total Inventory
        $inventoryQuery = $conn->prepare("SELECT SUM(quantity) as total FROM products");
        $inventoryQuery->execute();
        $inventoryResult = $inventoryQuery->get_result();
        $inventoryData = $inventoryResult->fetch_assoc();
        $totalInventory = $inventoryData['total'] ?? 0;

        // Cart Items
        $cartItems = 0;
        if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
            $cartItems = count($_SESSION['cart']);
        }

        // Total Payments
        $paymentsQuery = $conn->prepare("SELECT SUM(payment_amount) as total FROM cart_id WHERE c_status !=''");
        $paymentsQuery->execute();
        $paymentsResult = $paymentsQuery->get_result();
        $paymentsData = $paymentsResult->fetch_assoc();
        $totalPayments = $paymentsData['total'] ?? 0;
        ?>

        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-content">
                <h3>Total Products</h3>
                <p class="stat-number"><?php echo $totalProducts; ?></p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📊</div>
            <div class="stat-content">
                <h3>Total Inventory</h3>
                <p class="stat-number"><?php echo number_format($totalInventory); ?></p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">🛒</div>
            <div class="stat-content">
                <h3>Cart Items</h3>
                <p class="stat-number"><?php echo $cartItems; ?></p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">💳</div>
            <div class="stat-content">
                <h3>Total Transactions</h3>
                <p class="stat-number">RM <?php echo $totalPayments; ?></p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2>Quick Actions</h2>
        <div class="action-buttons">
            <a href="product.php" class="action-btn btn-primary">
                <span>📋</span> View Products
            </a>
            <a href="cartList.php" class="action-btn btn-secondary">
                <span>🛍️</span> View Cart
            </a>
            <a href="payment_historylist.php" class="action-btn btn-info">
                <span>💰</span> Payment History
            </a>
            <a href="add_product.php" class="action-btn btn-success">
                <span>➕</span> Add Product
            </a>
        </div>
    </div>

    <!-- Recent Products -->
    <div class="recent-section">
        <h2>Recent Products</h2>
        <div class="products-preview">
            <?php
            $recentQuery = $conn->prepare("SELECT id, sku, price, quantity, date_created FROM products ORDER BY date_created DESC LIMIT 5");
            $recentQuery->execute();
            $recentResult = $recentQuery->get_result();

            if($recentResult->num_rows > 0){
                while($product = $recentResult->fetch_assoc()){
                    echo "
                    <div class='product-card'>
                        <div class='product-header'>
                            <strong>SKU: " . htmlspecialchars($product['sku']) . "</strong>
                            <small>" . date('M d, Y', strtotime($product['date_created'])) . "</small>
                        </div>
                        <div class='product-info'>
                            <p><strong>Price:</strong> RM " . number_format($product['price'], 2) . "</p>
                            <p><strong>Quantity:</strong> " . $product['quantity'] . " units</p>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<p class='no-data'>No products available</p>";
            }
            ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>