<?php
	include "layouts/header.php"
?>
<div class="main_title " >
        <ul>
            
            <li><a href="./index.php" style="background: none;padding-left: 0px;">Trang chủ</a></li>
            <li><a>/</a></li>
            <li><a href="cart.php" style="background: none;padding-left: 0px;">Giỏ Hàng </a></li>
        </ul>
 </div>
<div class="content-pay">
    
    <div class="products-pay">
        <div class="modal-body">
            <div class="cart-row">
                <span class="cart-item cart-header cart-column">Sản Phẩm</span>
                <span class="cart-quantity cart-header cart-column">Số Lượng</span>
            </div>
            <div class="cart-items">
                <div class="cart-row">
                <div class="cart-item cart-column">
                    <img class="cart-item-image" src="https://anhdephd.com/wp-content/uploads/2019/08/anh-gai-xinh-viet-nam-thu-hut-moi-anh-nhin-xinh-moc-mac.jpg" width="100" height="100">
                    <span class="cart-item-title">Number 1</span>
                </div>                    
                <div class="cart-quantity cart-column">
                    <input class="cart-quantity-input" type="number" value="1">
                    <button class="btn btn-danger" type="button">Xóa</button>
                </div>
            </div>
            <div class="cart-row">
                <div class="cart-item cart-column">
                    <img class="cart-item-image" src="https://anhdephd.com/wp-content/uploads/2019/08/anh-gai-xinh-viet-nam-thu-hut-moi-anh-nhin-xinh-moc-mac.jpg" width="100" height="100">
                    <span class="cart-item-title">Number 2</span>
                </div>
                <div class="cart-quantity cart-column">
                    <input class="cart-quantity-input" type="number" value="2">
                    <button class="btn btn-danger" type="button">Xóa</button>
                </div>
            </div>
           
            </div>
        </div>
    </div>
    <div class="information-pay"></div>
    <div class="invoice-pay"></div>
    <div class="order-pay">  
        <input type="submit" name="submit" value="Thanh toán hoá đơn" class="pay-pay">       
    </div>
</div> 
<?php
	include "layouts/footer.php"
?>

