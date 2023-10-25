<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>

<?php
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
    echo "<script>window.location = 'productlist.php'</script>";
} else {
    $id = $_GET['productid'];
}
$product = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateproduct = $product->update_product($_POST, $_FILES, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <?php
        if (isset($updateproduct)) {
            echo $updateproduct;
        }
        ?>
        <?php
        $get_product = $product->get_product_by_id($id);
        if ($get_product) {
            while ($result_product = $get_product->fetch_assoc()) {

        ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="product_name" value="<?php echo $result_product['product_name'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="category">
                                    <option>Select Category</option>
                                    <?php
                                    $cat = new category();
                                    $catlist = $cat->show_category();
                                    if ($catlist) {
                                        while ($result = $catlist->fetch_assoc()) {
                                    ?>
                                            <option
                                            <?php
                                            if($result['cat_id'] == $result_product['cat_id']) {  echo 'selected'; }
                                            ?>
                                            value="<?php echo $result['cat_id'] ?>"><?php echo $result['cat_name'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Brand</label>
                            </td>
                            <td>
                                <select id="select" name="brand">
                                    <option>Select Brand</option>
                                    <?php
                                    $brand = new brand();
                                    $brandlist = $brand->show_brand();
                                    if ($brandlist) {
                                        while ($result = $brandlist->fetch_assoc()) {
                                    ?>
                                            <option
                                            <?php
                                            if($result['brand_id'] == $result_product['brand_id']) {  echo 'selected'; }
                                            ?>
                                            value="<?php echo $result['brand_id'] ?>"><?php echo $result['brand_name'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Description</label>
                            </td>
                            <td>
                                <textarea name="description" class="tinymce"><?php echo $result_product['description'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Price</label>
                            </td>
                            <td>
                                <input type="text" name="price" value="<?php echo $result_product['price'] ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="uploads/<?php echo $result_product['thumbnail'] ?>" width="130px" , height="120px">
                                <input type="file" name="thumbnail" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Product Type</label>
                            </td>
                            <td>
                                <select id="select" name="type">
                                    <option>Select Type</option>
                                    <?php
                                     if ($result_product['type'] == 0) {
                                    ?>
                                        <option selected value="0">Non-Featured</option>
                                        <option value="1">Featured</option>
                                    <?php
                                    } else {
                                    ?>
                                        <option  value="0">Non-Featured</option>
                                        <option selected value="1">Featured</option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
        <?php

            }
        }
        ?>
    </div>
</div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>