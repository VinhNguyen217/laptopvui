<?php
include "layouts/header.php";
require_once "helpers/format.php";
$fm = new Format();
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $list_cart = Session::get('list_cart');
    $add_bill = $bill->add_bill();
    $get_id_bill = $bill->get_id_bill();
    $id_bill = $get_id_bill->fetch_assoc();
    if ($add_bill) {
        foreach ($list_cart as $item) {
            $add_product_bill = $bill->add_product_bill($item, $id_bill['id_bill']);
            if ($add_product_bill) {
                //Xoá sản phẩm khỏi giỏ hàng
                $delete_product_cart = $ct->delete_prt_cart($item);
            }
        }
    } else echo '<span style="color:red">Đơn hàng thất bại </span>';
    echo  '<script language="javascript">alert("Đơn hàng đã đặt thành công !!!"); window.location="index.php";</script>';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['info'])) {
    header('Location:info.php');
}
if (isset($_POST['update'])) {
    header('Location:info.php');
}
?>
<div class="main_title ">
    <ul>

        <li><a href="./index.php" style="background: none;padding-left: 10px;">Trang chủ</a></li>
        <li><a>\</a></li>
        <li><a href="pay.php" style="background: none;padding-left: 10px;">Thanh toán </a></li>
    </ul>
</div>
<div class="content-pay">

    <div class="products-pay">
        <div class="modal-body">
            <div class="cart-row">
                <span class="cart-item cart-header cart-column" style="text-align: center;">Sản Phẩm</span>
                <span class="cart-quantity cart-header cart-column" style="text-align: center;">Số Lượng</span>
                <span class="cart-quantity cart-header cart-column" style="text-align: center;">Giá</span>

            </div>
            <div class="cart-items">
                <?php
                $list_cart = Session::get('list_cart');
                $total = 0;
                foreach ($list_cart as $item) {

                    $get_product_pay = $bill->get_product_pay($item);

                    $result = $get_product_pay->fetch_assoc();

                ?>
                    <div class="cart-row">
                        <div class="cart-item cart-column">
                            <img class="cart-item-image" src="uploads/<?= $result['image'] ?>" width="100" height="100">
                            <span class="cart-item-title"><?= $result['nameProduct'] ?></span>
                        </div>
                        <div class="cart-quantity cart-column">
                            <p><?= $result['quantity'] ?></p>
                        </div>
                        <div class="cart-quantity cart-column">
                            <?php
                            $sum = $result['quantity'] * $result['price'];
                            $total += $sum;
                            ?>
                            <p><?= $fm->format_currency($sum) . " đ" ?></p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="information-pay">
        <?php
        if ($_SESSION['check'] == true) {
        ?>
            <p>Tên Người Nhận: <?= $_SESSION['customer_recriver'] ?></p>
            <p>Số điện thoại: <?= $_SESSION['customer_phone'] ?></p>
            <p>Địa chỉ nhận hàng: <?= $_SESSION['customer_address'] ?></p>
        <?php
        } else {
        ?>
            <p>Tên Người Nhận: </p>
            <p>Số điện thoại: </p>
            <p>Địa chỉ nhận hàng:</p>
        <?php
        }
        ?>
        <a href="info.php"> Sửa</a>
    </div>
    <div class="invoice-pay">
        <p>Tổng tiền: <?= $fm->format_currency($total) . " đ" ?></p>
        <?php Session::set('total_pay', $total)  ?>
    </div>
    <div class="order-pay">
        <?php
        if ($_SESSION['check'] == true) {
        ?>
            <form action="" method="post">
                <input type="submit" name="submit" value="Đặt hàng" class="pay-pay">
            </form>
        <?php
        } else {
        ?>
            <form action="" method="post">
                <input type="submit" name="info" value="Đặt hàng" class="pay-pay">
            </form>
        <?php
        }
        ?>

    </div>
</div>
<?php
include "layouts/footer.php"
?>