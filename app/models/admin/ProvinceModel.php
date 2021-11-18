<?php 
	
	class ProvinceModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'province';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id';
	    }

	    public function getProvince()
	    { 
	    	return $this->db->table('province')->orderBy('id', 'asc')->get();
	    }
	}
	
 ?>