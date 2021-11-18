<?php 
	
	class DistrictModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'district';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id';
	    }

	    public function getDistrict($id)
	    { 
	    	return $this->db->table('district')->where('_province_id', '=', $id)->orderBy('id', 'asc')->get();
	    }
	}
	
 ?>