
<?php 
include('inc/header.php');
include('inc/slider.php');
?>
<?php
$login_check = Session::get('customer_login');
if ($login_check==false) {
	header('Location:login.php');
}
?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<div class="not_found">
                        <h1 style="text-align: center; margin-top:50px;font-size: 30px;font-weight: 700;color: red;">Order Page</h1>
                    </div>
					</div>
					
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php 
include('inc/footer.php');

?>