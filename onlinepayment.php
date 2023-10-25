<?php
include('inc/header.php');
// include('inc/slider.php');
?>
<?php
$login_check = Session::get('customer_id');
if ($login_check == false) {
    header('Location:login.php');
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
        padding: 20px;
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
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Online Payment</h3>
                </div>
                <div class="clear"></div>
                <div id="wrapper">
                    <div class="box-left">
                        <h3 class="payment">Chọn cổng thanh toán Online</h3>
                       <p><a href="donhangonline.php" class="btn btn-success" name="redirect" id="redirect">Thanh toán VNPay</a></p> 
                        <p><a href="donhangonline.php" class="btn btn-danger" name="redirect" id="redirect">Thanh toán MoMo</a></p>

                        </form>

                        <p>Đang trong quá trình phát triển xin vui lòng chờ...</p>
                        <a style="background: greenyellow; padding: 0.5em;" href="payment.php">
                            << Quay về</a>
                    </div>
                </div>


            </div>