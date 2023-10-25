<?php
include('inc/header.php');
// include('inc/slider.php');
?>
<?php
// if (isset($_GET['cartid'])) {
// 	$cart_id = $_GET['cartid'];
// 	$delcart = $cart->del_cart($cart_id);
// }
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
		<h2>Compare Product</h2>
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
					$get_compare = $product->get_compare($customer_id);
					if ($get_compare) {
						$i = 0;
						while ($result = $get_compare->fetch_assoc()) {
							$i++;
					?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $result['product_name']; ?></td>
								<td><img src="admin/uploads/<?php echo $result['thumbnail'] ?>" alt="" /></td>
								<td><?php echo $fm->product_price($result['price']); ?></td>
								<td><a  href="details.php?proid=<?php echo $result['product_id'] ?>">View</a></td>
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