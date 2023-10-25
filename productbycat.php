<?php 
include('inc/header.php');
// include('inc/slider.php');
?>
<?php

if (!isset($_GET['catID']) || $_GET['catID'] == NULL) {
    echo "<script>window.location = 'catlist.php'</script>";
} else {
    $id = $_GET['catID'];
}


// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $cat_name = $_POST['cat_name'];
//     $updateCat = $cat->update_category($cat_name, $id);
// }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
		<?php 
			  $product_by_cat_name = $cat->get_product_by_cat_name($id);
			  if($product_by_cat_name){
				  while($result_name =$product_by_cat_name->fetch_assoc()){
			  ?> 
    		<div class="heading">
    		<h3>Category : <?php echo $result_name['cat_name']; ?></h3>
    		</div>
			<?php
				}
			}?>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <?php 
			  $product_by_cat = $cat->get_product_by_cat($id);
			  if($product_by_cat){
				  while($result =$product_by_cat->fetch_assoc()){
			  ?> 
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details-3.php"><img src="admin/uploads/<?php echo $result['thumbnail'];?>" /></a>
					 <h2><?php echo $result['product_name'] ?></h2>
					 <p><?php echo $fm->textShorten($result['description'], 50)?></p>
					 <p><span class="price"><?php echo $fm->product_price($result['price']);?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['product_id']?>" class="details">Details</a></span></div>
				</div>
				<?php
				}
			}else{
				echo "<span style='color:red; font-style:italic'>Category do not exist!</span>";
			}
			
			?>
			</div>
    </div>
 </div>
 <?php 
include('inc/footer.php');
?>