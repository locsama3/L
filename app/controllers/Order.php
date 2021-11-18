<?php 
	class Order extends BaseController
	{
	    public $orderModel, $couponModel, $productModel, $statisticalModel;
	    public $request, $response;

		public function __construct()
		{
			$this->orderModel = $this->loadModel('OrderModel');
			$this->couponModel = $this->loadModel('CouponModel');
			$this->productModel = $this->loadModel('ProductModel');
			$this->statisticalModel = $this->loadModel('StatisticalModel');
	    	$this->request = new Request();
	    	$this->response = new Response();
		}

		public function save_order()
		{
			if(!empty($_SESSION['cart'])){
				$dataOrder = $this->request->getFields();
				$sub_total = 0;
				$total = 0;
				$orderCode = substr(md5(microtime()), rand(0,26), 5);

				foreach ($_SESSION['cart'] as $key => $value) {
					$sub_total += $value['total'];	
				}

				$total = $sub_total;

				$coupon = $this->couponModel->check_coupon($dataOrder['order_coupon']);
				if(!empty($coupon)){
					$coupon_value = $coupon['value'];
					$coupon_type = $coupon['type'];
					if($coupon_type == 0){
						$total = $total - ($total * $coupon_value/100);
					}elseif($coupon_type == 1){
						$total = $total - $coupon_value;
					}
				}

				$total += $dataOrder['order_fee_ship'];

				$data = [
					'order_code' => $orderCode,
					'cus_id' => $dataOrder['cus_id'],
					'name' => $dataOrder['order_name'],
					'address' => $dataOrder['order_address'],
					'phone' => $dataOrder['order_phone'],
					'order_note' => $dataOrder['order_note'],
					'subtotal' => $sub_total,
					'coupon' => $dataOrder['order_coupon'],
					'ship_fee' => $dataOrder['order_fee_ship'],
					'total' => $total,
					'payment_id' => $dataOrder['payment_select'],
					'create_at' => date('Y-m-d h:i:s')
				];

				$result_id = $this->orderModel->insertOrderGetId($data);

				Session::data('order_id', $result);

				Session::data('payment_id', $data['payment_id']);

				foreach ($_SESSION['cart'] as $key => $value) {
					
					$dataOrderDetail = [
						'order_id' => $result_id,
						'product_id' => $value['id'],
						'quantity' => $value['quantity'],
						'total' => $value['total'],
						'create_at' => date('Y-m-d h:i:s')
					];

					$this->orderModel->insertDetail($dataOrderDetail);
				}

				if(null !== Session::data('coupon')){
					Session::delete('coupon');
				}

				if(null !== Session::data('fee_ship')){
					Session::delete('fee_ship');
				}
				
				unset($_SESSION['cart']);

				return 'Yes';
			}else{
				return 'No';	
			}	
		}

		public function payment()
		{
			$payment = Session::data('payment_id');
			if ($payment == 1){
				return $this->response->redirect('ngan-hang');	
			}elseif ($payment == 2){
				return $this->response->redirect('checkout');
			}else{
				return $this->response->redirect('paypal');
			}
		}

		public function update_product_qty()
		{
			$dataField = $_POST;
			// lấy dữ liệu từ ajax
			$order_product_id = $dataField['order_product_id'];

			$order_product_qty = $dataField['order_product_qty'];
 			// trạng thái mới
			$order_status = [
				'status' => $dataField['order_status']
			];
			$order_id = $dataField['order_id'];

			// trạng thái cũ
			$late_order = $this->orderModel->find($order_id);

			// update trạng thái mới
			$this->orderModel->updateOverview($order_status, $order_id);

			// Nếu trạng thái mới là: Hủy - và - trạng thái cũ là: Đang giao thì mới cộng lại hàng đã chuyển vào số lượng của sản phẩm
			if($dataField['order_status'] == 4 && $late_order['status'] == 2){
				foreach ($order_product_id as $key1 => $prod_id) {
					$product_order = $this->productModel->find($prod_id);
					foreach ($order_product_qty as $key2 => $qty) {
						if($key1 == $key2){
							$prod_remain = ($product_order['product_quantity'] + $qty);// số lượng tồn
							$prod_sold = $product_order['product_sold'] - $qty;// số lượng bán được

							$update_qty = [
								'product_quantity' => $prod_remain,
								'product_sold' => $prod_sold
							];

							$sql = "UPDATE tbl_products SET product_quantity='$prod_remain', product_sold = '$prod_sold' WHERE id = '$prod_id'";
 
						    // Prepare statement
						    $stmt = $this->db->query($sql);
						}
					}
				}
			}

			// Nếu trạng thái mới là: Đang giao - và - trạng thái cũ là: Đang xử lý thì mới trừ đi số hàng
			if($dataField['order_status'] == 2 && $late_order['status'] == 1){
				foreach ($order_product_id as $key1 => $prod_id) {
					$product_order = $this->productModel->find($prod_id);
					foreach ($order_product_qty as $key2 => $qty) {
						if($key1 == $key2){
							$prod_remain = $product_order['product_quantity'] - $qty;
							
							$update_qty = [
								'product_quantity' => $prod_remain,
							];

							$sql = "UPDATE tbl_products SET product_quantity='$prod_remain' WHERE id = '$prod_id'";
 
						    $stmt = $this->db->query($sql);
						}
					}
				}
			}

			// Nếu trạng thái mới là: Đã hoàn thành
			if($dataField['order_status'] == 3){
				$create_at = $late_order['create_at'];
				$convert = date_create($create_at);
				$order_date = date_format($convert,'Y-m-d');

				$statistic = $this->statisticalModel->get_statistic_by_date($order_date);

				if($statistic){
					$statistic_count = count($statistic);	
				}else{
					$statistic_count = 0;
				}

				//them
				$total_order = 0;
				$sales = 0;
				$profit = 0;
				$quantity = 0;

				foreach ($order_product_id as $key1 => $prod_id) {
					$product_order = $this->productModel->find($prod_id);
					foreach ($order_product_qty as $key2 => $qty) {
						if($key1 == $key2){
							$prod_price = $product_order['regular_price'];
							$prod_sold = $product_order['product_sold'] + $qty;
							
							$now = date('Y-m-d');

							$sql = "UPDATE tbl_products SET product_sold='$prod_sold' WHERE id = '$prod_id'";
 
						    $stmt = $this->db->query($sql);

						    // update doanh thu
						    $quantity += $qty;
							$sales += $prod_price * $qty;
							$profit = $sales - ($prod_price/2*$qty);
						}
					}
				}

				//update doanh so db
				if($statistic_count > 0){
					$statistic_update = $this->statisticalModel->first_statistic_by_date($order_date);
					$update_data = [
						'sales' => $statistic_update['sales'] + $sales,
						'profit' => $statistic_update['profit'] + $profit,
						'quantity' => $statistic_update['quantity'] + $quantity,
						'total_order' => $statistic_update['total_order'] + 1
					];
					
					$this->statisticalModel->updateByDate($update_data, $order_date);
				}else{
					$insert_data = [
						'order_date' => $order_date,
						'sales' => $sales,
						'profit' => $profit,
						'quantity' => $quantity,
						'total_order' => 1
					];
					
					$this->statisticalModel->insertStatistical($insert_data);
				}
			}
		}

		public function update_qty_order()
		{
			$dataField = $this->request->getFields();
			$prod_id = $dataField['prod_id'];
			$order_id = $dataField['order_id'];

			// lấy ra tổng tiền cũ của sản phẩm chi tiết
			$late_total = $this->orderModel->getTotalDetail($prod_id, $order_id);

			//lấy giá tiền sản phẩm
			$product = $this->productModel->find($prod_id);

			//tổng tiền mới của chi tiết sản phẩm
			$total_detail = $product['regular_price'] * $dataField['prod_qty'];

			// cập nhật số lượng và tổng tiền của chi tiết sản phẩm
			$dataDetail = [
				'quantity' => $dataField['prod_qty'],
				'total' => $total_detail
			];

			$this->orderModel->updateQtyDetail($dataDetail, $prod_id, $order_id);

			// lấy ra total của order
			$order = $this->orderModel->find($order_id);
			$order_subtotal = $order['subtotal'] - $late_total['total'] + $total_detail;

			$total = $order_subtotal;

			$coupon = $this->couponModel->check_coupon($order['coupon']);
			if(!empty($coupon)){
				$coupon_value = $coupon['value'];
				$coupon_type = $coupon['type'];
				if($coupon_type == 0){
					$total = $total - ($total * $coupon_value/100);
				}elseif($coupon_type == 1){
					$total = $total - $coupon_value;
				}
			}

			$total += $order['ship_fee'];

			// cập nhật tổng tiền của hóa đơn
			$dataOrderOverView = [
				'subtotal' => $order_subtotal,
				'total' => $total,
				'update_at' => date('Y-m-d h:i:s')
			];

			$update_at = date('Y-m-d h:i:s'); 

			$sql = "UPDATE tbl_oder_overview 
					SET subtotal = '$order_subtotal',
						total = '$total',
						update_at = '$update_at'
					WHERE id = '$order_id'";
 
		    $stmt = $this->db->query($sql);
		}

		// admin
		public function AuthLogin()
		{
			$check = Session::data('admin_id');
	    	if(empty($check)){
	    		return $this->response->redirect('admin');
	    	}
		}

		public function manage_order()
		{
			$this->AuthLogin();
			$this->data['sub_content']['list_order'] = $this->orderModel->viewOrder();
			$this->data['content'] = 'admins.manager_order';	
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function view_order($id)
		{
			$this->AuthLogin();

			$order_by_id = $this->orderModel->order_byId($id);

			$coupon = $this->couponModel->check_coupon($order_by_id['coupon']);

			if(!empty($coupon)){
				$coupon_value = $coupon['value'];
				$coupon_type = $coupon['type'];
				$this->data['sub_content']['coupon_and_ship'] = [
					'coupon' => $order_by_id['coupon'],
					'coupon_value' => $coupon_value,
					'coupon_type' => $coupon_type,
					'fee_ship' => $order_by_id['ship_fee']
				];	
			}else{
				$this->data['sub_content']['coupon_and_ship'] = [
					'coupon' => $order_by_id['coupon'],
					'coupon_value' => 'Không',
					'coupon_type' => '',
					'fee_ship' => $order_by_id['ship_fee']
				];
			}

			$this->data['sub_content']['order_byId'] = $order_by_id;
			$this->data['sub_content']['list_prod_order'] = $this->orderModel->product_order($id);
			$this->data['content'] = 'admins.view_order';	
			return $this->view('layouts.admin_layout', $this->data);
		}

		public function delete_order($id)
		{
			
		}

		public function print_order($order_id)
		{	
			$this->AuthLogin();
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Huynh Tan Loc');
			$pdf->SetTitle('In đơn hàng');
			$pdf->SetSubject('Đơn hàng công ty Vitamin');
			$pdf->SetKeywords('order, vitamin, whey');

			// remove default header/footer
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			    require_once(dirname(__FILE__).'/lang/eng.php');
			    $pdf->setLanguageArray($l);
			}

			// ---------------------------------------------------------
			// Xử lý dữ liệu in ra PDF

			$order_by_id = $this->orderModel->order_byId($order_id);

			$list_prod_order = $this->orderModel->product_order($order_id);

			$coupon = $this->couponModel->check_coupon($order_by_id['coupon']);

			$coupon_and_ship = [];

			if(!empty($coupon)){
				$coupon_value = $coupon['value'];
				$coupon_type = $coupon['type'];
				$coupon_and_ship = [
					'coupon' => $order_by_id['coupon'],
					'coupon_value' => $coupon_value,
					'coupon_type' => $coupon_type,
					'fee_ship' => $order_by_id['ship_fee']
				];	
			}else{
				$coupon_and_ship = [
					'coupon' => $order_by_id['coupon'],
					'coupon_value' => 'Không',
					'coupon_type' => '',
					'fee_ship' => $order_by_id['ship_fee']
				];
			}

			$type_coupon = '';
            if(!empty($coupon_and_ship['coupon_type'])){
            	if($coupon_and_ship['coupon_type'] == 1){
                    $type_coupon = 'đ';
                }else{
                    $type_coupon = '%';
                }
            }

			$output = '
				<style>  
					table td, table th{
						vertical-align: middle;
					}
				</style>
			';

			$output .= '
				<h1 align="center">Công ty TNHH Thể Hình Vitamin</h1> </br>
				<h2 align="center">Đơn hàng số '. $order_by_id['order_code'] .'</h2> </br>
				<h3 align="center">Thông tin khách hàng</h3>
                <div class="right__tableWrapper">
                    <table border="1" cellspacing="3" cellpadding="4">
                        <thead>
                            <tr>
                                <th>Tên khách hàng</th>
                                <th>Email khách hàng</th>
                                <th>Số điện thoại</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>'. $order_by_id['fullname'] .'</td>
                                <td>'. $order_by_id['email'] .'</td>
                                <td>'. $order_by_id['cus_phone'] .'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 align="center">Thông tin vận chuyển</h3>
                <div class="right__tableWrapper">
                    <table border="1" cellspacing="3" cellpadding="4" align = "center">
                        <thead>
                            <tr>
                                <th>Tên người nhận</th>
                                <th colspan = "2">Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>'. $order_by_id['name'] .'</td>
                                <td colspan = "2">'. $order_by_id['address'] .'</td>
                                <td>'. $order_by_id['phone'] .'</td>
                                <td>'. $order_by_id['order_note'] .'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 align="center">Chi tiết sản phẩm</h3>
                <div class="right__tableWrapper">
                    <table border="1" cellspacing="3" cellpadding="4" align = "center">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá sản phẩm</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>';

            $sub_total = 0;

            foreach ($list_prod_order as $key => $product) {
                $sub_total += $product['total'];            

	            $output .= '
	                <tr>
	                    <td>'. $product['name'] .'</td>
	                    <td>'. $product['quantity'] .'</td>
	                    <td>'. number_format($product['regular_price']) .' đ</td>
	                    <td>'. number_format($product['total']) .' đ</td>
	                </tr>
	            ';
	        }

	        $total = $sub_total;
	        if(!empty($coupon)){
				$coupon_value = $coupon['value'];
				$coupon_type = $coupon['type'];
				if($coupon_type == 0){
					$total = $total - ($total * $coupon_value/100);
				}elseif($coupon_type == 1){
					$total = $total - $coupon_value;
				}
			}

			$total += $coupon_and_ship['fee_ship'];
	        
            $output .= '
						</tbody>	
						<tfoot>
		                    <tr style="font-size: 16px; font-weight: bold;">
		                        <td colspan="3">Tổng cộng</td>
		                        <td>'. number_format($sub_total) .' đ</td>
		                    </tr>
		                </tfoot>
		            </table>
		        </div>

		        <h3 align="center">Mã giảm giá, Phí ship và Thành tiền</h3>
                <div class="right__tableWrapper">
                    <table border="1" cellspacing="3" cellpadding="4" align = "center">
                        <thead>
                            <tr>
                                <th>Mã giảm giá</th>
                                <th>Giá trị mã giảm giá</th>
                                <th>Phí ship</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr>
                                <td>'. $coupon_and_ship['coupon'] .'</td>
                                <td>'. $coupon_and_ship['coupon_value'] . $type_coupon .'</td>
                                <td>'. number_format($coupon_and_ship['fee_ship']) .' đ</td>
                            </tr>
                        </tbody>
                        <tfoot>
		                    <tr style="font-size: 16px; font-weight: bold;">
		                        <td colspan="2">Tổng cộng</td>
		                        <td>'. number_format($total) .' đ</td>
		                    </tr>
		                </tfoot>
                    </table>
                </div>

                <h3 align="center">Ký tên</h3>
                <div class="right__tableWrapper">
                    <table border="0" cellspacing="3" cellpadding="4" align = "center">
                        <thead>
                            <tr>
                                <th><b>Người lập phiếu</b></th>
                                <th><b>Người nhận</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr>
                               <td> </td> 
                               <td> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
			';
			// ---------------------------------------------------------
			// set font
			$pdf->SetFont('dejavusans', '', 10);

			// add a page
			$pdf->AddPage();

			// set some text to print
			$txt = <<<EOD
			TCPDF Example 002

			Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
			EOD;

			// print a block of text using Write()
			$pdf->writeHTML($output, true, false, true, false, '');

			// ---------------------------------------------------------

			//Close and output PDF document
			$pdf->Output('example_002.pdf', 'I');

			//============================================================+
			// END OF FILE
			//============================================================+
		}

	}
 ?>