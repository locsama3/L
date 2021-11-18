<?php 
	
	class VisitorModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_visitors';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id_visitor';
	    }

	    public function insertVisitor($data)
	    {
	    	return $this->db->table('tbl_visitors')->insert($data);
	    }

	    public function updateVisitor($data, $id)		
	    {
	    	$this->db->table('tbl_visitors')->where('id_visitor','=',$id)->update($data);
	    }

	    public function deleteVisitor($id)
	    {
	    	$this->db->table('tbl_visitors')->where('id_visitor','=',$id)->delete();
	    }

	    public function getOnline($ip)
	    {
	    	return $this->db->table('tbl_visitors')->where('ip_address', '=', $ip)->get();
	    }

	    public function getVisitor($fromdate, $todate)
	    {
	    	return $this->db->table('tbl_visitors')->where('date_visitor', '>=', $fromdate)->where('date_visitor', '<=', $todate)->get();
	    }
	}
	
 ?>