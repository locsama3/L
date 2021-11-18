<?php 
	
	class LoginModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_admin';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'id';
	    }

	    public function loginAdmin($user, $pass)
	    {
	    	return $this->db->table('tbl_admin')->where('admin_user', '=', $user)->where('admin_pass','=',$pass)->first();
	    }

	    public function insertAdmin($data)
	    {
	    	$this->db->table('tbl_admin')->insert($data);
	    }

	    public function updateAdmin($data, $id)		
	    {
	    	$this->db->table('tbl_admin')->where('id','=',$id)->update($data);
	    }

	    public function deleteAdmin($id)
	    {
	    	# code...
	    }
	}
	
 ?>