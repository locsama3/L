<!-- Load blocks headers -->

<!-- end load blocks headers -->

<!-- Load Content -->
  <?php 

 	if(!empty($sub_content)){
		$this->view($content, $sub_content); 
 	}else{
 		$this->view($content); 
 	}
 		
 ?>
<!-- End Content -->

<!-- Load blocks footer-->
 <?php 
 	$this->view('blocks.footer');
  ?>
<!-- end load block footer -->