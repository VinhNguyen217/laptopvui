<?php
include "layouts/header.php";
require_once "helpers/format.php";
$fm = new Format();
?>
<?php
if (isset($_GET['cartid'])) {
    $id = $_GET['cartid'];
    $iduser = Session::get('customer_id');
    $delete_product_cart = $ct->delete_product_cart($id, $iduser);
}
?>
<div class="main_title ">
    <ul>

        <li><a href="./index.php" style="background: none;padding-left: 10px;">Trang chủ</a></li>
        <li><a>\</a></li>
        <li><a href="cart.php" style="background: none;padding-left: 10px;">Giỏ Hàng </a></li>
    </ul>
</div>
<div class="content-cart">
    <?php
    $iduser = Session::get('customer_id');
    $num_pt = $ct->num_product_cart($iduser);
    if ($num_pt > 0) {
    ?>
        <form action="" method="post">
            <?php $sum = 0 ?>
            <table style="width:100%">
                <tr>
                    <th>Lựa chọn</th>
                    <th>Tên sản phẩm </th>
                    <th>Ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền </th>
                    <th>Hành động</th>
                </tr>
                <?php
                $iduser = Session::get('customer_id');
                $get_product_cart = $ct->get_product_cart($iduser);
                if ($get_product_cart) {
                    while ($result = $get_product_cart->fetch_assoc()) {

                ?>
                        <tr style=" justify-content: space-between;">

                            <td>

                                <input type="checkbox" name="list_cart[]" value="<?php echo $result['id_carts'] ?>">

                            </td>
                            <td><?= $result['nameProduct'] ?></td>
                            <td><img class="cart-item-image" src="uploads/<?= $result['image'] ?>"></td>
                            <td><?= $fm->format_currency($result['price']) . " đ" ?></td>
                            <td>

                                <input class="cart-quantity-input change-qty" data-product_id="<?php echo  $result['id_carts'] ?>" type="number" name="quantity" value="<?= $result['quantity'] ?>" min=1 max=<?= $result['amount'] ?>>

                            </td>
                            <td class="price-<?php echo $result['id_carts'] ?> "><?php
                                                                                    $total = $result['price'] * $result['quantity'];
                                                                                    $sum += $total;
                                                                                    echo $fm->format_currency($total) . " đ";
                                                                                    ?></td>
                            <td><a onclick="return confirm('Are you want to delete?')" href="?cartid=<?= $result['id_carts'] ?>">Xóa</a></td>
                        </tr>

                <?php

                    }
                }

                ?>
            </table>

            <div class="cart-total">
                <?php Session::set('total', $sum);  ?>
                <strong class="cart-total-title">Tổng Cộng:</strong>
                <span class="cart-total-price"> <?= $fm->format_currency($_SESSION['total']) . " đ"  ?></span>

                <input type="submit" id="h1" name="resgiter" value="Đặt hàng">
            </div>
        </form>
    <?php
    } else {
    ?>
        <p> Không có sản phẩm nào !!!</p>
    <?php
    }
    ?>

    <?php
    if (isset($_POST['resgiter'])) {
        if (isset($_POST['list_cart'])) {
            $list_cart = $_POST['list_cart'];
            Session::set('list_cart', $list_cart);
            $_SESSION['check1'] = true;
            $redirect = "<script>location.href ='pay.php';</script>";
            echo $redirect;
        } else {
            echo '<script language="javascript">alert("Bạn chưa chọn sản phẩm !!!");</script>';
        }
    }
    ?>
</div>

<?php
include "layouts/footer.php"
?>