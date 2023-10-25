<?php
include('inc/header.php');
// include('inc/slider.php');
?>
<?php
$customer_id = Session::get('customer_id');
if (isset($_GET['proid'])) {
	$product_id = $_GET['proid'];
	$delproduct = $product->del_wishlist($product_id, $customer_id);
}
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
// 	$cart_id = $_POST['cart_id'];
// 	$qty = $_POST['qty'];
// 	$updateQtyCart = $cart->update_qty_cart($qty, $cart_id);
// 	if ($qty <= 0) {
// 		$delcart = $cart->del_cart($cart_id);
// 	}
// }
?>
<?php
if (!isset($_GET['id'])) {
	//  Làm mới giỏ hàng
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>
<div class="main">
	<div class="content">
		<div class="cartoption">
			<h2>Wishlist Product</h2>
			<div class="cartpage">
				<table class="tblone">
					<tr>
						<th width="10%">ID Compare</th>
						<th width="20%">Product Name</th>
						<th width="20%">Image</th>
						<th width="15%">Price</th>
						<th width="15%">Action</th>

					</tr>

					<?php
					$customer_id = Session::get('customer_id');
					$get_wishlist = $product->get_wishlist($customer_id);
					if ($get_wishlist) {
						$i = 0;
						while ($result = $get_wishlist->fetch_assoc()) {
							$i++;
					?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['product_name']; ?></td>
								<td><img src="admin/uploads/<?php echo $result['thumbnail'] ?>" alt="" /></td>
								<td><?php echo $fm->product_price($result['price']);  ?></td>
								<td>
									<a href="?proid=<?php echo $result['product_id'] ?>">Remove</a> ||
									<a href="details.php?proid=<?php echo $result['product_id'] ?>">Buy now</a>

								</td>

							</tr>
					<?php

						}
					}
					?>
				</table>


				<table style="float:right;text-align:left;" width="40%">

				</table>

			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>

			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php include 'inc/footer.php'; ?>