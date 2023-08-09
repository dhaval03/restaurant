<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Account;
class Returns extends \Opencart\System\Engine\Controller {
	public function addReturnAfter(&$route, &$return_data, &$last_return_id) {
	foreach($return_data as $data){	
		$query = $this->db->query("SELECT pvo.seller_id FROM `" . DB_PREFIX . "purpletree_vendor_orders` pvo WHERE pvo.order_id  = '" . (int)$data['order_id'] . "' AND pvo.product_id = '" .(int)$data['product_id'] . "'");
		
		if($query->num_rows > 0) {
		$data['seller_id'] = $query->row['seller_id'];
		
		if(isset($data['seller_id'])) {
			if(!empty($data['seller_id']) ||($data['seller_id'] != 0)){
			$this->db->query("INSERT INTO `" . DB_PREFIX . "purpletree_vendor_products_return` SET return_id = '" . (int)$last_return_id . "',order_id = '" . (int)$data['order_id'] . "',product_id  = '" . (int)$data['product_id'] . "',seller_id  = '" . (int)$data['seller_id'] . "',status   = 0, created_date = NOW(), modified_date = NOW()");	
			}
		}
		}
	}
	}
 
}
?>