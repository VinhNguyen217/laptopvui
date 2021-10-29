<?php require_once './layouts/header.php' ?>
<?php require_once '../classes/category.php' ?>
<?php
$cat = new Category();
if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];
    $deleteCat = $cat->delete_category($id);
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
        <h1 class="mt-4">Danh mục</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Bảng điều khiển</a></li>
            <li class="breadcrumb-item active">Danh sách danh mục</li>
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
                            <th>Tên danh mục</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Tên danh mục</th>
                            <th>Hành động</th>
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
                                    <td>
                                        <a href="category_edit.php?catId=<?php echo $result['id_producer'] ?>"><i style="font-size: 25px;" class="far fa-edit"></i></a> ||
                                        <a onclick="return confirm('Are you want to delete?')" href="?deleteId=<?php echo $result['id_producer'] ?>"><i style="font-size: 25px;" class="far fa-trash-alt"></i></a>
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