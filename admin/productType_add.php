<?php include './layouts/header.php' ?>
<?php include '../classes/productType.php' ?>
<?php
$productType = new ProductType();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productType_name = $_POST['productType_name'];

    $insertProductType = $productType->insert_productType($productType_name);
}
?>
<style>
    input[type="text"] {
        margin: 10px 0px;
        width: 500px;
    }

    input[type="submit"] {
        padding: 5px 20px;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Loại sản phẩm</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active">Thêm loại sản phẩm</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Nhập thông tin loại sản phẩm
            </div>
            <div class="card-body">
                <?php
                if (isset($insertProductType)) {
                    echo $insertProductType;
                }
                ?>
                <form action="productType_add.php" method="POST" class="productType_add">
                    <div class="form-group">
                        <input type="text" class="form-control" aria-describedby="emailHelp" name="productType_name" placeholder="Enter product types name..." required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Lưu" />
                </form>
            </div>
        </div>
    </div>
</main>
<?php
include('./layouts/footer.php');
?>