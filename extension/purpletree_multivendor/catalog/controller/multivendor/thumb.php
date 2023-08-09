<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Thumb extends \Opencart\System\Engine\Controller {
	public function index(array $data): string {
		$this->load->language('product/thumb');

		$data['cart'] = $this->url->link('common/cart|info', 'language=' . $this->config->get('config_language'));

		$data['add_to_cart'] = $this->url->link('checkout/cart|add', 'language=' . $this->config->get('config_language'));
		
		$template_product = $this->getTemplate($data['product_id']);
		if ($template_product == true) {
			$data['add_to_cart'] = $this->url->link('extension/purpletree_multivendor/multivendor/thumb|redirectProductPage', 'language=' . $this->config->get('config_language'));	
		}
		
		$data['add_to_wishlist'] = $this->url->link('account/wishlist|add', 'language=' . $this->config->get('config_language'));
		$data['add_to_compare'] = $this->url->link('product/compare|add', 'language=' . $this->config->get('config_language'));

		$data['review_status'] = (int)$this->config->get('config_review_status');
		$data['show_seller_name'] = $this->config->get('module_purpletree_multivendor_show_seller_name');
		$data['show_seller_address'] = $this->config->get('module_purpletree_multivendor_show_seller_address');

		return $this->load->view('extension/purpletree_multivendor/multivendor/thumb', $data);
	}
	
	public function redirectProductPage() {
		$json['redirect'] = $this->url->link('product/product', 'language=' . $this->config->get('config_language') . '&product_id=' . $this->request->post['product_id'], true);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
		public function getTemplate($product_id) {
		$query = $this->db->query("SELECT pvt.id FROM ". DB_PREFIX . "purpletree_vendor_template pvt WHERE pvt.product_id ='". (int)$product_id ."'");
		if($query->num_rows) {			
			return true;
		} else {
			return false;
		}
		
	}
}
