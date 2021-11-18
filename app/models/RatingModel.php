<?php 
	
	class RatingModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_rating';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'rating_id';
	    }

	    public function insertRating($data)
	    {
	    	return $this->db->table('tbl_rating')->insert($data);
	    }

	    public function updateRating($data, $id)		
	    {
	    	$this->db->table('tbl_rating')->where('rating_id','=',$id)->update($data);
	    }

	    public function deleteRating($id)
	    {
	    	$this->db->table('tbl_rating')->where('rating_id','=',$id)->delete();
	    }

	    //end model backend

	    public function getAvgRating($prod_id)
	    { 
	    	return $this->db->table('tbl_rating')->select('AVG(rating) as danhgia')->where('product_id', '=', $prod_id)->get();
	    }
	}
	
 ?>