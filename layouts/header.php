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
    $bill = new Bill();
	$cat = new Category();
	$cs = new Customer();
    $product = new Product();
    $demand = new ProductType();
?>
<?php
	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
		Session::destroy1();
		$del_all_data_cart =$ct->dell_all_data_cart(); 
		
	}
	if (isset($_REQUEST['ok'])) {
		$search = addslashes($_GET['search']);
		Session::set('search',$search);
		if (empty($search)) {
			
		} else {
			header('Location:search.php');
		}
	}
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
	<link rel="stylesheet" href="public/frontend/css/pay.css">
	<link rel="stylesheet" href="public/frontend/css/header_bottom.css">
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
	
</head>

<body>
	<?php 
		$user = Session::get('customer_name');
		$check_login = Session:: get('customer_login');
	?>

	<div class="wrap">
		<div class="header">
			<div class="headertop_desc">
				<div class="call">
					<p><span>Need help?</span> call us <span class="number">1-22-3456789</span></span></p>
				</div>
				<div class="account_desc">
					<ul>
                        <li>
						<?php
								if($check_login == false)
								?>
								<a href="info.php" class = "Info-click"><?=$user?> </a>		
								<?php		
							?>	
						</li>
						<li>
							<?php
							if ($check_login == false) {
							?>
								<a href="resgiter.php">Đăng Ký</a>
							<?php
							}
							?>
						</li>
						<li>
							<?php
							if ($check_login == false)
								echo '<a href="login.php">Đăng Nhập</a>';
							else {
								echo '<a href="?action=logout">Đăng Xuất</a>';
							}
							?>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<div class="header_top">
				<div class="logo">
					<a href="index.php"><img src="public/frontend/images/logo.png" alt="" /></a>
				</div>
				<div class="cart">
					<?php
						if($check_login == false)
						{
							?>
							<a href="login.php">
								<img src="public/frontend/images/bag.png" />
								<span class="title">Giỏ Hàng</span>
								<span class="product-count">0</span>
							</a>
							<?php
						}
						else{
							$num_product_cart = $ct->num_product_cart($_SESSION['customer_id']);
							?>
							<a href="cart.php">
								<img src="public/frontend/images/bag.png" />
								<span class="title">Giỏ Hàng</span>
								<span class="product-count"><?=$num_product_cart?></span>
							</a>
							<?php
						}
					?>
					
				</div>
				<script type="text/javascript">
					function DropDown(el) {
						this.dd = el;
						this.initEvents();
					}
					DropDown.prototype = {
						initEvents: function() {
							var obj = this;

							obj.dd.on('click', function(event) {
								$(this).toggleClass('active');
								event.stopPropagation();
							});
						}
					}

					$(function() {

						var dd = new DropDown($('#dd'));

						$(document).click(function() {
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
					<form action="" method="get">
						<input type="text" placeholder="Nhập tên sản phẩm" name="search" required/>
						<input type="submit" name="ok" value =""  />
					</form>
				</div>
				<div class="clear"></div>
			</div>
		</div>