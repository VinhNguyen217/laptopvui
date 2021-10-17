<?php
include 'libraries/session.php';
Session::init();
?>
<?php
    require_once 'libraries/Database.php';
    require_once 'helpers/format.php';
    spl_autoload_register(function($className){
        require_once "classes/". $className.".php";
    });
    $db = new Database();
    $fm = new Format();
    $ct = new Cart();
    $us = new User();
    $cat = new Category();
    $product = new Product();
    $demand = new ProductType();
?>
<!DOCTYPE HTML>
<head>
	<title>Free Home Shoppe Website Template | Home :: w3layouts</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="public/frontend/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="public/frontend/css/slider.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="public/frontend/css/Cart.css">
    <link rel="stylesheet" href="public/frontend/css/info.css">
    <link rel="stylesheet" href="public/frontend/css/resgiter.css">
    <link rel="stylesheet" href="public/frontend/css/login.css">
    <link rel="stylesheet" href="public/frontend/css/pay.css">
	<script type="text/javascript" src="public/frontend/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="public/frontend/js/move-top.js"></script>
	<script type="text/javascript" src="public/frontend/js/easing.js"></script>
	<script type="text/javascript" src="public/frontend/js/startstop-slider.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="public/frontend/js/jquery-3.6.0.js"></script>
	<script src="public/frontend/js/easyResponsiveTabs.js" type="text/javascript"></script>
	<link href="public/frontend/css/easy-responsive-tabs.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="public/frontend/css/global.css">
	<script src="public/frontend/js/slides.min.jquery.js"></script>
	<script src="public/frontend/js/include.js"></script>
</head>

<body>
	<div class="wrap">
		<div class="header">
			<div class="headertop_desc">
				<div class="call">
					<p><span>Need help?</span> call us <span class="number">1-22-3456789</span></span></p>
				</div>
				<div class="account_desc">
					<ul>
                        <li><a href="#" class = "Info-click">Đăng </a></li>
						<li><a href="#" class = "Register-click">Đăng Ký</a></li>
						<li><a href="#" class = "Login-click">Đăng Nhập</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<div class="header_top">
				<div class="logo">
					<a href="index.php"><img src="public/frontend/images/logo.png" alt="" /></a>
				</div>
				<div class="cart">
					<a href="#">
						<img src="public/frontend/images/bag.png" />
						<span class="title">Giỏ Hàng</span>
						<span class="product-count">0</span>
					</a>
				</div>
				<script type="text/javascript">
					function DropDown(el) {
						this.dd = el;
						this.initEvents();
					}
					DropDown.prototype = {
						initEvents: function () {
							var obj = this;

							obj.dd.on('click', function (event) {
								$(this).toggleClass('active');
								event.stopPropagation();
							});
						}
					}

					$(function () {

						var dd = new DropDown($('#dd'));

						$(document).click(function () {
							// all dropdowns
							$('.wrapper-dropdown-2').removeClass('active');
						});

					});

				</script>
				<div class="clear"></div>
			</div>

			<div class="header_bottom">
				<div class="menu">
					<ul>
						<li class="active"><a href="index.php">Trang chủ</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="delivery.php">Delivery</a></li>
						<li><a href="news.php">Tin tức</a></li>
						<li><a href="contact.php">Liên lạc</a></li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="search_box">
					<form>
						<input type="text" placeholder="Nhập tên sản phẩm">
						<input type="submit" value="">
					</form>
				</div>
				<div class="clear"></div>
			</div>
		</div>
        <div class="Login after-onclick-exit-login">
            <?php
                include "login.php"
            ?>
        </div>
        <div class="Resgiter after-onclick-exit-login">
            <?php
                include "resgiter.php"
            ?>
        </div>
        <div class="Infor after-onclick-exit-login ">
            <?php
                include "info.php "
            ?>  
        </div>
        <div class="Cart after-onclick-exit-login">
            <?php
                include "cart.php"
            ?>
        </div>