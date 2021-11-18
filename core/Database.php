<?php 
	
	class Database
	{
		private $__conn;

		use QueryBuilder;

		// Kết nối database
	    public function __construct()
	    {
	    	global $db_config;
	    	$this->__conn = Connection::getInstance($db_config);
	    }

	    // thêm dữ liệu
	    public function insertData($table, $data)
	    {
	    	if(!empty($data)){
	    		$fieldStr = '';
	    		$valueStr = '';
	    		foreach ($data as $key => $value) {
	    			$fieldStr .= $key.',';
	    			$valueStr .= "'" . $value . "',";
	    		}
	    		$fieldStr = rtrim($fieldStr, ',');
	    		$valueStr = rtrim($valueStr, ',');

	    		$sql = "INSERT INTO $table($fieldStr) VALUES ($valueStr)";

	    		$status = $this->query($sql);

	    		if($status){
	    			return true;
	    		}
	    	}

	    	return false;
	    }
//
	    // sửa dữ liệu
	    public function updateData($table,$data,$condition='')
	    {
	    	if(!empty($data)){
	    		$updateStr = '';
	    		foreach ($data as $key => $value) {
	    			$updateStr .= "$key = '$value',";
	    		}

	    		$updateStr = rtrim($updateStr,',');

	    		if(!empty($condition)){
	    			$sql = "UPDATE $table SET $updateStr WHERE $condition";
	    		}else{
	    			$sql = "UPDATE $table SET $updateStr";
	    		}

	    		$status = $this->query($sql);

	    		if($status){
	    			return true;
	    		}
	    	}

	    	return false;
	    }

	    // xóa dữ liệu
	    public function deleteData($table, $condition = '')		
	    {
	    	if(!empty($condition)){
	    		$sql = " DELETE FROM ". $table ." WHERE ". $condition;
	    	}else{
	    		$sql = " DELETE FROM ". $table;
	    	}

	    	$status = $this->query($sql);

	    	if($status){
	    		return true;
	    	}

	    	return false;
	    }

	    // truy vấn câu lệnh sql
	    public function query($sql)
	    {
	    	try{
		    	$statement = $this->__conn->prepare($sql);

		    	$statement->execute();

		    	return $statement;
		    }catch (Exception $e){
		    	$mess = $e->getMessage();
		    	$data['mess'] = $mess;
		    	App::$app->loadError('databaseError',$data);
		    	die();
		    }
	    }

	    // trả về id mới nhất sau khi insert, gắn với hành động insert
	    public function lastInsertId()
	    {
	        return $this->__conn->lastInsertId();
	    }
	}
	
 ?>