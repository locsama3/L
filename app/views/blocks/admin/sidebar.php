<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/backend/css/main.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/backend/css/all.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/backend/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/backend/css/morris.css">
    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/backend/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/backend/js/jquery-ui.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="dashboard">
                <div class="left">
                    <span class="left__icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="left__content">
                        <div class="left__logo">Vitamin</div>
                        <div class="left__profile">
                            <div class="left__image">
                                <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/profile.jpg" alt="">
                            </div>
                            <p class="left__name">Hello 
                                <?php 
                                    $admin_name = Session::data('admin_name');
                                    if($admin_name){
                                        echo $admin_name;
                                    }
                                ?>
                            </p>
                        </div>
                        <ul class="left__menu">
                            <li class="left__menuItem">
                                <a href="<?php echo _WEB_ROOT; ?>/dashboard" class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-dashboard.svg" alt="">Dashboard
                                </a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-tag.svg" alt="">Sản Phẩm
                                    <img class="left__iconDown" src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-down.svg" alt="">
                                </div>
                                <div class="left__text">
                                    <a class="left__link" href="<?php echo _WEB_ROOT; ?>/add-product">Chèn Sản Phẩm</a>
                                    <a class="left__link" href="<?php echo _WEB_ROOT; ?>/view-product">Xem Sản Phẩm</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-edit.svg" alt="">Danh Mục SP
                                    <img class="left__iconDown" src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-down.svg" alt="">
                                </div>
                                <div class="left__text">
                                    <a class="left__link" href="<?php echo _WEB_ROOT; ?>/add-cate-prod">Thêm Danh Mục SP</a>
                                    <a class="left__link" href="<?php echo _WEB_ROOT; ?>/view-cate-prod">Xem Danh Mục SP</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-book.svg" alt="">Thương hiệu
                                    <img class="left__iconDown" src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-down.svg" alt="">
                                </div>
                                <div class="left__text">
                                    <a class="left__link" href="<?php echo _WEB_ROOT; ?>/add-brand">Thêm thương hiệu SP</a>
                                    <a class="left__link" href="<?php echo _WEB_ROOT; ?>/view-brand">Xem thương hiệu SP</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="<?php echo _WEB_ROOT; ?>/manage-comment" class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-pencil.svg" alt="">Bình luận
                                </a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-settings.svg" alt="">Slide
                                    <img class="left__iconDown" src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="<?php echo _WEB_ROOT; ?>/add-slide">Chèn Slide</a>
                                    <a class="left__link" href="<?php echo _WEB_ROOT; ?>/view-slide">Xem Slide</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-book.svg" alt="">Coupons
                                    <img class="left__iconDown" src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="<?php echo _WEB_ROOT; ?>/add-coupon">Thêm Coupon</a>
                                    <a class="left__link" href="<?php echo _WEB_ROOT; ?>/view-coupon">Xem Coupons</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="<?php echo _WEB_ROOT; ?>/delivery" class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-book.svg" alt="">Phí vận chuyển
                                </a>
                            </li>
                            <li class="left__menuItem">
                                <a href="view_customers.php" class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-users.svg" alt="">Khách Hàng
                                </a>
                            </li>
                            <li class="left__menuItem">
                                <a href="<?php echo _WEB_ROOT; ?>/manage-order" class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-book.svg" alt="">Đơn Đặt Hàng
                                </a>
                            </li>
                            <li class="left__menuItem">
                                <a href="edit_css.php" class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-pencil.svg" alt="">Chỉnh CSS
                                </a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-user.svg" alt="">Admin
                                    <img class="left__iconDown" src="<?php echo _WEB_ROOT; ?>/public/backend/assets/arrow-down.svg" alt="">
                                </div>
                                <div class="left__text">
                                    <a class="left__link" href="insert_admin.php">Chèn Admin</a>
                                    <a class="left__link" href="view_admins.php">Xem Admins</a>
                                </div>
                            </li>                           
                            <li class="left__menuItem">
                                <a href="<?php echo _WEB_ROOT; ?>/logout" class="left__title">
                                    <img src="<?php echo _WEB_ROOT; ?>/public/backend/assets/icon-logout.svg" alt="">Đăng Xuất
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>