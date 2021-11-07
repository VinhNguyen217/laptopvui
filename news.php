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
						<table>
							<tr>
								<td>Sản phẩm</td>
								<td width="130">Giá</td>
								<td width="85">Số lượng</td>
								<td width="145">Thành tiền </td>
							</tr>
							<?php
								$idbill = $_GET['billid'];
								$get_products_bill = $bill->get_products_bill($idbill);
								if($get_products_bill)
								{
									while($result = $get_products_bill->fetch_assoc()){
							?>
							<div class="sanpham">
								<tr class="tk-pro-detail" >
									<td>
										<a href="preview.php?proid=<?=$result['id_product']?>" class="tk-pro-img">
										<img class="cart-item-image" src="uploads/<?=$result['image']?>">
										</a>
										<div class="tk-pro-info">
											<a href="#" class="tk-pro-name"><?=$result['nameProduct']?></a>
											<span class="tk-pro-ot">Mã SP: <?=$result['id_product']?></span>
											<span class="tk-pro-ot">Thương hiệu: <a  href="category.php"><?=$result['nameProducer']?></a></span>
											<div class="tk-pro-action">
											<a class="tk-pro-rebuy" href="preview.php?proid=<?=$result['id_product']?>" onclick="listenBuyPro(60412,0,1,'');">Mua lại</a>
											</div>
										</div>
									</td>
									<td width="130"><?=$result['price']?> đ</td>
									<td width="85"><?=$result['amount']?></td>
									<td width="145"><?=$result['price']* $result['amount']?>đ </td>
								</tr>
							</div>
							<?php
									}
								}
							?>
							<tr class="tk-pro-total">
								<td colspan="2">Tạm tính</td>
								<td colspan="3"><?=$result1['total_money']?>đ</td>
							</tr>
							<tr class="tk-pro-total">
								<td colspan="2">Phí vận chuyển</td>
								<td colspan="3">
									Chưa thanh toán
								</td>
							</tr>
							<tr class="tk-pro-total">
								<td colspan="2">Tổng cộng</td>
								<td colspan="3">
									<span><?=$result1['total_money']?>đ</span>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="box-order-detail-tk-bt">
					<a class="go-back" href="contact.php"><i class="fal fa-chevron-double-left"></i> Quay lại đơn hàng của tôi</a>
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