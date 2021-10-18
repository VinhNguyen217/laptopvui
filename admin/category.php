<?php require_once './layouts/header.php' ?>
<?php require_once '../classes/category.php' ?>
<?php
$cat = new Category();
if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];
    $deleteCat = $cat->delete_category($id);
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Category</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Categories</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List of categories
            </div>
            <div class="card-body">
                <?php
                if (isset($deleteCat)) {
                    echo $deleteCat;
                }
                ?>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Name</th>
                            <th>Display</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Category Name</th>
                            <th>Display</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $showCate = $cat->show_category();
                        if ($showCate) {
                            while ($result = $showCate->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $result['id_producer']; ?></td>
                                    <td>
                                        <?php echo $result['nameProducer'] ?>
                                    </td>
                                    <td><?php
                                        if ($result['status'] == 1) {
                                            echo '<input type="checkbox" name="status" checked />';
                                        } else {
                                            echo '<input type="checkbox" name="status"/>';
                                        }
                                        ?>
                                    </td>
                                    <td><a href="category_edit.php?catId=<?php echo $result['id_producer'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete?')" href="?deleteId=<?php echo $result['id_producer'] ?>">Delete</a></td>
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