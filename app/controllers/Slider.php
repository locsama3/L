<?php 
	
	class Slider extends BaseController
	{
	    public $sliderModel;
	    public $request, $response;

		public function __construct()
		{
			$this->sliderModel = $this->loadModel('SliderModel');
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

		public function add_slider()
		{
			$this->AuthLogin();
			$this->data['content'] = 'admins.add_slider';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function view_slider()
		{
			$this->AuthLogin();
			$this->data['sub_content']['list_slider'] = $this->sliderModel->getSlider();
			$this->data['content'] = 'admins.view_slider';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function save_slider()
		{		
			$this->AuthLogin();
			// lấy dữ liệu từ form
			$dataField = $this->request->getFields();
			$dataFile = $this->request->getFiles();
			$data = [];
			// xử lý ảnh
			//lấy hình ảnh
			$get_image = $dataFile['slider_link'];
			if($get_image){
				$uploadPath = "public/uploads/slider/";
				$unique_image = $this->checkImage($get_image, $uploadPath);
				if($unique_image){
					$data['slider_link'] = $unique_image;
				}
			}else{
				Session::flash('message', 'Bạn chưa thêm ảnh!');
				return $this->response->redirect('add-slide');
			}
			// đưa dữ liệu vào data để insert
			$data['slider_name'] = $dataField['slider_name'];
			$data['slider_desc'] = $dataField['slider_desc'];
			$data['slider_status'] = $dataField['display'];
			$data['create_at'] = date('Y-m-d h:i:s');

			$result = $this->sliderModel->insertSlider($data);

			Session::flash('message', 'Thêm Slide thành công!');
			return $this->response->redirect('add-slide');
		}

		public function unactive_slider($id)
		{	
			$this->AuthLogin();
			$unactive = [
				'slider_status' => 0
			];
			$this->sliderModel->updateSlider($unactive, $id);
			Session::flash('message', 'Ẩn Slide thành công!');
			return $this->response->redirect('view-slide');
		}

		public function active_slider($id)
		{
			$this->AuthLogin();
			$active = [
				'slider_status' => 1
			];
			$this->sliderModel->updateSlider($active, $id);
			Session::flash('message', 'Hiện Slide thành công!');
			return $this->response->redirect('view-slide');
		}

		public function edit_slider($id)
		{
			$this->AuthLogin();
			$this->data['sub_content']['slider_by_id'] = $this->sliderModel->find($id);
			$this->data['content'] = 'admins.edit_slider';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function update_slider($id)
		{
			$this->AuthLogin();
			// lấy dữ liệu từ form
			$dataField = $this->request->getFields();
			$dataFile = $this->request->getFiles();

			// xử lý ảnh
			//lấy hình ảnh
			$get_image = $dataFile['slider_link'];
			if($get_image){
				$uploadPath = "public/uploads/slider/";
				$unique_image = $this->checkImage($get_image, $uploadPath);
				if($unique_image){
					$data['slider_link'] = $unique_image;
				}
			}

			// đưa dữ liệu vào data để update
			$data = [];
			$data['slider_name'] = $dataField['slider_name'];
			$data['slider_desc'] = $dataField['slider_desc'];
			$data['slider_status'] = $dataField['display'];
			$data['update_at'] = date('Y-m-d h:i:s');

			$result = $this->sliderModel->updateSlider($data, $id);

			Session::flash('message', 'Cập nhật Slide thành công!');
			return $this->response->redirect('add-slide');
		}

		public function delete_slider($id)
		{
			$this->AuthLogin();
			$this->sliderModel->deleteSlider($id);
			Session::flash('message', 'Xóa Slide thành công!');
			return $this->response->redirect('view-slide');
		}

		//end controller admin

		public function show_slider_home($id)
	    {	
	    	
			$this->view('blocks.header');

			$this->loadSlider();

			$this->loadSidebars();

			//load list brand product
			$this->data['sub_content']['brand'] = $this->sliderModel->find($id);
			$this->data['sub_content']['slider_products'] = $this->sliderModel->getProducts($id);

			$this->data['content'] = 'clients.brand.show_brand';
			return $this->view('layouts.clients_layout', $this->data);
	    }


	}
	
 ?>