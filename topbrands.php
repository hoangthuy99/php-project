<?php 
include('inc/header.php');
include('inc/slider.php');
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Apple</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php
			  $getLastesAppleTop = $product->getLastesAppleTop();
			  if($getLastesAppleTop){
				  while($result=$getLastesAppleTop->fetch_assoc()){
					  ?>
					 <div class="grid_1_of_4 images_1_of_4">
						<a href="details.php?proid=<?php echo $result['product_id'] ?>"> <img src="admin/uploads/<?php echo $result['thumbnail']; ?>" /></a>
						<h2>Apple</h2>
						<p><?php echo $result['product_name']; ?></p>
						<p><span class="price"><?php echo $fm->product_price($result['price']) ?></span></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['product_id'] ?>">Add to cart</a></span></div>
					</div>
					  <?php
				  }
			  }
			  ?>
			</div>
    </div>
 </div>
 <?php 
include('inc/footer.php');

?>