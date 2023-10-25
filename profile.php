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

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Profile Customer</h3>
                </div>
                <div class="clear"></div>
            </div>
            <?php
            $id = Session::get('customer_id');
            $get_customer = $cus->show_customer($id);
            if ($get_customer) {
                while ($result = $get_customer->fetch_assoc()) {

            ?>
                    <table class="tblone">
                        <tr>
                            <th>Name</th>
                            <th>Zip Code</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Country</th>

                        </tr>
                        <tr>
                            <td><?php echo $result['name'] ?></td>
                            <td><?php echo $result['zipcode'] ?></td>
                            <td><?php echo $result['email'] ?></td>
                            <td><?php echo $result['city'] ?></td>
                            <td><?php echo $result['phone'] ?></td>
                            <td><?php echo $result['address'] ?></td>
                            <td><?php echo $result['country'] ?></td>


                        </tr>
                        <tr>
                            <td colspan="7">
                                <a href="editprofile.php">Update Profile</a>
                            </td>
                        </tr>
                <?php
                }
            }
                ?>
                    </table>
        </div>
    </div>
    <?php
    include('inc/footer.php');
    ?>