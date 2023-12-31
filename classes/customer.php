<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

?>

<?php

class customer
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_cus($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "") {
            $alert = "<span class='error'>Fields must not be empty</span>";
            return $alert;
        } else {
            $check_email = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $result_check = $this->db->select($check_email);
            if ($result_check) {
                $alert = "<span class='error'>Email already exists</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_customer (name, city,zipcode,email, address,country,phone,password) VALUES ('$name', '$city','$zipcode', '$email', '$address', '$country', '$phone', '$password')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'>Inserted successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Inserted not successfully</span>";
                    return $alert;
                }
            }
        }
    }
    public function insert_binhluan(){
        $product_id = $_POST['product_id_comment'];
        $tenbinhluan = $_POST['tennguoibinhluan'];
        $binhluan= $_POST['binhluan'];
        if($tenbinhluan==''||$binhluan==''){
            $alert = "<span class='error'>Fields must not be empty</span>";
            return $alert;
        }else{
            $query = "INSERT INTO tbl_comment (comment_name, comment,product_id) VALUES ('$tenbinhluan','$binhluan','$product_id')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'>Bình luận thành công!</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Bình luận không thành công</span>";
                    return $alert;
                }
        }

    }
    public function login_customer($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if ($email == "" || $password == "") {
            $alert = "<span class='error'>Email and Password cannot be empty</span>";
            return $alert;
        } else {
            $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
            $result = $this->db->select($check_login);
            if ($result) {
                $value = $result->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                header('Location:order.php');
            } else {
                $alert = "<span class='error'>Email or Password doesn't match</span>";
                return $alert;
            }
        }
    }
    public function show_customer($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_cus($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        if ($name == "" || $city == "" || $zipcode == "" || $address == "" || $phone == "") {
            $alert = "<span class='error'>Please update information!</span>";
            return $alert;
        } else {
            $query = "UPDATE tbl_customer SET name = '$name', city = '$city', zipcode = '$zipcode', address = '$address', phone = '$phone' WHERE id = '$id'";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'>Inserted successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Inserted not successfully</span>";
                return $alert;
            }
        }
    }
}

?>