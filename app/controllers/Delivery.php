<?php 
	
	class Delivery extends BaseController
	{
	    public $deliveryModel, $provinceModel, $districtModel, $wardModel;
	    public $request, $response;

		public function __construct()
		{
			$this->deliveryModel = $this->loadModel('DeliveryModel');
			$this->provinceModel = $this->loadModel('admin/ProvinceModel');
			$this->districtModel = $this->loadModel('admin/DistrictModel');
			$this->wardModel = $this->loadModel('admin/WardModel');
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

		public function manage_delivery()
		{
			$this->AuthLogin();
			$province = $this->provinceModel->getProvince();
			$this->data['sub_content']['list_province'] = $province;
			$this->data['content'] = 'admins.view_delivery';
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function select_delivery()
		{
			$dataField = $this->request->getFields();
			$id = $dataField['id'];

			if($dataField['action']){
				$output = '';

				if($dataField['action'] == 'province'){
					
					$select_district = $this->districtModel->getDistrict($id);
					$output .= '<option disabled selected>---Chọn Quận/Huyện---</option>';
					foreach ($select_district as $key => $district) {
						$output .= '<option value="'. $district['id'] .'">'. $district['_prefix'] .' '. $district['_name'] .'</option>';
					}

				}else{
					$select_ward = $this->wardModel->getWard($id);
					$output .= '<option disabled selected>---Chọn Xã/Phường---</option>';
					foreach ($select_ward as $key => $ward) {
						$output .= '<option value="'. $ward['id'] .'">'. $ward['_prefix'] .' '. $ward['_name'] .'</option>';
					}
				}

				echo $output;
			}
		}

		public function insert_delivery()
		{
			$dataField = $this->request->getFields();

			$data = [
				'province_id' => $dataField['province'],
				'district_id' => $dataField['district'],
				'ward_id' => $dataField['ward'],
				'fee_value' => $dataField['fee_ship']
			];

			$this->deliveryModel->insertDelivery($data);
		}

		public function select_shipfee()
		{
			$feeship = $this->deliveryModel->viewDelivery();
			$output = '';
			$i = 0;
			foreach ($feeship as $key => $value) {
				$i++;
				$province = $this->provinceModel->find($value['province_id']);
				$district = $this->districtModel->find($value['district_id']);
				$ward = $this->wardModel->find($value['ward_id']);
				$output .= '<tr>
                    <td data-label="STT">'
                    	. $i .
                    '</td>
                    <td data-label="Tỉnh/Thành phố">'
                        . $province['_name'] .
                    '</td>
                    <td data-label="Quận/Huyện">'
                        . $district['_prefix'] . ' ' . $district['_name'] .
                    '</td>
                    <td data-label="Xã/Phường/Thị trấn">'
                    	. $ward['_prefix'] . ' ' .$ward['_name'] .
                    '</td>
                    <td contenteditable class = "fee_value" data-feeship_id = "'. $value['fee_id'] .'">'
                    	. $value['fee_value'] .
                    '</td>
                    <td data-label="Xóa" class="right__iconTable">
                        <a href="'._WEB_ROOT.'/delete-brand/deleteid-'. $value['fee_id'] .'"
                           onclick = "return confirm("Bạn có chắc chắn muốn xóa?")">
                            <img src="'._WEB_ROOT.'/public/backend/assets/icon-trash-black.svg" alt="">
                        </a>
                    </td>

                </tr>
				';
			}

			echo $output;
		}

		public function update_delivery()
		{
			$dataField = $this->request->getFields();
			$id = $dataField['feeship_id'];

			$data = [
				'fee_value' => $dataField['fee_value']
			];

			$this->deliveryModel->updateDelivery($data, $id);
		}
	}
	
 ?>