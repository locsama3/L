<?php 
	
	class UserModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_users';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'user_id';
	    }

	    public function insertUser($data)
	    {
	    	return $this->db->table('tbl_users')->insert($data);
	    }

	    public function updateUser($data, $id)		
	    {
	    	$this->db->table('tbl_users')->where('user_id','=',$id)->update($data);
	    }

	    public function deleteUser($id)
	    {
	    	$this->db->table('tbl_users')->where('user_id','=',$id)->delete();
	    }

	    public function userAdmin($user, $pass)
	    {
	    	return $this->db->table('tbl_users')->where('email', '=', $user)->where('password','=',$pass)->first();
	    }
	}
	

 ?>