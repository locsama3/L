<?php 
	
	class Brand extends BaseController
	{
	    public $brandModel;
	    public $request, $response;

		public function __construct()
		{
			$this->brandModel = $this->loadModel('BrandModel');
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

		public function add_brand()
		{
			$this->AuthLogin();
			$this->data['content'] = 'admins.add_brand';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function view_brand()
		{
			$this->AuthLogin();
			$this->data['sub_content']['list_brand'] = $this->brandModel->all();
			$this->data['content'] = 'admins.view_brand';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function save_brand()
		{		
			$this->AuthLogin();
			// lấy dữ liệu từ form
			$dataField = $this->request->getFields();
			// đưa dữ liệu vào data để insert
			$data = [];
			$data['brand_name'] = $dataField['brand_name'];
			$data['brand_desc'] = $dataField['brand_desc'];
			$data['display'] = $dataField['display'];
			$data['create_at'] = date('Y-m-d h:i:s');

			$result = $this->brandModel->insertBrand($data);

			Session::flash('message', 'Thêm thương hiệu sản phẩm thành công!');
			return $this->response->redirect('add-brand');
		}

		public function unactive_brand($id)
		{	
			$this->AuthLogin();
			$unactive = [
				'display' => 0
			];
			$this->brandModel->updateBrand($unactive, $id);
			Session::flash('message', 'Ẩn thương hiệu sản phẩm thành công!');
			return $this->response->redirect('view-brand');
		}

		public function active_brand($id)
		{
			$this->AuthLogin();
			$active = [
				'display' => 1
			];
			$this->brandModel->updateBrand($active, $id);
			Session::flash('message', 'Hiện thương hiệu sản phẩm thành công!');
			return $this->response->redirect('view-brand');
		}

		public function edit_brand($id)
		{
			$this->AuthLogin();
			$this->data['sub_content']['brand_by_id'] = $this->brandModel->find($id);
			$this->data['content'] = 'admins.edit_brand';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function update_brand($id)
		{
			$this->AuthLogin();
			// lấy dữ liệu từ form
			$dataField = $this->request->getFields();
			// đưa dữ liệu vào mảng update	
			$update = [
				'brand_name' => $dataField['brand_name'],
				'brand_desc' => $dataField['brand_desc']
			];
			$data['update_at'] = date('Y-m-d h:i:s');
			$this->brandModel->updateBrand($update, $id);
			Session::flash('message', 'Cập nhật thương hiệu sản phẩm thành công!');
			return $this->response->redirect('view-brand');
		}

		public function delete_brand($id)
		{
			$this->AuthLogin();
			$this->brandModel->deleteBrand($id);
			Session::flash('message', 'Xóa thương hiệu sản phẩm thành công!');
			return $this->response->redirect('view-brand');
		}

		//end controller admin

		public function show_brand_home($id)
	    {	
	    	
			$this->view('blocks.header');

			$this->loadSlider();

			$this->loadSidebars();

			//load list brand product
			$this->data['sub_content']['brand'] = $this->brandModel->find($id);
			$this->data['sub_content']['brand_products'] = $this->brandModel->getProducts($id);

			$this->data['content'] = 'clients.brand.show_brand';
			return $this->view('layouts.clients_layout', $this->data);
	    }


	}
	
 ?>