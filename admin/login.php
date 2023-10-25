<?php
include '../classes/adminLogin.php';

?>

<?php
$class = new adminLogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$admin_user = $_POST['admin_user'];
	$admin_pass = md5($_POST['admin_pass']);

	$login_check = $class->login_admin($admin_user, $admin_pass);
}
?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
	<div class="container">
		<section id="content">
			<form action="login.php" method="post">
				<div class="row" style="margin-bottom: 20px;">
				<h1 >Admin Login</h1>
				<span "><?php 
				if(isset($login_check)){
					echo $login_check;
				}
				?></span>
				</div>
				<div>
					<input type="text" placeholder="Username"  name="admin_user" />
				</div>
				<div>
					<input type="password" placeholder="Password"  name="admin_pass" />
				</div>
				<div>
					<input type="submit" value="Log in" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="#">MVC Project</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>

</html>