<?php
include('inc/header.php');
// include('inc/slider.php');
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
?>
<?php
// if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
//     echo "<script>window.location = '404.php'</script>";
// } else {
//     $id = $_GET['proid'];
// }
$id = Session::get('customer_id');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updatecus = $cus->update_cus($_POST, $id);
}
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Update Profile Customer</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="post">
                <table class="tblone">
                    <?php
                    $id = Session::get('customer_id');
                    $get_customer = $cus->show_customer($id);
                    if ($get_customer) {
                        while ($result = $get_customer->fetch_assoc()) {

                    ?>
                            <tr>
                                <td colspan="2">
                                    <?php
                                    if (isset($updatecus)) {
                                        echo $updatecus;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th>Zip Code</th>
                                <th>City</th>
                                <th>Phone</th>
                                <th>Address</th>

                            </tr>
                            <tr>
                                <td> <input type="text" name="name" value="<?php echo $result['name']; ?>"></td>
                                <td> <input type="text" name="zipcode" value="<?php echo $result['zipcode']; ?>"></td>
                                <td> <input type="text" name="city" value="<?php echo $result['city']; ?>"></td>
                                <td> <input type="text" name="phone" value="<?php echo $result['phone']; ?>"></td>
                                <td> <input type="text" name="address" value="<?php echo $result['address']; ?>"></td>


                            </tr>
                            <tr>
                                <td colspan="7" style="padding:10px;">
                                    <input type="submit" name="submit" value="Save" class="grey">
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </form>
        </div>
    </div>
    <?php
    include('inc/footer.php');
    ?>