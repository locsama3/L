<?php 
	
	class Statistical extends BaseController
	{
	    public $statisticalModel, $visitorModel;
	    public $request, $response;

		public function __construct()
		{
			$this->statisticalModel = $this->loadModel('StatisticalModel');
			$this->visitorModel = $this->loadModel('VisitorModel');
	    	$this->request = new Request();
	    	$this->response = new Response();
		}

		public function AuthLogin()
		{
			$check = Session::data('admin_id');
	    	if(empty($check)){
	    		return $this->response->redirect('admin');
	    	}
		}

		public function filter_by_date()
		{
			$this->AuthLogin();
			$dataField = $this->request->getFields();

			$from_date = $dataField['from_date'];
			$to_date = $dataField['to_date'];

			$get = $this->statisticalModel->getStatistic($from_date, $to_date); 

			$this->convert_chart($get);
		}

		public function filter_by_select()
		{
			$this->AuthLogin();
			$dataField = $this->request->getFields();

			$now = date_create();

			$today = date_format($now, 'Y-m-d');

			$sub7days = date_format(date_modify($now, '-7 days'), 'Y-m-d'); 

			$sub365days = date_format(date_modify($now, '-365 days'), 'Y-m-d'); 

			$month_ini = new DateTime("first day of last month"); //ngày đầu của tháng trước
			$month_ini = date_format($month_ini, 'Y-m-d');

			$month_end = new DateTime("last day of last month"); //ngày cuối của tháng trước 
			$month_end = date_format($month_end, 'Y-m-d');

			$this_month_ini = date("Y-m-01", strtotime($today)); //ngày đầu của tháng này

			if($dataField['dashboard_value']=='7ngay'){

		        $get = $this->statisticalModel->getStatistic($sub7days, $today); 

		    }elseif($dataField['dashboard_value']=='thangtruoc'){

		        $get = $this->statisticalModel->getStatistic($month_ini, $month_end); 

		    }elseif($dataField['dashboard_value']=='thangnay'){

		        $get = $this->statisticalModel->getStatistic($this_month_ini, $today); 

		    }else{
		        $get = $this->statisticalModel->getStatistic($sub365days, $today); 
		    }

		    $this->convert_chart($get);
		}

		public function days_order()
		{
			$now = date_create();

			$today = date_format($now, 'Y-m-d');

			$sub30days = date_format(date_modify($now, '-30 days'), 'Y-m-d'); 

			$get = $this->statisticalModel->getStatistic($sub30days, $today); 

			$this->convert_chart($get);
		}

		public function convert_chart($get = [])
		{
			foreach ($get as $key => $value) {
				$chartData[] = array(
					'period' => $value['order_date'],
					'order' => $value['total_order'],
					'sales' => $value['sales'],
					'profit' => $value['profit'],
					'quantity' => $value['quantity']
				);
			}

			echo $data = json_encode($chartData);
		}

	}
	
 ?>