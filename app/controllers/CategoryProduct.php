<?php 
	
	class CategoryProduct extends BaseController
	{
	    public $cateModel;
	    public $request, $response;

		public function __construct()
		{
			$this->cateModel = $this->loadModel('CategoryProductModel');
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

		public function add_cate_prod()
		{
			$this->AuthLogin();
			$this->AuthLogin();
			$this->data['content'] = 'admins.add_category_product';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function view_cate_prod()
		{
			$this->AuthLogin();
			$this->data['sub_content']['list_cate'] = $this->cateModel->all();
			$this->data['content'] = 'admins.view_category_product';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function save_cate_prod()
		{		
			$this->AuthLogin();
			// lấy dữ liệu từ form
			$dataField = $this->request->getFields();
			// đưa dữ liệu vào data để insert
			$data = [];
			$data['cate_name'] = $dataField['cate_name'];
			$data['cate_slug'] = $dataField['cate_desc'];
			$data['display'] = $dataField['display'];
			$data['create_at'] = date('Y-m-d h:i:s');

			$result = $this->cateModel->insertCateProd($data);

			Session::flash('message', 'Thêm danh mục sản phẩm thành công!');
			return $this->response->redirect('add-cate-prod');
		}

		public function unactive_cate_prod($id)
		{	
			$this->AuthLogin();
			$unactive = [
				'display' => 0
			];
			$this->cateModel->updateCateProd($unactive, $id);
			Session::flash('message', 'Ẩn danh mục sản phẩm thành công!');
			return $this->response->redirect('view-cate-prod');
		}

		public function active_cate_prod($id)
		{
			$this->AuthLogin();
			$active = [
				'display' => 1
			];
			$this->cateModel->updateCateProd($active, $id);
			Session::flash('message', 'Hiện danh mục sản phẩm thành công!');
			return $this->response->redirect('view-cate-prod');
		}

		public function edit_cate_prod($id)
		{
			$this->AuthLogin();
			$this->data['sub_content']['cate_by_id'] = $this->cateModel->find($id);
			$this->data['content'] = 'admins.edit_category_product';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function update_cate_prod($id)
		{
			$this->AuthLogin();
			// lấy dữ liệu từ form
			$dataField = $this->request->getFields();
			// đưa dữ liệu vào mảng update	
			$update = [
				'cate_name' => $dataField['cate_name'],
				'cate_slug' => $dataField['cate_desc']
			];
			$data['update_at'] = date('Y-m-d h:i:s');
			$this->cateModel->updateCateProd($update, $id);
			Session::flash('message', 'Cập nhật danh mục sản phẩm thành công!');
			return $this->response->redirect('view-cate-prod');
		}

		public function delete_cate_prod($id)
		{
			$this->AuthLogin();
			$this->cateModel->deleteCateProd($id);
			Session::flash('message', 'Xóa danh mục sản phẩm thành công!');
			return $this->response->redirect('view-cate-prod');
		}

		//end function admin page

		public function show_cate_home($id)
	    {	
	    	
			$this->view('blocks.header');

			$this->loadSlider();

			$this->loadSidebars();

			//load list category product
			$this->data['sub_content']['cate'] = $this->cateModel->find($id);
			$this->data['sub_content']['cate_products'] = $this->cateModel->getProducts($id);

			$this->data['content'] = 'clients.category.show_category';
			return $this->view('layouts.clients_layout', $this->data);
	    }

	}
	
 ?>