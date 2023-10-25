<?php
include('inc/header.php');
// include('inc/slider.php');
?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $search_box = $_POST['search_box'];
                $search_product = $product->search_product($search_box);
            }
            ?>
            <div class="heading">
                <h3>Search key : <?php echo $search_box; ?></h3>
            </div>

            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            if ($search_product) {
                while ($result = $search_product->fetch_assoc()) {
            ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details-3.php"><img src="admin/uploads/<?php echo $result['thumbnail']; ?>" /></a>
                        <h2><?php echo $result['product_name'] ?></h2>
                        <p><?php echo $fm->textShorten($result['description'], 50) ?></p>
                        <p><span class="price"><?php echo $fm->product_price($result['price']); ?></span></p>
                        <div class="button"><span><a href="details.php?proid=<?php echo $result['product_id'] ?>" class="details">Details</a></span></div>
                    </div>
            <?php
                }
            } else {
                echo "<span style='color:red; font-style:italic'>Category do not exist!</span>";
            }

            ?>
        </div>
    </div>
</div>
<?php
include('inc/footer.php');
?>