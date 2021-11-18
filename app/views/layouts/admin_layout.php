<!-- Load block sidebar -->
<?php 
	$this->view('blocks.admin.sidebar');
 ?>

<!-- content -->
 <?php 

 	if(!empty($sub_content)){
		$this->view($content, $sub_content); 
 	}else{
 		$this->view($content); 
 	}
 		
 ?> 
<!-- content -->

<!-- Load block footer -->
 <?php 
 	$this->view('blocks.admin.footer');
  ?>
