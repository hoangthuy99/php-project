<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php

class category
{
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($cat_name){
        $cat_name = $this->fm->validation($cat_name);
        $cat_name = mysqli_real_escape_string($this->db->link, $cat_name);

        if(empty($cat_name)){
            $alert = "<span class='error'>Please enter Category</span>";
            return $alert;
        }else{
            $query ="INSERT INTO tbl_category(cat_name) VALUES ('$cat_name')";
            $result = $this->db->insert($query);
            if($result){
                $alert = "<span class='success'>Catalog import successfully!</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Import failed</span>";
                return $alert;
            }
            
        }

    }

    public function show_category(){
        $query ="SELECT *FROM tbl_category order by cat_id ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_cat_by_id($id){
        $query ="SELECT *FROM tbl_category WHERE cat_id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_category($cat_name, $id){
        $cat_name = $this->fm->validation($cat_name);
        $cat_name = mysqli_real_escape_string($this->db->link, $cat_name);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if(empty($cat_name)){
            $alert = "<span class='error'>Please enter Category</span>";
            return $alert;
        }else{
            $query ="UPDATE tbl_category SET cat_name = '$cat_name' WHERE cat_id = '$id' ";
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
    public function del_category( $id){
        $query ="DELETE FROM tbl_category WHERE cat_id = '$id' ";
        $result = $this->db->delete($query);
        if($result){
            $alert = "<span class='success'>Catalog deleted successfully!</span>";
            return $alert;
        }else{
            $alert = "<span class='error'>Deleted failed</span>";
            return $alert;
        }
       
    }
    public function show_category_fontend(){
        $query ="SELECT *FROM tbl_category order by cat_id ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_by_cat($id){
        $query ="SELECT *FROM tbl_products WHERE cat_id = '$id' order by cat_id desc LIMIT 8";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_by_cat_name($id){
        $query ="SELECT tbl_products.*,tbl_category.cat_name,tbl_category.cat_id FROM tbl_products,tbl_category WHERE tbl_products.cat_id=tbl_category.cat_id AND tbl_category.cat_id = '$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
}


?>