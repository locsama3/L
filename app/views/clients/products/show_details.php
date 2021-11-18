<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<style>
								.lSSlideOuter .lSPager.lSGallery img {
								    display: block;
								    height: 100px;
								    max-width: 100%;
								}

								li.active{
									border: 1px solid #FE980F;
								}
							</style>	
							<ul id="imageGallery">
								<li data-thumb="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $product_by_id['thumbnail'] ?>" 
							  	data-src="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $product_by_id['thumbnail'] ?>">
							    	<img src="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $product_by_id['thumbnail'] ?>" width="100%" alt = "<?php echo $product_by_id['name'] ?>"/>
							  </li>
							<?php 
								foreach ($product_gallery as $key => $gal) {
							 ?>
							  <li data-thumb="<?php echo _WEB_ROOT; ?>/public/uploads/product_gallery/<?php echo $gal['image_url'] ?>" 
							  	data-src="<?php echo _WEB_ROOT; ?>/public/uploads/product_gallery/<?php echo $gal['image_url'] ?>">
							    	<img alt="<?php echo $gal['gallery_name'] ?>" src="<?php echo _WEB_ROOT; ?>/public/uploads/product_gallery/<?php echo $gal['image_url'] ?>" width="100%"/>
							  </li>
							<?php 
							  	}
							?>
							</ul>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="<?php echo _WEB_ROOT; ?>/public/frontend/images/product-details/new.jpg" class="newarrival" alt="" />
								<h2><?php echo $product_by_id['name'] ?></h2>
								<p>Mã sản phẩm: <?php echo $product_by_id['slug'] ?></p>
								<img src="<?php echo _WEB_ROOT; ?>/public/frontend/images/product-details/rating.png" alt="" style = "display: block"/>
								<span>
									<span><?php echo number_format($product_by_id['regular_price']) ?> VND</span>
								</span>
								<!-- form nhập số lượng -->
								<form action="<?php echo _WEB_ROOT; ?>/luu-gio-hang" method="post">
									<span style="margin-top: 0;">
										<label>Số lượng:</label>
										<input type="number" value="1" min="1" name = "qty"/>
										<input type="hidden" value="<?php echo $product_by_id['prod_id'] ?>" 
											   name = "prodid_hidden"/>
									   <input type="hidden" value="<?php echo $product_by_id['code'] ?>" 
											   name = "prodslug_hidden"/>	
										<input type="hidden" value="<?php echo $product_by_id['name'] ?>" 
											   name = "prodname_hidden"/>
										<input type="hidden" value="<?php echo $product_by_id['thumbnail'] ?>" 
											   name = "prodimage_hidden"/>
										<input type="hidden" value="<?php echo $product_by_id['regular_price'] ?>" 
											   name = "prodprice_hidden"/>
										<button type="submit" class="btn btn-fefault cart">
											<i class="fa fa-shopping-cart"></i>
											Thêm vào giỏ hàng
										</button>
									</span>
								</form>

								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Trạng thái:</b> Mới</p>
								<p><b>Thương hiệu:</b> <?php echo $product_by_id['brand_name'] ?></p>
								<p><b>Danh mục:</b> <?php echo $product_by_id['cate_name'] ?></p>
								<a href=""><img src="<?php echo _WEB_ROOT; ?>/public/frontend/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Mô tả sản phẩm</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="col-sm-12">
									<?php echo $product_by_id['short_desc'] ?>
									
								</div>
								
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-12">
									<?php echo $product_by_id['description'] ?>
								</div>
								
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>Tấn Lộc</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>11:47 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>11 JUNE 2021</a></li>
									</ul>

									<style>
										.style_comment {
										    border: 1px solid #ddd;
										    background: #eeeeee47;
										    margin: 0;
										    margin-bottom: 16px;
										}
									</style>	

									<div class="row style_comment" data-prod_id = "<?php echo $product_by_id['prod_id'] ?>">
										
									</div>

									<p><b style="font-size: 16px; ">Để lại đánh giá của bạn</b></p>
									<!-- Rating here -->
									<ul class="list-inline" title="Average Rating">
										<?php 
											for ($count=1; $count <=5 ; $count++) { 
												if($count <= $rating){
													$color = 'color:#ffcc00;';
												}else{
													$color = 'color:#ccc;';
												}
										 ?>	
										<li title = "star_rating" data-index = "<?php echo $count ?>" 
										data-prod_id = "<?php echo $product_by_id['prod_id'] ?>" 
										data-rating = "<?php echo $rating ?>" style = "<?php echo $color ?>"
										class = "rating" id = "<?php echo $product_by_id['prod_id'].'-'.$count ?>"
										>
											&#9733;
										</li>
										<?php 
											}
										 ?>
									</ul>

									<form>
										<span>
											<input type="text" 
												<?php 
													if(Session::data('user_name') != null){
														echo 'placeholder="'. Session::data('user_name'). '"';
													}else{
														echo 'placeholder="Họ và tên"';
													}
												 ?>
											/>
											<input type="email" 
												<?php 
													if(Session::data('user_email') != null){
														echo 'placeholder="'. Session::data('user_email'). '"';
													}else{
														echo 'placeholder="Địa chỉ Email"';
													}
												 ?>
											/>
										</span>
										<input type="hidden" class="user_id" value="<?php echo Session::data('user_id'); ?>">
										<textarea name="comment_content" class="comment_content" placeholder="Nhập bình luận"></textarea>
										<button type="button" class="btn btn-default pull-right send-comment">
											Bình luận
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm tương tự</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<?php 
										for ($i=0; $i < count($related_product); $i++) { 
											if($i == 3){
												break;
											}
									 ?>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $related_product[$i]['thumbnail'] ?>" alt="" />
													<h2><?php echo number_format($related_product[$i]['regular_price']) ?> VND</h2>
													<a href="<?php echo _WEB_ROOT; ?>/chi-tiet-sp/chitiet-<?php echo $related_product[$i]['id'] ?>">
														<p><?php echo $related_product[$i]['name'] ?></p>
													</a>
													
													<a href="<?php echo _WEB_ROOT; ?>/them-gio-hang/them-<?php echo $related_product[$i]['id'] ?>" 
													   class="btn btn-default add-to-cart">
														<i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
													</a>
												</div>
											</div>
										</div>
									</div>
									<?php 
										}
									 ?>
								</div>

								<div class="item">	
									<?php 
										for ($i=3; $i < count($related_product); $i++) { 
											if($i == 5){
												break;
											}
									 ?>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $related_product[$i]['thumbnail'] ?>" alt="" />
													<h2><?php echo number_format($related_product[$i]['regular_price']) ?> VND</h2>
													<a href="<?php echo _WEB_ROOT; ?>/chi-tiet-sp/chitiet-<?php echo $related_product[$i]['id'] ?>">
														<p><?php echo $related_product[$i]['name'] ?></p>
													</a>
													
													<a href="<?php echo _WEB_ROOT; ?>/them-gio-hang/them-<?php echo $related_product[$i]['id'] ?>" 
													   class="btn btn-default add-to-cart">
														<i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
													</a>
												</div>
											</div>
										</div>
									</div>
									<?php 
										}
									 ?>
								</div>

								<div class="item">	
									<?php 
										for ($i=6; $i < count($related_product); $i++) { 
											if($i == 8){
												break;
											}
									 ?>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $related_product[$i]['thumbnail'] ?>" alt="" />
													<h2><?php echo number_format($related_product[$i]['regular_price']) ?> VND</h2>
													<a href="<?php echo _WEB_ROOT; ?>/chi-tiet-sp/chitiet-<?php echo $related_product[$i]['id'] ?>">
														<p><?php echo $related_product[$i]['name'] ?></p>
													</a>
													
													<a href="<?php echo _WEB_ROOT; ?>/them-gio-hang/them-<?php echo $related_product[$i]['id'] ?>" 
													   class="btn btn-default add-to-cart">
														<i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
													</a>
												</div>
											</div>
										</div>
									</div>
									<?php 
										}
									 ?>
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
<script src="<?php echo _WEB_ROOT; ?>/public/frontend/js/lightslider.js"></script>
<script src="<?php echo _WEB_ROOT; ?>/public/frontend/js/lightgallery-all.min.js"></script>
<script src="<?php echo _WEB_ROOT; ?>/public/frontend/js/prettify.js"></script>
<script type="text/javascript">
	  $(document).ready(function() {
	    $('#imageGallery').lightSlider({
	        gallery:true,
	        item:1,
	        loop:true,
	        thumbItem:3,
	        slideMargin:0,
	        enableDrag: false,
	        currentPagerPosition:'left',
	        onSliderLoad: function(el) {
	            el.lightGallery({
	                selector: '#imageGallery .lslide'
	            });
	        }   
	    });  
	  });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		load_comment();
		
		function load_comment() {
			var prod_id = $('.style_comment').data('prod_id');
			$.ajax({
				url: '<?php echo _WEB_ROOT; ?>/load-comment',
				method:'POST',
				data:{
					prod_id:prod_id
				},
				success:function(data){
					$('.style_comment').html(data);
				}
			})
		}

		$('.send-comment').click(function(){
			var prod_id = $('.style_comment').data('prod_id');
			var cus_id = $('.user_id').val();
			var comment_content = $('.comment_content').val();

			if(cus_id == ''){
				swal("", "Bạn phải đăng nhập để bình luận", "warning");
			}else{
				$.ajax({
					url: '<?php echo _WEB_ROOT; ?>/send-comment',
					method:'POST',
					data:{
						prod_id:prod_id,
						cus_id:cus_id,
						comment_content:comment_content
					},
					success:function(data){
						load_comment();
						var comment_content = $('.comment_content').val('');
					}
				})
			}
		})
	})
</script>

<script type="text/javascript">
	function remove_background(product_id) {
		for(var count = 1; count <= 5; count++){
			$('#' + product_id + '-' + count).css('color','#ccc');
		}
	}

	//hover chuột đánh giá sao
	$(document).on('mouseenter', '.rating', function(){
		var index = $(this).data('index');
		var prod_id = $(this).data('prod_id');

		remove_background(prod_id);

		for(var count = 1; count <= index; count++){
			$('#' + prod_id + '-' + count).css('color','#ffcc00');
		}
	});

	//Nhả chuột ko đánh giá
	$(document).on('mouseleave', '.rating', function () {
		var index = $(this).data('index');
		var prod_id = $(this).data('prod_id');
		var rating = $(this).data('rating');

		remove_background(prod_id);

		for(var count = 1; count <= rating; count++){
			$('#' + prod_id + '-' + count).css('color','#ffcc00');
		}
	});

	// click đánh giá sao
	$(document).on('click', '.rating', function () {
		var index = $(this).data('index');
		var prod_id = $(this).data('prod_id');

		$.ajax({
			url: '<?php echo _WEB_ROOT; ?>/insert-rating',
			method: 'POST',
			data:{
				index:index,
				prod_id:prod_id
			},
			success:function (data) {
				if(data == "done"){
					swal("Cảm ơn", "Bạn đã đánh giá " + index + " trên 5 sao", "success");
				}else{
					swal("", "Lỗi đánh giá", "danger");
				}
			}
		})
	})
</script>