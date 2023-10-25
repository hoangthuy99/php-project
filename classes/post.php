<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php

class post
{
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_post($cat_name, $cat_desc, $cat_status){
        $cat_name = $this->fm->validation($cat_name);
        $cat_desc = $this->fm->validation($cat_desc);
        $cat_status = $this->fm->validation($cat_status);

        $cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
        $cat_desc = mysqli_real_escape_string($this->db->link, $cat_desc);
        $cat_status = mysqli_real_escape_string($this->db->link, $cat_status);



        if(empty($cat_name) || empty($cat_desc) ){
            $alert = "<span class='error'>Please enter Category and Description</span>";
            return $alert;
        }else{
            $query ="INSERT INTO tbl_cat_post(cat_name, description, status) VALUES ('$cat_name', '$cat_desc', '$cat_status')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class='success'>Catagory Post import successfully!</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Import failed</span>";
                return $alert;
            }
            
        }

    }

    public function show_post(){
        $query ="SELECT *FROM tbl_cat_post order by id_cat_post ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_cat_by_id($id){
        $query ="SELECT *FROM tbl_cat_post WHERE id_cat_post = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_post($cat_name,$cat_desc, $cat_status, $id){
        $cat_name = $this->fm->validation($cat_name);
        $cat_desc = $this->fm->validation($cat_desc);
        $cat_status = $this->fm->validation($cat_status);

        $cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
        $cat_desc = mysqli_real_escape_string($this->db->link, $cat_desc);
        $cat_status = mysqli_real_escape_string($this->db->link, $cat_status);

        $id = mysqli_real_escape_string($this->db->link, $id);
        if(empty($cat_name) || empty($cat_desc)){
            $alert = "<span class='error'>Please enter post</span>";
            return $alert;
        }else{
            $query ="UPDATE tbl_cat_post SET cat_name = '$cat_name', description = '$cat_desc', status = '$cat_status' WHERE id_cat_post = '$id' ";
            $result = $this->db->update($query);
            if($result){
                $alert = "<span class='success'>Catalog update successfully!</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Update failed</span>";
                return $alert;
            }
            
        }
    }
    public function del_post( $id){
        $query ="DELETE FROM tbl_cat_post WHERE id_cat_post = '$id' ";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='success'>Catalog deleted successfully!</span>";
            return $alert;
        }else{
            $alert = "<span class='error'>Deleted failed</span>";
            return $alert;
        }
       
    }
    public function show_post_fontend(){
        $query ="SELECT *FROM tbl_cat_post order by id_cat_post ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_by_cat($id){
        $query ="SELECT *FROM tbl_products WHERE id_cat_post = '$id' order by id_cat_post desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_by_cat_name($id){
        $query ="SELECT tbl_products.*,tbl_cat_post.cat_name,tbl_cat_post.id_cat_post FROM tbl_products,tbl_cat_post WHERE tbl_products.id_cat_post=tbl_cat_post.id_cat_post AND tbl_cat_post.id_cat_post = '$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}


?>