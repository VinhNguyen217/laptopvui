<?php
include "layouts/header.php"
?>

<div class="main">
	<div class="header_slide">
		<div class="header_bottom_left">
			<div class="categories">
				<ul>
					<h3>Danh Mục</h3>
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
			</div>

		</div>
		<div class="header_bottom_right">
			<div class="slider">
				<div id="slider">
					<div id="mover">
						<div id="slide-1" class="slide">
							<div class="slider-img">
								<a href="preview.php"><img src="public/frontend/images/slide-1-image.png" alt="learn more" /></a>
							</div>
							<div class="slider-text">
								<h1>Clearance<br><span>SALE</span></h1>
								<h2>UPTo 20% OFF</h2>
								<div class="features_list">
									<h4>Get to Know More About Our Memorable Services Lorem Ipsum is simply
										dummy text</h4>
								</div>
								<a href="preview.php" class="button">Shop Now</a>
							</div>
							<div class="clear"></div>
						</div>
						<div class="slide">
							<div class="slider-text">
								<h1>Clearance<br><span>SALE</span></h1>
								<h2>UPTo 40% OFF</h2>
								<div class="features_list">
									<h4>Get to Know More About Our Memorable Services</h4>
								</div>
								<a href="preview.php" class="button">Shop Now</a>
							</div>
							<div class="slider-img">
								<a href="preview.php"><img src="public/frontend/images/slide-3-image.jpg" alt="learn more" /></a>
							</div>
							<div class="clear"></div>
						</div>
						<div class="slide">
							<div class="slider-img">
								<a href="preview.php"><img src="public/frontend/images/slide-2-image.jpg" alt="learn more" /></a>
							</div>
							<div class="slider-text">
								<h1>Clearance<br><span>SALE</span></h1>
								<h2>UPTo 10% OFF</h2>
								<div class="features_list">
									<h4>Get to Know More About Our Memorable Services Lorem Ipsum is simply
										dummy text</h4>
								</div>
								<a href="preview.php" class="button">Shop Now</a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Sản Phẩm Mới Nhất</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$iid = 1;
			$name = "new";
			$nums = 4;
			$adr = "product";
			$product_new = $product->get_product($adr, $iid, $name, $nums);
			if ($product_new) {
				while ($result_new = $product_new->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.php?proid=<?= $result_new['id_product'] ?>"><img src="uploads/<?= $result_new['image'] ?>" alt="" /></a>
						<h2><?= $result_new['nameProduct'] ?></h2>
						<div class="price-details">
							<div class="price-number">
								<p><span class="rupees"><?= $result_new['price'] ?></span></p>
							</div>
							
							<div class="clear"></div>
						</div>

					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>Sản Phẩm Ưa Thích</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$iid = 1;
			$name = "top";
			$nums = 4;
			$adr = "product";
			$product_hot = $product->get_product($adr, $iid, $name, $nums);
			if ($product_hot) {
				while ($result_hot = $product_hot->fetch_assoc()) {



			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.php?proid=<?= $result_hot['id_product'] ?>"><img src="uploads/<?= $result_hot['image'] ?>" alt="" /></a>
						<h2><?= $result_hot['nameProduct'] ?></h2>
						<div class="price-details">
							<div class="price-number">
								<p><span class="rupees"><?= $result_hot['price'] ?></span></p>
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
	<style>
		.main_title {
			font-size: 12px;
		}

		.main_title ul {
			list-style: none;
			margin: 10px;
			display: block;
		}

		.main_title ul li {
			float: left;
		}

		.main_title ul li a {
			line-height: 35px;
			font-size: 15px;
			font-weight: 600;
			color: #555;
			padding: 0px 10px;
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
			background: #243a76;
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
</div>
<?php
include "layouts/footer.php"
?>