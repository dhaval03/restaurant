<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Checkout;
class Paymentmethod extends \Opencart\System\Engine\Controller {
		public function paymentIndexBefore(&$route, &$data) {
			if($this->config->get('module_purpletree_multivendor_status')){
			$this->session->data['config_stock_checkout_payment_m_1'] = $this->config->get('config_stock_checkout');
			$this->config->set('config_stock_checkout',1);
		}
		}
		public function paymentIndexAfter(&$route, &$data, &$output) {
		if($this->config->get('module_purpletree_multivendor_status')){
			$this->config->set('config_stock_checkout',$this->session->data['config_stock_checkout_payment_m_1']);
		$this->load->language('checkout/payment_method');

		$data['language'] = $this->config->get('config_language');

		$status = true;

		// Validate cart has products and has stock.
		$hasStock = $this->load->controller('extension/purpletree_multivendor/multivendor/events/checkout/cart|hasStock');
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$hasStock && !$this->config->get('config_stock_checkout'))) {
			$status = false;
		}

		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			if (!$product['minimum']) {
				$status = false;

				break;
			}
		}

		if (!isset($this->session->data['customer'])) {
			$status = false;
		}

		if ($this->config->get('config_checkout_address') && !isset($this->session->data['payment_address'])) {
			$status = false;
		}

		// Validate Shipping
		if ($this->cart->hasShipping()) {
			// Validate shipping address
			if (!isset($this->session->data['shipping_address'])) {
				$status = false;
			}

			// Validate shipping method
			if (isset($this->session->data['shipping_method']) && isset($this->session->data['shipping_methods'])) {
				$shipping = explode('.', $this->session->data['shipping_method']);

				if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
					$status = false;
				}
			} else {
				$status = false;
			}
		}

		$data['payment_methods'] = [];

		if ($status) {
			if (isset($this->session->data['payment_methods'])) {
				$data['payment_methods'] = $this->session->data['payment_methods'];
			} else {
				if (isset($this->session->data['payment_address'])) {
					$payment_address = $this->session->data['payment_address'];
				} else {
					$payment_address = [
						'address_id'     => 0,
						'firstname'      => '',
						'lastname'       => '',
						'company'        => '',
						'address_1'      => '',
						'address_2'      => '',
						'city'           => '',
						'postcode'       => '',
						'zone_id'        => 0,
						'zone'           => '',
						'zone_code'      => '',
						'country_id'     => 0,
						'country'        => '',
						'iso_code_2'     => '',
						'iso_code_3'     => '',
						'address_format' => '',
						'custom_field'   => []
					];
				}

				$this->load->model('checkout/payment_method');

				$data['payment_methods'] = $this->model_checkout_payment_method->getMethods($payment_address);

				$this->session->data['payment_methods'] = $data['payment_methods'];
			}
		} else {
			// Remove any payment methods that does not meet checkout validation requirements
			unset($this->session->data['payment_methods']);
		}

		if (isset($this->session->data['payment_method'])) {
			$data['code'] = $this->session->data['payment_method'];
		} else {
			$data['code'] = '';
		}

		if (isset($this->session->data['comment'])) {
			$data['comment'] = $this->session->data['comment'];
		} else {
			$data['comment'] = '';
		}

		$this->load->model('catalog/information');

		$information_info = $this->model_catalog_information->getInformation($this->config->get('config_checkout_id'));

		if ($information_info) {
			$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information|info', 'language=' . $this->config->get('config_language') . '&information_id=' . $this->config->get('config_checkout_id')), $information_info['title']);
		} else {
			$data['text_agree'] = '';
		}

		if (isset($this->session->data['agree'])) {
			$data['agree'] = $this->session->data['agree'];
		} else {
			$data['agree'] = '';
		}

		$output = $this->load->view('checkout/payment_method', $data);
		}	
		return $output;
	}
	
	public function getMethodsBefore(&$route, &$data) {
	if($this->config->get('module_purpletree_multivendor_status')){
			$this->session->data['config_stock_checkout_payment_m_2'] = $this->config->get('config_stock_checkout');
			$this->config->set('config_stock_checkout',1);
		}	
	}
	public function getMethodsAfter(&$route, &$data, &$output) {
		if($this->config->get('module_purpletree_multivendor_status')){
			$this->config->set('config_stock_checkout',$this->session->data['config_stock_checkout_payment_m_2']);
			
				$this->load->language('checkout/payment_method');

		$json = [];

		$status = true;

		// Validate cart has products and has stock.
		$hasStock = $this->load->controller('extension/purpletree_multivendor/multivendor/events/checkout/cart|hasStock');
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$hasStock && !$this->config->get('config_stock_checkout'))) {
			$status = false;
		}

		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			if (!$product['minimum']) {
				$json['redirect'] = $this->url->link('checkout/cart', 'language=' . $this->config->get('config_language'), true);

				break;
			}
		}

		// Validate if customer session data is set
		if (!isset($this->session->data['customer'])) {
			$status = false;
		}

		if ($this->config->get('config_checkout_address') && !isset($this->session->data['payment_address'])) {
			$status = false;
		}

		// Validate shipping
		if ($this->cart->hasShipping()) {
			// Validate shipping address
			if (!isset($this->session->data['shipping_address'])) {
				$status = false;
			}

			// Validate shipping method
			if (isset($this->session->data['shipping_method']) && isset($this->session->data['shipping_methods'])) {
				$shipping = explode('.', $this->session->data['shipping_method']);

				if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
					$status = false;
				}
			} else {
				$status = false;
			}
		}

		if ($status) {
			if (isset($this->session->data['payment_address'])) {
				$payment_address = $this->session->data['payment_address'];
			} else {
				$payment_address = [
					'address_id'     => 0,
					'firstname'      => '',
					'lastname'       => '',
					'company'        => '',
					'address_1'      => '',
					'address_2'      => '',
					'city'           => '',
					'postcode'       => '',
					'zone_id'        => 0,
					'zone'           => '',
					'zone_code'      => '',
					'country_id'     => 0,
					'country'        => '',
					'iso_code_2'     => '',
					'iso_code_3'     => '',
					'address_format' => '',
					'custom_field'   => []
				];
			}

			// Payment Methods
			$this->load->model('checkout/payment_method');

			$payment_methods = $this->model_checkout_payment_method->getMethods($payment_address);

			if ($payment_methods) {
				// Store payment methods in session
				$this->session->data['payment_methods'] = $payment_methods;

				$json['payment_methods'] = $payment_methods;
			} else {
				$json['error'] = sprintf($this->language->get('error_no_payment'), $this->url->link('information/contact', 'language=' . $this->config->get('config_language')));
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));

		}	
	}
	
	public function saveBefore(&$route, &$data) {
	if($this->config->get('module_purpletree_multivendor_status')){
			$this->session->data['config_stock_checkout_payment_m_3'] = $this->config->get('config_stock_checkout');
			$this->config->set('config_stock_checkout',1);
		}	
	}
	public function saveAfter(&$route, &$data, &$output) {
		if($this->config->get('module_purpletree_multivendor_status')){
			$this->config->set('config_stock_checkout',$this->session->data['config_stock_checkout_payment_m_3']);
			
			$this->load->language('checkout/payment_method');

		$json = [];

		// Validate cart has products and has stock.
		$hasStock = $this->load->controller('extension/purpletree_multivendor/multivendor/events/checkout/cart|hasStock');
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$hasStock && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart', 'language=' . $this->config->get('config_language'), true);
		}

		// Validate minimum quantity requirements.
		$products = $this->cart->getProducts();

		foreach ($products as $product) {
			if (!$product['minimum']) {
				$json['redirect'] = $this->url->link('checkout/cart', 'language=' . $this->config->get('config_language'), true);

				break;
			}
		}

		// Validate if payment address is set if required in settings
		if ($this->config->get('config_checkout_address') && !isset($this->session->data['payment_address'])) {
			$json['redirect'] = $this->url->link('checkout/cart', 'language=' . $this->config->get('config_language'), true);
		}

		// Validate shipping
		if ($this->cart->hasShipping()) {
			// Validate shipping address
			if (!isset($this->session->data['shipping_address'])) {
				$json['redirect'] = $this->url->link('checkout/cart', 'language=' . $this->config->get('config_language'), true);
			}

			// Validate shipping method
			if (isset($this->session->data['shipping_method']) && isset($this->session->data['shipping_methods'])) {
				$shipping = explode('.', $this->session->data['shipping_method']);

				if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
					$json['redirect'] = $this->url->link('checkout/cart', 'language=' . $this->config->get('config_language'), true);
				}
			} else {
				$json['redirect'] = $this->url->link('checkout/cart', 'language=' . $this->config->get('config_language'), true);
			}
		}

		if (!$json) {
			// Validate payment method
			if (!isset($this->request->post['payment_method']) || !isset($this->session->data['payment_methods']) || !isset($this->session->data['payment_methods'][$this->request->post['payment_method']])) {
				$json['error'] = $this->language->get('error_payment_method');
			}
		}

		if (!$json) {
			$this->session->data['payment_method'] = $this->request->post['payment_method'];

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));

		}	
	}
}?>