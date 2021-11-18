<?php 
	
	class Coupons extends BaseController
	{
	    public $couponModel;
	    public $request, $response;

		public function __construct()
		{
			$this->couponModel = $this->loadModel('CouponModel');
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

		public function add_coupon()
		{
			$this->AuthLogin();
			$this->data['content'] = 'admins.add_coupon';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function view_coupon()
		{
			$this->AuthLogin();
			$this->data['sub_content']['list_coupon'] = $this->couponModel->viewCoupon();
			$this->data['content'] = 'admins.view_coupon';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function save_coupon()
		{		
			$this->AuthLogin();
			// lấy dữ liệu từ form
			$dataField = $this->request->getFields();

			//đưa dữ liệu vào data để insert
			$data = [
				'code' => $dataField['coupon_code'],
				'name' => $dataField['coupon_name'],
				'amount' => $dataField['coupon_amount'],
				'type' => $dataField['coupon_type'],
				'value' => $dataField['coupon_reduce'],
				'date_end' => $dataField['coupon_date'],
				'create_at' => date("Y-m-d h:i:s")
			];

			$result = $this->couponModel->insertCoupon($data);

			Session::flash('message', 'Thêm mã giảm giá thành công!');
			return $this->response->redirect('add-coupon');
		}

		public function unactive_coupon($id)
		{	
			$this->AuthLogin();
			$unactive = [
				'status' => 0
			];
			$this->couponModel->updateCoupon($unactive, $id);
			Session::flash('message', 'Hủy mã giảm giá thành công!');
			return $this->response->redirect('view-coupon');
		}

		public function active_coupon($id)
		{
			$this->AuthLogin();
			$active = [
				'status' => 1
			];
			$this->couponModel->updateCoupon($active, $id);
			Session::flash('message', 'Kích hoạt mã giảm giá thành công!');
			return $this->response->redirect('view-coupon');
		}

		public function edit_coupon($id)
		{
			
		}

		public function update_coupon($id)
		{
			
		}

		public function delete_coupon($id)
		{
			$this->AuthLogin();
			$this->couponModel->deleteCoupon($id);
			Session::flash('message', 'Xóa mã giảm giá thành công!');
			return $this->response->redirect('view-coupon');
		}

		//end admin page

		public function check_coupon()
		{
			$dataField = $this->request->getFields();
			$code = $dataField['coupon'];
			$result = $this->couponModel->check_coupon($code);
			if(!empty($result)){
				$coupon = [
					'coupon_code' => $result['code'],
					'coupon_type' => $result['type'],
					'coupon_value' => $result['value']
				];
				Session::data('coupon', $coupon);
				Session::flash('success', 'Nhập mã giảm giá thành công!');
				return $this->response->redirect('gio-hang');
			}else{
				Session::flash('error', 'Mã giảm giã sai hoặc chưa tới thời hạn kích hoạt. Mời nhập lại!');
				return $this->response->redirect('gio-hang');
			}
		}

		public function unset_coupon()
		{
			Session::delete('coupon');
			return $this->response->redirect('gio-hang');
		}
	}
	
 ?>