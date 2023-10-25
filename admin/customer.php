<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/customer.php');
include_once($filepath . '/../helpers/format.php');

?>
<?php

if (!isset($_GET['customerid']) || $_GET['customerid'] == NULL) {
    echo "<script>window.location = 'inbox.php'</script>";
} else {
    $id = $_GET['customerid'];
}
$cus = new customer();


?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa danh mục</h2>
        <div class="block copyblock">
            

            <?php
            $get_cus = $cus->show_customer($id);
            if ($get_cus) {
                while ($result = $get_cus->fetch_assoc()) {
            ?>
                    <form action="" method="POST">
                        <table class="form">
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input type="text" readonly="read" value="<?php echo $result['name'] ?>" name="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>
                                    <input type="text" readonly="read" value="<?php echo $result['phone'] ?>" name="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="text" readonly="read" value="<?php echo $result['email'] ?>" name="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    <input type="text" readonly="read" value="<?php echo $result['address'] ?>" name="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Zip Code</td>
                                <td>
                                    <input type="text" readonly="read" value="<?php echo $result['zipcode'] ?>" name="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>
                                    <input type="text" readonly="read" value="<?php echo $result['city'] ?>" name="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>
                                    <input type="text" readonly="read" value="<?php echo $result['country'] ?>" name="" class="medium" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>