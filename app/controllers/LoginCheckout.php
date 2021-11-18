<?php 
	
	class LoginCheckout extends BaseController
	{
	    public $userModel;
	    public $request, $response;

		public function __construct()
		{
			$this->userModel = $this->loadModel('UserModel');
	    	$this->request = new Request();
	    	$this->response = new Response();
		}

		public function AuthLoginUser()
		{
			$check = Session::data('user_id');
	    	if(!empty($check)){
	    		$data['content'] = 'clients.index';
				return $this->view('layouts.clients_layout',$data);
	    	}else{
	    		return $this->response->redirect('login-checkout');
	    	}
		}

		public function login_user()
		{
	    	//lấy dữ liệu từ form
	    	$dataField = $this->request->getFields();
	    	$user = $dataField['email'];
	    	$pass = md5($dataField['password']);

	    	//lấy dữ liệu từ model
	    	$result = $this->userModel->userAdmin($user, $pass);

	    	if($result){
	    		Session::data('user_name', $result['fullname']);
	    		Session::data('user_email', $result['email']);
	    		Session::data('user_id', $result['user_id']);

	    		return $this->response->redirect('checkout');
	    	}else{
	    		Session::flash('mess', 'Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại');
	    		return $this->response->redirect('login-checkout');
	    	}
		}

		public function logout_user()
		{
			Session::delete();
			return $this->response->redirect('login-checkout');
		}

		public function login_checkout()
		{
			$this->view('blocks.header');	
			$this->data['content'] = 'clients.checkouts.login_checkout';
			return $this->view('layouts.clients_layout', $this->data);
		}

		public function add_customer()
		{
			$dataFields = $this->request->getFields();
			$data = [
				'email' 	=> $dataFields['user_email'],
				'password' 	=> md5($dataFields['user_password']),
				'phone' 	=> $dataFields['user_phone'],
				'fullname' 	=> $dataFields['user_name'],
				'address' 	=> $dataFields['user_address'],
				'create_at' => date("Y-m-d h:i:s")
			];

			$insert_customer = $this->userModel->insertUser($data);

			Session::flash('message', 'Đăng ký tài khoản mới thành công!');
			return $this->response->redirect('login-checkout');
		}

		public function checkout()
		{
			$user_id = Session::data('user_id');

			if(isset($_SESSION['cart'])){
				$this->data['sub_content']['cart_prod'] = $_SESSION['cart'];
			}
			
			if(!empty($user_id)){
				$this->data['sub_content']['user'] = $this->userModel->find($user_id);
			}

			$this->data['sub_content']['payment_options'] = $this->db->table('tbl_payment')->get();

			$this->view('blocks.header');	
			$this->data['content'] = 'clients.checkouts.show_checkout';
			return $this->view('layouts.clients_layout', $this->data);		
		}

	}
	
 ?>