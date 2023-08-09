<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Events\Customer;
class Customer extends \Opencart\System\Engine\Controller {
	public function customer_form(&$route, &$data, &$output): void {
		$find = array();
		$replace = array();
		$data['become_seller'] = '';
		$data['seller_storename'] = '';	
		$customer_id = $data['customer_id'];
		/** get seller store information **/
			$this->load->language('extension/purpletree_multivendor/customer/ptscustomer');
			$this->load->model('extension/purpletree_multivendor/multivendor/stores');
			
			$data['text_seller'] = $this->language->get('text_seller');
			$data['text_store_name'] = $this->language->get('text_store_name');
			$seller_info = $this->model_extension_purpletree_multivendor_multivendor_stores->getStoreDetail($customer_id);
			
		/***  get become seller status and seller store name **/
		if (isset($this->request->post['become_seller'])) {
			$data['become_seller'] = $this->request->post['become_seller'];
		} elseif (!empty($seller_info)) {
			$data['become_seller'] = 1;
		} else {
			$data['become_seller'] = '';
		}
 		
		$data['become_seller_base'] = '';
		if (!empty($seller_info)) {
			$data['become_seller_base'] = $seller_info['store_status'];
		}
		if (isset($this->request->post['seller_storename'])) {
			$data['seller_storename'] = $this->request->post['seller_storename'];
		} elseif (!empty($seller_info)) {
			$data['seller_storename'] = $seller_info['store_name'];
		} else {
			$data['seller_storename'] = '';
		}

		$find = '<div class="form-text">'.$data['help_safe'].'</div>';
		
		$replace = $this->load->view('extension/purpletree_multivendor/customer/customer_form', $data);

		$output = str_replace($find,$replace,$output);
	}
	
	public function addCustomer(&$route, &$data, &$output): void {
	/** add seller **/
			$store_name 	= '';
			$customer_id 	= $output;
			$become_seller 	= $data[0]['become_seller'];
			$storename		= $data[0]['seller_storename'];
		    if(isset($become_seller)){			
			if($become_seller==1){			
			     $livecheck = 1;
		     // if (!$this->customer->validateSeller($livecheck)) {
		      if (!1) {
				$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
				$this->session->data['error_warning'] = $this->language->get('error_license');
				$this->response->redirect($this->url->link('customer/customer', 'user_token=' . $this->session->data['user_token'] . $url, true));
			     }
				 if(isset($storename)){
			     $store_name = trim($storename);
				}	$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
							$file ='';
							$this->model_extension_purpletree_multivendor_multivendor_vendor->addSeller($customer_id,$store_name, $become_seller,$file);
				
			 }
			}
	}
	public function editCustomer(&$route, &$data): void {
		/** edit seller **/
		$store_name 	= '';
		$customer_id 	= $data[0];
		$become_seller 	= $data[1]['become_seller'];
		$storename		= $data[1]['seller_storename'];
		if(isset($become_seller)){	
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			if($become_seller==1){			
				$livecheck = 1;
				//
				//if (!validateSeller($livecheck)) {
				if (!1) {
					$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
					$this->session->data['error_warning'] = $this->language->get('error_license');
					$this->response->redirect($this->url->link('customer/customer', 'user_token=' . $this->session->data['user_token'] . $url, true));
			    }
				if(isset($storename)){
					$store_name = trim($storename);
				}
				$file ='';
				$this->model_extension_purpletree_multivendor_multivendor_vendor->editSeller($customer_id,$store_name, $become_seller,$file);
			} else {
				if(isset($storename)){
				    $store_name = trim($storename);
				}
				$file ='';
				$this->model_extension_purpletree_multivendor_multivendor_vendor->editSeller($customer_id,$store_name, $become_seller,$file);
			}
		}
	}
	
	public function validateForm(&$route, &$data): void {
		echo "Hi";
		die;	
	}
	public function saveCustomer(&$route, &$data): void {
		/* echo "<pre>";
		var_dump($route);
		echo "<br>";
		var_dump($data);
		echo "<br>";
		var_dump($output);
		echo "<br>";
		die;	 */
	}
}
