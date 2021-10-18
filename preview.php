<?php
	include "layouts/header.php"
?>
<?php
	if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
		echo "<script>window.location = 'index.php'</script>";
	} else {
		$id = $_GET['proid'];
	}
?>
<div class="main">
	<div class="content">
		<?php
			$product_preview = $product->get_product_preview($id);
			if($product_preview){
				while($result_preview =$product_preview->fetch_assoc()){
		?>
		<div class="content_top">
			<div class="main_title " >
				<ul>
					
					<li><a href="./index.php" style="background: none;padding-left: 0px;">Trang chủ</a></li>
					<li><a>/</a></li>
					<li><a href="category.php?catid=<?=$result_preview['id_producer']?>" style="background: none;padding-left: 0px;"> <?=$result_preview['nameProducer']?></a></li>
					<li><a>/</a></li>
					<li><a href="demand.php?demandid=<?=$result_preview['id_product_type']?>" style="background: none;padding-left: 0px;"> <?=$result_preview['nameProductType']?></a></li>
					<li><a>/</a></li>
					<li><a href="#" style="background: none;padding-left: 0px;"> <?=$result_preview['nameProduct']?></a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<div class="cont-desc span_1_of_2">
				
				<div class="product-details">
					<div class="grid images_3_of_2">
						<div id="products">
							<li><a href="#"><img  style ="width :100%;margin-top: -15px; "src="uploads/<?=$result_preview['image']?>" alt=" " /></a>
							</li>
						</div>
					</div>
					<div class="desc span_3_of_2">
						<h2><?=$result_preview['nameProduct']?></h2>
						<p><?php echo $fm->textShorten($result_preview['detail'],150)?></p>
						<div class="price">
							<p>Price: <span><?=$result_preview['price']?> VND</span></p>
						</div>
						<div class="share-desc">
							<div class="share">
								<p>Share Product :</p>
								<ul>
									<li><a href="#"><img src="public/frontend/images/facebook.png" alt="" /></a></li>
									<li><a href="#"><img src="public/frontend/images/twitter.png" alt="" /></a></li>
								</ul>
							</div>
							<div class="button"><span><a href="#">Add to Cart</a></span></div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="product_desc">
					<div id="horizontalTab">
						<ul class="resp-tabs-list">
							<li>Product Details</li>
							<li>product Tags</li>
							<li>Product Reviews</li>
							<div class="clear"></div>
						</ul>
						<div class="resp-tabs-container">
							<div class="product-desc">
								<?=$result_preview['detail']?>
							</div>

							<div class="product-tags">
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
									Lorem Ipsum has been the industry's standard dummy text ever since the
									1500s, when an unknown printer took a galley of type and scrambled it to
									make a type specimen book. It has survived not only five centuries, but also
									the leap into electronic typesetting, remaining essentially unchanged.</p>
								<h4>Add Your Tags:</h4>
								<div class="input-box">
									<input type="text" value="">
								</div>
								<div class="button"><span><a href="#">Add Tags</a></span></div>
							</div>

							<div class="review">
								<h4>Lorem ipsum Review by <a href="#">Finibus Bonorum</a></h4>
								<ul>
									<li>Price :<a href="#"><img src="public/frontend/imagesprice-rating.png" alt="" /></a></li>
									<li>Value :<a href="#"><img src="public/frontend/images/value-rating.png" alt="" /></a></li>
									<li>Quality :<a href="#"><img src="public/frontend/images/quality-rating.png" alt="" /></a>
									</li>
								</ul>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
									Lorem Ipsum has been the industry's standard dummy text ever since the
									1500s, when an unknown printer took a galley of type and scrambled it to
									make a type specimen book. It has survived not only five centuries, but also
									the leap into electronic typesetting, remaining essentially unchanged.</p>
								<div class="your-review">
									<h3>How Do You Rate This Product?</h3>
									<p>Write Your Own Review?</p>
									<form>
										<div>
											<span><label>Nickname<span class="red">*</span></label></span>
											<span><input type="text" value=""></span>
										</div>
										<div><span><label>Summary of Your Review<span
														class="red">*</span></label></span>
											<span><input type="text" value=""></span>
										</div>
										<div>
											<span><label>Review<span class="red">*</span></label></span>
											<span><textarea> </textarea></span>
										</div>
										<div>
											<span><input type="submit" value="SUBMIT REVIEW"></span>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$(document).ready(function () {
						$('#horizontalTab').easyResponsiveTabs({
							type: 'default', //Types: default, vertical, accordion           
							width: 'auto', //auto or any width like 600px
							fit: true   // 100% fit in a container
						});
					});
				</script>
				
				<div class="content_bottom">
					<div class="heading">
						<h3>Related Products</h3>
					</div>
					<div class="see">
						<p><a href="#">See all Products</a></p>
					</div>
					<div class="clear"></div>
				</div>
				<div class="section group">
					<div class="grid_1_of_4 images_1_of_4">
						<a href="#"><img src="public/frontend/images/new-pic1.jpg" alt=""></a>
						<div class="price" style="border:none">
							<div class="add-cart" style="float:none">
								<h4><a href="#">Add to Cart</a></h4>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="#"><img src="public/frontend/images/new-pic2.jpg" alt=""></a>
						<div class="price" style="border:none">
							<div class="add-cart" style="float:none">
								<h4><a href="#">Add to Cart</a></h4>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="#"><img src="public/frontend/images/new-pic4.jpg" alt=""></a>
						<div class="price" style="border:none">
							<div class="add-cart" style="float:none">
								<h4><a href="#">Add to Cart</a></h4>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="grid_1_of_4 images_1_of_4">
						<img src="public/frontend/images/new-pic3.jpg" alt="">
						<div class="price" style="border:none">
							<div class="add-cart" style="float:none">
								<h4><a href="#">Add to Cart</a></h4>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				
				<ul class="side-w3ls">
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
				
				<div class="subscribe">
					<h2>Newsletters Signup</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.......</p>
					<div class="signup">
						<form>
							<input type="text" value="E-mail address" onfocus="this.value = '';"
								onblur="if (this.value == '') {this.value = 'E-mail address';"><input
								type="submit" value="Sign up">
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
		.rightsidebar.span_3_of_1 {
			margin-top: 28px;
		}
	</style>
	<script>
		$(function () {
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