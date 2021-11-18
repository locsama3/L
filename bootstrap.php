<?php 

	define('_DIR_ROOT', __DIR__);

	// Xử lý http root
	if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
		$web_root = 'https://'.$_SERVER['HTTP_HOST'];
	}else{
		$web_root = 'http://'.$_SERVER['HTTP_HOST'];
	}

	$droot = str_replace('\\', '/', _DIR_ROOT);

	$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower($droot));

	$web_root = $web_root.$folder;

	define('_WEB_ROOT', $web_root);
	
	// Autoload Config
	$configs_dir = scandir('configs');
	if (!empty($configs_dir)) {
		foreach ($configs_dir as $item) {
			if($item != '.' && $item != '..' && file_exists('configs/'.$item)){
				require_once 'configs/'.$item;
			}
		}
	}

	require_once 'core/Route.php'; // load route class

	require_once 'core/Session.php'; // load session class

	require_once 'public/backend/tcpdf/tcpdf.php';

	require_once 'app/App.php'; // load app

	// kiểm tra config và load database
	if (!empty($config['database'])) {
		$db_config = array_filter($config['database']);	

		if (!empty($db_config)) {
			require_once 'core/Connection.php';
			require_once 'core/QueryBuilder.php';	
			require_once 'core/Database.php';
			require_once 'core/DB.php';
		}
	}

	//load core helpers
	require_once 'core/Helper.php';

	//load all helpers
	$allHelpers = scandir('app/helpers');
	if (!empty($allHelpers)) {
		foreach ($allHelpers as $item) {
			if($item != '.' && $item != '..' && file_exists('app/helpers/'.$item)){
				require_once 'app/helpers/'.$item;
			}
		}
	}

	require_once 'core/BaseModel.php'; // load base model

	require_once 'core/BaseController.php'; // load base controller

	require_once 'core/Request.php'; // load request
	
	require_once 'core/Response.php';

 ?>