<?php require_once './layouts/header.php' ?>
<?php require_once '../classes/category.php' ?>
<?php
$cat = new Category();

if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
    echo "<script>window.location = 'category.php'</script>";
} else {
    $id = $_GET['catId'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];

    $updateCat = $cat->update_category($category_name, $id);
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
        <h1 class="mt-4">Category</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Category</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit category
            </div>
            <div class="card-body">
                <?php
                if (isset($updateCat)) {
                    echo $updateCat;
                }
                ?>
                <?php
                $get_cate_name = $cat->getCatById($id);

                if ($get_cate_name) {
                    while ($result = $get_cate_name->fetch_assoc()) {
                ?>
                        <form action="" method="POST" class="category_add">
                            <div class="form-group">
                                <input type="text" value="<?php echo $result['name'] ?>" class="form-control" aria-describedby="emailHelp" name="category_name" placeholder="Enter category name..." required>
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