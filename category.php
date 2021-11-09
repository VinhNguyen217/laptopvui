<?php
include "layouts/header.php";
require_once "helpers/format.php";

$fm = new Format();
$_SESSION['check1'] = false;
?>
<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script>window.location = 'index.php'</script>";
} else {
    $id = $_GET['catid'];
}
?>
<div class="main">
    <?php
    $get_cat = $cat->getCatById($id);
    if ($get_cat) {
        while ($result_cat = $get_cat->fetch_assoc()) {
    ?>
            <div class="main_title">

                <ul>
                    <li><a href="./index.php" style="background: none;padding-left: 10px;">Trang chủ</a></li>
                    <li><a>\</a></li>
                    <li><a style="background: none;padding-left: 10px;"><?= $result_cat['nameProducer'] ?></a></li>
                </ul>
            </div>
    <?php
        }
    }
    ?>
    <div class="header_slide">
        <div class="header_bottom_left">
            <?php
            //   $iid = 0;
            //   $get_cat = $cat->getCatById($id) ;
            //   if($get_cat){
            //       while($result_cat =$get_cat->fetch_assoc()){ 
            //         // gan id catid
            //         $iid = $result_cat['id_producer'];
            //        }
            //     }        

            include "layouts/slidebar.php";
            ?>
        </div>
        <div class="header_bottom_right">
            <div class="content_category">
                <?php
                $adr = "product";
                $name = "id_producer";
                $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 8;
                $current_page =  !empty($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($current_page - 1) * $item_per_page;
                $totalRecords = $product->get_products_cat($adr, $id, $name);
                $totalPage = ceil($totalRecords / $item_per_page);

                $product_cat = $product->get_products($adr, $id, $name, $item_per_page, $offset);
                if ($product_cat) {
                    while ($result_product_cat = $product_cat->fetch_assoc()) {
                ?>
                        <div class="grid_1_of_4 images_1_of_4">
                            <a href="preview.php?proid=<?= $result_product_cat['id_product'] ?>"><img src="uploads/<?= $result_product_cat['image'] ?>" alt="" /></a>
                            <h2><?= $result_product_cat['nameProduct'] ?> </h2>
                            <div class="price-details">
                                <div class="price-number">
                                    <p><span class="rupees"><?= $fm->format_currency($result_product_cat['price']) . " đ"  ?></span></p>
                                </div>

                                <div class="clear"></div>
                            </div>

                        </div>

                <?php
                    }
                }
                ?>

            </div>
        </div>
        <?php

        $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 8;
        $current_page =  !empty($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($current_page - 1) * $item_per_page;
        $totalRecords = $product->get_products_cat($adr, $id, $name);
        $totalPage = ceil($totalRecords / $item_per_page);
        $ids = "catid";
        include "classes/pagination.php";
        ?>
    </div>
    <div class="clear"></div>
</div>
<style>
    .main_title {
        width: 100%;
        border: 0.5px #eceaea solid;
        height: 40px;
        background-color: #F5F5F5;
        margin: 10px 0px 30px 0px;
        border-radius: 5px;
    }

    .main_title ul {
        list-style: none;
        margin: 0px;
        line-height: 45px;
        display: block;
    }

    .main_title ul li {
        float: left;
    }

    .main_title ul li a {
        font-size: 18px;
        color: #555;
        padding: 0px 10px;
        font-family: sans-serif;
    }

    .main_title ul li a:hover {
        color: red;
    }

    .filter {
        border: 1px solid #EEE;
    }

    .filter h3 {
        text-align: left;
        line-height: 32px;
        padding: 5px;
        font-size: 20px;
        font-weight: 500;
        background: #B81D22;
        color: #fff;
    }

    .filter ul li {
        display: block;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .filter ul li a {
        display: block;
        font-size: 0.8em;
        padding: 8px 15px;
        color: #9C9C9C;
        font-family: 'inherit';
        margin: 0 20px;
        background: url(./images/drop_arrow.png) no-repeat 0;
        border-bottom: 1px solid #EEE;
        text-transform: uppercase;
        text-decoration: none;
        cursor: pointer;
    }

    .filter ul li a:hover {
        color: red;
    }

    .content_category {
        margin-top: -7px;
    }

    .grid_1_of_4:nth-child(5) {
        margin-left: 0;
    }

    .grid_1_of_4:nth-child(9) {
        margin-left: 0;
    }
</style>
<?php
include "layouts/footer.php"
?>