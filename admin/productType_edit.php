<?php include './layouts/header.php' ?>
<?php include '../classes/productType.php' ?>
<?php
$productType = new ProductType();
if (!isset($_GET['productTypeId']) || $_GET['productTypeId'] == NULL) {
    echo "<script>window.location = 'productType.php'</script>";
} else {
    $id = $_GET['productTypeId'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productType_name = $_POST['productType_name'];

    $updateProductType = $productType->update_productType($productType_name, $id);
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
        <h1 class="mt-4">Product Type</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Product Type</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit Product Type
            </div>
            <div class="card-body">
                <?php
                if (isset($updateProductType)) {
                    echo $updateProductType;
                }
                ?>
                <?php
                $get_productType_name = $productType->getProductTypeByIdd($id);
                if ($get_productType_name) {
                    while ($result = $get_productType_name->fetch_assoc()) {
                ?>

                        <form action="" method="POST" class="productType_add">
                            <div class="form-group">
                                <input type="text" value="<?php echo $result['nameProductType'] ?>" class="form-control" aria-describedby="emailHelp" name="productType_name" placeholder="Enter product types name..." required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="UPDATE" />
                        </form>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</main>
<?php
include('./layouts/footer.php');
?>