<?php 
	
	class BrandModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_brand';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id';
	    }

	    public function insertBrand($data)
	    {
	    	return $this->db->table('tbl_brand')->insert($data);
	    }

	    public function updateBrand($data, $id)		
	    {
	    	$this->db->table('tbl_brand')->where('id','=',$id)->update($data);
	    }

	    public function deleteBrand($id)
	    {
	    	$this->db->table('tbl_brand')->where('id','=',$id)->delete();
	    }

	    //end model backend

	    public function getProducts($id)
	    { 
	    	return $this->db->table('tbl_products as a')->select('*, a.id as prod_id')->where('a.brand_id','=',$id)->orderBy('a.id','desc')->limit(6)->get();
	    }
	}
	
 ?>