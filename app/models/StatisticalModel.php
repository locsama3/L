<?php 
	
	class StatisticalModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_statistical';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id_statistical';
	    }

	    public function insertStatistical($data)
	    {
	    	return $this->db->table('tbl_statistical')->insert($data);
	    }

	    public function updateStatistical($data, $id)		
	    {
	    	$this->db->table('tbl_statistical')->where('id_statistical','=',$id)->update($data);
	    }

	    public function updateByDate($data, $order_date)		
	    {
	    	$this->db->table('tbl_statistical')->where('order_date','=',$order_date)->update($data);
	    }

	    public function deleteStatistical($id)
	    {
	    	$this->db->table('tbl_statistical')->where('id_statistical','=',$id)->delete();
	    }

	    public function getStatistic($fromdate, $todate)
	    {
	    	return $this->db->table('tbl_statistical')->where('order_date', '>=', $fromdate)->where('order_date', '<=', $todate)->orderBy('order_date', 'ASC')->get();
	    }

	    public function get_statistic_by_date($order_date)
	    {
	    	return $this->db->table('tbl_statistical')->where('order_date', '=', $order_date)->get();
	    }

	    public function first_statistic_by_date($order_date)
	    {
	    	return $this->db->table('tbl_statistical')->where('order_date', '=', $order_date)->first();
	    }
	}
	
 ?>