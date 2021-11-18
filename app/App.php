<?php 

	class App
	{
		private $__controller, $__action, $__params, $__routes, $__db;

		public static $app;

	    public function __construct()
	    {
	    	global $routes;

	    	self::$app = $this;

	    	$this->__routes = new Route();

	    	if(!empty($routes['default_controller'])){
		    	$this->__controller = $routes['default_controller'];
	    	}
	    	$this->__action = 'index';
	    	$this->__params = [];

	    	// global query builder
	    	if(class_exists('DB')){
	    		$dbObject = new DB();

	    		$this->__db = $dbObject->db;
	    	}

	    	$this->handleUrl();
	    }

	    public function getUrl()
	    {
	    	if(!empty($_SERVER['PATH_INFO'])){
	    		$url = $_SERVER['PATH_INFO'];
	    	}else{
	    		$url = '/';
	    	}

	    	return $url;
	    }

	    public function handleUrl()
	    {
	    	$url = $this->getUrl();

	    	$url = $this->__routes->handleRoute($url);

	    	// Tách chuỗi url thành mảng url
	    	$urlArr = array_filter(explode('/', $url));

	    	// Đưa về đúng dạng cấu trúc mảng index: 0,1,2,3
	    	$urlArr = array_values($urlArr);

	    	$urlCheck = '';
	    	if (!empty($urlArr)) {
		    	foreach ($urlArr as $key => $item) {
		    		$urlCheck .= $item.'/';
		    		$fileCheck = rtrim($urlCheck,'/');
		    		// Xử lý để viết hoa tên file
		    		$fileArr = explode('/', $fileCheck);
		    		$last = count($fileArr) - 1;
		    		$fileArr[$last] = ucfirst($fileArr[$last]);

		    		$fileCheck = implode('/', $fileArr);

		    		if(!empty($urlArr[$key - 1])){
				 		unset($urlArr[$key - 1]);
		    		}
		   
		    		if (file_exists('app/controllers/' .($fileCheck). '.php')) {
		    			$urlCheck = $fileCheck;	
		    			break;
		    		}
		    	}
		    	
		    	// Đưa về đúng dạng cấu trúc mảng index: 0,1,2,3
		    	$urlArr = array_values($urlArr);	
	    	}


	    	//Xử lý controller
	    	if(!empty($urlArr[0])){
	    		$this->__controller = ucfirst($urlArr[0]);	    		
	    	}else{
	    		$this->__controller = ucfirst($this->__controller);
	    	}

	    	// xử lý khi urlcheck rỗng
	    	if(empty($urlCheck)){
	    		$urlCheck = $this->__controller;
	    	}

	    	if(file_exists('app/controllers/' .($urlCheck). '.php')){
    			require_once 'controllers/' .($urlCheck). '.php';
    			//Kiểm tra class controller có tồn tại ko?
    			if(class_exists($this->__controller)){
    				$this->__controller = new $this->__controller();

    				unset($urlArr[0]);

    				if(!empty($this->__db)){
	    				$this->__controller->db = $this->__db;
    				}
    			}else{
    				$this->loadError();
    			}
    			
    		}else{
    			$this->loadError();
    		}

	    	//Xử lý action
	    	if(!empty($urlArr[1])){
	    		$this->__action = $urlArr[1];	
	    		unset($urlArr[1]);    		
	    	}

	    	//Xử lý params
	    	$this->__params = array_values($urlArr);

	    	//Kiểm tra method tồn tại
	    	if(method_exists($this->__controller, $this->__action)){
		    	//Gọi phương thức
	    		call_user_func_array([$this->__controller, $this->__action], $this->__params);
	    	}else{
	    		$this->loadError();
	    	}
	    	
	    }

	    public function getCurrentController()
	    {
	    	return $this->__controller;
	    }

	    public function loadError($name = '404', $data)
	    {
	    	extract($data);
	    	require_once 'errors/'.($name).'.php';
	    }
	}
	
 ?>