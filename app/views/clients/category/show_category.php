<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center"><?php echo $cate['cate_name']; ?></h2>
						<?php 
							foreach ($cate_products as $key => $prod) {
						 ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $prod['thumbnail'] ?>" alt="" />
										<h2><?php echo number_format($prod['regular_price']) ?> VND</h2>
										<p><?php echo $prod['name'] ?></p>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2><?php echo number_format($prod['regular_price']) ?> VND</h2>
											<a href="<?php echo _WEB_ROOT; ?>/chi-tiet-sp/chitiet-<?php echo $prod['id'] ?>">
												<p><?php echo $prod['name'] ?></p>
											</a>
											
											<form action="<?php echo _WEB_ROOT; ?>/luu-gio-hang" method="post">
												<span style="margin-top: 0;">
													<input type="hidden" value="1" min="1" name = "qty"/>
													<input type="hidden" value="<?php echo $new_prod['id'] ?>" 
														   name = "prodid_hidden"/>
												   <input type="hidden" value="<?php echo $new_prod['slug'] ?>" 
														   name = "prodslug_hidden"/>	
													<input type="hidden" value="<?php echo $new_prod['name'] ?>" 
														   name = "prodname_hidden"/>
													<input type="hidden" value="<?php echo $new_prod['thumbnail'] ?>" 
														   name = "prodimage_hidden"/>
													<input type="hidden" value="<?php echo $new_prod['regular_price'] ?>" 
														   name = "prodprice_hidden"/>
													<button type="submit" class="btn btn-fefault add-to-cart">
														<i class="fa fa-shopping-cart"></i>
														Thêm vào giỏ hàng
													</button>
												</span>
											</form>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php 
							}
						 ?>
					</div><!--features_items-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="<?php echo _WEB_ROOT; ?>/public/frontend/images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="<?php echo _WEB_ROOT; ?>/public/frontend/images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>