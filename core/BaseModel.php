<?php 
	
	abstract class BaseModel extends Database
	{
		protected $db;

	    public function __construct()
	    {
	    	$this->db = new Database();
	    }

	    abstract function tableFill();

	    abstract function fieldFill();

	    abstract function primaryKey();

	    // lấy tất cả bản ghi
	    public function all()
	    {
	    	$tableName = $this->tableFill();
	    	$fieldSelect = $this->fieldFill();
	    	if(empty($fieldSelect)){
	    		$fieldSelect = '*';
	    	}

	    	$sql = "SELECT $fieldSelect FROM $tableName";
	    	$query = $this->db->query($sql);

	    	if(!empty($query)){
	    		return $query->fetchAll(PDO::FETCH_ASSOC);
	    	}

	    	return false;
	    }

	    // lấy bản ghi đầu tiên
	    public function find($id)
	    {
	    	$tableName = $this->tableFill();
	    	$fieldSelect = $this->fieldFill();
	    	$primaryKey = $this->primaryKey();
	    	if(empty($fieldSelect)){
	    		$fieldSelect = '*';
	    	}

	    	$sql = "SELECT $fieldSelect FROM $tableName WHERE $primaryKey = $id";
	    	$query = $this->db->query($sql);

	    	if(!empty($query)){
	    		return $query->fetch(PDO::FETCH_ASSOC);
	    	}

	    	return false;
	    }
	}
	
 ?>