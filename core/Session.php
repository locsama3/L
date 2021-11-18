<?php 
	
	class Session
	{
		/*
			- data(key, value) => set session
			- data(key) => get session
		*/
	    public static function data($key = '', $value = '')
	    {	
	    	$sessionKey = self::isInvalid();
	    	
	    	if(!empty($value)){
	    		if(!empty($key)){
	    			$_SESSION[$sessionKey][$key] = $value; // set session
	    			return true;
	    		}
	    		return false;

	    	}else{
	    		if(empty($key)){
	    			if(isset($_SESSION[$sessionKey])){
	    				return $_SESSION[$sessionKey]; // get all session
	    			}
	    		}else{
	    			if(isset($_SESSION[$sessionKey][$key])){
	    				return $_SESSION[$sessionKey][$key]; // get session
	    			}
	    		}
	    	}
	    }

	    public static function many($key = '', $keyvalue = '', $value)
	    {	
	    	$sessionKey = self::isInvalid();
	    	
	    	if(!empty($value) && !empty($keyvalue)){
	    		if(!empty($key)){
	    			$_SESSION[$sessionKey][$key][$keyvalue] = $value;
	    			return true;
	    		}
	    		return false;

	    	}elseif(empty($value) && !empty($keyvalue)){
	    		if(!empty($key)){
	    			if(isset($_SESSION[$sessionKey][$key][$keyvalue])){
	    				return $_SESSION[$sessionKey][$key][$keyvalue];
	    			}
	    		}

	    		return false;
	    	}

	    	return false;
	    }

	    // thêm 1 phần tử vào cuối mảng
	    public static function put($key = '', $value = '')
	    {	
	    	$sessionKey = self::isInvalid();
	    	
	    	if(!empty($value)){
	    		if(!empty($key)){
	    			array_push($_SESSION[$sessionKey][$key], $value);
	    			return true;
	    		}
	    		return false;
	    	}

	    	return false;
	    }

	    /*
			- delete(key) => xóa session với key
			- delete() => xóa toàn bộ session
	    */
	    public static function delete($key = '')
	    {
	    	$sessionKey = self::isInvalid();

	        if(!empty($key)){
	        	if(isset($_SESSION[$sessionKey][$key])){
	        		unset($_SESSION[$sessionKey][$key]);
	        		return true;
	        	}
	        	return false;
	        }else{
	        	unset($_SESSION[$sessionKey]);
	        	return true;
	        }

	        return false;
	    }

	    /*
			Flash Data
			- Set flash data => giống như set session
			- Get flash data => giống như get session, xóa luôn session sau khi get
	    */
		public static function flash($key = '', $value = '')
		{
		    $dataFlash = self::data($key, $value);
		    if(empty($value)){
		    	self::delete($key);
		    }

		    return $dataFlash;
		}

	    static public function showErrors($mess)
	    {
	    	$data = ['message' => $mess];
	        App::$app->loadError('sessionError', $data);
	        die();
	    }

	    public static function isInvalid()
	    {
	    	global $config;

	        if(!empty($config['session'])){
	    		$sessionConfig = $config['session'];
	    		if(!empty($sessionConfig['session_key'])){
	    			$sessionKey = $sessionConfig['session_key'];
	    			return $sessionKey;
	    		}else{
	    			self::showErrors('Thiếu cấu hình Session_key. Vui lòng kiểm tra lại config Session!');
	    		}
	    	}else{
	    		self::showErrors('Thiếu cấu hình Session. Vui lòng kiểm tra lại config Session!');
	    	}
	    }
	}
		
 ?>