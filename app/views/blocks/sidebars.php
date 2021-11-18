<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php 
								foreach ($cate_prod as $key => $value) {
							 ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="<?php echo _WEB_ROOT; ?>/danh-muc-sp/cate-<?php echo $value['id'] ?>">
											<?php echo $value['cate_name'] ?>
										</a>
									</h4>
								</div>
							</div>
							<?php 
								}
							 ?>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<?php 
										foreach ($brand as $key => $value) {
									 ?>
									<li>
										<a href="<?php echo _WEB_ROOT; ?>/thuong-hieu-sp/brand-<?php echo $value['id'] ?>">
										<?php echo $value['brand_name'] ?>	
										</a>
									</li>
									<?php 
										}
									 ?>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Mức giá</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="<?php echo _WEB_ROOT; ?>/public/frontend/images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>