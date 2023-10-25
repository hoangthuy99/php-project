<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php' ?>
<?php

if (!isset($_GET['brandID']) || $_GET['brandID'] == NULL) {
    echo "<script>window.lobrandion = 'brandlist.php'</script>";
} else {
    $id = $_GET['brandID'];
}
$brand = new brand();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = $_POST['brand_name'];
    $updatebrand = $brand->update_brand($brand_name, $id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa danh mục</h2>
        <div class="block copyblock">
            <?php
            if (isset( $updatebrand)) {
                echo  $updatebrand;
            }
            ?>

            <?php
            $get_brand_name = $brand->get_brand_by_id($id);
            if ($get_brand_name) {
                while ($result = $get_brand_name->fetch_assoc()) {
            ?>
                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['brand_name'] ?>" name="brand_name" placeholder="Sửa thương hiệu sản phẩm" class="medium" />
                                </td>
                            </tr>
                            <tr>
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
<?php include 'inc/footer.php'; ?>