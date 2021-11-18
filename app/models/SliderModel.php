<?php 
	
	class SliderModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_slider';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'slider_id';
	    }

	    public function insertSlider($data)
	    {
	    	return $this->db->table('tbl_slider')->insert($data);
	    }

	    public function updateSlider($data, $id)		
	    {
	    	$this->db->table('tbl_slider')->where('slider_id','=',$id)->update($data);
	    }

	    public function deleteSlider($id)
	    {
	    	$this->db->table('tbl_slider')->where('slider_id','=',$id)->delete();
	    }

	    public function getSlider()
	    {
	    	return $this->db->table('tbl_slider')->orderBy('slider_id', 'desc')->get();
	    }
	}
	
 ?>