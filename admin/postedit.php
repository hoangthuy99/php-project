<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php' ?>
<?php

if (!isset($_GET['postID']) || $_GET['postID'] == NULL) {
    echo "<script>window.location = 'postlist.php'</script>";
} else {
    $id = $_GET['postID'];
}
$post = new post();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_name = $_POST['cat_name'];
    $cat_desc = $_POST['cat_desc'];
    $cat_status = $_POST['cat_status'];

    $updatePost = $post->update_post($cat_name, $cat_desc, $cat_status, $id);
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa danh mục tin tức</h2>
        <div class="block copyblock">
            <?php
            if (isset($updatePost)) {
                echo  $updatePost;
            }
            ?>

            <?php
            $get_cat_name = $post->get_cat_by_id($id);
            if ($get_cat_name) {
                while ($result = $get_cat_name->fetch_assoc()) {
            ?>
                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['cat_name'] ?>" name="cat_name" placeholder="Sửa danh mục sản phẩm" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $result['description']; ?>" name="cat_desc" placeholder="Nhập thêm miêu tả" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="cat_status" id="">
                                        <?php
                                        if ($result['status'] == 0) {
                                        ?>
                                            <option selected value="0">Hiển thị</option>
                                            <option value="1">Ẩn hiển thị</option>
                                        <?php
                                        } else  {
                                        ?>
                                            <option selected="selected" value="1">Ẩn hiển thị</option>
                                            <option value="0">Hiển thị</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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