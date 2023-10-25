<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php'; ?>
<?php include '../classes/blog.php'; ?>

<?php
if (!isset($_GET['blogid']) || $_GET['blogid'] == NULL) {
    echo "<script>window.location = 'bloglist.php'</script>";
} else {
    $id = $_GET['blogid'];
}
$blog = new blog();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updateblog = $blog->update_blog($_POST, $_FILES, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Chỉnh sửa sản phẩm</h2>
        <?php
        if (isset($updateblog)) {
            echo $updateblog;
        }
        ?>
        <?php
        $get_blog = $blog->get_blog_by_id($id);
        if ($get_blog) {
            while ($result_blog = $get_blog->fetch_assoc()) {

        ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="blog_name" value="<?php echo $result_blog['blog_name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Category Post</label>
                            </td>
                            <td>
                                <select id="select" name="category">
                                    <option>Select Category</option>
                                    <?php
                                    $post = new post();
                                    $postlist = $post->show_post();
                                    if ($postlist) {
                                        while ($result = $postlist->fetch_assoc()) {
                                    ?>
                                            <option <?php
                                                    if ($result['id_cat_post'] == $result_blog['cat_post_id']) {
                                                        echo 'selected';
                                                    }
                                                    ?> value="<?php echo $result['id_cat_post'] ?>"><?php echo $result['cat_name'] ?></option>
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
                                <textarea name="description" class="tinymce" "<?php echo $result_blog['description'] ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="content" class="tinymce" "<?php echo $result_blog['content']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td><img src="uploads/<?php echo $result_blog['image'] ?>" width="90px">
                                <input type="file" name="image" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Blog Status</label>
                            </td>
                            <td>
                                <select id="select" name="status">
                                    <?php
                                    if ($result_blog['status'] == 0) {
                                    ?>
                                        <option selected value="0">Hiển thị</option>
                                        <option value="1">Ẩn hiển thị</option>
                                    <?php
                                    } else {
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