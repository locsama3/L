<?php 
	
	class Products extends BaseController
	{
	    public $productModel, $galleryModel, $ratingModel;
	    public $request, $response;

		public function __construct()
		{
			$this->productModel = $this->loadModel('ProductModel');
			$this->galleryModel = $this->loadModel('GalleryModel');
			$this->ratingModel = $this->loadModel('RatingModel');
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

		public function add_product()
		{
			$this->AuthLogin();
			$cate_prod = $this->db->table('tbl_category_product')->orderBy('id','desc')->get();
			$brand = $this->db->table('tbl_brand')->orderBy('id','desc')->get();
			$this->data['sub_content'] = [
				'cate_prod' => $cate_prod,
				'brand'		=> $brand
			];
			$this->data['content'] = 'admins.add_product';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function view_product()
		{
			$this->AuthLogin();
			$this->data['sub_content']['list_product'] = $this->productModel->viewProduct();
			$this->data['content'] = 'admins.view_product';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function save_product()
		{		
			$this->AuthLogin();
			// lấy dữ liệu từ form
			$dataField = $this->request->getFields();
			$dataFile = $this->request->getFiles();

			//đưa dữ liệu vào data để insert
			$data = [
				'name' => $dataField['product_name'],
				'code' => $dataField['product_slug'],
				'cate_id' => $dataField['product_cate'],
				'brand_id' => $dataField['product_brand'],
				'thumbnail' => '',
				'feature' => $dataField['type'],
				'regular_price' => $dataField['price'],
				'sale_price' => $dataField['sale_price'],
				'product_quantity' => $dataField['quantity'],
				'best_seller' => $dataField['status'],
				'short_desc' => $dataField['short_desc'],
				'description' => $dataField['product_desc'],
				'create_at' => date("Y-m-d h:i:s")
			];

			//lấy hình ảnh
			$get_image = $dataFile['thumbnail'];

			if($get_image){
				$uploadPath = "public/uploads/product_thumbnail/";
				$unique_image = $this->checkImage($get_image, $uploadPath);
				if($unique_image){
					$data['thumbnail'] = $unique_image;
				}
			}

			$result_id = $this->productModel->insertProduct($data);

			self::save_gallery($result_id);

			$dataRating = [
				'product_id' => $result_id,
				'rating' => 0,
				'create_at' => date("Y-m-d h:i:s")
			];

			$this->ratingModel->insertRating($dataRating);

			Session::flash('message', 'Thêm sản phẩm thành công!');
			return $this->response->redirect('add-product');
		}

		public function unactive_product()
		{	
			$this->AuthLogin();

			$unactive = [
				'best_seller' => 0
			];
			$dataField = $this->request->getFields();
			$id = $dataField['unact_id'];
			$this->productModel->updateProduct($unactive, $id);
		}

		public function active_product()
		{
			$this->AuthLogin();
			$active = [
				'best_seller' => 1
			];
			$dataField = $this->request->getFields();
			$id = $dataField['act_id'];
			$this->productModel->updateProduct($active, $id);
		}

		public function nonfeature_product()
		{	
			$this->AuthLogin();
			$unactive = [
				'feature' => 0
			];
			$dataField = $this->request->getFields();
			$id = $dataField['nonfeat_id'];
			$this->productModel->updateProduct($unactive, $id);
		}

		public function feature_product()
		{
			$this->AuthLogin();
			$active = [
				'feature' => 1
			];
			$dataField = $this->request->getFields();
			$id = $dataField['feat_id'];
			$this->productModel->updateProduct($active, $id);
		}

		public function edit_product($id)
		{
			$this->AuthLogin();
			$cate_prod = $this->db->table('tbl_category_product')->orderBy('id','desc')->get();
			$brand = $this->db->table('tbl_brand')->orderBy('id','desc')->get();
			$this->data['sub_content'] = [
				'cate_prod' => $cate_prod,
				'brand'		=> $brand
			];
			$this->data['sub_content']['product_by_id'] = $this->productModel->find($id);
			$this->data['content'] = 'admins.edit_product';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function update_product($id)
		{
			$this->AuthLogin();
			// lấy dữ liệu từ form
			$dataField = $this->request->getFields();
			$dataFile = $this->request->getFiles();

			//đưa dữ liệu vào data để update
			$update = [
				'name' => $dataField['product_name'],
				'code' => $dataField['product_slug'],
				'cate_id' => $dataField['product_cate'],
				'brand_id' => $dataField['product_brand'],
				'feature' => $dataField['type'],
				'regular_price' => $dataField['price'],
				'sale_price' => $dataField['sale_price'],
				'product_quantity' => $dataField['quantity'],
				'best_seller' => $dataField['status'],
				'short_desc' => $dataField['short_desc'],
				'description' => $dataField['product_desc'],
				'update_at' => date("Y-m-d h:i:s")
			];

			//lấy hình ảnh
			$get_image = $dataFile['thumbnail'];
			if(!empty($get_image)){
				$uploadPath = "public/uploads/product_thumbnail/";
				$this->del_upload($id, $uploadPath, 'productModel', 'thumbnail');
				$unique_image = $this->checkImage($get_image, $uploadPath);
				if($unique_image){
					$update['thumbnail'] = $unique_image;
				}
			}

			$this->productModel->updateProduct($update, $id);
			Session::flash('message', 'Cập nhật sản phẩm thành công!');
			return $this->response->redirect('view-product');
		}

		public function delete_product($id)
		{
			$this->AuthLogin();
			$uploadPath = "public/uploads/product_thumbnail/";
			$this->del_upload($id, $uploadPath, 'productModel', 'thumbnail');
			$this->productModel->deleteProduct($id);
			Session::flash('message', 'Xóa sản phẩm thành công!');
			return $this->response->redirect('view-product');
		}

		// controller product gallery
		public function view_gallery($id)
		{
			$this->AuthLogin();

			$this->data['sub_content']['list_gallery'] = $this->galleryModel->getGallery($id);

			$this->data['sub_content']['prod_id'] = $id;

			$this->data['content'] = 'admins.view_gallery';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function load_gallery()
		{
			$this->AuthLogin();
			$dataField = $this->request->getFields();
			$prod_id = $dataField['prod_id'];
			$output = '';

			$list_gallery = $this->galleryModel->getGallery($prod_id);

			$i = 0;
			foreach ($list_gallery as $key => $gallery) {
				$output .= '
				<tr>
	                <td data-label="STT">'. $i .'</td>

	                <td data-label="Tiêu đề" contenteditable class="edit-gallery-name"
	                    data-gal_id = "'. $gallery['gallery_id'] .'">
	                    '. $gallery['gallery_name'] .'
	                </td>

	                <td data-label="Hình ảnh">
	                    <img style="width: 68%" class="img-gallery" src="'._WEB_ROOT.'/public/uploads/product_gallery/'. $gallery['image_url'] .'" alt=""/>
	                    <input type="file" class="file_image" style="width: 30%;"
		                        data-gal_id = "'. $gallery['gallery_id'] .'"
		                        id = "file-'. $gallery['gallery_id'] .'" 
		                        name = "file_image" accept = "image/*"
		                >
	                </td>
	                
	                <td data-label="Xóa" class="right__iconTable">
	                    <a onclick = "return confirm("Bạn có chắc chắn muốn xóa?")"
	                       class = "delete_gallery" data-gal_id = "' .$gallery['gallery_id'] .'">
	                        <img src="'._WEB_ROOT.'/public/backend/assets/icon-trash-black.svg" alt="">
	                    </a>
	                    
	                </td>
	            </tr>';
			}

			echo $output;
		}

		public function update_gallery_name()
		{
			$this->AuthLogin();
			$dataField = $this->request->getFields();
			$gal_id = $dataField['gal_id'];
			$gal_name = $dataField['gal_name'];
			$data['gallery_name'] = $gal_name;
			$data['update_at'] = date("Y-m-d h:i:s");
			$this->galleryModel->updateGallery($data, $gal_id);
		}

		public function update_gallery()
		{
			$this->AuthLogin();
			$dataGallery = $this->request->getFiles();
			$get_image = $dataGallery['file_image'];
			$dataField = $this->request->getFields();
			$gal_id = $dataField['gal_id'];

			if(!empty($get_image)){
				$uploadPath = "public/uploads/product_gallery/";
				$this->del_upload($gal_id, $uploadPath, 'galleryModel', 'image_url');
				$unique_image = $this->checkImage($get_image, $uploadPath);
				if($unique_image){
					$update['image_url'] = $unique_image;
					$update['update_at'] = date("Y-m-d h:i:s");
					$this->galleryModel->updateGallery($update, $gal_id);
				}
			}
		}

		public function delete_gallery()
		{
			$this->AuthLogin();
			$dataField = $this->request->getFields();
			$gal_id = $dataField['gal_id'];

			$uploadPath = "public/uploads/product_gallery/";
			$this->del_upload($gal_id, $uploadPath, 'galleryModel', 'image_url');
			$this->galleryModel->deleteGallery($gal_id);
		}

		public function save_gallery($prod_id)
		{
			$this->AuthLogin();
			$dataGallery = $this->request->getFiles();
			$get_gallery = $dataGallery['desc_image'];

			$dataField = $this->request->getFields();

			$data = [];
			if(!empty($get_gallery)){
				$i = 0;
				$files_name = $get_gallery['name'];
				$files_temp = $get_gallery['tmp_name'];

				foreach ($files_name as $key => $value) {

					$path = "public/uploads/product_gallery/";

					$div = explode('.', $value);
					$file_current = strtolower(reset($div)); // lấy tên
					$file_ext = strtolower(end($div)); // lấy đuôi
					$unique_image = $file_current.substr(md5(time()), 0, 5).'.'.$file_ext;
					$uploaded_image = $path.$unique_image;

					move_uploaded_file($files_temp[$key],$uploaded_image);

					$data = [
						'gallery_name' => $file_current,
						'product_id' => $prod_id,
						'image_url' => $unique_image,
						'create_at' => date("Y-m-d h:i:s")
					];

					$this->galleryModel->insertGallery($data);
				}	
			}

			if(isset($dataField['token'])){
				return $this->response->redirect('view-gallery/prodid-'.$prod_id);
			}
		}

		//end admin page

		public function product_details($id)
		{
			$this->view('blocks.header');

			$this->loadSidebars();
			//load rating
			$rating_result = $this->ratingModel->getAvgRating($id);
			
			$rating = 0;

			foreach ($rating_result as $key => $value) {
			    $rating = round($value['danhgia']);
			}
			
			$this->data['sub_content']['rating'] = $rating;

			//load product by id

			$this->data['sub_content']['product_by_id'] = $this->productModel->getProductById($id);

			$this->data['sub_content']['product_gallery'] = $this->galleryModel->getGallery($id);

			$prod_by_id = $this->data['sub_content']['product_by_id'];
			$cate_id = $prod_by_id['cate_id'];

			$this->data['sub_content']['related_product'] = $this->productModel->getProductByCate($cate_id,$id);

			$this->data['content'] = 'clients.products.show_details';
			return $this->view('layouts.clients_layout', $this->data);
		}

		// rating
		public function insert_rating()
		{
			$dataField = $this->request->getFields();

			$data = [
				'product_id' => $dataField['prod_id'],
				'rating' => $dataField['index'],
				'create_at' => date("Y-m-d h:i:s")
			];

			$this->ratingModel->insertRating($data);

			echo "done";
		}	

	}
	
 ?>