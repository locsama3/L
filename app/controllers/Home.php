<?php 
			
	class Home extends BaseController
	{
		public $homeModel;
		public $request, $response;

		public function __construct()
		{
			$this->homeModel = $this->loadModel('HomeModel');
			$this->request = new Request();
	    	$this->response = new Response();
		}

	    public function index()
	    {	
	    	
			$this->view('blocks.header');

			$this->loadSlider();

			$this->loadSidebars();

			//load list newest product
			$this->data['sub_content']['newest_product'] = $this->homeModel->getList();

			$this->data['content'] = 'clients.index';
			return $this->view('layouts.clients_layout', $this->data);
	    }

	    public function search()
	    {
	    	$dataField = $this->request->getFields();
	    	$keyWord = $dataField['keyword_search'];

	    	$this->view('blocks.header');

			$this->loadSlider();

			$this->loadSidebars();

			//load list newest product
			$this->data['sub_content']['search_product'] = $this->homeModel->getSearch($keyWord);

			$this->data['content'] = 'clients.products.search';
			return $this->view('layouts.clients_layout', $this->data);
	    }
	}
	
 ?>