<?php 
	$check = Session::data('admin_id');
	if(!empty($check)){
		$data['content'] = 'admins.dashboard';
		$this->view('layouts.admin_layout',$data);
	}else{
 ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Đăng nhập Trang quản trị</title>
<link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/backend/css/main.css">
</head>
<body>
<div class="container">
	<section id="content">
		<form action="<?php echo _WEB_ROOT; ?>/admin-dashboard" method="post" autocomplete = "off">
			<h1>Đăng nhập</h1>
			<span class="error">
				<?php 
					$message = Session::flash('mess');
					if($message){
						echo $message;
					}
				?>
			</span>
			<div>
				<input type="text" placeholder="Tên đăng nhập" required="" id="username" name="admin_user" />
			</div>
			<div>
				<input type="password" placeholder="Mật khẩu" required="" id="password" name="admin_pass" />
			</div>
			<div>
				<input type="submit" value="Đăng nhập" name="login_admin" />
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>

<?php 
	}
 ?>