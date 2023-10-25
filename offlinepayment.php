<?php
include('inc/header.php');
// include('inc/slider.php');
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id =Session::get('customer_id');
    $insertOder = $cart->insert_order($customer_id);
    $delCart = $cart->del_all_data_cart();
    header('Location:success.php');
}

?>
<style>
    #wrapper {
        display: flex;
        flex-wrap: wrap;
    }

    .box-left {
        width: 65%;
        border: 1px solid #ccc;
    }

    .box-right {
        width: 32%;
        border: 1px solid #ccc;
        margin-left: 20px;
    }

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
                        <h3>Offline Payment</h3>
                    </div>
                    <div class="clear"></div>
                    <div id="wrapper">
                        <div class="box-left">
                            <div class="cartpage">
                                <?php
                                $sub_total = 0;
                                $qty = 0;
                                $i = 0
                                ?>
                                <?php
                                if (isset($updateQtyCart)) {
                                    echo $updateQtyCart;
                                }
                                ?>
                                <?php
                                if (isset($delcart)) {
                                    echo $delcart;
                                }
                                ?>

                                <table class="tblone">
                                    <tr>
                                        <th width="3%">ID</th>
                                        <th width="17%">Product Name</th>
                                        <th width="15%">Price</th>
                                        <th width="25%">Quantity</th>
                                        <th width="20%">Total Price</th>
                                    </tr>

                                    <?php
                                    $get_product_cart = $cart->get_product_cart();
                                    if ($get_product_cart) {

                                        while ($result = $get_product_cart->fetch_assoc()) {
                                            $i++;
                                    ?>
                                            <tr>
                                                <td><?php echo $i ?></td>

                                                <td><?php echo $result['product_name']; ?></td>
                                                <td><?php echo $result['price'] . ' ' . 'VND'; ?></td>
                                                <td>
                                                    <?php echo $result['qty'] ?>
                                                </td>
                                                <td><?php
                                                    $total = $result['price'] * $result['qty'];
                                                    echo $total . ' ' . 'VND';
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                            $sub_total += $total;
                                            $qty = $qty + $result['qty'];
                                            Session::set('qty', $qty);
                                        }
                                    }
                                    ?>
                                </table>
                                <?php $check_cart = $cart->check_cart();
                                if ($check_cart) {
                                ?>

                                    <table style="float:right;text-align:left;" width="40%">
                                        <tr>
                                            <th>Sub Total : </th>
                                            <td><?php
                                                echo $sub_total . ' ' . 'VND';
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <th>VAT : </th>
                                            <td>10% (<?php echo $vat = $sub_total * 0.1; ?>)</td>
                                        </tr>
                                        <tr>
                                            <th>Grand Total :</th>
                                            <td><?php
                                                $vat = $sub_total * 0.1;
                                                $gtotal = $sub_total + $vat;
                                                echo $gtotal . ' ' . 'VND';
                                                ?></td>
                                        </tr>
                                    </table>
                                <?php } else {
                                    echo "<span style='color:red; font-style: italic;'>Your cart is Empty! Please shopping now </span>";
                                } ?>

                            </div>
                        </div>
                        <div class="box-right">
                            <?php
                            $id = Session::get('customer_id');
                            $get_customer = $cus->show_customer($id);
                            if ($get_customer) {
                                while ($result = $get_customer->fetch_assoc()) {

                            ?>
                                    <table class="tblone">
                                        <tr>
                                            <td>Name</td>
                                            <td><?php echo $result['name'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Zip Code</td>
                                            <td><?php echo $result['zipcode'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $result['email'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td><?php echo $result['phone'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td><?php echo $result['address'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>City</td>
                                            <td><?php echo $result['city'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td><?php echo $result['country'] ?></td>
                                        </tr>

                                <?php
                                }
                            }
                                ?>
                                    </table>
                        </div>
                    </div>
                </div>
            </div>
            <center class="submit-oder"><a href="?orderid=order">Order Now</center>

        </div>
</form>