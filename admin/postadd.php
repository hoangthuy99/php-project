<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php' ?>
<?php
$post = new post();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_name = $_POST['cat_name'];
    $cat_desc = $_POST['cat_desc'];
    $cat_status = $_POST['cat_status'];

    $insertCatPost = $post->insert_post($cat_name, $cat_desc, $cat_status);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm danh mục tin tức</h2>
        <div class="block copyblock">
            <form action="postadd.php" method="POST" autocomplete="off">
                <?php
                if (isset($insertCatPost)) {
                    echo $insertCatPost;
                }
                ?>
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="cat_name" placeholder="Nhập thêm danh mục ..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="cat_desc" placeholder="Nhập thêm miêu tả" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="cat_status" id="">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn hiển thị</option>

                            </select>
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