<?php
include('inc/header.php');
// include('inc/slider.php');
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $customer_id = Session::get('customer_id');
    $insertOder = $cart->insert_order($customer_id);
    $delCart = $cart->del_all_data_cart();
    header('Location:success.php');
}

?>
<style>
    .success-order {
        text-align: center;
        font-weight: 800;
        color: green !important;
    }

    .success-text {
        text-align: center;
        margin-top: 10px;
        color: #747474;
        font-weight: bold;
    }

    .success-text a {
        color: #b32ab3;
        text-decoration: underline;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <h2 class="success-order">Order successfully!</h2>
            <?php
            $amount = 0;
            $customer_id = Session::get('customer_id');
            $get_amount = $cart->get_amount_price($customer_id);
            if ($get_amount) {

                while ($result = $get_amount->fetch_assoc()) {
                    $price = $result['price'];
                    $amount += $price;
                }
            }
            ?>
            <p class="success-text">Total price you have bought from my website : <?php $vat = $amount * 0.1;
                                                                                     $total_price = $amount + $vat;
                                                                                     echo $fm->product_price($total_price);
                                                                                      ?> </p>
            <p class="success-text">We will contact as soon as possible. Please see your order details here. <a href="orderdetails.php">Click here</a>.</p>


        </div>
    </div>
    <?php
    include('inc/footer.php');
    ?>