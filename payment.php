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
<style>
    #wrapper {
        width: 550px;
        margin: 0 auto;
        border: 1px solid #787878;
        padding: 20px;
        background: orange;
    }

    .heading-pay{
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        margin-bottom:22px;
    }

    .choose-pay {
        padding :10px 28px;
        border: 1px dashed #eee;
        background: yellowgreen;
        margin-left: 30px;
        font-weight: 600;
    }
    a.pre-bt {
    display: inline-block;
    background: gray;
    padding: 11px;
    /* text-align: center; */
    color: #334152;
    margin-left: 219px;
    margin-top: 27px;
}
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>
                <div class="clear"></div>
                <div id="wrapper">
                    <h3 class="heading-pay">Choose your Payment Method</h3>
                    <a href="offlinepayment.php" class="choose-pay">Offline Payment >></a>
                    <a href="donhangonline.php" class="choose-pay">Online Payment >></a>
                    <a href="cart.php" class="pre-bt"> << Previous</a>
                </div>
            </div>

        </div>
    </div>
    <?php
    include('inc/footer.php');
    ?>