<?php 
	
	class Comment extends BaseController
	{
	    public $commentModel;
	    public $request, $response;

		public function __construct()
		{
			$this->commentModel = $this->loadModel('CommentModel');
	    	$this->request = new Request();
	    	$this->response = new Response();
		}

		public function AuthLogin()
		{
			$check = Session::data('admin_id');
	    	if(empty($check)){
	    		return $this->response->redirect('admin');
	    	}
		}

		public function load_comment()
		{
			$dataField = $this->request->getFields();
			$prod_id = $dataField['prod_id'];

			$list_comment = $this->commentModel->getComment($prod_id);

			$output = '';

			foreach ($list_comment as $key => $comment) {
				$output .= '
					<div class="col-sm-1 avatar">
						<img src="'. _WEB_ROOT .'/public/frontend/images/product-details/avt.png" alt="Ảnh đại diện" class = "img img-responsive img-thumbnail" style = "border-radius: 50%">
					</div>
					<div class="col-sm-10 load_comment">
						<p style="color: orange;">
							'. $comment['fullname'] .'
						</p>
						<p style="color: gray;">
							'. $comment['comment_day'] .'
						</p>
						<p class = "load_content">
							'. $comment['content'] .'
						</p>
					</div>
				';

				$rep_comments = $this->commentModel->getRepComment($comment['id_bl']);

				if(!empty($rep_comments)){
					foreach ($rep_comments as $key => $rep) {
						$output .= '
							<div class="col-sm-10 col-sm-push-1">
								<div class = "row">
									<div class="col-sm-1 avatar">
										<img src="'. _WEB_ROOT .'/public/frontend/images/product-details/businessman.png" alt="Ảnh đại diện" class = "img img-responsive img-thumbnail" style = "border-radius: 50%; width: 90%">
									</div>
									<div class="col-sm-10 load_comment">
										<p style="color: orange;">
											'. $rep['fullname'] .'
										</p>
										<p style="color: gray;">
											'. $rep['comment_day'] .'
										</p>
										<p class = "load_content">
											'. $rep['content'] .'
										</p>
									</div>
								</div>
							</div>
							<div class = "clearfix"></div>
						';
					}
				}
			}

			echo $output;
		}

		public function send_comment()
		{
			$dataField = $this->request->getFields();

			$data = [
				'content' => $dataField['comment_content'],
				'product_id' => $dataField['prod_id'],
				'cus_id' => $dataField['cus_id'],
				'create_at' => date("Y-m-d h:i:s")
			];

			$this->commentModel->insertComment($data);
		}

		public function manage_comment()
		{
			$this->AuthLogin();
			$this->data['sub_content']['list_product_comment'] = $this->commentModel->getProducts();
			$this->data['content'] = 'admins.manage_comment';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function view_comment($prod_id)
		{
			$this->AuthLogin();
			$this->data['sub_content']['title'] = "Danh sách bình luận theo sản phẩm";
			$this->data['sub_content']['subtitle'] = "Chi tiết bình luận của sản phẩm";
			$this->data['sub_content']['list_comment'] = $this->commentModel->viewComment($prod_id);
			$this->data['content'] = 'admins.view_comment';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function allow_comment()
		{
			$dataField = $this->request->getFields();
			$comment_id = $dataField['comment_id'];

			$data['comment_status'] = $dataField['status'];

			$this->commentModel->updateComment($data, $comment_id);
		}

		public function reply_comment()
		{
			$dataField = $this->request->getFields();
			$data = [
				'content' => $dataField['content'],
				'product_id' => $dataField['prod_id'],
				'cus_id' => 4,
				'parent_id' => $dataField['comment_id'],
				'create_at' => date("Y-m-d h:i:s")
			];

			$this->commentModel->insertComment($data);
		}

		public function child_comment($parent_id)
		{
			$this->AuthLogin();
			$this->data['sub_content']['title'] = "Danh sách trả lời bình luận";
			$this->data['sub_content']['subtitle'] = "Chi tiết bình luận";
			$this->data['sub_content']['list_comment'] = $this->commentModel->childComment($parent_id);
			$this->data['content'] = 'admins.view_comment';
			return $this->view('layouts.admin_layout', $this->data);
		}
	}
	
 ?>