<?php 
	
	class Login extends BaseController
	{
	    public $loginModel;
	    public $request, $response;

		public function __construct()
		{
			$this->loginModel = $this->loadModel('admin/LoginModel');
	    	$this->request = new Request();
	    	$this->response = new Response();
		}

		public function AuthLogin()
		{
			$check = Session::data('admin_id');
	    	if(!empty($check)){
	    		$data['content'] = 'admins.dashboard';
	    		return $this->view('layouts.admin_layout',$data);
	    	}else{
	    		return $this->response->redirect('admin');
	    	}
		}

	    public function index()
	    {
	    	return $this->view('admins.login');
	    }

	    public function dashboard()
	    {
	    	//lấy dữ liệu từ form
	    	$dataField = $this->request->getFields();
	    	$user = $dataField['admin_user'];
	    	$pass = $dataField['admin_pass'];

	    	//lấy dữ liệu từ model
	    	$result = $this->loginModel->loginAdmin($user, $pass);

	    	if($result){
	    		Session::data('admin_name', $result['admin_name']);
	    		Session::data('admin_id', $result['id']);

	    		return $this->response->redirect('dashboard');
	    	}else{
	    		Session::flash('mess', 'Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại');
	    		return $this->response->redirect('admin');
	    	}
	    }

	    public function logout()
	    {
	    	Session::delete('admin_name');
    		Session::delete('admin_id');
    		return $this->response->redirect('admin');
	    }
	}
	
 ?>