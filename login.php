<?php
require_once 'libraries/session.php';
Session::init();
?>
<?php
require_once 'libraries/Database.php';
require_once 'helpers/format.php';
spl_autoload_register(function ($className) {
	require_once "classes/" . $className . ".php";
});
$cs = new Customer();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$login_customer = $cs->login_customer($_POST);
}
?>
<?php
	$check_login = Session:: get('customer_login');
	if($check_login != false)
		header('Location:index.php');					
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<title>Online Login Form Responsive Widget Template :: w3layouts</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Online Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- Meta tag Keywords -->
	<!-- css files -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="public/frontend/css/login.css" type="text/css" media="all" /> <!-- Style-CSS -->
	<link rel="stylesheet" href="public/frontend/css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- online-fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
	<!-- //online-fonts -->
</head>

<body>
	<!-- main -->
	<div class="center-container">
		<!--header-->
		<div class="header-w3l">
			<h1>Online Login Form</h1>
		</div>
		<!--//header-->
		<div class="main-content-agile">
			<div class="sub-main-w3">
				<div class="wthree-pro">
					<h2>Login Quick</h2>
				</div>
				<form action="#" method="post">
					<div class="pom-agile">
						<input placeholder="E-mail" name="email" class="user" type="email">
						<span class="icon1"><i class="far fa-user"></i></span>
					</div>
					<div class="pom-agile">
						<input placeholder="Password" name="Password" class="pass" type="password">
						<span class="icon2"><i class="fas fa-unlock"></i></span>
					</div>
					<div class="sub-w3l">
						<h6><a href="#">Forgot Password?</a></h6>
						<div class="right-w3l">
							<input type="submit" name="submit" value="Login">
						</div>
					</div>
				</form>
			</div>
		</div>
		<!--//main-->
		<!--footer-->
		<div class="footer">

		</div>
		<!--//footer-->
	</div>
</body>

</html>