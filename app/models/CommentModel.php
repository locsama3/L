<?php 
	
	class CommentModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_comments';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id_bl';
	    }

	    public function insertComment($data)
	    {
	    	return $this->db->table('tbl_comments')->insert($data);
	    }

	    public function updateComment($data, $id)		
	    {
	    	$this->db->table('tbl_comments')->where('id_bl','=',$id)->update($data);
	    }

	    public function deleteComment($id)
	    {
	    	$this->db->table('tbl_comments')->where('id_bl','=',$id)->delete();
	    }

	    public function viewComment($prod_id)
	    {
	    	return $this->db->table('tbl_comments as a')->join('tbl_users as b','a.cus_id = b.user_id')->where('product_id','=',$prod_id)->whereIs('parent_id','NULL')->orderBy('id_bl', 'desc')->select('a.*, b.*, a.create_at as comment_day')->get();
	    }

	    public function getProducts()
	    {
	    	return $this->db->table('tbl_products as a')->join('tbl_comments as b', 'a.id = b.product_id')->select('b.*, a.name, a.thumbnail, COUNT(b.product_id) as soluotbl')->orderBy('a.id', 'desc')->groupBy('b.product_id')->get();
	    }

	    public function childComment($parent_id)
	    {
	    	return $this->db->table('tbl_comments as a')->join('tbl_users as b','a.cus_id = b.user_id')->where('parent_id','=',$parent_id)->orderBy('id_bl', 'desc')->select('a.*, b.*, a.create_at as comment_day')->get();
	    }

	    // clients
	    public function getComment($prod_id)
	    {
	    	return $this->db->table('tbl_comments as a')->join('tbl_users as b','a.cus_id = b.user_id')->where('product_id','=',$prod_id)->where('comment_status', '=', 1)->whereIs('parent_id','NULL')->orderBy('id_bl', 'desc')->select('a.*, b.*, a.create_at as comment_day')->get();
	    }

	    public function getRepComment($parent_id)
	    {
	    	return $this->db->table('tbl_comments as a')->join('tbl_users as b','a.cus_id = b.user_id')->where('parent_id','=',$parent_id)->where('comment_status', '=', 1)->orderBy('id_bl', 'desc')->select('a.*, b.*, a.create_at as comment_day')->get();
	    }

	}
	
 ?>