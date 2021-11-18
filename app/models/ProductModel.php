<?php 
	
	class ProductModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_products';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id';
	    }

	    public function viewProduct(){
	    	return $this->db->table('tbl_products as a')->join('tbl_category_product as b','a.cate_id=b.id')->select('*, a.id as prod_id')->orderBy('a.id', 'desc')->get();
	    }	

	    public function insertProduct($data)
	    {
	    	$this->db->table('tbl_products')->insert($data);
	    	return $this->db->lastId();
	    }

	    public function updateProduct($data, $id)		
	    {
	    	$this->db->table('tbl_products')->where('id','=',$id)->update($data);
	    }

	    public function deleteProduct($id)
	    {
	    	$this->db->table('tbl_products')->where('id','=',$id)->delete();
	    }

	    // model clients
	    public function getProductById($id)
	    {
	    	return $this->db->table('tbl_products as a')->select('*, a.id as prod_id, b.id as cate_id, c.id as brand_id')->join('tbl_category_product as b', 'a.cate_id = b.id')->join('tbl_brand as c', 'a.brand_id = c.id')->where('a.id','=',$id)->first();
	    }

	    public function getProductByCate($cate_id, $prod_id)
	    {
	    	return $this->db->table('tbl_products')->where('cate_id','=',$cate_id)->where('id','!=', $prod_id)->limit(9)->get();
	    }

	    public function get_selling()
	    {
	    	return $this->db->table('tbl_products')->orderBy('product_sold', 'DESC')->limit(9)->get();
	    }
	}
	
 ?>