<?php require_once './layouts/header.php'; ?>
<?php require_once '../classes/product.php' ?>
<?php require_once '../helpers/format.php' ?>
<style>
    #products {
        font-family: sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #products td {
        border: 1px solid #ddd;
        padding: 0px 5px;
        text-align: left;
        font-size: 14px;
    }

    #products th {
        border: 1px solid #ddd;
        padding: 0px 5px;
        text-align: left;
    }

    p {
        margin: 0;
    }

    #products th {
        padding-top: 12px;
        padding-bottom: 12px;
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
        <h1 class="mt-4">Products</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List of products
            </div>
            <div class="card-body">

                <table id="products">
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Product Type</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Display</th>
                        <th>Top</th>
                        <th>Newtest</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $pdlist = $pd->show_product();
                    if ($pdlist) {
                        $i = 0;
                        while ($result = $pdlist->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $result['id_product'] ?></td>
                                <td><?php echo $result['producer_name'] ?></td>
                                <td><?php echo $result['product_type_name'] ?></td>
                                <td><?php echo $result['name'] ?></td>
                                <td><img src="../uploads/<?php echo $result['image'] ?>" style="width: 50px;" /></td>
                                <td style="text-align: center;"><?php echo $result['amount'] ?></td>
                                <td><?php echo $result['price'] ?></td>
                                <td><?php echo $fm->textShorten($result['detail']) ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($result['status'] == 1) {
                                        echo '<input type="checkbox" name="status" checked />';
                                    } else {
                                        echo '<input type="checkbox" name="status"/>';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($result['top'] == 1) {
                                        echo "Active";
                                    } else {
                                        echo "Not Active";
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    if ($result['new'] == 1) {
                                        echo "Active";
                                    } else {
                                        echo "Not Active";
                                    }
                                    ?>
                                </td>
                                <td><a href="product_edit.php?productId=<?php echo $result['id_product'] ?>">Edit</a> ||
                                    <a onclick="return confirm('Are you want to delete?')" href="?productId=<?php echo $result['id_product'] ?>">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
include('./layouts/footer.php');
?>