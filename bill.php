<?php
include "layouts/header.php"
?>
<?php
    $id = -1;
	if (!isset($_GET['statusid']) || $_GET['statusid'] == NULL) {
		
	} else {
		$id = $_GET['statusid'];
	}
?>
<div class="main">
<div class="tk-bill">
    <div class="box-order-list-tk-new">
    <div class="title-tk-2021">Đơn hàng của tôi</div>
    <div class="list-tab-tk">
        <a href="bill.php"  class="active">Tất cả</a>
        <a href="bill.php?statusid=0 "  >Chưa xử lý</a>
        <a href="bill.php?statusid=1"  >Đang xử lý</a>
        <a href="bill.php?statusid=2" >Hoàn thành</a>
    </div>
    <div class="box-search-tk">
            <button onclick="searchOrderTk()"><i class="fa fa-search" aria-hidden="true"></i></button>
            <input id="input-search-order-tk" type="text" placeholder="Tìm kiếm theo tên sản phẩm">
    </div>
    <div class="content-tab-tk">
        <div class="tab-tk-item active" id="tab-tk-1">
             
            <table>
                <tr>
                    <td width="20%">Mã đơn hàng</td>
                    <td width="20%">Ngày mua</td>
                    <td width="20%">Người Nhận x Địa Chỉ</td>
                    <td width="20%">Tổng tiền  </td>
                    <td width="20%">Tình trạng đơn</td>
                      	
                   
                </tr>
                <?php
                    $sum =0;
                    $iduser = Session::get('customer_id');
                    if($id < 0){
                        $get_bill = $bill->get_bill($iduser);}
                        else{$get_bill = $bill->get_bill1($iduser,$id);}
                        if($get_bill)
                        {
                            while($result = $get_bill->fetch_assoc()){
                    
                ?>
                <tr id="js-item-tk-231912">
                    <td width="120">
                        <a href="bill_detail.php?billid=<?=$result['id_bill']?>" class="tk-id"><?=$result['id_bill']?></a>
                    </td>
                    <td width="110">
                        <span class="tk-date"><?=$result['date_created']?></span>
                    </td>
                    <td colspan="1">
                        <div class="tk-od-info" data-id="60412">
                            <span>Người Nhận: <?=$result['name_customer']?></span><br>
                            <span>Địa Chỉ: <?=$result['address']?> </span>
                        </div>                     	 
                    </td>
					<td>
					<b> <?=$fm->format_currency($result['total_money']) ?>đ</b>

					</td>
                    <td>
                        <?php
                            if($result['status'] == 0) {
                            ?>
                            <b>Chưa Xử Lý</b></div>
                            <?php
                            }else if($result['status'] == 1){
                            ?>
                            <b>Đã Xử Lý</b></div>
                            <?php
                            }else {
                            ?>
                            <b>Hoàn Thành</b></div>
                            <?php
                            }
                        ?>
                    </td>
                </tr>
                <?php
                    $sum = $sum + $result['total_money'];
                
                        }
                    }
                
                ?>                
            </table>
               <div class="tk-pro-item-price">
                            Số tiền: <span><?= $fm->format_currency($sum)?>đ</span>
                        </div>
        </div>
    </div>
</div>

<script>
function buyOrder(elm) {
    let ad_item = $(elm).attr("data-id");
    let holder_item = "#js-item-tk-" + ad_item;
    $(holder_item).find(".tk-od-info").each(function(){
        let id_pro = $(this).attr("data-id");
        listenBuyProAccount(id_pro,0,1)
    })

    location.href="/cart";
}

function listenBuyProAccount(product_id, variant_id, quantity) {
    var product_prop = {
        quantity: 1,
        buyer_note : ""
    };
    Hura.Cart.Product.add(product_id, variant_id, product_prop).then(function(response){
       if(response.status === 'error') {
      console.log("Lỗi thêm sản phẩm vào giỏ hàng: error_type = " + response.error_type);
       }else{
       }
    });
}
  
function searchOrderTk() {
    let text_search = $("#input-search-order-tk").val();
    let order_status = "";
    let url = "/taikhoan?view=account-order&q="+ text_search +"&status=" + order_status;
    location.href = url;
}
</script>
            </div>
        </div>
    </div>
</div>
<?php
include "layouts/footer.php"
?>