<?php 
	
	class Cart extends BaseController
	{
	    public $cartModel, $provinceModel, $districtModel, $wardModel, $deliveryModel;
	    public $request, $response;

		public function __construct()
		{
			$this->cartModel = $this->loadModel('CartModel');
			$this->deliveryModel = $this->loadModel('DeliveryModel');
			$this->provinceModel = $this->loadModel('admin/ProvinceModel');
			$this->districtModel = $this->loadModel('admin/DistrictModel');
			$this->wardModel = $this->loadModel('admin/WardModel');
	    	$this->request = new Request();
	    	$this->response = new Response();
		}

		public function show_cart()
		{
			if(isset($_SESSION['cart'])){
				$this->data['sub_content']['cart_prod'] = $_SESSION['cart'];
			}		

			$province = $this->provinceModel->getProvince();
			$this->data['sub_content']['list_province'] = $province;

			$this->view('blocks.header');	
			$this->data['content'] = 'clients.carts.show_cart';
			return $this->view('layouts.clients_layout', $this->data);
		}

		public function process_qty()
		{
			if(isset($_POST['product'])){
				$product = $_POST['product'];
		        $id = $product['prod_id'];
		        $qty = $product['prod_qty'];
		        if (isset($_SESSION['cart'][$id])) {
		            $_SESSION['cart'][$id]['quantity'] = $qty;
		            $_SESSION['cart'][$id]['total'] = $qty * $_SESSION['cart'][$id]['price'];
		        }
			}
			echo $_SESSION['cart'][$id]['qty'];
		}

		public function del_cart()
		{	
			$dataField = $this->request->getFields();
			$id = $dataField['id'];
			unset($_SESSION['cart'][$id]);
		}

		// gio hang ajax
		public function add_cart()
		{
			$dataField = $this->request->getFields();
			$id = $dataField['cart_product_id'];
			$qty = $dataField['cart_product_qty'];

			if (isset($_SESSION['cart'][$id])) {
		        $_SESSION['cart'][$id]['quantity'] += $qty;
		        $_SESSION['cart'][$id]['total']=$_SESSION['cart'][$id]['quantity']*$_SESSION['cart'][$id]['price'];
		    }else{
				$subtotal = $dataField['cart_product_price'] * $dataField['cart_product_qty'];
				$item = [
					'id' => $dataField['cart_product_id'],
					'code' => $dataField['cart_product_code'],
					'name' => $dataField['cart_product_name'],
					'thumb' => $dataField['cart_product_image'],
					'price' => $dataField['cart_product_price'],
					'quantity'	 => $dataField['cart_product_qty'],
					'total'		=> $subtotal
				];

				$_SESSION['cart'][$id] = $item;
			}
		}

		public function select_delivery_home()
		{
			$dataField = $this->request->getFields();
			$id = $dataField['id'];

			if($dataField['action']){
				$output = '';

				if($dataField['action'] == 'province'){
					
					$select_district = $this->districtModel->getDistrict($id);
					$output .= '<option disabled selected>Chọn Quận/Huyện</option>';
					foreach ($select_district as $key => $district) {
						$output .= '<option value="'. $district['id'] .'">'. $district['_prefix'] .' '. $district['_name'] .'</option>';
					}

				}else{
					$select_ward = $this->wardModel->getWard($id);
					$output .= '<option disabled selected>Chọn Xã/Phường</option>';
					foreach ($select_ward as $key => $ward) {
						$output .= '<option value="'. $ward['id'] .'">'. $ward['_prefix'] .' '. $ward['_name'] .'</option>';
					}
				}

				echo $output;
			}
		}

		public function calculate_fee()
		{
			$dataField = $this->request->getFields();

			if(!empty($dataField['province'])){
				$result = $this->deliveryModel->getDeliveryFee($dataField['province'], $dataField['district'], $dataField['ward']);
				if(!empty($result)){
					$feeship = $result['fee_value'];

					Session::data('fee_ship', $feeship);

					echo $feeship;
				}else{
					$feeship = 20000;

					Session::data('fee_ship', $feeship);

					echo $feeship;
				}
			}
		}

		public function unset_feeship()
		{
			Session::delete('fee_ship');
			return $this->response->redirect('gio-hang');
		}

	}
	
 ?>