<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php

class blog
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_blog($data, $files)
    {
        $blog_name = mysqli_real_escape_string($this->db->link, $data['blog_name']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $content =mysqli_real_escape_string($this->db->link, $data['content']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $status= mysqli_real_escape_string($this->db->link, $data['status']);


        $permited = array('jpg', 'png', 'gif', 'jpeg');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $file_current = strtolower(current($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;


        if ($blog_name == "" || $category == "" || $description == "" ||  $status== "" || $file_name == "") {
            $alert = "<span class='error'>Please enter blog</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_blog(blog_name,description, content, cat_post_id, image,status) VALUES ('$blog_name', '$description', '$content', '$category', '$unique_image', $status)";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Blog import successfully!</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Import failed</span>";
                return $alert;
            }
        }
    }

    public function search_blog($search_box){
        $search_box= $this->fm->validation($search_box);
        $query ="SELECT *FROM tbl_blog WHERE blog_name LIKE '%$search_box%'";
        $result = $this->db->select($query);
        return $result;
    }
   
    public function show_blog()
    {
        // $query = "SELECT *FROM tbl_blog order by blog_id desc ";
        // $result = $this->db->select($query);
        // return $result;
        $query = "SELECT tbl_blog.*, tbl_cat_post.cat_name FROM tbl_blog INNER JOIN tbl_cat_post ON tbl_blog.cat_post_id = tbl_cat_post.id_cat_post  order by tbl_blog.blog_id desc";
        $result = $this->db->select($query);
        return $result;
    }
   
    public function get_blog_by_id($id)
    {
        $query = "SELECT *FROM tbl_blog WHERE blog_id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_blog($data, $files, $id)
    {
        $blog_name = mysqli_real_escape_string($this->db->link, $data['blog_name']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $content =mysqli_real_escape_string($this->db->link, $data['content']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $status= mysqli_real_escape_string($this->db->link, $data['status']);

        // Kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
        $permited = array('jpg', 'png', 'gif', 'jpeg');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        // $file_current =strtolower(current($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($blog_name == "" ||$content== "" || $category == "" || $description == "" || $status== "") {
            $alert = "<span class='error'>Please enter blog</span>";
            return $alert;
        } else {
            if (!empty($file_name)) {
                // echo $file_size;
                // Nếu người dùng chọn ảnh
                if ($file_size >  805970) {
                    $alert = "<span class='error'>Image Size should be less than 800MB!</span>";
                    return $alert;
                } elseif (in_array($file_ext, $permited) === false) {
                    // echo "<span class='error'> You can enter:-" . implode(',', $permited) . "</span>";
                    $alert = "<span class='error'> You can upload only:-" . implode(', ', $permited) . "</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                // unlink($unique_image); 
                $query = "UPDATE tbl_blog SET
                 blog_name = '$blog_name',cat_post_id = '$category',content = '$content',description = '$description',status= '$status',image = '$unique_image'  WHERE blog_id = '$id' ";
            } else {
                // Nếu người dùng không chọn ảnh
                $query = "UPDATE tbl_blog SET
                 blog_name = '$blog_name',cat_post_id = '$category',content = '$content',description = '$description', status= '$status' WHERE blog_id = '$id' ";
            }

            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Blog update successfully!</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update failed</span>";
                return $alert;
            }
        }
    }
    
    public function del_blog($id)
    {
        $query = "DELETE FROM tbl_blog WHERE blog_id = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>blog deleted successfully!</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Deleted failed</span>";
            return $alert;
        }
    }
   
    //END BACKEND
   
}


?>