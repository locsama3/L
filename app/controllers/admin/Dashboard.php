<?php 
	
	class Dashboard extends BaseController
	{	
		public $visitorModel, $productModel, $orderModel, $customerModel;
		public $request, $response;

		public function __construct()
		{
			$this->visitorModel = $this->loadModel('VisitorModel');
			$this->productModel = $this->loadModel('ProductModel');
			$this->orderModel = $this->loadModel('OrderModel');
			$this->customerModel = $this->loadModel('UserModel');
	    	$this->request = new Request();
	    	$this->response = new Response();
		}

	    public function index()
	    {
	    	$check = Session::data('admin_id');
	    	if(empty($check)){
	    		return $this->response->redirect('admin');		
	    	}

	    	// lấy IP của user
	    	$ip = $_SERVER['REMOTE_ADDR'];
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}

			// lấy ngày tháng cần tính toán
			$now = date_create();

			$today = date_format($now, 'Y-m-d');

			$month_ini = new DateTime("first day of last month"); //ngày đầu của tháng trước
			$month_ini = date_format($month_ini, 'Y-m-d');

			$month_end = new DateTime("last day of last month"); //ngày cuối của tháng trước 
			$month_end = date_format($month_end, 'Y-m-d');

			$this_month_ini = date("Y-m-01", strtotime($today)); //ngày đầu của tháng này

			$sub_oneyear = date_format(date_modify($now, '-365 days'), 'Y-m-d'); 

			// đang online
			$visitors_current = $this->visitorModel->getOnline($ip);
			$count_current = count($visitors_current);

			if($count_current < 1){
				$visitor = [
					'ip_address' => $ip,
					'date_visitor' => $today
				];

				$this->visitorModel->insertVisitor($visitor);
			}

			// lấy ra số lượng truy cập các thời gian trước
			$last_month_visitors = $this->visitorModel->getVisitor($month_ini, $month_end); // tháng trước

			$this_month_visitors = $this->visitorModel->getVisitor($this_month_ini, $today); // tháng này

			$oneyear_visitors = $this->visitorModel->getVisitor($sub_oneyear, $today); // 1 năm

			$total_all_visitors = $this->visitorModel->all();

			$total_visitors = count($total_all_visitors);

			$data['sub_content']['count_current'] = $count_current;

			$data['sub_content']['last_month_visitors'] = count($last_month_visitors);

			$data['sub_content']['this_month_visitors'] = count($this_month_visitors);

			$data['sub_content']['oneyear_visitors'] = count($oneyear_visitors);

			$data['sub_content']['total_visitors'] = $total_visitors;

			//so luong san pham, so luong don hang, so khach hang
			$data['sub_content']['total_product'] = count($this->productModel->all());
			$data['sub_content']['total_order'] = count($this->orderModel->all());
			$data['sub_content']['total_customer'] = count($this->customerModel->all());

			$data['sub_content']['product_selling'] = $this->productModel->get_selling();

			$data['sub_content']['lastest_order'] = $this->orderModel->getLastestOrder();

	    	$data['content'] = 'admins.dashboard';

    		return $this->view('layouts.admin_layout',$data);
	    }
	}
	
 ?>