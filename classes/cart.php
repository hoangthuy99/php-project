<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php

class cart
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_to_cart($qty, $id)
    {
        $qty = $this->fm->validation($qty);

        $qty = mysqli_real_escape_string($this->db->link, $qty);
        $id = mysqli_real_escape_string($this->db->link, $id);

        $sess_id = session_id();
        $query = "SELECT * FROM tbl_products WHERE product_id = '$id'";
        $result = $this->db->select($query)->fetch_assoc();
        $product_name = $result['product_name'];
        $price = $result['price'];
        $thumbnail = $result['thumbnail'];
        $query_insert = "INSERT INTO tbl_cart(product_id,product_name,qty, sess_id, price, thumbnail) VALUES ('$id','$product_name','$qty','$sess_id','$price', '$thumbnail')";
        $insert_cart = $this->db->insert($query_insert);
        if ($result) {
            header("Location:cart.php");
        } else {
            header("Location:404.php");
        }
    }
    public function get_product_cart()
    {
        $sess_id = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sess_id = '$sess_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_qty_cart($qty, $cart_id)
    {
        $qty = mysqli_real_escape_string($this->db->link, $qty);
        $cart_id = mysqli_real_escape_string($this->db->link, $cart_id);

        $query = "UPDATE tbl_cart SET
                qty = '$qty' WHERE cart_id = '$cart_id' ";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span style='color:green; font-style: italic;'>Cart updated successfully</span>";
            return $msg;
        } else {
            $msg = "<span style='color:red; font-style: italic;'>Cart not updated successfully</span>";
            return $msg;
        }
    }
    public function del_cart($cart_id)
    {
        $cart_id = mysqli_real_escape_string($this->db->link, $cart_id);
        $query = "DELETE FROM tbl_cart WHERE cart_id = '$cart_id' ";
        $result = $this->db->delete($query);
        if ($result) {
            header("Location:cart.php");
        } else {
            $alert = "<span style='color:red; font-style: italic;'>Deleted failed</span>";
            return $alert;
        }
    }
    public function check_cart()
    {
        $sess_id = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sess_id = '$sess_id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_all_data_cart()
    {
        $sess_id = session_id();
        $query = "DELETE FROM tbl_cart WHERE sess_id = '$sess_id'";
        $result = $this->db->delete($query);
        return $result;
    }
    public function del_compare($customer_id){
        $query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
        $result = $this->db->delete($query);
        return $result;
    }
    public function insert_order($customer_id)
    {
        $sess_id = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sess_id = '$sess_id'";
        $get_product = $this->db->select($query);
        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $product_id = $result['product_id'];
                $product_name = $result['product_name'];
                $customer_id = $customer_id;
                $qty  = $result['qty'];
                $price = $result['price'] * $qty;
                $thumbnail = $result['thumbnail'];
                $query_order = "INSERT INTO tbl_order(product_id,product_name,qty, customer_id, price, thumbnail) VALUES ('$product_id','$product_name','$qty','$customer_id','$price', '$thumbnail')";
                $insert_order = $this->db->insert($query_order);
            }
        }
    }
    public function get_amount_price($customer_id)
    {
        $query = "SELECT price FROM tbl_order WHERE customer_id = '$customer_id' ";
        $get_price = $this->db->select($query);
        return $get_price;
    }
    public function get_cart_order($customer_id)
    {
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id' ";
        $get_ordered = $this->db->select($query);
        return $get_ordered;
    }
    public function check_order($customer_id)
    {
        $sess_id = session_id();
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
        $result = $this->db->select($query);
        return $result;
    }

    //Back-end
    public function get_inbox_cart()
    {
        $query = "SELECT * FROM tbl_order ORDER BY date_order";
        $get_inbox_cart = $this->db->select($query);
        return $get_inbox_cart;
    }
    public function shifted($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET
        status = '1'
     WHERE ID = '$id' AND date_order= '$time' AND price = '$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span style='color:green; font-style: italic;'>Update order successfully</span>";
            return $msg;
        } else {
            $msg = "<span style='color:red; font-style: italic;'>Update not successfully</span>";
            return $msg;
        }
    }
    public function deled($id, $time, $price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "DELETE FROM tbl_order 
        WHERE ID = '$id' AND date_order= '$time' AND price = '$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "<span style='color:green; font-style: italic;'>Delete order successfully</span>";
            return $msg;
        } else {
            $msg = "<span style='color:red; font-style: italic;'>Delete not successfully</span>";
            return $msg;
        }
    }
    public function shifted_conf($id,$time,$price)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $time = mysqli_real_escape_string($this->db->link, $time);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $query = "UPDATE tbl_order SET
        status = '2'
         WHERE 	customer_id = '$id' AND date_order= '$time' AND price = '$price'";
        $result = $this->db->update($query);
        return $result;
    }
    
    
}


?>