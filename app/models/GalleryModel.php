<?php 
	
	class GalleryModel extends BaseModel
	{
	    public function __construct()
	    {
	    	parent::__construct();
	    }

	    public function tableFill()
	    {
	    	return 'tbl_product_gallery';
	    }

	    public function fieldFill()
	    {
	    	return '*';
	    }

	    public function primaryKey()
	    {
	    	return 'gallery_id';
	    }

	    // model gallery

	    public function insertGallery($data)
	    {
	    	$this->db->table('tbl_product_gallery')->insert($data);
	    }

	    public function updateGallery($data, $id)		
	    {
	    	$this->db->table('tbl_product_gallery')->where('gallery_id','=',$id)->update($data);
	    }

	    public function deleteGallery($id)
	    {
	    	$this->db->table('tbl_product_gallery')->where('gallery_id','=',$id)->delete();
	    }

	    public function getGallery($id)
	    {
	    	return $this->db->table('tbl_product_gallery')->where('product_id', '=', $id)->get();
	    }
	}
	
 ?>