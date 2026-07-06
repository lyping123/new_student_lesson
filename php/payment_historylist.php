<?php include("header.php"); 
$sql = "SELECT ci.cart_id as receiptId, ci.id as newid, ci.payment_amount, ci.payment_date, ci.payment_type, ci.c_status FROM cart_id ci 
JOIN carts c ON ci.id = c.cart_id
WHERE c.u_id = ? GROUP BY ci.cart_id, ci.id, ci.payment_amount, ci.payment_date, ci.payment_type, ci.c_status ORDER BY ci.id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();


?>
<div class="product-container checkout-page">
    <h2>Payment History</h2>
    <div class="checkout-section cart-detail-box">

        <div class="cart-table-wrap">
            <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Payment Amount</th>
                    <th>Payment Date</th>
                    <th>Payment Type</th>
                    <th>Payment Proof</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td> <a href='checkoutList.php?cart_id=" . $row['newid'] . "'>" . $row['receiptId'] . "</a></td>";
                    echo "<td>$" . $row['payment_amount'] . "</td>";
                    echo "<td>" . $row['payment_date'] . "</td>";
                    echo "<td>" . $row['payment_type'] . "</td>";
                    echo "<td><img src='" . $row['c_status'] . "' alt='Payment Proof' width='100'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
    
    
</div>


<?php include('footer.php'); ?>