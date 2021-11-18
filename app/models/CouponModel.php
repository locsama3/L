<?php 
	
	class CouponModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_coupon';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id';
	    }

	    public function insertCoupon($data)
	    {
	    	return $this->db->table('tbl_coupon')->insert($data);
	    }

	    public function updateCoupon($data, $id)		
	    {
	    	$this->db->table('tbl_coupon')->where('id','=',$id)->update($data);
	    }

	    public function deleteCoupon($id)
	    {
	    	$this->db->table('tbl_coupon')->where('id','=',$id)->delete();
	    }

	    public function viewCoupon()
	    {
	    	return $this->db->table('tbl_coupon')->orderBy('id', 'desc')->get();
	    }

	    //end model backend

	    public function check_coupon($code)
	    {
	    	return $this->db->table('tbl_coupon')->where('code', '=', $code)->where('status', '=', 1)->first();
	    }
	}
	
 ?>