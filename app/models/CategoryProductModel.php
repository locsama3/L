<?php 
	
	class CategoryProductModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_category_product';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id';
	    }

	    public function insertCateProd($data)
	    {
	    	return $this->db->table('tbl_category_product')->insert($data);
	    }

	    public function updateCateProd($data, $id)		
	    {
	    	$this->db->table('tbl_category_product')->where('id','=',$id)->update($data);
	    }

	    public function deleteCateProd($id)
	    {
	    	$this->db->table('tbl_category_product')->where('id','=',$id)->delete();
	    }

	    //model for clients

	    public function getProducts($id)
	    {
	    	return $this->db->table('tbl_products')->where('cate_id','=',$id)->orderBy('id','desc')->limit(6)->get();
	    }
	}
	
 ?>