<?php 
	/* 
		Kế thừa từ class model
	*/
	class HomeModel extends BaseModel
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

	    public function getList()
	    {
	    	return $this->db->table('tbl_products')->where('best_seller','=','1')->orderBy('id','desc')->limit(6)->get();
	    }

	    public function getSearch($keyWord)
	    {
	    	return $this->db->table('tbl_products')->whereLike('name','%'.$keyWord.'%')->orderBy('id','desc')->limit(6)->get();
	    }
	}
	
 ?>