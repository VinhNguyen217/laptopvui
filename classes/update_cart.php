<?php
include '../libraries/session.php';
Session::init();
?>
<?php

    $filepath = realpath(dirname(__FILE__));
    require_once ($filepath.'/../libraries/Database.php');
    require_once ($filepath.'/../helpers/format.php');
    spl_autoload_register(function($className){
		require_once  $className.".php";
	});
	$ct = new Cart();
?>


<?php

if(isset($_GET['productId'])){
    $productId = $_GET['productId'];
    $qty = $_GET['qty'];
    $update_qty_cart = $ct->update_qty_cart($productId,$qty);
    if($update_qty_cart)
    $result_qty = $update_qty_cart->fetch_assoc();
    
    $total = $qty * $result_qty['price'];
    echo $total.'-'.$_SESSION['total'];
}