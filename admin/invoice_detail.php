<?php require_once './layouts/header.php' ?>
<?php require_once '../classes/bill.php' ?>
<?php require_once '../classes/product.php' ?>
<?php require_once '../helpers/format.php' ?>
<?php
$bill = new Bill();
$product = new Product();
$fm = new Format();
if (isset($_GET['bill_id'])) {
    $bill_id = $_GET['bill_id'];
    $result = $bill->getBillById($bill_id);
    $value = $result->fetch_assoc();
}

if (isset($_POST['status'])) {
    $status = $_POST['status'];
    if ($status == 1) {
        $detail_bill = $bill->getDetailBillById($bill_id);
        $updateStatus = $bill->updateStatus($bill_id, $status);
        while ($value_detail_bill = $detail_bill->fetch_assoc()) {
            $id = $value_detail_bill['id_product'];
            $amount = $value_detail_bill['amount'];
            $updateAmount = $product->updateAmount($id, $amount);
        }
        if ($updateStatus != false) {
            echo "<script>location.href = 'invoice.php';</script>";
        }
    } else {
        $updateStatus = $bill->updateStatus($bill_id, $status);
        if ($updateStatus != false) {
            echo "<script>location.href = 'invoice.php';</script>";
        }
    }
}
?>
<main>

    <div class="container">
        <div class="row">
            <h1 class="mt-4" style="color: #1092F4;">Chi tiết đơn hàng</h1>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Thông tin khách hàng
                    </h3>
                </div>
                <div class="panel-body text-left">
                    <p>Tên khách hàng: <?php echo $value['name_customer'] ?></p>
                    <p>Số điện thoại: <?php echo $value['phone'] ?></p>
                    <p>Địa chỉ nhận hàng: <?php echo $value['address'] ?></p>
                    <p>Ngày đặt hàng: <?php echo $value['date_created'] ?></p>
                    <p>Trạng thái đơn hàng:
                        <?php if ($value['status'] == 0) {
                            echo "Chưa xử lý";
                        } else if ($value['status'] == 1) {
                            echo "Đang xử lý";
                        } else if ($value['status'] == 2) {
                            echo "Hoàn thành";
                        } else {
                            echo "Hủy";
                        } ?>
                    </p>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Danh sách đơn hàng
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['bill_id'])) {
                                    $bill_id = $_GET['bill_id'];
                                    $detail = $bill->getDetailBillById($bill_id);
                                    $i = 0;
                                    while ($value_detail = $detail->fetch_assoc()) {
                                        $i++;
                                ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $value_detail['nameProduct'] ?></td>
                                            <td><img src="../uploads/<?php echo $value_detail['image'] ?>" style="width: 60px;" /></td>
                                            <td><?php echo $value_detail['amount'] ?></td>
                                            <td><?php echo $fm->format_currency($value_detail['price']) . " đ"  ?></td>
                                            <td><?php echo $fm->format_currency($value_detail['amount'] * $value_detail['price']) . " đ" ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                                <tr class="bg-danger">
                                    <td>Tổng tiền: </td>
                                    <td><?php echo $fm->format_currency($value['total_money']) . " đ" ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form action="" method="POST" class="form-inline" role="form">
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Cập nhật trạng thái" />
                            <label class="sr-only">Trạng thái</label>
                            <select name="status" id="input" class="form-control-file" required>
                                <option value="0" <?php echo ($value['status'] == 0 ? 'selected' : ''); ?>>Chưa xử lý</option>
                                <option value="1" <?php echo ($value['status'] == 1 ? 'selected' : ''); ?>>Đang xử lý</option>
                                <option value="2" <?php echo ($value['status'] == 2 ? 'selected' : ''); ?>>Hoàn thành</option>
                                <option value="3" <?php echo ($value['status'] == 3 ? 'selected' : ''); ?>>Hủy</option>
                            </select>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</main>
<?php
include('./layouts/footer.php');
?>