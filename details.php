<?php
include('inc/header.php');
// include('inc/slider.php');
?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
	echo "<script>window.location = '404.php'</script>";
} else {
	$id = $_GET['proid'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$qty = $_POST['qty'];
	$addTocart = $cart->add_to_cart($qty, $id);
}
$customer_id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
	$productid = $_POST['productid'];
	$insertCompare = $product->insert_compare($productid, $customer_id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
	$productid = $_POST['productid'];
	$insertWishlist = $product->insert_wishlist($productid, $customer_id);
}
if(isset($_POST['btn_submit'])){
	$insert_binhluan = $cus->insert_binhluan();
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$get_product_details = $product->get_details($id);
			if ($get_product_details) {
				while ($result_details = $get_product_details->fetch_assoc()) {
			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result_details['thumbnail'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result_details['product_name']; ?></h2>
							<p><?php echo $fm->textShorten($result_details['description'], 150); ?></p>
							<div class="price">
								<p>Price: <span><?php echo $fm->product_price($result_details['price']); ?></span></p>
								<p>Category: <span><?php echo $result_details['cat_name']; ?> </span></p>
								<p>Brand:<span><?php echo $result_details['brand_name']; ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="qty" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
							</div>
							<div class="btn-form">

							</div>
							<div class="add-cart">
								<div class="btn_details">
									<form action="" method="post">
										<!-- <a href="?wishlist=<?php echo $result_details['product_id'] ?>"  class="buysubmit">Save to wishlist</a> -->
										<!-- <a href="?compare=<?php echo $result_details['product_id'] ?>" class="buysubmit"></a> -->
										<input type="hidden" class="buysubmit" name="productid" value="<?php echo $result_details['product_id'] ?>" />
										<?php
										$login_check = Session::get('customer_login');
										if ($login_check == true) {
											echo "<input type='submit' class='buysubmit' name='compare' value='Compare product' />" . ' ';
										} else {
											echo '';
										}
										?>

									</form>
									<form action="" method="post">
										<!-- <a href="?wishlist=<?php echo $result_details['product_id'] ?>"  class="buysubmit">Save to wishlist</a> -->
										<!-- <a href="?compare=<?php echo $result_details['product_id'] ?>" class="buysubmit"></a> -->
										<input type="hidden" class="buysubmit" name="productid" value="<?php echo $result_details['product_id'] ?>" />
										<?php
										$login_check = Session::get('customer_login');
										if ($login_check == true) {
											echo "<input type='submit' class='buysubmit' name='wishlist' value='Save to wishlist' />";
										} else {
											echo '';
										}
										?>

									</form>
									<div class="clear"></div>
									<p><?php
										if (isset($insertCompare))
											echo $insertCompare;
										?>

										<?php
										if (isset($insertWishlist))
											echo $insertWishlist;
										?>
									</p>
								</div>
							</div>
						</div>
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?php echo $result_details['description']; ?></p>
						</div>
				<?php
				}
			}
				?>
					</div>
					<div class="rightsidebar span_3_of_1">
						<h2>CATEGORIES</h2>
						<ul>
							<?php
							$getall_category = $cat->show_category_fontend();
							if ($getall_category) {
								while ($category = $getall_category->fetch_assoc()) {

							?>
									<li><a href="productbycat.php?catID=<?php echo $category['cat_id']; ?>"><?php echo $category['cat_name']; ?></a></li>
							<?php
								}
							}
							?>
						</ul>

					</div>
		</div>
		<div class="binhluan">
			<div class="row">
				<div class="col-md-10">
					<h5>Ý kiến sản phẩm</h5>
					<?php
					if(isset($insert_binhluan)){
						echo $insert_binhluan;
					}
					?>
					<form action="" method="post">
						<p><input type="hidden" value="<?php echo $id ?>" name="product_id_comment"></p>
						<p><input type="text" class="form-control" name="tennguoibinhluan" placeholder="Điền tên..."></p>
						<p><textarea name="binhluan" class="form-control" placeholder="Bình luận..." id="" rows="5" style="resize:none;"></textarea></p>
						<p><input type="submit" name="btn_submit" class="btn btn-success" value="Gửi bình luận"></p>
					</form>

				</div>

			</div>

		</div>
	</div>
	<?php
	include('inc/footer.php');
	?>