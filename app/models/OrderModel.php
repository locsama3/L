<?php 
	
	class OrderModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_oder_overview';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id';
	    }

	    public function insertOrderGetId($data)
	    {
	    	$this->db->table('tbl_oder_overview')->insert($data);
	    	return $this->db->lastId();
	    }

	    public function insertDetail($data)
	    {
	    	$this->db->table('tbl_order_detail')->insert($data);
	    }

	    public function updateOverview($data, $id)
	    {
	    	$this->db->table('tbl_oder_overview')->where('id','=',$id)->update($data);
	    }

	    public function deleteOrder($id)
	    {
	    	$this->db->table('tbl_oder_overview')->where('id','=',$id)->delete();
	    }

	    public function viewOrder()
	    {
	    	return $this->db->table('tbl_oder_overview as a')->orderBy('a.create_at', 'desc')->get();
	    }

	    public function order_byId($id)
	    {
	    	return $this->db->table('tbl_users as a')->join('tbl_oder_overview as b', 'a.user_id = b.cus_id')->join('tbl_payment as c', 'b.payment_id = c.payment_id')->select('a.*, b.*, b.phone as cus_phone, b.address as cus_address, c.payment_method')->where('b.id', '=', $id)->first();
	    }

	    public function product_order($id)
	    {
	    	return $this->db->table('tbl_order_detail as a')->join('tbl_products as b', 'a.product_id = b.id')->where('a.order_id', '=', $id)->select('a.*, b.name, b.regular_price, b.product_quantity')->get();
	    }

	    public function updateQtyDetail($data, $prod_id, $order_id)
	    {
	    	$this->db->table('tbl_order_detail')->where('order_id', '=', $order_id)->where('product_id', '=', $prod_id)->update($data);
	    }

	    public function getTotalDetail($prod_id, $order_id)
	    {
	    	return $this->db->table('tbl_order_detail')->where('order_id', '=', $order_id)->where('product_id', '=', $prod_id)->select('total')->first();
	    }

	    public function getLastestOrder()
	    {
	    	return $this->db->table('tbl_oder_overview as a')->orderBy('a.create_at', 'desc')->limit(9)->get();
	    }
	}
	
 ?>