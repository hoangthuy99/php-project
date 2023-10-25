<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php' ?>
<?php
$brand = new brand();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand_name = $_POST['brand_name'];
    $insertbrand = $brand->insert_brand($brand_name);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm thương hiệu</h2>
        <div class="block copyblock">
            <form action="brandadd.php" method="POST">
                <?php
                if (isset($insertbrand)) {
                    echo $insertbrand;
                }
                ?>
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brand_name" placeholder="Nhập thêm thương hiệu sản phẩm" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>