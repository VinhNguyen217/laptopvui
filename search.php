<?php
include "layouts/header.php"
?>

<div class="main">
	
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Sản Phẩm Tìm Kiếm</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
                $get_prt = $product->search($_SESSION['search']);
			    if ($get_prt) {
				    while ($result_new = $get_prt->fetch_assoc()) {
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