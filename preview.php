<?php
include "layouts/header.php";
require_once "helpers/format.php";
$_SESSION['check1'] = false;
$fm = new Format();
?>
<?php
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
	echo "<script>window.location = 'index.php'</script>";
} else {
	$id = $_GET['proid'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$iduser = Session::get('customer_id');
	$addtocart = $ct->add_to_cart($quantity, $id, $iduser);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sub'])) {
	header('Location:login.php');
}
?>
<style>
	.price p {
		font-size: 20px;
		color: black;
	}

	.price p span {
		font-size: 2em;
		font-family: sans-serif;
		color: #CD1F25;
	}

	.amount {
		margin-bottom: 20px;
	}

	.amount p {
		font-size: 20px;
		color: black;
	}
</style>
<div class="main">
	<div class="content">
		<?php
		$product_preview = $product->get_product_preview($id);
		if ($product_preview) {
			while ($result_preview = $product_preview->fetch_assoc()) {
		?>
				<div class="content_top">
					<div class="main_title " style="margin-top:0px">
						<ul>

							<li><a href="./index.php" style="background: none;padding-left: 10px;">Trang chủ</a></li>
							<li><a>/</a></li>
							<li><a href="category.php?catid=<?= $result_preview['id_producer'] ?>" style="background: none;padding-left: 10px;"> <?= $result_preview['nameProducer'] ?></a></li>
							<li><a>/</a></li>
							<li><a href="demand.php?demandid=<?= $result_preview['id_product_type'] ?>" style="background: none;padding-left: 10px;"> <?= $result_preview['nameProductType'] ?></a></li>
							<li><a>/</a></li>
							<li><a href="#" style="background: none;padding-left: 10px;"> <?= $result_preview['nameProduct'] ?></a></li>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
				<div class="section group">
					<div class="cont-desc span_1_of_2">

						<div class="product-details">
							<div class="grid images_3_of_2">
								<div id="products">
									<li><a href="#"><img style="width :100%;margin-top: -15px; " src="uploads/<?= $result_preview['image'] ?>" alt=" " /></a>
									</li>
								</div>
							</div>
							<div class="desc span_3_of_2">
								<h1 style="font-family: sans-serif;font-size: 30px;font-weight: 600;"><?php echo $result_preview['nameProduct'] ?></h1>
								<div class="price">
									<p>Giá: <span> <?= $fm->format_currency($result_preview['price']) . " đ" ?></span></p>
								</div>
								<div class="amount">
									<?php
									if ($result_preview['amount'] > 0) {
									?>
										<p>Số lượng: <span><?= $result_preview['amount'] ?></span></p>
									<?php
									} else echo "<p> Sản phẩm hết hàng</p>"
									?>

								</div>
								<div class="share-desc">

									<div class="add_cart">
										<form action="" method="post">
											<input type="number" name="quantity" value="1" min="1" max=<?= $result_preview['amount'] ?> style="width:45px;height:25px;">

											<?php
											if ($check_login == false) {
											?>

												<input type="submit" name="sub" class="button" value="Add to cart" style="margin: -7px 230px 0px 0px;padding:0px 15px;cursor: pointer;">

												<?php
											} else {
												if ($result_preview['amount'] > 0) {
												?>
													<input type="submit" name="submit" class="button" value="Add to cart" style="margin: -7px 230px 0px 0px;padding:0px 15px;cursor: pointer;">
												<?php

												} else {
												?>
													<input type="submit" name="submit" class="button" value="Add to cart" style="margin: -7px 230px 0px 0px;padding:0px 15px;cursor: pointer;" disabled>
											<?php
												}
											}
											?>

										</form>
									</div>
									<div class="clear"></div>
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<div class="product_desc">
							<div id="horizontalTab">
								<ul class="resp-tabs-list">
									<li style="font-family: 'sans-serif';">Chi Tiết Sản Phẩm</li>

									<div class="clear"></div>
								</ul>
								<div class="resp-tabs-container">
									<div class="product-desc">
										<?= $result_preview['detail'] ?>
									</div>
								</div>
							</div>
						</div>
						<script type="text/javascript">
							$(document).ready(function() {
								$('#horizontalTab').easyResponsiveTabs({
									type: 'default', //Types: default, vertical, accordion           
									width: 'auto', //auto or any width like 600px
									fit: true // 100% fit in a container
								});
							});
						</script>

						<div class="content_bottom">
							<div class="heading">
								<h3 style="font-family: 'sans-serif';">Sản Phẩm Liên Quan</h3>
							</div>
							<div class="clear"></div>
						</div>
						<div class="section group">
							<?php
							$idProducer = $result_preview['id_producer'];
							$idProductType = $result_preview['id_product_type'];
							$idProduct = $result_preview['id_product'];
							$productRelated = $product->getProductRelated($idProduct, $idProducer, $idProductType);
							if ($productRelated != false) {
								while ($value_productRelated = $productRelated->fetch_assoc()) {
							?>
									<div class="grid_1_of_4 images_1_of_4">
										<a href="preview.php?proid=<?= $value_productRelated['id_product'] ?>"><img width="169.613" height="169.613" src="uploads/<?= $value_productRelated['image'] ?>" alt=""></a>
										<div class="price" style="border:none">
											<div class="add-cart" style="float:none">
												<h2><?= $value_productRelated['nameProduct'] ?></h2>
											</div>
											<div class="clear"></div>
										</div>
										<div class="price" style="border-top:1px solid #CD1F25;margin-top: 10px;padding-top: 10px;">
											<div class="add-cart" style="float:none">
												<h4><?= $fm->format_currency($value_productRelated['price']) . " đ"  ?></h4>
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
					<div class="rightsidebar span_3_of_1">
						<h2 style="font-family: sans-serif;">Danh Mục</h2>

						<ul class="side-w3ls">
							<?php
							$adr = "producer";

							$category = $product->get_category($adr);
							if ($category) {
								while ($result_category = $category->fetch_assoc()) {
							?>
									<li><a href="category.php?catid=<?= $result_category['id_producer'] ?>"><?= $result_category['nameProducer'] ?></a></li>
							<?php
								}
							}
							?>
						</ul>

						<div class="subscribe">
							<h2>Thông tin liên quan</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.......</p>
							<div class="signup">
								<form>
									<input type="text" value="E-mail address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail address';"><input type="submit" value="Sign up">
								</form>
							</div>
						</div>
						<div class="community-poll">
							<h2>Community POll</h2>
							<p>What is the main reason for you to purchase products online?</p>
							<div class="poll">
								<form>
									<ul>
										<li>
											<input type="radio" name="vote" class="radio" value="1">
											<span class="label"><label>More convenient shipping and delivery
												</label></span>
										</li>
										<li>
											<input type="radio" name="vote" class="radio" value="2">
											<span class="label"><label for="vote_2">Lower price</label></span>
										</li>
										<li>
											<input type="radio" name="vote" class="radio" value="3">
											<span class="label"><label for="vote_3">Bigger choice</label></span>
										</li>
										<li>
											<input type="radio" name="vote" class="radio" value="5">
											<span class="label"><label for="vote_5">Payments security </label></span>
										</li>
										<li>
											<input type="radio" name="vote" class="radio" value="6">
											<span class="label"><label for="vote_6">30-day Money Back Guarantee
												</label></span>
										</li>
										<li>
											<input type="radio" name="vote" class="radio" value="7">
											<span class="label"><label for="vote_7">Other.</label></span>
										</li>
									</ul>
								</form>
							</div>
						</div>
					</div>
				</div>

		<?php
			}
		}
		?>


	</div>

	<script>
		$(function() {
			$('#products').slides({
				preload: true,
				preloadImage: 'public/frontend/img/loading.gif',
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				generateNextPrev: true,
				generatePagination: false
			});
		});
	</script>
</div>
<?php
include "layouts/footer.php"
?>