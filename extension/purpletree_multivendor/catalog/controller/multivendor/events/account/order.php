<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Account;
class Order extends \Opencart\System\Engine\Controller {
	public function getOrderInfo(&$route, &$data, &$output) {

			$this->load->model('account/order');
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			 $this->load->model('account/order');
$data['seller_histories'] = array();
		$order_info = $this->model_account_order->getOrder($data['order_id']); 
			
			$data['text_history_seller'] = $this->language->get('text_history_seller');
			$data['text_history_admin'] = $this->language->get('text_history_admin');

			$products = $this->model_account_order->getProducts($data['order_id']);

			foreach ($products as $product) {
				$orderd_pro_seller_id = "";
				$seller_datile = "";
                $orderd_pro_seller_id = $this->model_extension_purpletree_multivendor_multivendor_vendor->getOrderedProductsellerid($data['order_id'],$product['product_id']);
				////quick order ////
				$data['module_purpletree_multivendor_status'] = $this->config->get('module_purpletree_multivendor_status');
				$this->load->model('extension/purpletree_multivendor/multivendor/sellerorder');
			    $pts_order_info = $this->model_extension_purpletree_multivendor_multivendor_sellerorder->getOrder($data['order_id'],$orderd_pro_seller_id);
				//// end quick order ////
				$seller_datile = $this->model_extension_purpletree_multivendor_multivendor_vendor->getsellerInfofororder($orderd_pro_seller_id);
				if(empty($seller_datile)){
					$seller_datile['store_name'] = '';
					$seller_datile['store_id'] = '';
				}
				$delivery_address ='';
				$delivery_address_lat ='';
				$delivery_address_lon ='';
				if (defined('QUICK_ORDER') && QUICK_ORDER == 1 ){
			     $data['quick_order_check'] = QUICK_ORDER;
				}
				$deliveraddresslon='';
				$deliveraddresslat='';
				
				if (defined('QUICK_ORDER') && QUICK_ORDER == 1 ){
				$delivery_address1 = $this->model_extension_purpletree_multivendor_multivendor_sellerorder->getDeliveryAddress($product['product_id']);
				if(isset($delivery_address1['delivery_address'])) {
					$delivery_address = $delivery_address1['delivery_address'];
				}

				if(isset($delivery_address1['deliveraddresslon'])) {
					$deliveraddresslon = $delivery_address1['deliveraddresslon'];
				}
				if(isset($delivery_address1['deliveraddresslat'])) {
					$deliveraddresslat = $delivery_address1['deliveraddresslat'];
				}
				}
				$storesstatus[$orderd_pro_seller_id] = array(
				
				'seller_id'    => $orderd_pro_seller_id,	 'seller_store_name'    => $seller_datile['store_name'],
				 'admin_order_status_id'    => (!empty($pts_order_info['admin_order_status_id'])?$pts_order_info['admin_order_status_id']:''),
				'seller_order_status' => (!empty($seller_datile['store_name'])?$this->model_extension_purpletree_multivendor_multivendor_vendor->getLatestsellerstatus($data['order_id'], $orderd_pro_seller_id):'')
			);
			
			$data['products_data'][] = array(
			//purpletree
			'product_id'    	   => $product['product_id'],
			'name'    	  		   => $product['name'],
			'delivery_address'     => $delivery_address,
			'deliveraddresslon'    => $deliveraddresslon,
			'deliveraddresslat'    => $deliveraddresslat,
			'admin_order_status_id'    => (!empty($pts_order_info['admin_order_status_id'])?$pts_order_info['admin_order_status_id']:''),
                    'seller_store_name'    => $seller_datile['store_name'],
                    'seller_id'    => $orderd_pro_seller_id,
					'seller_store_id'    => $seller_datile['store_id'],
					'seller_order_status' => (!empty($seller_datile['store_name'])?$this->model_extension_purpletree_multivendor_multivendor_vendor->getLatestsellerstatus($this->request->get['order_id'], $orderd_pro_seller_id):''),
					);
			}

			$data['storesstatus'] = $storesstatus;
			$data['column_updated_by'] = "Updated By";
			$resultssellers = 
			$this->model_extension_purpletree_multivendor_multivendor_vendor->getSellerOrderHistories($data['order_id']);
			foreach ($resultssellers as $result1) {
			$data['seller_histories'][] = array(
					'date_added' => date($this->language->get('date_format_short'), strtotime($result1['created_at'])),
					'product_name' => $this->model_extension_purpletree_multivendor_multivendor_vendor->getSellerOrderProducts($result1['order_id'],$result1['seller_id']),
					'status'     => $result1['status'],
					'comment'    => $result1['notify'] ? nl2br($result1['comment']) : '',
					'updated_by' => $this->model_extension_purpletree_multivendor_multivendor_vendor->getStoreName($result1['seller_id'])
				);
			}

		$find='<div class="d-inline-block pt-2 pd-2 w-100">';
		$replace = '';
		if($data['module_purpletree_multivendor_status']){	
			if(!empty($data['seller_histories'])){	
				$replace .= '<h3>'. $data['text_history_seller'] .'</h3>';
				$replace .= '<div class="table-responsive">';
				$replace .= '<table class="table table-bordered table-hover">';
				$replace .= '<thead>';
				$replace .= '<tr>';
				$replace .= '<td class="text-left">'. $data['column_name'] .'</td>';
			
				$replace .= '<td class="text-left">'. $data['column_date_added'] .'</td>';
				$replace .= '<td class="text-left">'. $data['column_status'] .'</td>';
				$replace .= '<td class="text-left">'. $data['column_comment'] .'</td>';
				$replace .= '<td class="text-left">'. $data['column_updated_by'] .'</td>';
				$replace .= '</td>';
				$replace .= '</tr>';
				$replace .= '</thead>';
				$replace .= '<tbody>';
				if($data['seller_histories']){
					foreach($data['seller_histories'] as $history){
						$replace .= '<tr>';
						$replace .= '<td class="text-left">';
						$replace .= '<table>';
							foreach($history['product_name'] as $product){
								$replace .= '<tr>';
								$replace .= '<td class="purpleproductname">'. $product['product_name'] .'</td>';
								$replace .= '</tr>';
							}
						$replace .= '</table>';
						$replace .= '</td>';
						$replace .= '<td class="text-left">'. $history['date_added'] .'</td>';
						$replace .= '<td class="text-left">'. $history['status'] .'</td>';
						$replace .= '<td class="text-left">'. $history['comment'] .'</td>';
						$replace .= '<td class="text-left">'. $history['updated_by'] .'</td>';
						$replace .= '</tr>';
					}
				} else {
					$replace .= '<tr>';
					$replace .= '<td colspan="3" class="text-center">'. $text_no_results .'</td>';
					$replace .= '</tr>';
				}
				$replace .= '</tbody>';
				$replace .= '</table>';
				$replace .= '</div>';
			}
		}

		$replace .= '<div class="d-inline-block pt-2 pd-2 w-100">';
		$output = str_replace($find,$replace,$output);
		
		$find1		=	'<h3>'. $data['text_history'] .'</h3>';
		$replace1	=	'<h3>'. $data['text_history_admin'] .'</h3>';

		$output = str_replace($find1,$replace1,$output);
		
		$data['text_seller_label']=$this->language->get('text_seller_label');
		$data['text_seller_label_status']=$this->language->get('text_seller_label_status');
	if(!empty($data['products_data'])){	
		foreach($data['products_data'] as $product){
		$find2 = '<td class="text-start">'. $product['name'];
		$replace2 = '<td class="text-start">'. $product['name'];
		$replace2 .= '<br>';
		if($product['seller_store_name']){
		$replace2 .= '<small> '. $data['text_seller_label'] .' : <a target="_blank" href="index.php?route=extension/purpletree_multivendor/multivendor/sellerstore|storeview&seller_store_id='. $product['seller_store_id'] .'"> '. $product['seller_store_name'] .'</a> | '. $data['text_seller_label_status'];
		if($product['seller_order_status']['status']){
		$replace2 .= ' '.$product['seller_order_status']['status'];
		}
		$replace2 .='</small>';
		}
		$output = str_replace($find2,$replace2,$output);
		}
	}

		}
 public function changeStatus() {
			$this->load->language('extension/purpletree_multivendor/multivendor/sellerorder');
			
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			
			$json = array();
			
			/* if (!isset($this->session->data['api_id'])) {
				$json['error'] = $this->language->get('error_permission');
			} else { */
			// Add keys for missing post vars
			$keys = array(
			'order_status_id',
			'notify',
			'override',
			'comment'
			);
			
			foreach ($keys as $key) {
				if (!isset($this->request->post[$key])) {
					$this->request->post[$key] = '';
				}
			}
			
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerorder');
			
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
				} else {
				$order_id = 0;
			}
			if (isset($this->request->post['seller_id'])) {
				$seller_id = $this->request->post['seller_id'];
				} 
			$order_info = $this->model_extension_purpletree_multivendor_multivendor_sellerorder->getOrder($order_id,$seller_id);
			
			if ($order_info) {
				$this->model_extension_purpletree_multivendor_multivendor_sellerorder->addOrderHistory($order_id,$seller_id, $this->request->post['order_status_id'], $this->request->post['comment'], $this->request->post['notify'], $this->request->post['override']);
				
				$json['success'] = $this->language->get('text_success');
				} else {
				$json['error'] = $this->language->get('error_not_found');
			}
			//}
			
			if (isset($this->request->server['HTTP_ORIGIN'])) {
				$this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
				$this->response->addHeader('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				$this->response->addHeader('Access-Control-Max-Age: 1000');
				$this->response->addHeader('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
			}
			
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
}
?>