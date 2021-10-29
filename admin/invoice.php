<?php
require_once './layouts/header.php';
require_once '../classes/bill.php';
?>
<?php require_once '../helpers/format.php' ?>
<?php
$bill = new Bill();
$fm = new Format();
if (isset($_GET['deleteBill_id'])) {
    $id = $_GET['deleteBill_id'];
    $deleteBill = $bill->deleteBill($id);
}
?>
<style>
    #datatablesSimple th,
    td {
        text-align: center;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Đơn hàng</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active">Danh sách đơn hàng</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List of invoices
            </div>
            <div class="card-body">
                <?php
                if (isset($deleteBill)) {
                    echo $deleteBill;
                }
                ?>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Thời gian tạo</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Thời gian tạo</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <?php
                        $result = $bill->showBill();
                        if ($result) {
                            while ($value = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $value['id_bill'] ?>
                                    </td>
                                    <td>
                                        <?php echo $value['name_customer'] ?>
                                    </td>
                                    <td>
                                        <?php echo $fm->format_currency($value['total_money']) . " đ" ?>
                                    </td>
                                    <td>
                                        <?php echo $value['date_created'] ?>
                                    </td>
                                    <td style="text-align: center; font-size: 18px;">
                                        <?php if ($value['status'] == 0) {
                                            echo '<b style="color:orange">Chưa xử lý</b>';
                                        } else if ($value['status'] == 1) {
                                            echo '<b style="color:blue">Đang xử lý</b>';
                                        } else if ($value['status'] == 2) {
                                            echo '<b style="color:green">Hoàn thành</b>';
                                        } else {
                                            echo '<b style="color:red">Hủy</b>';
                                        } ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="invoice_detail.php?bill_id=<?php echo $value['id_bill'] ?>"><i style="font-size: 25px;" class="far fa-edit"></i></a> |
                                        <a onclick="return confirm('Are you want to delete?')" href="?deleteBill_id=<?php echo $value['id_bill'] ?>"><i style="font-size: 25px;" class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
include('./layouts/footer.php');
?>