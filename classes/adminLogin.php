<?php
$filepath = realpath(dirname(__FILE__));

include ($filepath.'/../lib/session.php');
Session::checkLogin();
include ($filepath.'/../lib/database.php');
include ($filepath.'/../helpers/format.php');
?>

<?php

class adminLogin
{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($admin_user, $admin_pass)
    {
        $admin_user = $this->fm->validation($admin_user);
        $admin_pass = $this->fm->validation($admin_pass);

        $admin_user = mysqli_real_escape_string($this->db->link, $admin_user);
        $admin_pass = mysqli_real_escape_string($this->db->link, $admin_pass);

        if (empty($admin_user)) {
            $alert = "<span class='error'> Please enter Username and Password</span>";
            return $alert;
        } else {
            $query = "SELECT * FROM tbl_admin WHERE admin_user = '{$admin_user}' AND admin_pass = '{$admin_pass}' LIMIT 1";
            $result = $this->db->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('adminLogin', true);
                Session::set('admin_id ', $value['admin_id']);
                Session::set('admin_user', $value['admin_user']);
                Session::set('admin_name', $value['admin_name']);
                header("Location: index.php");
            } else {
                $alert = "<span class='error'> Username and Password not match</span>";
                return $alert;
            }
        }
    }
}


?>