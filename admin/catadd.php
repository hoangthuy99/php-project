<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php' ?>
<?php
$cat = new category();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_name = $_POST['cat_name'];
    $insertCat = $cat->insert_category($cat_name);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm danh mục</h2>
        <div class="block copyblock">
            <form action="catadd.php" method="POST">
                <?php
                if (isset($insertCat)) {
                    echo $insertCat;
                }
                ?>
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="cat_name" placeholder="Nhập thêm danh mục sản phẩm" class="medium" />
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