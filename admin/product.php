<?php require_once './layouts/header.php'; ?>
<?php require_once '../classes/product.php' ?>
<?php require_once '../helpers/format.php' ?>
<style>
    #datatablesSimple th,
    td {
        text-align: center;
    }
</style>
<?php
$pd = new Product();
$fm = new Format();
if (isset($_GET['productId'])) {
    $id = $_GET['productId'];
    $deleteProduct = $pd->delete_product($id);
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active">Danh sách sản phẩm</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List of products
            </div>
            <div class="card-body">

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Danh mục</th>
                            <th>Loại sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Hiển thị</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Danh mục</th>
                            <th>Loại sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Hiển thị</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $pdlist = $pd->show_product_pagination();
                        if ($pdlist) {
                            while ($result = $pdlist->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $result['id_product'] ?></td>
                                    <td><?php echo $result['nameProducer'] ?></td>
                                    <td><?php echo $result['nameProductType'] ?></td>
                                    <td><?php echo $result['nameProduct'] ?></td>
                                    <td><img src="../uploads/<?php echo $result['image'] ?>" style="width: 50px;" /></td>
                                    <td><?php echo $result['amount'] ?></td>
                                    <td><?php echo $fm->format_currency($result['price']) . " đ"  ?></td>
                                    <td>
                                        <input class="handle_product" type="checkbox" data-product_id="<?= $result['id_product'] ?>" value="<?= $result['status'] ?>" <?php echo ($result['status'] == 1 ? 'checked' : ''); ?> />
                                    </td>
                                    <td><a href="product_edit.php?productId=<?php echo $result['id_product'] ?>"><i style="font-size: 25px;" class="far fa-edit"></i></a> ||
                                        <a onclick="return confirm('Are you want to delete?')" href="?productId=<?php echo $result['id_product'] ?>"><i style="font-size: 25px;" class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <?php ?>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function() {
        $('input.handle_product').click(function() {
            var id_product = $(this).data('product_id');
            var status = $(this).val();
            $.ajax({
                url: '../helpers/handle_product.php',
                type: 'GET',
                data: {
                    id_product: id_product,
                    status: status
                },
                success: function(data) {
                    if (data == true)
                        alert("update success !!!");
                    else
                        alert("update fail !!!");

                }
            });
        })
    });
</script>
<?php
include('./layouts/footer.php');
?>