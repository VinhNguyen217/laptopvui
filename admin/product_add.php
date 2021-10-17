<?php include './layouts/header.php' ?>
<?php include '../classes/category.php' ?>
<?php include '../classes/productType.php' ?>
<?php include '../classes/product.php' ?>
<?php
$product = new Product();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $insertProduct = $product->insert_product($_POST, $_FILES);
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
            <li class="breadcrumb-item active">Add Product</li>
        </ol>
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Add new product
        </div>
        <div class="card-body">
            <?php
            if (isset($insertProduct)) {
                echo $insertProduct;
            }
            ?>
            <form action="product_add.php" method="POST" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" required />
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
                                    while ($result = $catList->fetch_assoc()) {

                                ?>
                                        <option value="<?php echo $result['id_producer'] ?>"><?php echo $result['name'] ?></option>

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
                                    while ($result = $productTypeList->fetch_assoc()) {

                                ?>
                                        <option value="<?php echo $result['id_product_type'] ?>"><?php echo $result['name'] ?></option>

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
                            <textarea name="productDesc" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr class="divide"></tr>
                    <tr>
                        <td><label>Price</label></td>
                        <td><input type="number" name="price" placeholder="Enter Price ..." required /></td>
                    </tr>
                    <tr class="divide"></tr>
                    <tr>
                        <td><label>Amount</label></td>
                        <td><input type="number" name="amount" placeholder="Enter Amount ..." required /></td>
                    </tr>
                    <tr class="divide"></tr>
                    <tr>
                        <td><label>Upload Image</label></td>
                        <td>
                            <input name="image" type="file" required />
                        </td>
                    </tr>
                    <tr class="divide"></tr>
                    <tr>
                        <td><label>Top Hot</label></td>
                        <td>
                            <select id="select" name="top">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="divide"></tr>
                    <tr>
                        <td><label>Newtest</label></td>
                        <td>
                            <select id="select" name="new">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="divide"></tr>
                    <tr>
                        <td><label></label></td>
                        <td><input type="submit" name="submit" value="SAVE" class="btn btn-primary" /></td>
                    </tr>
                    <tr class="divide"></tr>
                </table>
            </form>

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