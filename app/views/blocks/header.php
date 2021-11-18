<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Meta -->
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link  rel="icon" type="image/x-icon" href="" />
    
	<meta property="og:image" content="{{$image_og}}" />
	<meta property="og:site_name" content="thiatv.com" />
	<meta property="og:description" content="{{$meta_desc}}" />
	<meta property="og:title" content="{{$meta_title}}" />
	<meta property="og:url" content="{{$url_canonical}}" />
	<meta property="og:type" content="website" />
	<!-- End SEO Meta -->

    <title>Trang chủ | E-Shopper</title>
    <link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/price-range.css" rel="stylesheet">
    <link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/animate.css" rel="stylesheet">
	<link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/main.css" rel="stylesheet">
	<link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/responsive.css" rel="stylesheet">
	<link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/sweetalert.css" rel="stylesheet">
	<link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/lightslider.css" rel="stylesheet">
	<link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/lightGallery.css" rel="stylesheet">
	<link href="<?php echo _WEB_ROOT; ?>/public/frontend/css/prettify.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo _WEB_ROOT; ?>/public/frontend/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script src="<?php echo _WEB_ROOT; ?>/public/frontend/js/jquery.js"></script>
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="<?php echo _WEB_ROOT; ?>/public/frontend/images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Việt Nam</a></li>
									<li><a href="#">English</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">VietNam Đồng</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php 
									$cus_id = Session::data('user_id');
									if(!empty($cus_id)){
								 ?>
									<li><a href="<?php echo _WEB_ROOT; ?>/tai-khoan"><i class="fa fa-user"></i> Tài khoản</a></li>
								<?php 
									}else{
								 ?>
									<li><a href="<?php echo _WEB_ROOT; ?>/login-checkout"><i class="fa fa-user"></i> Tài khoản</a></li>
								<?php 
									}
								 ?>
								
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>

								<?php 
									$cus_id = Session::data('user_id');
									$order_id = Session::data('order_id');
									if(!empty($cus_id) && empty($order_id)){
								 ?>
									<li><a href="<?php echo _WEB_ROOT; ?>/checkout"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php 
									}elseif(!empty($cus_id) && !empty($order_id)){
								 ?>
								 	<li><a href="<?php echo _WEB_ROOT; ?>/payment"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php 
									}else{
								 ?>
									<li><a href="<?php echo _WEB_ROOT; ?>/login-checkout"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php 
									}
								 ?>

								<li><a href="<?php echo _WEB_ROOT; ?>/gio-hang"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>

								<?php 
									$cus_id = Session::data('user_id');
									if(!empty($cus_id)){
								 ?>
									<li><a href="<?php echo _WEB_ROOT; ?>/dang-xuat"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								<?php 
									}else{
								 ?>
									<li><a href="<?php echo _WEB_ROOT; ?>/login-checkout"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								<?php 
									}
								 ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Thanh tùy chọn</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?php echo _WEB_ROOT; ?>" class="active">Trang chủ</a></li>
								<li class="dropdown"><a href="<?php echo _WEB_ROOT; ?>">Cửa hàng<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Sản phẩm</a></li>
										<li><a href="product-details.html">Sản phẩm mới nhất</a></li> 
										<li><a href="checkout.html">Sản phẩm nổi bật</a></li> 
										<li><a href="">Sản phẩm giảm giá</a></li> 
										<li><a href="login.html">Chi tiết sản phẩm</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Danh mục</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="404.html">Giới thiệu</a></li>
								<li><a href="contact-us.html">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<form action="<?php echo _WEB_ROOT; ?>/tim-kiem" method="post">
							<div class="search_box pull-right">
								<input type="text" placeholder="Tìm kiếm sản phẩm" name="keyword_search" />
								<input type="submit" name="search_item" class="btn btn-warning btn-sm my-search" value="">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->