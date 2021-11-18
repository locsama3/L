<?php 
	
	class DeliveryModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_ship_fee';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'fee_id';
	    }

	    public function insertDelivery($data)
	    {
	    	return $this->db->table('tbl_ship_fee')->insert($data);
	    }

	    public function updateDelivery($data, $id)		
	    {
	    	$this->db->table('tbl_ship_fee')->where('fee_id','=',$id)->update($data);
	    }

	    public function deleteDelivery($id)
	    {
	    	$this->db->table('tbl_ship_fee')->where('fee_id','=',$id)->delete();
	    }

	    public function viewDelivery()
	    {
	    	return $this->db->table('tbl_ship_fee')->orderBy('fee_id', 'desc')->get();
	    }

	    public function getDeliveryFee($prov_id, $distr_id, $ward_id)
	    {
	    	return $this->db->table('tbl_ship_fee')->where('province_id', '=', $prov_id)->where('district_id', '=', $distr_id)->where('ward_id', '=', $ward_id)->first();
	    }
	}
	
 ?>