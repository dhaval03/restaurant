<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Module;
class Thumb extends \Opencart\System\Engine\Controller {
public function beforeThumbView(&$route, &$data) {
	if($this->config->get('module_purpletree_multivendor_status')){
		$template_product = $this->getTemplate($data['product_id']);
		if ($template_product == true) {
			$data['add_to_cart'] = $this->url->link('extension/purpletree_multivendor/multivendor/thumb|redirectProductPage', 'language=' . $this->config->get('config_language'));		
		}
	}
}
public function getTemplate($product_id) {
		$query = $this->db->query("SELECT pvt.id FROM ". DB_PREFIX . "purpletree_vendor_template pvt WHERE pvt.product_id ='". (int)$product_id ."'");
		if($query->num_rows) {			
			return true;
		} else {
			return false;
		}
		
	}
public function afterThumbView(&$route, &$data, &$output) {
if($this->config->get('module_purpletree_multivendor_status')){
$this->load->model('extension/purpletree_multivendor/multivendor/sellerproduct');
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
            $data['text_seller_label'] =$this->language->get('text_seller_label');
			$data['button_deliver'] =$this->language->get('button_deliver');
             $data['show_seller_name'] = $this->config->get('module_purpletree_multivendor_show_seller_name');
             $data['show_seller_address'] = $this->config->get('module_purpletree_multivendor_show_seller_address');
			 $data['multivendor_status'] = $this->config->get('module_purpletree_multivendor_status');
			 $this->load->model('extension/purpletree_multivendor/multivendor/vendor');
					$seller_detail = array();
					$data['pts_quick_status'] = '';
					$seller_detail = $this->model_extension_purpletree_multivendor_multivendor_sellerproduct->getSellername($data['product_id']);
					$data['pts_quick_status'] = $this->model_extension_purpletree_multivendor_multivendor_sellerproduct->getQucikOrderStatus($data['product_id']);
					$seller_detailss = array();
					if($seller_detail){
				      $seller_detailss = $this->model_extension_purpletree_multivendor_multivendor_vendor->getStoreDetail($seller_detail['seller_id']);
					}
					if(!empty($seller_detailss)){
					   $cuntry_name = $this->model_extension_purpletree_multivendor_multivendor_vendor->getStoreDetail($seller_detail['seller_id']);
					   $cuntry_name = $this->model_extension_purpletree_multivendor_multivendor_vendor->getCountryName($seller_detailss['store_country']);
					   $state_name = $this->model_extension_purpletree_multivendor_multivendor_vendor->getStateName($seller_detailss['store_state'],$seller_detailss['store_country']);
					   $data['store_address'] = $seller_detailss['store_address'].','.$seller_detailss['store_city'].','.$state_name.','.$cuntry_name;
					   $data['seller_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|storeview', 'seller_store_id=' . $seller_detailss['id'].'&language=' . $this->config->get('config_language'));
					   $data['google_map'] = $seller_detailss['google_map_link'];
					 $data['seller_name'] = isset($seller_detail['seller_name'])?$seller_detail['seller_name']:'';
					 $data['quick_order'] = $this->url->link('extension/purpletree_multivendor/multivendor/quick_order', '&product_id='.$data['product_id'].'&language=' . $this->config->get('config_language'), true);
					}else{
						$data['quick_order'] ='';
						$data['seller_name'] ='';
						$data['seller_link'] ='';
						$data['store_address'] = '';
						$data['google_map'] = '';
					}			
			
$find = '<p>'. $data['description'] .'</p>';			 
$replace = '<p>'.$data['description'].'</p>';	
if($data['multivendor_status']){
	if($data['show_seller_name']){
		if($data['seller_name']){
			$replace .= '<p><a href="'. $data['seller_link'].'">'.$data['text_seller_label'].' '. $data['seller_name'] .'</a></p>';
		}
	}
	if($data['show_seller_address']){
		if($data['store_address']){
			if($data['google_map']){	
					$replace .= '<a href="'.$data['google_map'] .'"><p><i class ="fa fa-map-marker" style = "color: #6aa5d1;"></i>&nbsp'.$data['store_address'] .'</p></a>';
				} else {
					$replace .= '<p><i class ="fa fa-map-marker" style = "color: #6aa5d1;"></i>&nbsp'. $data['store_address'] .'</p>';
			}
		}
	}
}
if(!empty($seller_detail['seller_id'])){
	$find1 = '<input type="hidden" name="product_id" value="'.$data['product_id'].'"/>';
	$replace1 = '<input type="hidden" name="product_id" value="'.$data['product_id'].'"/>
	<input type="hidden" name="seller_id" value="'.$seller_detail['seller_id'].'"/>
	';	
}

$output = $this->load->controller('extension/purpletree_multivendor/multivendor/events/stringreplace',$find,$replace,$output);	
if(!empty($seller_detail['seller_id'])){
	$output = $this->load->controller('extension/purpletree_multivendor/multivendor/events/stringreplace',$find1,$replace1,$output);	
}
}
return $output;
	}
}
?>