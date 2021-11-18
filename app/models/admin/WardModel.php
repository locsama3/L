<?php 
	
	class WardModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'ward';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id';
	    }

	    public function getWard($id)
	    { 
	    	return $this->db->table('ward')->where('_district_id', '=', $id)->orderBy('id', 'asc')->get();
	    }
	}
	
 ?>