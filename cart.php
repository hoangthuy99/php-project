<?php
include('inc/header.php');
// include('inc/slider.php');
?>
<?php
if (isset($_GET['cartid'])) {
	$cart_id = $_GET['cartid'];
	$delcart = $cart->del_cart($cart_id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$cart_id = $_POST['cart_id'];
	$qty = $_POST['qty'];
	$updateQtyCart = $cart->update_qty_cart($qty, $cart_id);
	if ($qty <= 0) {
		$delcart = $cart->del_cart($cart_id);
	}
}
?>
<?php
     if(!isset($_GET['id'])){
		//  Làm mới giỏ hàng
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	 }
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>
				<?php
				$sub_total = 0;
				$qty = 0;
				?>
				<?php
				if (isset($updateQtyCart)) {
					echo $updateQtyCart;
				}
				?>
				<?php
				if (isset($delcart)) {
					echo $delcart;
				}
				?>

				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>

					<?php
					$get_product_cart = $cart->get_product_cart();
					if ($get_product_cart) {

						while ($result = $get_product_cart->fetch_assoc()) {
					?>
							<tr>
								<td><?php echo $result['product_name']; ?></td>
								<td><img src="admin/uploads/<?php echo $result['thumbnail'] ?>" alt="" /></td>
								<td><?php echo $fm->product_price($result['price']) ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cart_id" value="<?php echo $result['cart_id'] ?>" />
										<input type="number" name="qty" min="0" value="<?php echo $result['qty'] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td><?php
									$total = $result['price'] * $result['qty'];
									echo $fm->product_price($total);
									?>
								</td>
								<td><a onclick="return confirm('Are you want to delete this item?')" href="?cartid=<?php echo $result['cart_id'] ?>">Xóa</a></td>
							</tr>
					<?php
							$sub_total += $total;
							$qty = $qty + $result['qty'];
							Session::set('qty', $qty);
						}
					}
					?>
				</table>
				<?php $check_cart = $cart->check_cart();
				if ($check_cart) {
				?>

					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Sub Total : </th>
							<td><?php
								echo $fm->product_price($sub_total);
								?></td>
						</tr>
						<tr>
							<th>VAT : </th>
							<td>10%</td>
						</tr>
						<tr>
							<th>Grand Total :</th>
							<td><?php
								$vat = $sub_total * 0.1;
								$gtotal = $sub_total + $vat;
								echo $fm->product_price($gtotal);
								?></td>
						</tr>
					</table>
				<?php }else{ 
					echo "<span style='color:red; font-style: italic;'>Your cart is Empty! Please shopping now </span>";
				} ?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>