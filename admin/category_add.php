<?php include './layouts/header.php' ?>
<?php include '../classes/category.php' ?>
<?php
$cat = new Category();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];

    $insertCat = $cat->insert_category($category_name);
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
            <li class="breadcrumb-item active">Add Category</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Add new category
            </div>
            <div class="card-body">
                <?php
                if (isset($insertCat)) {
                    echo $insertCat;
                }
                ?>
                <form action="category_add.php" method="POST" class="category_add">
                    <div class="form-group">
                        <input type="text" class="form-control" aria-describedby="emailHelp" name="category_name" placeholder="Enter category name..." required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="SAVE" />
                </form>
            </div>
        </div>
    </div>
</main>
<?php
include('./layouts/footer.php');
?>