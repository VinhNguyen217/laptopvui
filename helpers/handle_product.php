<?php
require_once '../classes/product.php';
$product = new Product();

if (isset($_GET['id_product']) && isset($_GET['status'])) {
    $id_product = $_GET['id_product'];
    $status = $_GET['status'];
    // $result = false;
    if ($status == 0) {
        $result = $product->updateStatus($id_product, 1);
    } else {
        $result = $product->updateStatus($id_product, 0);
    }
    if ($result != false)
        echo true;
    else
        echo false;
}
