<?php include './layouts/header.php' ?>
<?php include '../classes/productType.php' ?>
<?php
$productType = new ProductType();
if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];
    $deleteProductType = $productType->delete_productType($id);
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
        <h1 class="mt-4">Loại sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active">Danh sách loại sản phẩm</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List of product types
            </div>
            <div class="card-body">
                <?php
                if (isset($deleteProductType)) {
                    echo $deleteProductType;
                }
                ?>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tên loại sản phẩm</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Tên loại sản phẩm</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $showProductType = $productType->show_productType();
                        if ($showProductType) {
                            while ($result = $showProductType->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $result['id_product_type']; ?></td>
                                    <td>
                                        <?php echo $result['nameProductType'] ?>
                                    </td>
                                    <td>
                                        <a href="productType_edit.php?productTypeId=<?php echo $result['id_product_type'] ?>"><i style="font-size: 25px;" class="far fa-edit"></i></a> ||
                                        <a onclick="return confirm('Are you want to delete?')" href="?deleteId=<?php echo $result['id_product_type'] ?>"><i style="font-size: 25px;" class="far fa-trash-alt"></i></a>
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