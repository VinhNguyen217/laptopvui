<div class="categories">
    <ul>
    <h3>Danh Mục</h3>
    <?php
        $adr = "producer";
        
        $category = $product->get_category ($adr);
        if($category){
            while($result_category =$category->fetch_assoc()){
    ?>
        <li><a href="category.php?catid=<?=$result_category['id_producer']?>"><?=$result_category['nameProducer']?></a></li>
        <?php
            }
        }
    ?>
    </ul>
</div>

<div class="filter" style="margin-top: 50px;">
    <ul>
    <h3>Nhu Cầu Sử Dụng</h3>
    <?php
        $adr = "product_type";
        
        $demand = $product->get_category ($adr);
        if($demand){
            while($result_demand =$demand->fetch_assoc()){
    ?>
        <li><a href="demand.php?demandid=<?=$result_demand['id_product_type']?>"><?=$result_demand['nameProductType']?></a></li>
        <?php
            }
        }
    ?>
    </ul>
</div>