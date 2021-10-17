<?php require_once './layouts/header.php' ?>
<?php require_once '../classes/category.php' ?>
<?php require_once '../classes/productType.php' ?>
<?php require_once '../classes/product.php' ?>
<?php
$pd = new Product();

if (!isset($_GET['productId']) || $_GET['productId'] == NULL) {
    echo "<script>window.location = 'product.php'</script>";
} else {
    $id = $_GET['productId'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $updateProduct = $pd->update_product($_POST, $_FILES, $id);
}
?>
<style>
    .divide {
        height: 20px;
    }

    label {
        font-weight: 500;
        margin-right: 60px;
    }

    input[type='text'] {
        width: 500px;
    }

    input[type='number'] {
        width: 500px;
    }

    input[type="submit"] {
        padding: 5px 20px;
    }

    select {
        width: 250px;
    }
</style>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Product</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
        </ol>
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Edit Product
        </div>
        <div class="card-body">
            <?php
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
            ?>
            <?php
            $get_product_by_id = $pd->getProductById($id);
            if ($get_product_by_id) {
                while ($result_product = $get_product_by_id->fetch_assoc()) {
            ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="form">
                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" value="<?php echo $result_product['name'] ?>" required />
                                </td>
                            </tr>
                            <tr class="divide"></tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="category">
                                        <option>----------Select Category----------</option>
                                        <?php
                                        $cat = new Category();
                                        $catList = $cat->show_category();

                                        if ($catList) {
                                            while ($result_cate = $catList->fetch_assoc()) {

                                        ?>
                                                <option <?php
                                                        if ($result_cate['id_producer'] == $result_product['id_producer']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $result_cate['id_producer'] ?>"><?php echo $result_cate['name'] ?></option>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="divide"></tr>
                            <tr>
                                <td>
                                    <label>Product Type</label>
                                </td>
                                <td>
                                    <select id="select" name="productType">
                                        <option>--------Select Product Type--------</option>
                                        <?php
                                        $productType = new ProductType();
                                        $productTypeList = $productType->show_productType();

                                        if ($productTypeList) {
                                            while ($result_productType = $productTypeList->fetch_assoc()) {

                                        ?>
                                                <option <?php
                                                        if ($result_productType['id_product_type'] == $result_product['id_product_type']) {
                                                            echo 'selected';
                                                        }
                                                        ?> value="<?php echo $result_productType['id_product_type'] ?>"><?php echo $result_productType['name'] ?></option>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="divide"></tr>
                            <tr>
                                <td>
                                    <label>Description</label>
                                </td>
                                <td>
                                    <textarea name="productDesc" class="tinymce"><?php echo $result_product['detail'] ?></textarea>
                                </td>
                            </tr>
                            <tr class="divide"></tr>
                            <tr>
                                <td><label>Price</label></td>
                                <td><input type="number" name="price" placeholder="Enter Price..." required value="<?php echo $result_product['price'] ?>" /></td>
                            </tr>
                            <tr class="divide"></tr>
                            <tr>
                                <td><label>Amount</label></td>
                                <td><input type="number" name="amount" placeholder="Enter Amount..." required value="<?php echo $result_product['amount'] ?>" /></td>
                            </tr>
                            <tr class="divide"></tr>
                            <tr>
                                <td><label>Upload Image</label></td>
                                <td>
                                    <img src="../uploads/<?php echo $result_product['image'] ?>" width="120" /></br>
                                    <input name="image" type="file" />
                                </td>
                            </tr>
                            <tr class="divide"></tr>
                            <tr>
                                <td><label>Top Hot</label></td>
                                <td>
                                    <select id="select" name="top">
                                        <?php
                                        if ($result_product['top'] == 1) {


                                        ?>
                                            <option selected value="1">Active</option>
                                            <option value="0">Not Active</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="1">Active</option>
                                            <option selected value="0">Not Active</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="divide"></tr>
                            <tr>
                                <td><label>Newtest</label></td>
                                <td>
                                    <select id="select" name="new">
                                        <?php
                                        if ($result_product['new'] == 1) {


                                        ?>
                                            <option selected value="1">Active</option>
                                            <option value="0">Not Active</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="1">Active</option>
                                            <option selected value="0">Not Active</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="divide"></tr>
                            <tr>
                                <td><label></label></td>
                                <td><input type="submit" name="submit" value="UPDATE" class="btn btn-primary" /></td>
                            </tr>
                            <tr class="divide"></tr>
                        </table>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.tiny.cloud/1/15djb3atimlwakqjfsf24gv1mewejsgicebeywj012oofkn5/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea',
            plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
    </script>

</main>

<?php
include('./layouts/footer.php');
?>