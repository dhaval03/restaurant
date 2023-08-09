<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Checkout;
class Checkout extends \Opencart\System\Engine\Controller {
	public function beforeCheckoutView(&$route, &$data) {
		if($this->config->get('module_purpletree_multivendor_status')){
			if($route === 'checkout/checkout'){
				$this->config->set('config_stock_checkout',$this->session->data['config_stock_checkout']);
				$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
				$pts_products = $this->load->controller('extension/purpletree_multivendor/multivendor/events/checkout/cart|getCartProducts');
				//$pts_products = $this->cart->getProducts();
				foreach ($pts_products as $pts_product) {
					$product_total = 0;

					foreach ($pts_products as $pts_product_2) {
						if ($pts_product_2['product_id'] == $pts_product['product_id']) {
							$product_total += $pts_product_2['quantity'];
						}
					}
					if ($this->config->get('module_purpletree_multivendor_product_limit') < $product_total) {
						$this->response->redirect($this->url->link('checkout/cart', 'language=' . $this->config->get('config_language'), true));
					break;
					}
				}
				$hasStock = $this->load->controller('extension/purpletree_multivendor/multivendor/events/checkout/cart|hasStock');
				if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$hasStock && !$this->config->get('config_stock_checkout'))) {
					$this->response->redirect($this->url->link('checkout/cart', 'language=' . $this->config->get('config_language')));
				}				
			}
		}
	}
	
	public function beforeCheckoutController(&$route, &$data) {
		if($this->config->get('module_purpletree_multivendor_status')){
			$this->session->data['config_stock_checkout'] = $this->config->get('config_stock_checkout');
			$this->config->set('config_stock_checkout',1);
		}
	}
}
?>