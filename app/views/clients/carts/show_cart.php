<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="<?php echo _WEB_ROOT; ?>">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="stt">STT</td>
							<td class="image">Sản phẩm</td>
							<td class="name"></td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td class="delete"></td>
						</tr>
					</thead>
					<tbody class="table_cart">
						<?php 
							$i = 1;
							if(isset($cart_prod)){
								foreach ($cart_prod as $key => $value) {
						 ?>
						<tr class="product_cart_item" id = "<?php echo $value['id'] ?>">
							<td><?php echo $i ?></td>
							<td class="cart_product">
								<a href="">
									<img src="<?php echo _WEB_ROOT; ?>/public/uploads/product_thumbnail/<?php echo $value['thumb'] ?>" alt="" 
									width = "90">
								</a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $value['name'] ?></a></h4>
								<p>Code: <?php echo $value['code'] ?></p>
							</td>
							<td class="cart_price">
								<span class="cart_price_mini">
									<?php 
										echo number_format($value['price']);
									?>
								</span>
								đ
							</td>
							<td class="cart_quantity">
								<input class="cart_quantity_input" type="number" name="quantity" 
									value="<?php echo $value['quantity'] ?>" autocomplete="off" size="2" min = "1">
							</td>
							<td class="cart_total">
								<span class="cart_total_price"></span> 
								<span style="font-size: 22px;color: orange;"> đ</span>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" 
								data-delid = "<?php echo $value['id'] ?>"
								onclick="return confirm('Bạn chắc chắn muốn xóa?')">
									<i class="fa fa-times"></i>
								</a>
							</td>
						</tr>
						<?php 
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Bạn muốn làm gì tiếp theo?</h3>
				<p>Chọn xem bạn có mã giảm giá hoặc điểm thưởng muốn sử dụng hoặc muốn ước tính chi phí giao hàng của mình.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<form action="<?php echo _WEB_ROOT; ?>/ma-giam-gia" method="post">
						<div class="chose_area">
							<ul class="user_option">
								<span class="success" style="font-size: 18px">
	                                <?php 
	                                    $message = Session::flash('success');
	                                    if($message){
	                                        echo $message;
	                                    }
	                                ?>
	                            </span>
	                            <span class="error" style="font-size: 18px">
	                                <?php 
	                                    $message = Session::flash('error');
	                                    if($message){
	                                        echo $message;
	                                    }
	                                ?>
	                            </span>
								<li>
									<label style="">Sử dụng mã giảm giá</label><br>
									<input type="text" placeholder="Nhập mã giảm giá" name = "coupon"
									class="form-control" autocomplete="off">
								</li>
								
							</ul>
							<input type="submit" class="btn btn-default check_out" value="Tiếp tục" name="ship_and_coupon">
						</div>
					</form>
					<!-- phi van chuyen -->
					<form>
						<div class="chose_area">
							<ul class="user_info">
								<li class="single_field">
									<label for="province">Tỉnh/Thành phố</label>
                                    <select name="province" id="province" class="choose province">
                                        <option disabled selected>Tỉnh/Thành phố</option>
                                        <?php 
                                            foreach ($list_province as $key => $province) {
                                        ?>
                                            <option value="<?php echo $province['id'] ?>">
                                                <?php echo $province['_name'] ?>
                                            </option>
                                        <?php 
                                            }
                                         ?>
                                    </select>	
								</li>
								<li class="single_field">
									<label for="district">Quận/Huyện</label>
                                    <select name="district" id="district" class="choose district">
                                        <option disabled selected>Chọn Quận/Huyện</option>

                                    </select>
								</li>
								<li class="single_field">
									<label for="ward">Xã/Phường</label>
                                    <select name="ward" id="ward" class="ward">
                                        <option disabled selected>Chọn Xã/Phường</option>

                                    </select>
								</li>
							</ul>
							<button type="button" class="btn btn-default calcu_delivery check_out">
								Tính phí vận chuyển
							</button>
						</div>
					</form>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span class="subtotal">59</span></li>
							<!-- <li>Thuế <span>$2</span></li> -->
							<li>Phí vận chuyển 
								<span>
									<?php 
									if(!empty($_SESSION['cart']) && null !== Session::data('fee_ship') ){
											
									?>
										<i class="fee_ship"><?php echo Session::data('fee_ship'); ?></i>
										<i class="vnd"> đ</i>		
									<?php
									}else{
									?>
										<i class="fee_ship">Mặc định</i>
										<i class="vnd"></i>
									<?php 
									}
									 ?>
								</span>
							</li>
							<li>Mã giảm giá 
								<span>
									<?php 
									if(!empty($_SESSION['cart']) && null !== Session::data('coupon') ){
											$coupon_cart = Session::data('coupon');
									?>
									<i class="sale_value"><?php echo $coupon_cart['coupon_value']; ?></i>
									<?php 
											if($coupon_cart['coupon_type'] == 0){
									?>
											<i class="type_sale">%</i>
									<?php
											}else{
									?>
											<i class="type_sale">đ</i>
									<?php
										}
									}else{
									?>
										<i class="sale_value">0</i>
										<i class="type_sale">đ</i>
									<?php 
									}
									 ?>
								</span>
							</li>
							<li>Thành tiền <span class="grandtotal">61</span></li>
						</ul>
							<?php 
								if(null !== Session::data('coupon')){
							 ?>
								<a class="btn btn-default check_out unset_coup" href="<?php echo _WEB_ROOT; ?>/unset-coupon">
									Xóa mã khuyến mãi
								</a>
							<?php 
								}
							 ?>
							 <?php 
								if(null !== Session::data('fee_ship')){
							 ?>
								<a class="btn btn-default check_out unset_feeship" href="<?php echo _WEB_ROOT; ?>/unset-feeship">
									Xóa phí vận chuyển
								</a>
							<?php 
								}
							 ?>
							<?php 
								$cus_id = Session::data('user_id');
								$order_id = Session::data('order_id');
								if(!empty($cus_id) && empty($order_id)){
							 ?>
								<a href="<?php echo _WEB_ROOT; ?>/checkout" 
								class="btn btn-default check_out">
									Thanh toán
								</a>
							<?php 
								}elseif(!empty($cus_id) && !empty($order_id)){
							 ?>
							 	 <a href="<?php echo _WEB_ROOT; ?>/payment" 
								class="btn btn-default check_out">
									Thanh toán
								</a>
							<?php 
								}else{
							 ?>
								 <a href="<?php echo _WEB_ROOT; ?>/login-checkout" 
								class="btn btn-default check_out">
									Thanh toán
								</a>
							<?php 
								}
							 ?>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

<!-- Xử lý giỏ hàng -->
 <script type="text/javascript">

	function total_item() {
		var products = document.querySelectorAll('.product_cart_item');
		products.forEach(product => {
			var priceStr = product.querySelector('.cart_price_mini').innerHTML;
			var a = priceStr.replaceAll(',','');
			var price = Number(a);
			var qty = Number(product.querySelector('.cart_quantity_input').value);
			var total = price * qty;
			product.querySelector('.cart_total_price').innerHTML = total;
		});
	}

	function total_cart() {
		var total_item = document.querySelectorAll('.cart_total_price');
		var result = 0;
		total_item.forEach(element => {
			result += Number(element.innerHTML);
		});

		var sub_total = result;

		var sale_value = document.querySelector('.sale_value').innerHTML;
		var type_sale = document.querySelector('.type_sale').innerHTML;

		if(type_sale == '%'){
			result = result - (result * sale_value/100);
			console.log(sale_value);
		}else if(type_sale == 'đ'){
			result = result - sale_value;
		}

		var fee_ship = document.querySelector('.fee_ship').innerHTML;
		if(fee_ship !== 'Mặc định'){
			result = result + Number(fee_ship);
		}

		document.querySelector('.total_area .subtotal').innerHTML = sub_total + " đ";
		document.querySelector('.total_area .grandtotal').innerHTML = result + " đ";
	}

	total_item();
	total_cart();

	var qties = document.querySelectorAll('.cart_quantity_input');
	qties.forEach(element => {
		element.addEventListener('change', function() {
			total_item();
			var time = setTimeout(total_cart(), 1000);
			$.ajax({
				url: '<?php echo _WEB_ROOT; ?>/process-qty',
				method: 'POST',
				data: {
					product: {
						prod_id: element.parentElement.parentElement.id,
						prod_qty: element.value
					}
				},
				success:function(data){
					console.log(data);
				}
			})
		});
	});

	var del_items = document.querySelectorAll('.cart_quantity_delete');
	var table_cart = document.querySelector('.table_cart');
	del_items.forEach(element => {
		element.addEventListener('click', function() {
			var del_id = element.dataset.delid;
			$.ajax({
				url: '<?php echo _WEB_ROOT; ?>/del-cart',
				method: 'POST',
				data:{
					id:del_id
				},
				success:function(data){
					table_cart.removeChild(element.parentElement.parentElement);
					var time = setTimeout(total_cart(), 1000);
				}
			})
		});
	});

</script>

<!-- Xử lý phí vận chuyển -->
<script type="text/javascript">
    $(document).ready(function(){
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var id = $(this).val();
            var result = '';

            if(action == 'province'){
                result = 'district';
            }else{
                result = 'ward';
            }

            $.ajax({
                url: '<?php echo _WEB_ROOT; ?>/van-chuyen',
                method: 'POST',
                data: {
                    action:action,
                    id:id
                },
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });

        $('.calcu_delivery').click(function(){
        	var province = $('.province').val();
            var district = $('.district').val();
            var ward = $('.ward').val();

            if(province == '' || district == '' || ward == ''){
            	swal("Bạn hãy chọn đầy đủ thông tin để tính phí vận chuyển");
            }else{
            	$.ajax({
	                url: '<?php echo _WEB_ROOT; ?>/phi-van-chuyen',
	                method: 'POST',
	                data: {
	                    province:province,
	                    district:district,
	                    ward:ward
	                },
	                success:function(data){
	                    $('.fee_ship').html(data);
	                    $('.vnd').html(' đ');
	                    var time = setTimeout(total_cart(), 1000);
	                }
	            });
            }	
        });
    });
</script>