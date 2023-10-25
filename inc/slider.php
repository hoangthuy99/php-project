<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
			$getLastesDell = $product->getLastesDell();
			if ($getLastesDell) {
				while ($result = $getLastesDell->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $result['product_id'] ?>"> <img src="admin/uploads/<?php echo $result['thumbnail']; ?>" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Dell</h2>
							<p><?php echo $result['product_name']; ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $result['product_id'] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			} ?>
			<?php
			$getLastesApple = $product->getLastesApple();
			if ($getLastesApple) {
				while ($result = $getLastesApple->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $result['product_id'] ?>"> <img src="admin/uploads/<?php echo $result['thumbnail']; ?>" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Apple</h2>
							<p><?php echo $result['product_name']; ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $result['product_id'] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			} ?>
		</div>
		<div class="section group">
			<?php
			$getLastesHM = $product->getLastesHM();
			if ($getLastesHM) {
				while ($result = $getLastesHM->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $result['product_id'] ?>"> <img src="admin/uploads/<?php echo $result['thumbnail']; ?>" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>H&M</h2>
							<p><?php echo $result['product_name']; ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $result['product_id'] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			} ?>
			<?php
			$getLastesSenka = $product->getLastesSenka();
			if ($getLastesSenka) {
				while ($result = $getLastesSenka->fetch_assoc()) {

			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php?proid=<?php echo $result['product_id'] ?>"> <img src="admin/uploads/<?php echo $result['thumbnail']; ?>" /></a>
						</div>
						<div class="text list_2_of_1">
							<h2>Senka</h2>
							<p><?php echo $result['product_name']; ?></p>
							<div class="button"><span><a href="details.php?proid=<?php echo $result['product_id'] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			} ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="header_bottom_right_images">
		<!-- FlexSlider -->

		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<?php
					$get_slider = $product->show_slider();
					if ($get_slider) {
						while ($result = $get_slider->fetch_assoc()) {
					?>
							<li><img src="admin/uploads/<?php echo $result['slider_image']?>" alt="<?php echo $result['slider_name']?>" width="200px" height="300px" /></li>
					<?php
						}
					}
					?>
				</ul>
			</div>
		</section>
		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>