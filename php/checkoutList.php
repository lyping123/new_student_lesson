<?php include('header.php'); ?>

<?php
$cartId=isset($_GET['cart_id']) ? (int)$_GET['cart_id'] : 0;

$qry="SELECT *,ci.cart_id receipt_id FROM cart_id ci 
JOIN carts c ON ci.id = c.cart_id
JOIN products p ON c.p_id = p.id
WHERE ci.id = ? ORDER BY c.created_date DESC";

$stmt = $conn->prepare($qry);
$stmt->bind_param("i", $cartId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    $receiptId = 'N/A';
    $checkoutItems = [];
    $subtotal = 0;
    $serviceFee = 0;
    $grandTotal = 0;
} else {
    $row = $result->fetch_assoc();
    $receiptId = $row['receipt_id'];
	$date = $row['created_date'];
    $checkoutItems = [];
    $subtotal = 0;

    foreach ($result as $item) {
        $lineTotal = (float)$item['price'] * (int)$item['qty'];
        $subtotal += $lineTotal;

        $checkoutItems[] = [
            'id' => (int)$item['p_id'],
            'sku' => htmlspecialchars($item['sku']),
            'price' => (float)$item['price'],
            'qty' => (int)$item['qty'],
            'line_total' => $lineTotal
        ];
    }

    $serviceFee = round($subtotal * 0.05, 3);
    $grandTotal = round($subtotal + $serviceFee, 3);
}
?>

<div class="product-container checkout-page">
	<div class="header checkout-header">
		<div class="title">Checkout</div>
		<button onclick="window.location.href='cartList.php'" class="btn-add" type="button">Back To Cart</button>
	</div>

	<div class="checkout-card">
		<div class="checkout-section receipt-box">
			<h2>Receipt ID</h2>
			<div class="receipt-id"><?= htmlspecialchars($receiptId) ?></div>
			<p class="receipt-note">Issued on <?= date('d M Y, h:i A', strtotime($date)) ?></p>
		</div>

		<div class="checkout-section cart-detail-box">
			<h2>Cart Detail</h2>

			<?php if (empty($checkoutItems)) { ?>
				<p class="cart-empty">No items found in your cart.</p>
			<?php } else { ?>
				<div class="cart-table-wrap">
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>SKU</th>
								<th>Qty</th>
								<th>Unit Price</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($checkoutItems as $item) { ?>
								<tr>
									<td><?= $item['id'] ?></td>
									<td><?= htmlspecialchars($item['sku']) ?></td>
									<td><?= $item['qty'] ?></td>
									<td class="price">RM <?= number_format($item['price'], 2) ?></td>
									<td class="price">RM <?= number_format($item['line_total'], 2) ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<div class="checkout-summary">
					<div class="summary-row">
						<span>Subtotal</span>
						<strong>RM <?= number_format($subtotal, 2) ?></strong>
					</div>
					<div class="summary-row">
						<span>Service Fee</span>
						<strong>RM <?= number_format($serviceFee, 2) ?></strong>
					</div>
					<div class="summary-row grand">
						<span>Grand Total</span>
						<strong>RM <?= number_format($grandTotal, 2) ?></strong>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="checkout-section shipping-box">
			<h4>Shipping Address</h4>
			<p>123 Main Street, Cityville, Country</p>	
		</div>

		<div class="checkout-section payment-box">
			<h4>Payment Method</h4>
			<form class="payment-method-form" action="payment.php?cart_id=<?= $cartId ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="payment_amount" value="<?= $grandTotal ?>">
				<label class="payment-option">
					<input type="radio" name="payment_method" value="E-Wallet" checked>
					<span>E-Wallet</span>
				</label>
				
				<div class="payment_detail ewallet_detail" style="display: block;">
					<p>Pay using your preferred E-Wallet app.</p>
					<img src="./ewallet.jpg" alt="E-Wallet QR Code" width="400" height=500 />
					<br>
					<input type="file" name="payment_proof" accept="image/*" >
				</div>
				<button type="submit" class="btn-add pay-btn" <?= empty($checkoutItems) ? 'disabled' : '' ?>>Confirm Payment</button>
			</form>
		</div>
	</div>
</div>

<script>
	const paymentOptions = document.querySelectorAll('.payment-option input');
	const ewalletDetail = document.querySelector('.ewallet_detail');
	const ftxDetail = document.querySelector('.ftx_detail');

	function updatePaymentDetails() {
		paymentOptions.forEach(option => {
			if (option.checked && option.value === 'E-Wallet') {
				ewalletDetail.style.display = 'block';
				ftxDetail.style.display = 'none';
			} else if (option.checked && option.value === 'FTX') {
				ewalletDetail.style.display = 'none';
				ftxDetail.style.display = 'block';
			}
		});
	}

	paymentOptions.forEach(option => {
		option.addEventListener('change', updatePaymentDetails);
	});
	updatePaymentDetails();
</script>



<?php include('footer.php'); ?>