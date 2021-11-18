<?php 
	$check = Session::data('user_id');
	if(!empty($check)){
		$data['content'] = 'clients.index';
		return $this->view('layouts.clients_layout',$data);
	}
 ?>
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản của bạn</h2>
						<?php 
                            $message = Session::flash('mess');
                            if($message){
                                echo $message;
                            }
                        ?>
						<form action="<?php echo _WEB_ROOT; ?>/login-user" method="post">
							<input type="email" placeholder="Email" name="email" />
							<input type="password" placeholder="Mật khẩu" name="password" />
							<button type="submit" class="btn btn-default" name="login">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">HOẶC</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản mới</h2>
						<?php 
                            $message = Session::flash('message');
                            if($message){
                                echo $message;
                            }
                        ?>
						<form action="<?php echo _WEB_ROOT; ?>/add-customer" method="post">
							<input type="text" placeholder="Họ và tên" name="user_name" />
							<input type="email" placeholder="Địa chỉ Email" name="user_email" />
							<input type="password" placeholder="Mật khẩu" name="user_password" />
							<input type="text" placeholder="Địa chỉ" name="user_address" />
							<input type="text" placeholder="Số điện thoại" name="user_phone" />
							<button type="submit" class="btn btn-default" name="submit">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->