<?php
include "layouts/header.php"
?>

<div class="main">
	<div class="tk-ct">
		<?php
			$iduser = Session::get('customer_id');
			$get_bill = $bill->get_bill($iduser);
			if($get_bill)
			{
				$result1 = $get_bill->fetch_assoc()
		?>
		<div class="box-order-detail-tk">
			<div class="title-tk-2021">Đơn hàng của tôi - 
				<?php
				if($result1['status'] == 0) {
				?>
				<b>Chưa Xử Lý</b></div>
				<?php
				}else if($result1['status'] == 1){
				?>
				<b>Đã Xử Lý</b></div>
				<?php
				}else {
				?>
				<b>Hoàn Thành</b></div>
				<?php
				}
				?>
			<div class="box-order-detail-tk-daybuy">Ngày đặt hàng: <?=$result1['date_created']?></div>
				<div class="box-order-detail-tk-ct">
					<div class="list-od-tk-info">
						<div class="item-od-tk">
						<div class="title-txt">Thông báo</div>
						<div class="item-od-tk-ct">
							<b>Người Nhận: <?=$result1['name_customer']?></b><br>
							<b>Địa chỉ:  <?=$result1['address']?></b><br>
							<b>Điện thoại:  <?=$result1['phone']?></b>
						</div>
						</div>
						<div class="item-od-tk">
						<div class="title-txt">Hình thức giao hàng</div>
						<div class="item-od-tk-ct">
							<b>
								Chưa được cập nhật hoặc miễn phí
							</b>
						</div>
						</div>
						<div class="item-od-tk">
						<div class="title-txt">Hình thức thanh toán</div>
						<div class="item-od-tk-ct">
							<b>Thanh toán tiền mặt khi nhận hàng</b>
						</div>
						</div>
					</div>
					<div class="list-od-tk-list">
						<table style="width:100%">
							<tr>
								<th width = "20%">Tên sản phẩm </th>
								<th width = "20%">Ảnh</th>
								<th width = "20%" >Giá</th>
								<th width = "20%" >Số lượng</th>
								<th width = "20%">Thành tiền </th>
								
							</tr>
							<?php
							
							$idbill = $_GET['billid'];
							$get_products_bill = $bill->get_products_bill($idbill);
							if($get_products_bill)
							{
								while($result = $get_products_bill->fetch_assoc()){
							?>
									<tr style=" justify-content: space-between;">

										
										<td style = "margin-top = 10px "><?= $result['nameProduct'] ?></td>
										<td><img class="cart-item-image" src="uploads/<?= $result['image'] ?>"></td>
										<td> <?=$result['price'] ?> đ</td>
										<td>

											<input class="cart-quantity-input change-qty" data-product_id="<?php echo  $result['id_carts'] ?>" type="number" name="amount" value="<?= $result['amount'] ?>" min=1 max=<?= $result['amount'] ?>>

										</td>
										<td class="price-<?php echo $result['id_carts'] ?> "> <?=$fm->format_currency($result['price']* $result['amount'])?>đ</td>
										
									</tr>

							<?php

								}
							}

							?>
						</table>
					</div>
				</div>
				<div class="total">
					<p>Tổng tiền: <?=$fm->format_currency($result1['total_money'])?>  đ</p> <br>
				</div>
				<div class="box-order-detail-tk-bt">
					<p><a class="go-back" href="bill.php"><i class="fal fa-chevron-double-left"></i> Quay lại đơn hàng của tôi</a></p>
					
				</div>
			</div>
		</div>
		<?php
				}
				
		?>
	</div>
</div>

<?php
include "layouts/footer.php"
?>