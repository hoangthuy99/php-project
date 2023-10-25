<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php

class product
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {
        $product_name = mysqli_real_escape_string($this->db->link, $data['product_name']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $description = mysqli_real_escape_string($this->db->link, $data['description']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);


        $permited = array('jpg', 'png', 'gif', 'jpeg');
        $file_name = $_FILES['thumbnail']['name'];
        $file_size = $_FILES['thumbnail']['size'];
        $file_temp = $_FILES['thumbnail']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $file_current = strtolower(current($div));
        $unique_thumbnail = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_thumbnail = "uploads/" . $unique_thumbnail;


        if ($product_name == "" || $category == "" || $brand == "" || $description == "" || $price == "" || $type == "" || $file_name == "") {
            $alert = "<span class='error'>Please enter product</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_thumbnail);
            $query = "INSERT INTO tbl_products(product_name,cat_id, brand_id, description, price, type, thumbnail) VALUES ('$product_name', '$category', '$brand', '$description', '$price', '$type', '$unique_thumbnail')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Product import successfully!</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Import failed</span>";
                return $alert;
            }
        }
    }

    //  
}


?>