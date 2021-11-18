<?php 
	
	class BaseController
	{	
		const VIEW_FOLDER_NAME = 'app/views';

		const MODEL_FOLDER_NAME = 'app/models';
		public $db;
		/*
		*	Quy tắc đường dẫn: 
				- Path name: folderName.fileName
				- Mặc định chỉ truyền thư mục từ sau thư mục view
		*/
	    public function loadModel($model)
	    {	    		
	    	if(file_exists(self::MODEL_FOLDER_NAME .'/'. $model . '.php')){
	    		require_once self::MODEL_FOLDER_NAME .'/'. $model . '.php';

	    		$modelArr = explode('/', $model);

    			$modelReal = end($modelArr);

	    		if(class_exists($modelReal)){
	    			$model = new $modelReal();	
	    			return $model;
	    		}
	    	}
	    	return false;
	    }

	    public function view($viewPath, array $data = [])
	    {
	    	extract($data);
	    	if(file_exists(self::VIEW_FOLDER_NAME .'/'. str_replace('.', '/', $viewPath) . '.php')){
	    		return require_once (self::VIEW_FOLDER_NAME .'/'. str_replace('.', '/', $viewPath) . '.php');
	    	}
	    }

	    public function checkImage($file = [], $uploadPath)
	    {
	    	if(isset($file['name']) && isset($file['tmp_name']) && isset($file['size'])){
		        //Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
				$permited  = array('jpg', 'jpeg', 'png', 'gif');

				$file_name = $file['name'];
				$file_size = $file['size'];
				$file_temp = $file['tmp_name'];
				
				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				if ($file_size > 2048000) {
	    		 	$alert = "<span class='error'>Kích thước của ảnh phải nhỏ hơn 2MB!</span>";
					return $alert;
			    } 
				elseif (in_array($file_ext, $permited) === false) 
				{	
				    $alert = "<span class='error'>Bạn chỉ có thể tải lên các file sau: -".implode(', ', $permited)."</span>";
					return $alert;
				}
				
				$file_current = strtolower(reset($div));
				$unique_image = $file_current.substr(md5(time()), 0, 5).'.'.$file_ext;
				$uploaded_image = $uploadPath.$unique_image;
				move_uploaded_file($file_temp,$uploaded_image);
				return $unique_image;
			}

			return false;
	    }

		public function del_upload($id, $path = '', $model = '', $field = '')
		{
			$del_upload = $this->$model->find($id);
			$filePath = $path.$del_upload[$field];
			if (file_exists($filePath)){
				unlink($filePath);
			}
		}
		
	    public function loadSidebars()
	    {
	    	//load cate and brand into view sidebar.
	    	$cate_prod = $this->db->table('tbl_category_product')->where('display','=',1)->orderBy('id','desc')->limit(8)->get();
			$brand = $this->db->table('tbl_brand')->where('display','=',1)->orderBy('id','desc')->limit(8)->get();
			$this->bc_list = [
				'cate_prod' => $cate_prod,
				'brand'		=> $brand
			];

			return $this->view('blocks.sidebars', $this->bc_list);
	    }

	    public function loadSlider()
	    {
	    	$list_sliders = $this->db->table('tbl_slider')->where('slider_status', '=', 1)->orderBy('slider_id', 'desc')->limit(4)->get();

	    	$data['list_sliders'] = $list_sliders;

	    	return $this->view('blocks.sliders', $data);
	    }
	}
	
 ?>