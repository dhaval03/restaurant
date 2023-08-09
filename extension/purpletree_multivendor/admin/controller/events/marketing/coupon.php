<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Events\Marketing;
class Coupon extends \Opencart\System\Engine\Controller {
	
	public function getCouponListViewAfter(&$route, &$data, &$output) {
		$this->load->model('extension/purpletree_multivendor/multivendor/stores');
		
		$coupons =  $data['coupons'];
		$data['coupons'] = array();
		if(!empty($coupons)){
			foreach($coupons as $key=>$coupon){
				$seller_id = $this->model_extension_purpletree_multivendor_multivendor_stores->getSellerIdByCouponId($coupon['coupon_id']);
				$store_detail = $this->model_extension_purpletree_multivendor_multivendor_stores->getStoreDetail($seller_id);
				$store_name= isset($store_detail['store_name'])?$store_detail['store_name']:'';
				if($seller_id == -1){
						$store_name = $this->language->get('text_all');
					}
				
				$coupon['seller_id'] = $seller_id?$seller_id:'';
				$coupon['store_name'] = $store_name;
				$data['coupons'][]= $coupon;
			}
		}
		
		$find = '<td class="text-start"><a href="'. $data['sort_name'] .'"';

		$replace = '<td class="text-start"><a href="'. $data['sort_name'] .'"';
		if($data['sort'] == 'name'){
		$replace .= 'class="'. strtolower($data['order']) .'"';
		}
		$replace .= '> Store Name</a></td>';
		$replace .= '<td class="text-start"><a href="'. $data['sort_name'] .'"';

		$output = str_replace($find,$replace,$output);
		
		if(!empty($data['coupons'])){
		foreach($data['coupons'] as $coupon){
		$find1 = '<td class="text-start">'. $coupon['name'] .'</td>';
		$replace1 = '<td class="text-start">'. $coupon['store_name'] .'</td>';
		$replace1 .= '<td class="text-start">'. $coupon['name'] .'</td>';
		$output = str_replace($find1,$replace1,$output);
		}
		}
	
	
	
	return $output;
	}
	public function getCouponFormViewAfter(&$route, &$data, &$output) {
		$this->load->language('extension/purpletree_multivendor/multivendor/shipping');
			$this->load->language('extension/purpletree_multivendor/multivendor/stores');
			$this->load->language('marketing/coupon');
			$filter_data1 = array();			
			$text_n_a = $this->language->get('text_n_a');
			$text_all = $this->language->get('text_all');
			$data['entry_store_name'] = 'Store Name';
			///Help code///	
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-coupons";
			$data['helplink'] = "https://cutt.ly/gCpfBqI";
			if (defined ('DISABLED_PTS_HELP')){if(DISABLED_PTS_HELP == 0){$data['helpcheck'] = 1;}else{$data['helpcheck'] = 0;}}else{$data['helpcheck'] = 1;}
				$data['helpimage'] = HTTP_SERVER . 'view/image/help.png';
			/// End Help code///
			$data['seller_stores'] = array();
			$seller_store1[] = array(
			'vendor_id'       => -1,
			'name'              => $text_all,
			);
			$seller_store2[] = array(
			'vendor_id'       => 0,
			'name'              => $text_n_a
			);
			$data['seller_stores'] = array_merge($seller_store1,$seller_store2);
			$this->load->model('extension/purpletree_multivendor/multivendor/shipping');
			$results_seller_store = $this->model_extension_purpletree_multivendor_multivendor_shipping->getSellers($filter_data1);
			foreach ($results_seller_store as $result_seller_store) {
				$data['seller_stores'][] = array(
				'vendor_id'       => $result_seller_store['seller_id'],
				'name'              => strip_tags(html_entity_decode($result_seller_store['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		$this->load->model('extension/purpletree_multivendor/multivendor/stores');
		$seller_id = $this->model_extension_purpletree_multivendor_multivendor_stores->getSellerIdByCouponId($data['coupon_id']); 
		if (isset($this->request->post['seller_id'])) {
			$data['seller_id'] = $this->request->post['seller_id'];
		} elseif (!empty($seller_id)) {
			$data['seller_id'] = $seller_id;
			if($data['seller_id'] == -1){
						$data['seller_name'] =$text_all;
					}
		} else {
			$data['seller_id'] = '';
		}

		$find = '<div id="tab-general" class="tab-pane active">';
		
		$replace = '<div class="row mb-3">
                <label for="input-name" class="col-sm-2 col-form-label">'. $data['entry_store_name'] .'</label>
                <div class="col-sm-10">
				<select name="seller_id" id="input-filter_name" class="form-select">';
		foreach($data['seller_stores'] as $seller_store){
			if($seller_store['vendor_id'] == $data['seller_id']){
				$replace .= '<option value="'. $seller_store['vendor_id'] .'" selected="selected">'. $seller_store['name'] .'</option>';
			} else {
				$replace .= '<option value="'. $seller_store['vendor_id'] .'">'. $seller_store['name'] .'</option>';	
			}

		}			
		$replace .= '</select>
                  <div id="error-name" class="invalid-feedback"></div>
                </div>
              </div>';
		$replace .= '<div id="tab-general" class="tab-pane active">';
		
		$output = str_replace($find,$replace,$output);

	}
	
	public function addCouponAfter(&$route, &$coupon_data, &$coupon_id) {
		$data = $coupon_data[0];
		if($this->config->get('module_purpletree_multivendor_status')) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_coupons SET coupon_id = '" . $coupon_id . "', seller_id = '".$data['seller_id']."'");
		}	
	}
	
	public function editCouponAfter(&$route, &$data, &$output) {
		$coupon_id = $data[0];
		$seller_id = $data[1]['seller_id'];

		$query = $this->db->query("SELECT coupon_id FROM " . DB_PREFIX . "purpletree_vendor_coupons  WHERE  coupon_id = " . (int)$coupon_id . "");
		if($query->num_rows > 0){
			$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_coupons SET seller_id = '" . (int)$seller_id . "' WHERE coupon_id = '" . (int)$coupon_id . "'");	
		} else { 
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_coupons SET seller_id = '" . (int)$seller_id . "' , coupon_id = '" . (int)$coupon_id . "'");
		}	
	}
}
?>