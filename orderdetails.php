<?php
include('inc/header.php');
// include('inc/slider.php');
?>

<?php
$cart = new cart();

$login_check = Session::get('customer_login');
if ($login_check == false) {
    header('Location:login.php');
}
if (isset($_GET['confirmid'])) {
    $id = $_GET['confirmid'];
    $time = $_GET['time'];
    $price = $_GET['price'];
    $shifted_conf = $cart->shifted_conf($id, $time, $price);
}
?>
<style>
    .submit-oder {
        margin: 10px 495px;
        padding: 10px 30px;
        font-size: 18px;
        font-weight: 600;
        background: #df421f;
        border: none;
        border-radius: 9px;
        cursor: pointer;
    }

    .submit-oder a {
        color: #fff;
    }
</style>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="content_top">
                    <div class="heading">
                        <h3>Your details ordered</h3>
                    </div>
                    <div class="clear"></div>
                    <div id="wrapper">
                        <div class="box-left">
                            <div class="cartpage">
                                <table class="tblone">
                                    <tr>
                                        <th width="3%">ID</th>
                                        <th width="17%">Product Name</th>
                                        <th width="10%">Image</th>
                                        <th width="15%">Price</th>
                                        <th width="5%">Quantity</th>
                                        <th width="10%">Status</th>
                                        <th width="20%">Date Order</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                    <?php
                                    $qty = 0;
                                    $i = 0
                                    ?>
                                    <?php
                                    $customer_id = Session::get('customer_id');
                                    $get_cart_order = $cart->get_cart_order($customer_id);
                                    if ($get_cart_order) {

                                        while ($result = $get_cart_order->fetch_assoc()) {
                                            $i++;
                                    ?>
                                            <tr>
                                                <td><?php echo $i ?></td>

                                                <td><?php echo $result['product_name']; ?></td>
                                                <td><img src="admin/uploads/<?php echo $result['thumbnail']; ?>" /></td>
                                                <td><?php echo $fm->product_price($result['price']); ?></td>
                                                <td>
                                                    <?php echo $result['qty'] ?>
                                                </td>
                                                <td><?php
                                                    if ($result['status'] == 0) {
                                                        echo 'Pending';
                                                    } elseif ($result['status'] == 1) {
                                                    ?>
                                                        <span class="error">Shifted</span>

                                                    <?php
                                                    } elseif ($result['status'] == 2) {
                                                        echo "<span class='success'>Received</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                                                <?php
                                                if ($result['status'] == 0) {
                                                ?>
                                                    <td><?php echo 'N/A'; ?></td>
                                                <?php
                                                } else if ($result['status'] == 1) {
                                                ?>
                                                    <td><a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Confirm</a></td>
                                                <?php
                                                } else {
                                                ?>
                                                    
                                                    <td><?php echo "<span class='success'>Received</span>"; ?></td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                    <?php

                                        }
                                    }
                                    ?>
                                </table>
                                <div class="shopping">
                                    <div class="shopleft">
                                        <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
</form>