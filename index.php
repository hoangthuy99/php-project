<?php
include 'inc/header.php';
include 'inc/slider.php';
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php $product_features = $product->get_product_features();
			if ($product_features) {
				while ($result = $product_features->fetch_assoc()) {

					?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result['thumbnail'] ?>" width="150px" ,
								height="100px"" alt="" /></a>
						<h2><?php echo $result['product_name'] ?></h2>
						<p><?php echo $fm->textShorten($result['description'], 50) ?></p>
						<p><span class=" price">
							<?php echo $fm->product_price($result['price']) ?></span></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $result['product_id'] ?>"
										class="details">Details</a></span></div>
					</div>
					<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php $product_new = $product->get_product_new();
			if ($product_new) {
				while ($result_new = $product_new->fetch_assoc()) {

					?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result_new['thumbnail'] ?>" width="150px" ,
								height="100px"" alt="" /></a>
						<h2><?php echo $result_new['product_name'] ?></h2>
						<p><?php echo $fm->textShorten($result_new['description'], 50) ?></p>
						<p><span class=" price">
							<?php echo $fm->product_price($result_new['price']) ?></span></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $result_new['product_id'] ?>"
										class="details">Details</a></span></div>
					</div>
				<?php }
			} ?>
		</div>
		<div class="phantrang"></div>
		<?php
		$product_all = $product->get_all_product();
		$product_count = mysqli_num_rows($product_all);
		$product_button = ceil($product_count / 4);
		$i = 1;
		for ($i = 1; $i <= $product_button; $i++) {
			echo "<a style='margin:0 5px;border: 1px solid #ccc; padding: 5px' href='index.php?trang=$i'>$i</a>";

		}


		?>
	</div>
</div>
<?php
include 'inc/footer.php';
?>