<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php

class brand
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_brand($brand_name)
    {
        $brand_name = $this->fm->validation($brand_name);
        $brand_name = mysqli_real_escape_string($this->db->link, $brand_name);

        if (empty($brand_name)) {
            $alert = "<span class='error'>Please enter brand</span>";
            return $alert;
        } else {
            $query = "INSERT INTO tbl_brand(brand_name) VALUES ('$brand_name')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Brand import successfully!</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Import failed</span>";
                return $alert;
            }
        }
    }

    public function show_brand()
    {
        $query = "SELECT *FROM tbl_brand order by brand_id ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_brand_by_id($id)
    {
        $query = "SELECT *FROM tbl_brand WHERE brand_id = '$id' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_brand($brand_name, $id)
    {
        $brand_name = $this->fm->validation($brand_name);
        $brand_name = mysqli_real_escape_string($this->db->link, $brand_name);
        $id = mysqli_real_escape_string($this->db->link, $id);
        if (empty($brand_name)) {
            $alert = "<span class='error'>Please enter brand</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_brand SET brand_name = '$brand_name' WHERE brand_id = '$id' ";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Brand update successfully!</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Update failed</span>";
                return $alert;
            }
        }
    }
    public function del_brand($id)
    {
        $query = "DELETE FROM tbl_brand WHERE brand_id = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Brand deleted successfully!</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Deleted failed</span>";
            return $alert;
        }
    }
}


?>