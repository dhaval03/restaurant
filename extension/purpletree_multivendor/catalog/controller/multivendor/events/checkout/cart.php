<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Checkout;
class Cart extends \Opencart\System\Engine\Controller {
	private $db = array();
	private array $data = [];
	public function __construct($registry) {
		$this->db = $registry->get('db');
		parent::__construct($registry);
	}

	public function beforeCartView(&$route, &$data) {
		if($this->config->get('module_purpletree_multivendor_status')){
			if($route === 'checkout/cart'){
				$this->config->set('config_stock_checkout',$this->session->data['config_stock_checkout_cart']);
				
				$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
				$pts_products = $this->getCartProducts();
				foreach ($pts_products as $pts_product) {
					$product_total = 0;

					foreach ($pts_products as $pts_product_2) {
						if ($pts_product_2['product_id'] == $pts_product['product_id']) {
							$product_total += $pts_product_2['quantity'];
						}
					}
					if ($this->config->get('module_purpletree_multivendor_product_limit') < $product_total) {
						$data['error_warning'] = sprintf($this->language->get('error_maximum'), $pts_product['name'], $this->config->get('module_purpletree_multivendor_product_limit'));
					}
				}
			$hasStock = $this->load->controller('extension/purpletree_multivendor/multivendor/events/checkout/cart|hasStock');
			if (!$hasStock && (!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning'))) {
				$data['error_warning'] = $this->language->get('error_stock');
			} elseif (isset($this->session->data['error'])) {
				$data['error_warning'] = $this->session->data['error'];

				unset($this->session->data['error']);
			} else {
				$data['error_warning'] = '';
			}				
			}
		}
	}
	public function beforeCartAddController(&$route, &$data) {
		if($this->config->get('module_purpletree_multivendor_status')){
			if($route == 'checkout/cart|add'){
				if(isset($this->request->post['seller_id'])) {
					$seller_id = (int)$this->request->post['seller_id'];
				}
				if(isset($this->request->get['seller_id'])) {
					$seller_id = (int)$this->request->get['seller_id'];
				}
				if (isset($this->request->post['product_id'])) {
					$product_id = (int)$this->request->post['product_id'];
				} else {
					$product_id = 0;
				}
				$this->load->language('checkout/cart');
				if($this->config->get('module_purpletree_multivendor_seller_product_template')){
					$template_product = $this->getTemplate($product_id);
					if ($template_product == true) {
						if (!isset($seller_id)) {
							$json['error']['template'] = $this->language->get('error_recurring_required');
						}
					}
				}
			}
		}
	}
	public function afterCartAddController(&$route, &$data) {
		if($this->config->get('module_purpletree_multivendor_status')){
			if($route == 'checkout/cart|add' || $route == 'api/sale/cart|add'){
				
				$seller_id= '';
				$template_product_id = 0;
					if(isset($this->request->get['seller_id'])) {
						$seller_id = (int)$this->request->get['seller_id'];
					 }
					if(isset($this->request->get['template_product_id'])) {
						$template_product_id = (int)$this->request->get['template_product_id'];
					}
					if(isset($this->request->post['seller_id'])) {
						$seller_id = (int)$this->request->post['seller_id'];
					}
				if($route == 'api/sale/cart|add'){
					$seller_id = $this->getSellerIdByProductId($this->request->post['product_id']);
				}					
				if (isset($this->request->post['product_id'])) {
					$product_id = (int)$this->request->post['product_id'];
				} else {
					$product_id = 0;
				}

				if (isset($this->request->post['option'])) {
					$option = array_filter($this->request->post['option']);
				} else {
					$option = [];
				}
				
		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			// If variant get master product
			if ($product_info['master_id']) {
				$product_id = $product_info['master_id'];
			}

			// Merge variant code with options
			foreach ($product_info['variant'] as $key => $value) {
				$option[$key] = $value;
			}
		}
		
		$customer_id = 0;
		if($route == 'checkout/cart|add'){
			if($this->customer->getId()){
				$customer_id = $this->customer->getId();  
			}
		}

	/* 	if($route == 'api/sale/cart|add'){
			if(isset($this->session->data['customer'])){
				if(isset($this->session->data['customer']['customer_id'])){
				$customer_id = $this->session->data['customer']['customer_id'];  
				}
			}
		} */
				$cart_id = '';
				$query = $this->db->query("SELECT cart_id FROM " . DB_PREFIX . "cart WHERE api_id = '" . (isset($this->session->data['api_id']) ? (int)$this->session->data['api_id'] : 0) . "' AND customer_id = '" . (int)$customer_id . "' AND session_id = '" . $this->db->escape($this->session->getId()) . "' AND product_id = '" . (int)$product_id . "' AND `option` = '" . $this->db->escape(json_encode($option)) . "'");

				if($query->num_rows){
					$cart_id = $query->row['cart_id'];
				}

			if($template_product_id){
					if (isset($seller_id)) {
						if($seller_id && $cart_id && $template_product_id) {
							$this->addVendorproduct($cart_id, $seller_id, $template_product_id);
						}
					}
				} else {
					if (isset($seller_id)) {
						if($seller_id && $cart_id) {
							$this->addVendorproduct($cart_id, $seller_id);
						}
					}
				}
			}
		}
	}
	
	public function getCartSubTotal() {
			$total = 0;

		foreach ($this->getCartProducts() as $product) {
			$total += $product['total'];
		}

		return $total;
		
	}
	public function getSubTotal(&$route, &$data, &$output) {
			$this->load->language('extension/opencart/total/sub_total');

		$sub_total = $this->getCartSubTotal();

		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $voucher) {
				$sub_total += $voucher['amount'];
			}
		}
		
		if(!empty($data[0])){
			foreach($data[0] as $key => $pts_totals){
				if($pts_totals['code'] == 'sub_total'){
				$old_subtotal = $pts_totals['value'];	
				$data[0][$key]['value']= $sub_total;	
				}
			}
			
		}

		$data[2] += $sub_total;	
		$data[2] -= $old_subtotal;	
	}
	
	public function beforeCartController(&$route, &$data) {
		if($this->config->get('module_purpletree_multivendor_status')){
			$this->session->data['config_stock_checkout_cart'] = $this->config->get('config_stock_checkout');
			$this->config->set('config_stock_checkout',1);
		}
	}
	public function afterGetListController(&$route, &$data, &$output) {
		if($this->config->get('module_purpletree_multivendor_status')){
			$data['list'] = $this->url->link(' ', 'language=' . $this->config->get('config_language'));
		$data['product_edit'] = $this->url->link('checkout/cart|edit', 'language=' . $this->config->get('config_language'));
		$data['product_remove'] = $this->url->link('checkout/cart|remove', 'language=' . $this->config->get('config_language'));
		$data['voucher_remove'] = $this->url->link('checkout/voucher|remove', 'language=' . $this->config->get('config_language'));

		$this->load->model('tool/image');
		$this->load->model('tool/upload');

		$data['products'] = [];

		$this->load->model('checkout/cart');

		$products = $this->model_checkout_cart->getProducts();

		foreach ($products as $product) {
			if (!$product['minimum']) {
				$data['error_warning'] = sprintf($this->language->get('error_minimum'), $product['name'], $product['minimum']);
			}

			// Display prices
			if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				$unit_price = $this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));

				$price = $this->currency->format($unit_price, $this->session->data['currency']);
				$total = $this->currency->format($unit_price * $product['quantity'], $this->session->data['currency']);
			} else {
				$price = false;
				$total = false;
			}

			$description = '';

			if ($product['subscription']) {
				$trial_price = $this->currency->format($this->tax->calculate($product['subscription']['trial_price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				$trial_cycle = $product['subscription']['trial_cycle'];
				$trial_frequency = $this->language->get('text_' . $product['subscription']['trial_frequency']);
				$trial_duration = $product['subscription']['trial_duration'];

				if ($product['subscription']['trial_status']) {
					$description .= sprintf($this->language->get('text_subscription_trial'), $trial_price, $trial_cycle, $trial_frequency, $trial_duration);
				}

				$price = $this->currency->format($this->tax->calculate($product['subscription']['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				$cycle = $product['subscription']['cycle'];
				$frequency = $this->language->get('text_' . $product['subscription']['frequency']);
				$duration = $product['subscription']['duration'];

				if ($duration) {
					$description .= sprintf($this->language->get('text_subscription_duration'), $price, $cycle, $frequency, $duration);
				} else {
					$description .= sprintf($this->language->get('text_subscription_cancel'), $price, $cycle, $frequency);
				}
			}

			$data['products'][] = [
				'cart_id'      => $product['cart_id'],
				'thumb'        => $product['image'],
				'name'         => $product['name'],
				'model'        => $product['model'],
				'option'       => $product['option'],
				'subscription' => $description,
				'quantity'     => $product['quantity'],
				'stock'        => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
				'minimum'      => $product['minimum'],
				'reward'       => $product['reward'],
				'price'        => $price,
				'total'        => $total,
				'href'         => $this->url->link('product/product', 'language=' . $this->config->get('config_language') . '&product_id=' . $product['product_id'])
			];
		}

		// Gift Voucher
		$data['vouchers'] = [];

		$vouchers = $this->model_checkout_cart->getVouchers();

		foreach ($vouchers as $key => $voucher) {
			$data['vouchers'][] = [
				'key'         => $key,
				'description' => $voucher['description'],
				'amount'      => $this->currency->format($voucher['amount'], $this->session->data['currency'])
			];
		}

		$data['totals'] = [];

		$totals = [];
		$taxes = $this->getTaxes();
		$total = 0;

		// Display prices
		if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
			($this->model_checkout_cart->getTotals)($totals, $taxes, $total);

			foreach ($totals as $result) {
				$data['totals'][] = [
					'title' => $result['title'],
					'text'  => $this->currency->format($result['value'], $this->session->data['currency'])
				];
			}
		}

		$output = $this->load->view('checkout/cart_list', $data);
		}
		return $output;
	}
	public function getProducts(&$route, &$data, &$output) {
		$this->load->model('tool/image');
		$this->load->model('tool/upload');

		// Products
		$product_data = [];

		$products = $this->getCartProducts();

		foreach ($products as $product) {
			if ($product['image']) {
				$image = $this->model_tool_image->resize(html_entity_decode($product['image'], ENT_QUOTES, 'UTF-8'), $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			}

			$option_data = [];

			foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['value'];
				} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

					if ($upload_info) {
						$value = $upload_info['name'];
					} else {
						$value = '';
					}
				}

				$option_data[] = [
					'name'  => $option['name'],
					'value' => (strlen($value) > 20 ? substr($value, 0, 20) . '..' : $value),
					'type'  => $option['type']
				];
			}

			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$minimum = false;
			} else {
				$minimum = true;
			}

			$option_data = [];

			foreach ($product['option'] as $option) {
				$option_data[] = [
					'product_option_id'       => $option['product_option_id'],
					'product_option_value_id' => $option['product_option_value_id'],
					'option_id'               => $option['option_id'],
					'option_value_id'         => $option['option_value_id'],
					'name'                    => $option['name'],
					'value'                   => $option['value'],
					'type'                    => $option['type']
				];
			}
		/* 	$seller_id='';
			$template_product_id='';
			$seller_cart = $this->getvendorcart($product['cart_id']);
				$output[$key]['shipping_charge']=$this->getShippingCharge($product['product_id']);
				if(!empty($seller_cart)){
					$seller_id=$seller_cart['seller_id'];
					if($seller_cart['template_product_id']){
					$template_product_id=$seller_cart['template_product_id'];
					}
				} */

			$product_data[] = [
				'cart_id'      => $product['cart_id'],
				'product_id'   => $product['product_id'],
				'master_id'    => $product['master_id'],
				'image'        => $image,
				'name'         => $product['name'],
				'model'        => $product['model'],
				'option'       => $product['option'],
				'subscription' => $product['subscription'],
				'download'     => $product['download'],
				'quantity'     => $product['quantity'],
				'stock'        => $product['stock'],
				'minimum'      => $minimum,
				'shipping'     => $product['shipping'],
				'subtract'     => $product['subtract'],
				'reward'       => $product['reward'],
				'tax_class_id' => $product['tax_class_id'],
				'price'        => $product['price'],
				'total'        => $product['price'] * $product['quantity']
			];
		}
		$output = $product_data;
		if(!empty($output)){
			$products = $output;
			$seller_id = '';
			foreach($products as $key=>$product){
				$seller_cart = $this->getvendorcart($product['cart_id']);
				$output[$key]['shipping_charge']=$this->getShippingCharge($product['product_id']);
				if(!empty($seller_cart)){
					$output[$key]['seller_id']=$seller_cart['seller_id'];
					if($seller_cart['template_product_id']){
					$output[$key]['template_product_id']=$seller_cart['template_product_id'];
					}
				}
			}
		} 
		return $output;
	}
	public function beforeCartIndexController(&$route, &$data) {
			$this->sellerCart();
	}
	
	public function beforeCartRemoveController(&$route, &$data) {
	if (isset($this->request->post['key'])) {
			$key = (int)$this->request->post['key'];
		} else {
			$key = 0;
		}	
		$this->sellerCartRemove($key);		
	}
	
	private function sellerCart() {
		$query = $this->db->query("SELECT * FROM ". DB_PREFIX . "cart");
		if($query->num_rows){
			$query_vandor = $this->db->query("DELETE FROM ". DB_PREFIX . "purpletree_vendor_cart WHERE cart_id NOT IN(SELECT cart_id FROM ". DB_PREFIX . "cart)");
			
		} else {
			$query = $this->db->query("DELETE FROM ". DB_PREFIX . "purpletree_vendor_cart");
		}			
	}
	
	private function sellerCartRemove($cart_id) {
		$query = $this->db->query("DELETE FROM ". DB_PREFIX . "purpletree_vendor_cart WHERE cart_id ='". (int)$cart_id ."'");		
	}
	
	public function getTemplate($product_id) {
		$query = $this->db->query("SELECT pvt.id FROM ". DB_PREFIX . "purpletree_vendor_template pvt WHERE pvt.product_id ='". (int)$product_id ."'");
		if($query->num_rows) {			
			return true;
		} else {
			return false;
		}
		
	}
	public function addVendorproduct($cart_id, $seller_id, $template_product_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "purpletree_vendor_cart WHERE cart_id = '".(int)$cart_id."'");
		if (!$query->row['total']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_cart SET cart_id = '".(int)$cart_id."',seller_id = '".(int)$seller_id."',template_product_id = '".$template_product_id."'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_cart SET seller_id = '".(int)$seller_id."',template_product_id = '".$template_product_id."' WHERE cart_id = '".(int)$cart_id."'");
		}
    }
	public function getvendorcart($cart_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_cart WHERE cart_id='".$cart_id."'");
		if($query->num_rows){
			return $query->row;
		}
	}	
	public function getShippingCharge($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product WHERE product_id='".$product_id."'");
		if($query->num_rows){
			return $query->row['shipping_charge'];
		}
	}
	
		public function getSellerIdByProductId($product_id) {
			$query = $this->db->query("SELECT pvp.seller_id FROM `" . DB_PREFIX . "purpletree_vendor_products` pvp WHERE product_id='".$product_id."'");
			if($query->num_rows){
				return $query->row['seller_id'];
			}
				return null;
		}
	
		public function getTempateProductDetail($product_id,$seller_id) {
		$query = $this->db->query("SELECT pvtp.* FROM `" . DB_PREFIX . "purpletree_vendor_template` pvt LEFT JOIN `" . DB_PREFIX . "purpletree_vendor_template_products` pvtp ON (pvt.id = pvtp.template_id) WHERE product_id='".$product_id."' AND pvtp.seller_id='".$seller_id."'");
		if($query->num_rows){
			return $query->row;
		}
		return null;
	}
	public function checkid($product_id,$seller_id) {
		$sellerprice = $this->db->query("SELECT pvt.product_id FROM `" . DB_PREFIX . "purpletree_vendor_template_products` pvtp LEFT JOIN `" . DB_PREFIX . "purpletree_vendor_template` pvt ON (pvt.id = pvtp.template_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (pvt.product_id = p.product_id) LEFT JOIN `" . DB_PREFIX . "purpletree_vendor_stores` pvs ON (pvs.seller_id = pvtp.seller_id) WHERE pvt.product_id = '" . (int)$product_id . "' AND pvtp.seller_id='".$seller_id."'");	
		if ($sellerprice->num_rows > 0){
			return $sellerprice->num_rows;
		}
	}
		public function getSellerPrice($product_id,$seller_id) {
		$sellerprice = $this->db->query("SELECT pvtp.price AS seller_price FROM " . DB_PREFIX . "purpletree_vendor_template_products pvtp LEFT JOIN " . DB_PREFIX . "purpletree_vendor_template pvt ON (pvt.id = pvtp.template_id) LEFT JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON (pvs.seller_id = pvtp.seller_id) WHERE pvt.product_id = '" . (int)$product_id . "' AND pvtp.seller_id='".$seller_id."'");		
		if($sellerprice->num_rows){
			return $sellerprice->row['seller_price'];
		}
	}
	public function getCartProducts(): array {
		$this->data=[];
		if (!$this->data) {
			$cart_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "cart` WHERE `api_id` = '" . (isset($this->session->data['api_id']) ? (int)$this->session->data['api_id'] : 0) . "' AND `customer_id` = '" . (int)$this->customer->getId() . "' AND `session_id` = '" . $this->db->escape($this->session->getId()) . "'");

			foreach ($cart_query->rows as $cart) {
				$seller_id = '';
				$stock = true;

				$product_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_to_store` `p2s` LEFT JOIN `" . DB_PREFIX . "product` p ON (p2s.`product_id` = p.`product_id`) LEFT JOIN `" . DB_PREFIX . "product_description` pd ON (p.`product_id` = pd.`product_id`) WHERE p2s.`store_id` = '" . (int)$this->config->get('config_store_id') . "' AND p2s.`product_id` = '" . (int)$cart['product_id'] . "' AND pd.`language_id` = '" . (int)$this->config->get('config_language_id') . "' AND p.`date_available` <= NOW() AND p.`status` = '1'");

				if ($product_query->num_rows && ($cart['quantity'] > 0)) {
					$option_price = 0;
					$option_points = 0;
					$option_weight = 0;

					$option_data = [];

					$product_options = (array)json_decode($cart['option'], true);

					// Merge variant code with options
					$variant = json_decode($product_query->row['variant'], true);

					if ($variant) {
						foreach ($variant as $key => $value) {
							$product_options[$key] = $value;
						}
					}

					foreach ($product_options as $product_option_id => $value) {
						if (!$product_query->row['master_id']) {
							$product_id = $cart['product_id'];
						} else {
							$product_id = $product_query->row['master_id'];
						}

						$option_query = $this->db->query("SELECT po.`product_option_id`, po.`option_id`, od.`name`, o.`type` FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.`option_id` = o.`option_id`) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.`option_id` = od.`option_id`) WHERE po.`product_option_id` = '" . (int)$product_option_id . "' AND po.`product_id` = '" . (int)$product_id . "' AND od.`language_id` = '" . (int)$this->config->get('config_language_id') . "'");

						if ($option_query->num_rows) {
							if ($option_query->row['type'] == 'select' || $option_query->row['type'] == 'radio') {
		$seller_id = $this->getvendorcart($cart['cart_id']);
		$temp_product_option = $this->db->query("SELECT ptpov.*FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "purpletree_temp_product_option_value ptpov ON (pov.option_value_id = ptpov.option_value_id) LEFT JOIN " . DB_PREFIX . "purpletree_vendor_template_products pvtp ON (pvtp.id = ptpov.temp_product_id) WHERE ptpov.product_id='".(int)$cart['product_id']."' AND pov.product_option_id='".(int)$product_option_id."' AND pov.product_option_value_id='".(int)$value."' AND pvtp.seller_id='".(int)$seller_id."'");						
								
								
								$option_value_query = $this->db->query("SELECT pov.`option_value_id`, ovd.`name`, pov.`quantity`, pov.`subtract`, pov.`price`, pov.`price_prefix`, pov.`points`, pov.`points_prefix`, pov.`weight`, pov.`weight_prefix` FROM `" . DB_PREFIX . "product_option_value` pov LEFT JOIN `" . DB_PREFIX . "option_value` ov ON (pov.`option_value_id` = ov.`option_value_id`) LEFT JOIN `" . DB_PREFIX . "option_value_description` ovd ON (ov.`option_value_id` = ovd.`option_value_id`) WHERE pov.`product_option_value_id` = '" . (int)$value . "' AND pov.`product_option_id` = '" . (int)$product_option_id . "' AND ovd.`language_id` = '" . (int)$this->config->get('config_language_id') . "'");

								if ($option_value_query->num_rows) {
	if($temp_product_option->num_rows && $this->config->get('module_purpletree_multivendor_seller_product_template')){
				if ($temp_product_option->row['price_prefix'] == '+') {
					$option_price += $temp_product_option->row['price'];
				} elseif ($temp_product_option->row['price_prefix'] == '-') {
					$option_price -= $temp_product_option->row['price'];
				}					
				} else {								
									if ($option_value_query->row['price_prefix'] == '+') {
										$option_price += $option_value_query->row['price'];
									} elseif ($option_value_query->row['price_prefix'] == '-') {
										$option_price -= $option_value_query->row['price'];
									}
				}

									if ($option_value_query->row['points_prefix'] == '+') {
										$option_points += $option_value_query->row['points'];
									} elseif ($option_value_query->row['points_prefix'] == '-') {
										$option_points -= $option_value_query->row['points'];
									}

									if ($option_value_query->row['weight_prefix'] == '+') {
										$option_weight += $option_value_query->row['weight'];
									} elseif ($option_value_query->row['weight_prefix'] == '-') {
										$option_weight -= $option_value_query->row['weight'];
									}
if($temp_product_option->num_rows && $this->config->get('module_purpletree_multivendor_seller_product_template')){
								if ($temp_product_option->row['subtract'] && (!$temp_product_option->row['quantity'] || ($temp_product_option->row['quantity'] < $cart['quantity']))) {
								$stock = false;
								}	
								} else {
									if ($option_value_query->row['subtract'] && (!$option_value_query->row['quantity'] || ($option_value_query->row['quantity'] < $cart['quantity']))) {
										$stock = false;
									}
	}

									$option_data[] = [
										'product_option_id'       => $product_option_id,
										'product_option_value_id' => $value,
										'option_id'               => $option_query->row['option_id'],
										'option_value_id'         => $option_value_query->row['option_value_id'],
										'name'                    => $option_query->row['name'],
										'value'                   => $option_value_query->row['name'],
										'type'                    => $option_query->row['type'],
										'quantity'                => $option_value_query->row['quantity'],
										'subtract'                => $option_value_query->row['subtract'],
										'price'                   => $option_value_query->row['price'],
										'price_prefix'            => $option_value_query->row['price_prefix'],
										'points'                  => $option_value_query->row['points'],
										'points_prefix'           => $option_value_query->row['points_prefix'],
										'weight'                  => $option_value_query->row['weight'],
										'weight_prefix'           => $option_value_query->row['weight_prefix']
									];
								}
							} elseif ($option_query->row['type'] == 'checkbox' && is_array($value)) {
								foreach ($value as $product_option_value_id) {
									$option_value_query = $this->db->query("SELECT pov.`option_value_id`, pov.`quantity`, pov.`subtract`, pov.`price`, pov.`price_prefix`, pov.`points`, pov.`points_prefix`, pov.`weight`, pov.`weight_prefix`, ovd.`name` FROM `" . DB_PREFIX . "product_option_value` `pov` LEFT JOIN `" . DB_PREFIX . "option_value_description` ovd ON (pov.`option_value_id` = ovd.option_value_id) WHERE pov.product_option_value_id = '" . (int)$product_option_value_id . "' AND pov.product_option_id = '" . (int)$product_option_id . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

									if ($option_value_query->num_rows) {
										if ($option_value_query->row['price_prefix'] == '+') {
											$option_price += $option_value_query->row['price'];
										} elseif ($option_value_query->row['price_prefix'] == '-') {
											$option_price -= $option_value_query->row['price'];
										}

										if ($option_value_query->row['points_prefix'] == '+') {
											$option_points += $option_value_query->row['points'];
										} elseif ($option_value_query->row['points_prefix'] == '-') {
											$option_points -= $option_value_query->row['points'];
										}

										if ($option_value_query->row['weight_prefix'] == '+') {
											$option_weight += $option_value_query->row['weight'];
										} elseif ($option_value_query->row['weight_prefix'] == '-') {
											$option_weight -= $option_value_query->row['weight'];
										}

										if ($option_value_query->row['subtract'] && (!$option_value_query->row['quantity'] || ($option_value_query->row['quantity'] < $cart['quantity']))) {
											$stock = false;
										}

										$option_data[] = [
											'product_option_id'       => $product_option_id,
											'product_option_value_id' => $product_option_value_id,
											'option_id'               => $option_query->row['option_id'],
											'option_value_id'         => $option_value_query->row['option_value_id'],
											'name'                    => $option_query->row['name'],
											'value'                   => $option_value_query->row['name'],
											'type'                    => $option_query->row['type'],
											'quantity'                => $option_value_query->row['quantity'],
											'subtract'                => $option_value_query->row['subtract'],
											'price'                   => $option_value_query->row['price'],
											'price_prefix'            => $option_value_query->row['price_prefix'],
											'points'                  => $option_value_query->row['points'],
											'points_prefix'           => $option_value_query->row['points_prefix'],
											'weight'                  => $option_value_query->row['weight'],
											'weight_prefix'           => $option_value_query->row['weight_prefix']
										];
									}
								}
							} elseif ($option_query->row['type'] == 'text' || $option_query->row['type'] == 'textarea' || $option_query->row['type'] == 'file' || $option_query->row['type'] == 'date' || $option_query->row['type'] == 'datetime' || $option_query->row['type'] == 'time') {
								$option_data[] = [
									'product_option_id'       => $product_option_id,
									'product_option_value_id' => '',
									'option_id'               => $option_query->row['option_id'],
									'option_value_id'         => '',
									'name'                    => $option_query->row['name'],
									'value'                   => $value,
									'type'                    => $option_query->row['type'],
									'quantity'                => '',
									'subtract'                => '',
									'price'                   => '',
									'price_prefix'            => '',
									'points'                  => '',
									'points_prefix'           => '',
									'weight'                  => '',
									'weight_prefix'           => ''
								];
							}
						}
					}

					$price = $product_query->row['price'];

					// Product Discounts
					$discount_quantity = 0;

					foreach ($cart_query->rows as $cart_2) {
						if ($cart_2['product_id'] == $cart['product_id']) {
							$discount_quantity += $cart_2['quantity'];
						}
					}

					$product_discount_query = $this->db->query("SELECT `price` FROM `" . DB_PREFIX . "product_discount` WHERE `product_id` = '" . (int)$cart['product_id'] . "' AND `customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND `quantity` <= '" . (int)$discount_quantity . "' AND ((`date_start` = '0000-00-00' OR `date_start` < NOW()) AND (`date_end` = '0000-00-00' OR `date_end` > NOW())) ORDER BY `quantity` DESC, `priority` ASC, `price` ASC LIMIT 1");

					if ($product_discount_query->num_rows) {
						$price = $product_discount_query->row['price'];
					}

					// Product Specials
					$product_special_query = $this->db->query("SELECT `price` FROM `" . DB_PREFIX . "product_special` WHERE `product_id` = '" . (int)$cart['product_id'] . "' AND `customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((`date_start` = '0000-00-00' OR `date_start` < NOW()) AND (`date_end` = '0000-00-00' OR `date_end` > NOW())) ORDER BY `priority` ASC, `price` ASC LIMIT 1");

					if ($product_special_query->num_rows) {
						$price = $product_special_query->row['price'];
					}

					$product_total = 0;

					foreach ($cart_query->rows as $cart_2) {
						if ($cart_2['product_id'] == $cart['product_id']) {
							$product_total += $cart_2['quantity'];
						}
					}

					if ($product_query->row['minimum'] > $product_total) {
						$minimum = false;
					} else {
						$minimum = true;
					}

					// Reward Points
					$product_reward_query = $this->db->query("SELECT `points` FROM `" . DB_PREFIX . "product_reward` WHERE `product_id` = '" . (int)$cart['product_id'] . "' AND `customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "'");

					if ($product_reward_query->num_rows) {
						$reward = $product_reward_query->row['points'];
					} else {
						$reward = 0;
					}

					// Downloads
					$download_data = [];

					$download_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_to_download` p2d LEFT JOIN `" . DB_PREFIX . "download` d ON (p2d.`download_id` = d.`download_id`) LEFT JOIN `" . DB_PREFIX . "download_description` dd ON (d.`download_id` = dd.`download_id`) WHERE p2d.`product_id` = '" . (int)$cart['product_id'] . "' AND dd.`language_id` = '" . (int)$this->config->get('config_language_id') . "'");

					foreach ($download_query->rows as $download) {
						$download_data[] = [
							'download_id' => $download['download_id'],
							'name'        => $download['name'],
							'filename'    => $download['filename'],
							'mask'        => $download['mask']
						];
					}

					// Stock
					$sellertemplateproductdetail=array();
				$seller_detail = $this->getvendorcart($cart['cart_id']);
		if(!empty($seller_detail['seller_id'])){
				$seller_id =$seller_detail['seller_id'];
				if(!empty($seller_id)) {
					$sellertemplateproductdetail = $this->getTempateProductDetail($product_query->row['product_id'],$seller_id);
				}
			}
				if(!empty($sellertemplateproductdetail)) {
					if (!$sellertemplateproductdetail['quantity'] || ($sellertemplateproductdetail['quantity'] < $cart['quantity'])) {
					$stock = false;
				}
					} else {
					if (!$product_query->row['quantity'] || ($product_query->row['quantity'] < $cart['quantity'])) {
						$stock = false;
					}
					}

					$subscription_data = [];

					$subscription_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_subscription` ps LEFT JOIN `" . DB_PREFIX . "subscription_plan` sp ON (ps.`subscription_plan_id` = sp.`subscription_plan_id`) LEFT JOIN `" . DB_PREFIX . "subscription_plan_description` spd ON (sp.`subscription_plan_id` = spd.`subscription_plan_id`) WHERE ps.`product_id` = '" . (int)$cart['product_id'] . "' AND ps.`subscription_plan_id` = '" . (int)$cart['subscription_plan_id'] . "' AND ps.`customer_group_id` = '" . (int)$this->config->get('config_customer_group_id') . "' AND spd.`language_id` = '" . (int)$this->config->get('config_language_id') . "' AND sp.`status` = '1'");

					if ($subscription_query->num_rows) {
						$subscription_data = [
							'subscription_plan_id' => $subscription_query->row['subscription_plan_id'],
							'name'                 => $subscription_query->row['name'],
							'description'          => $subscription_query->row['description'],
							'trial_price'          => $subscription_query->row['trial_price'],
							'trial_frequency'      => $subscription_query->row['trial_frequency'],
							'trial_cycle'          => $subscription_query->row['trial_cycle'],
							'trial_duration'       => $subscription_query->row['trial_duration'],
							'trial_status'         => $subscription_query->row['trial_status'],
							'price'                => $subscription_query->row['price'],
							'frequency'            => $subscription_query->row['frequency'],
							'cycle'                => $subscription_query->row['cycle'],
							'duration'             => $subscription_query->row['duration'],
							'remaining'            => $subscription_query->row['duration']
						];
					}
						if($this->config->get('module_purpletree_multivendor_seller_product_template')){
			  $seller_detail = $this->getvendorcart($cart['cart_id']);
			  $sellertemplateproduct = array();
			  if(!empty($seller_detail['seller_id'])){
			  $seller_id = $seller_detail['seller_id'];
 				if(!empty($seller_id)) {
					$sellertemplateproduct = $this->checkid($product_query->row['product_id'],$seller_id);
				}
			}
				if(!empty($sellertemplateproduct)) {
						$sellerprices = $this->getSellerPrice($product_query->row['product_id'],$seller_id);
						if(!empty($sellerprices)) {
								$price           = $sellerprices;
						}
					}
				}		

					$this->data[] = [
						'cart_id'         => $cart['cart_id'],
						'seller_id' => $seller_id,
						'shipping_charge' => $product_query->row['shipping_charge'],
						'product_id'      => $product_query->row['product_id'],
						'master_id'       => $product_query->row['master_id'],
						'name'            => $product_query->row['name'],
						'model'           => $product_query->row['model'],
						'shipping'        => $product_query->row['shipping'],
						'image'           => $product_query->row['image'],
						'option'          => $option_data,
						'subscription'    => $subscription_data,
						'download'        => $download_data,
						'quantity'        => $cart['quantity'],
						'minimum'         => $minimum,
						'subtract'        => $product_query->row['subtract'],
						'stock'           => $stock,
						'price'           => ($price + $option_price),
						'total'           => ($price + $option_price) * $cart['quantity'],
						'reward'          => $reward * $cart['quantity'],
						'points'          => ($product_query->row['points'] ? ($product_query->row['points'] + $option_points) * $cart['quantity'] : 0),
						'tax_class_id'    => $product_query->row['tax_class_id'],
						'weight'          => ($product_query->row['weight'] + $option_weight) * $cart['quantity'],
						'weight_class_id' => $product_query->row['weight_class_id'],
						'length'          => $product_query->row['length'],
						'width'           => $product_query->row['width'],
						'height'          => $product_query->row['height'],
						'length_class_id' => $product_query->row['length_class_id']
					];
				} else {
					$this->remove($cart['cart_id']);
				}
			}
		}
// echo "<pre>";
// print_r($this->data);
// die;
		return $this->data;
	}
	public function getTaxes(): array {
		$tax_data = [];
		foreach ($this->getCartProducts() as $product) {
			if ($product['tax_class_id']) {
				$tax_rates = $this->tax->getRates($product['price'], $product['tax_class_id']);

				foreach ($tax_rates as $tax_rate) {
					if (!isset($tax_data[$tax_rate['tax_rate_id']])) {
						$tax_data[$tax_rate['tax_rate_id']] = ($tax_rate['amount'] * $product['quantity']);
					} else {
						$tax_data[$tax_rate['tax_rate_id']] += ($tax_rate['amount'] * $product['quantity']);
					}
				}
			}
		}

		return $tax_data;
	}
		public function hasStock(): bool {
		foreach ($this->getCartProducts() as $product) {
			if (!$product['stock']) {
				return false;
			}
		}

		return true;
	}
		public function getWeight(): float {
		$weight = 0;

		foreach ($this->getCartProducts() as $product) {
			if ($product['shipping']) {
				$weight += $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
			}
		}

		return $weight;
	}

}
?>