<?php
	include "layouts/header.php"
?>
<?php
    if (isset( $_GET['cartid'] )) 
    {
        $id = $_GET['cartid'];
        $delete_product_cart= $ct->delete_product_cart($id);
    }
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitupdate'])) {
        $quantity = $_POST['quantity'];
        $cartid = $_POST['cartid'];
        $update_quantity_cart = $ct->update_quantity_cart($quantity,$cartid);
        if($quantity <=  0)
        {
            $delete_product_cart= $ct->delete_product_cart($cartid);
        }
    }
   
?>
<div class="main_title " >
        <ul>
            
            <li><a href="./index.php" style="background: none;padding-left: 0px;">Trang chủ</a></li>
            <li><a>/</a></li>
            <li><a href="cart.php" style="background: none;padding-left: 0px;">Giỏ Hàng </a></li>
        </ul>
    </div>
<div class="content-cart">
    <?php $sum = 0 ?>
    <table style="width:100%">
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm </th>
            <th>Ảnh</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng tiền </th>
            <th>Ghi chú</th>
        </tr>
        <?php
                $sId = session_id();
                $get_product_cart = $ct->get_product_cart($sId);
                if($get_product_cart)
                {
                    while($result = $get_product_cart->fetch_assoc()){
                   
            ?>
        <tr style = " justify-content: space-between;">
            
            <td >
            <form action="" method = "post">
                <input  style="visibility: hidden; opacity: 0;position: absolute" type="hidden" name ="cartid" value="<?=$result['id_carts']?>" > 
                <input type="checkbox"  name="list_check[]" value="<?php echo $result['id_carts'] ?>" checked >
               
                </form>
            </td>
            <td ><?=$result['nameProduct']?></td>
            <td  ><img class="cart-item-image" src="uploads/<?=$result['image']?>" ></td>
            <td ><?=$result['price']?></td>
            <td >
                <form action="" method = "post">
                    <input  style="visibility: hidden; opacity: 0;position: absolute" type="hidden" name ="cartid" value="<?=$result['id_carts']?>" > 
                    <input  class="cart-quantity-input change " type="number"  name = "quantity" value = "<?=$result['quantity']?>" >
                    <input class="btn btn-danger  update " type="submit" name = "submitupdate"  class="button" value = "update">
                </form>
            </td>
            <td  ><?php
                $total = $result['price']* $result['quantity'];
                echo $total;
            ?></td>
            <td  ><a href="?cartid=<?=$result['id_carts']?>">Xoá</a></td>
        </tr>
                    
        <?php      
            
                }
            }
        ?>
    </table>
    <div class="cart-total">
        <strong class="cart-total-title">Tổng Cộng:</strong>
        <span class="cart-total-price"> <?=$sum?></span>
        <a href=""><input type="submit" id = "h1"name = "Resgiter" value="Resgiter"></a>
    </div>
</div> 
<?php
	include "layouts/footer.php"
?>