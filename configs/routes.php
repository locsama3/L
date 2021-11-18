<?php 
	$routes['default_controller'] = 'home';

	/* 
	* Đường dẫn ảo => đường dẫn thiệt	
	* key => value
	*/
	// routes clients
	$routes['trang-chu'] = 'home/index';
	$routes['tim-kiem'] = 'home/search';

	//san pham trang chu
	$routes['danh-muc-sp/.+-(\d+)'] = 'categoryproduct/show_cate_home/$1';
	$routes['thuong-hieu-sp/.+-(\d+)'] = 'brand/show_brand_home/$1';
	$routes['chi-tiet-sp/.+-(\d+)'] = 'products/product_details/$1';

	//gio hang
	$routes['gio-hang'] = 'cart/show_cart'; 
	$routes['luu-gio-hang'] = 'cart/add_cart'; 
	$routes['process-qty'] = 'cart/process_qty';
	$routes['del-cart'] = 'cart/del_cart';

	// ma giam gia
	$routes['ma-giam-gia'] = 'coupons/check_coupon';
	$routes['unset-coupon'] = 'coupons/unset_coupon';

	// van chuyen 
	$routes['van-chuyen'] = 'cart/select_delivery_home';
	$routes['phi-van-chuyen'] = 'cart/calculate_fee';
	$routes['unset-feeship'] = 'cart/unset_feeship';

	// thanh toan
	$routes['add-customer'] = 'logincheckout/add_customer';
	$routes['checkout'] = 'logincheckout/checkout';

	$routes['login-user'] = 'logincheckout/login_user';

	$routes['login-checkout'] = 'logincheckout/login_checkout';

	$routes['dang-xuat'] = 'logincheckout/logout_user';

	// don hang
	$routes['xac-nhan-don-hang'] = 'order/save_order';

	$routes['payment'] = 'order/payment';

	$routes['update-product-qty'] = 'order/update_product_qty';

	$routes['update-qty-order'] = 'order/update_qty_order';

	// tin tuc
	$routes['tin-tuc/.+-(\d+)'] = 'news/categorynews/$1'; 

	//comment
	$routes['load-comment'] = 'comment/load_comment';

	$routes['send-comment'] = 'comment/send_comment';

	$routes['manage-comment'] = 'comment/manage_comment';

	$routes['view-comment/.+-(\d+)'] = 'comment/view_comment/$1';

	$routes['allow-comment'] = 'comment/allow_comment';

	$routes['reply-comment'] = 'comment/reply_comment';

	$routes['view-child-comment/.+-(\d+)'] = 'comment/child_comment/$1';

	//rating
	$routes['insert-rating'] = 'products/insert_rating';

	/*< ------------------------------------------------------------------------------------- >*/

	//routes admin dashboard
	$routes['dashboard'] = 'admin/dashboard/index';

	//routes admin login
	$routes['admin'] = 'admin/login/index';
	$routes['admin-dashboard'] = 'admin/login/dashboard';
	$routes['logout'] = 'admin/login/logout';

	//routes admin category product
	$routes['add-cate-prod'] = 'categoryproduct/add_cate_prod';
	$routes['view-cate-prod'] = 'categoryproduct/view_cate_prod';
	$routes['save-cate-prod'] = 'categoryproduct/save_cate_prod';


	$routes['active-cate-prod/.+-(\d+)'] = 'categoryproduct/active_cate_prod/$1';

	$routes['unactive-cate-prod/.+-(\d+)'] = 'categoryproduct/unactive_cate_prod/$1';

	$routes['edit-cate-prod/.+-(\d+)'] = 'categoryproduct/edit_cate_prod/$1';

	$routes['update-cate-prod/.+-(\d+)'] = 'categoryproduct/update_cate_prod/$1';

	$routes['delete-cate-prod/.+-(\d+)'] = 'categoryproduct/delete_cate_prod/$1';

	//routes admin brand product
	$routes['add-brand'] = 'brand/add_brand';
	$routes['view-brand'] = 'brand/view_brand';
	$routes['save-brand'] = 'brand/save_brand';


	$routes['active-brand/.+-(\d+)'] = 'brand/active_brand/$1';

	$routes['unactive-brand/.+-(\d+)'] = 'brand/unactive_brand/$1';

	$routes['edit-brand/.+-(\d+)'] = 'brand/edit_brand/$1';

	$routes['update-brand/.+-(\d+)'] = 'brand/update_brand/$1';

	$routes['delete-brand/.+-(\d+)'] = 'brand/delete_brand/$1';

	//routes admin product
	$routes['add-product'] = 'products/add_product';
	$routes['view-product'] = 'products/view_product';
	$routes['save-product'] = 'products/save_product';


	$routes['active-product'] = 'products/active_product';

	$routes['unactive-product'] = 'products/unactive_product';

	$routes['feature-product'] = 'products/feature_product';

	$routes['nonfeature-product'] = 'products/nonfeature_product';

	$routes['edit-product/.+-(\d+)'] = 'products/edit_product/$1';

	$routes['update-product/.+-(\d+)'] = 'products/update_product/$1';

	$routes['delete-product/.+-(\d+)'] = 'products/delete_product/$1';

	// routes gallery
	$routes['view-gallery/.+-(\d+)'] = 'products/view_gallery/$1';

	$routes['update-gallery-name'] = 'products/update_gallery_name';

	$routes['delete-gallery'] = 'products/delete_gallery';

	$routes['load-gallery'] = 'products/load_gallery';

	$routes['update-gallery'] = 'products/update_gallery';

	$routes['save-gallery/.+-(\d+)'] = 'products/save_gallery/$1';

	//routes order
	$routes['manage-order'] = 'order/manage_order';

	$routes['view-order/.+-(\d+)'] = 'order/view_order/$1';

	$routes['delete-order/.+-(\d+)'] = 'order/delete_order/$1';

	$routes['print-order/.+-(\d+)'] = 'order/print_order/$1';
	

	// routes coupon
	$routes['add-coupon'] = 'coupons/add_coupon';
	$routes['view-coupon'] = 'coupons/view_coupon';
	$routes['save-coupon'] = 'coupons/save_coupon';

	$routes['active-coupon/.+-(\d+)'] = 'coupons/active_coupon/$1';

	$routes['unactive-coupon/.+-(\d+)'] = 'coupons/unactive_coupon/$1';

	$routes['edit-coupon/.+-(\d+)'] = 'coupons/edit_coupon/$1';

	$routes['update-coupon/.+-(\d+)'] = 'coupons/update_coupon/$1';

	$routes['delete-coupon/.+-(\d+)'] = 'coupons/delete_coupon/$1';

	// routes delivery
	$routes['delivery'] = 'delivery/manage_delivery';
	
	$routes['select-delivery'] = 'delivery/select_delivery';

	$routes['insert-delivery'] = 'delivery/insert_delivery';

	$routes['select-shipfee'] = 'delivery/select_shipfee';

	$routes['update-delivery'] = 'delivery/update_delivery';
	
	// routes slider
	$routes['add-slide'] = 'slider/add_slider';
	$routes['view-slide'] = 'slider/view_slider';
	$routes['save-slide'] = 'slider/save_slider';

	$routes['active-slide/.+-(\d+)'] = 'slider/active_slider/$1';

	$routes['unactive-slide/.+-(\d+)'] = 'slider/unactive_slider/$1';

	$routes['edit-slide/.+-(\d+)'] = 'slider/edit_slider/$1';

	$routes['update-slide/.+-(\d+)'] = 'slider/update_slider/$1';

	$routes['delete-slide/.+-(\d+)'] = 'slider/delete_slider/$1';

	// routes statistical dashboard
	$routes['filter-by-date'] = 'statistical/filter_by_date';

	$routes['filter-by-select'] = 'statistical/filter_by_select';

	$routes['days-order'] = 'statistical/days_order';
 ?>