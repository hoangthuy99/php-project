<?php include('lib/session.php');
Session::init();
?>
<?php
include_once 'lib/database.php';
include_once 'helpers/format.php';
// hàm tự động gọi hàm
spl_autoload_register(function ($className) {
	include_once "classes/" . $className . ".php";
});
$db = new Database();
$fm = new Format();
$cart = new cart();
$user = new user();
$cat = new category();
$cus = new customer();
$product = new product();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE php>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Web bán hàng</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
	<link rel="shortcut icon" type="image/png" href="/images/arrow_up.png"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form action="search.php" method="Post">
						<input type="text" value="" placeholder="Search for products..." name="search_box" id="search_box"><input type="submit" value="SEARCH" name="search_product">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<span class="no_product">
								<?php
								$check_cart = $cart->check_cart();
								if ($check_cart) {
									$qty = Session::get("qty");
									echo $qty;
								} else {
									echo "Empty";
								}

								?>
							</span>
						</a>
					</div>
				</div>
				<?php if (isset($_GET['customer_id'])) {
					$customer_id = $_GET['customer_id'];
					$delCart = $cart->del_all_data_cart();
					$delCompare = $cart->del_compare($customer_id);

					Session::destroy();
				}
				?>
				<div class="login">
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo "<a href='login.php'>Login</a></div>";
					} else {
						echo "<a href='?customer_id='.Session::get('customer_id').' '>Logout</a></div>";
					}
					?>

					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="menu">
				<ul id="dc_mega-menu-orange" class="dc_mm-orange">
					<li><a href="index.php">Home</a></li>
					<li><a href="products.php">Products</a> </li>
					<li><a href="topbrands.php">Top Brands</a></li>
					<?php
					$check_cart = $cart->check_cart();
					if ($check_cart == true) {
						echo "<li><a href='cart.php'>Cart</a></li>";
					} else {
						echo ' ';
					}
					?>
					<?php
					$customer_id = Session::get('customer_id');
					$check_order = $cart->check_order($customer_id);
					if ($check_order == true) {
						echo "<li><a href='orderdetails.php'>Ordered</a></li>";
					} else {
						echo ' ';
					}
					?>

					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo ' ';
					} else {
						echo	"<li><a href='profile.php'>Profile</a> </li>";
					}

					?>`
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo ' ';
					} else {
						echo "<li><a href='compare.php'>Compare</a></li>";
					}
					?>
					<?php
					$login_check = Session::get('customer_login');
					if ($login_check == false) {
						echo ' ';
					} else {
						echo "<li><a href='wishlist.php'>Wishlist</a></li>";
					}
					?>

					<li><a href="contact.php">Contact</a> </li>
					<div class="clear"></div>
				</ul>
			</div>