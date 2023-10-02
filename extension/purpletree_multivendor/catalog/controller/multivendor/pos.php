<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Pos extends \Opencart\System\Engine\Controller {
		private $error = array();
		public function index() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/pos');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/pos');
			
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home','language=' . $this->config->get('config_language'),true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/pos','&language=' . $this->config->get('config_language'), true)
			);
			
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			$data['vendor_categories'] = $this->model_extension_purpletree_multivendor_multivendor_vendor->getAssingedCategories();
			
			$this->load->model('catalog/product');
			$data['products'] = $this->model_catalog_product->getProducts();
			$data['image1'] = HTTP_SERVER.'extension/purpletree_multivendor/image/table_logo.jpg';
			$data['image2'] = HTTP_SERVER.'extension/purpletree_multivendor/image/profile.png';
			
			$data['column_left'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/column_left');
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/pos', $data));
		}
		public function getCart(){
				$this->load->language('extension/purpletree_multivendor/multivendor/pos');
			
			$this->load->language('common/cart');

			$totals = [];
			$taxes = $this->cart->getTaxes();
			$total = 0;

			$this->load->model('checkout/cart');

			if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				($this->model_checkout_cart->getTotals)($totals, $taxes, $total);
			}

			$data['text_items'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total, $this->session->data['currency']));

			// Products
			$data['products'] = [];

			$products = $this->model_checkout_cart->getProducts();
			
			foreach ($products as $product) {
				// Display prices
				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$unit_price = (float)$this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax'));

					$price = $this->currency->format($unit_price, $this->session->data['currency']);
					$total = $this->currency->format($unit_price * $product['quantity'], $this->session->data['currency']);
				} else {
					$price = false;
					$total = false;
				}

				$description = '';

				if ($product['subscription']) {
					if ($product['subscription']['trial_status']) {
						$trial_price = $this->currency->format($this->tax->calculate($product['subscription']['trial_price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						$trial_cycle = $product['subscription']['trial_cycle'];
						$trial_frequency = $this->language->get('text_' . $product['subscription']['trial_frequency']);
						$trial_duration = $product['subscription']['trial_duration'];

						$description .= sprintf($this->language->get('text_subscription_trial'), $trial_price, $trial_cycle, $trial_frequency, $trial_duration);
					}

					if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product['subscription']['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					}

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
					'price'        => $price,
					'total'        => $total,
					'reward'       => $product['reward'],
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

			// Totals
			$data['totals'] = [];

			foreach ($totals as $total) {
				$data['totals'][] = [
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'], $this->session->data['currency'])
				];
			}

			$data['list'] = $this->url->link('common/cart.info', 'language=' . $this->config->get('config_language'));
			$data['product_remove'] = $this->url->link('common/cart.removeProduct', 'language=' . $this->config->get('config_language'));
			$data['voucher_remove'] = $this->url->link('common/cart.removeVoucher', 'language=' . $this->config->get('config_language'));

			$data['cart'] = $this->url->link('checkout/cart', 'language=' . $this->config->get('config_language'));
			$data['checkout'] = $this->url->link('checkout/checkout', 'language=' . $this->config->get('config_language'));

			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/getcart', $data));
		}
		public function getProductSearch(){
			$json = [];
			if(isset($this->request->post['product_id']) && $this->request->post['product_id'] > 0){
				$this->load->model('extension/purpletree_multivendor/multivendor/pos');
				$results = $this->model_extension_purpletree_multivendor_multivendor_pos->getPos($this->request->post['product_id']);
				foreach ($results as $result) {
					if (!empty($result['image'])) {
						//$thumb = str_replace('\\', '/', realpath(DIR_IMAGE.$result['image']));
						$thumb = HTTP_SERVER.'image/'.$result['image'];
					} else {
						$thumb = DIR_IMAGE.'no_image.png';
					}
					$json['rt_products'][] = array(
						'product_id' => $result['product_id'],
						'name'       => strip_tags(html_entity_decode($result['model']." - ".$result['name'], ENT_QUOTES, 'UTF-8')),
						'thumb'=>$thumb	
					);
				}				
				$json['success'] = true;
			}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
		public function getCategorieProducts(){
			$json = [];
			if(isset($this->request->post['category_id']) && $this->request->post['category_id'] > 0){
				$this->load->model('extension/purpletree_multivendor/multivendor/pos');
				$this->load->model('catalog/product');
				$this->load->model('tool/image');
				$filter = '';
				if(isset($this->request->post['product']) && $this->request->post['product'] != ''){
					$filter = $this->request->post['product'];
				}
				$filter_data = array(
					'filter_category_id'=>$this->request->post['category_id'],
					'filter_name'=>$filter,
				);
				$results = $this->model_catalog_product->getProducts($filter_data);
				foreach ($results as $result) {
					if (!empty($result['image'])) {
						//$thumb = str_replace('\\', '/', realpath(DIR_IMAGE.$result['image']));
						$thumb = HTTP_SERVER.'image/'.$result['image'];
					} else {
						$thumb = DIR_IMAGE.'no_image.png';
					}
					$options = array();
					$product_options = $this->model_catalog_product->getOptions($result['product_id']);

					foreach ($product_options as $option) {
						
							$product_option_value_data = [];

							foreach ($option['product_option_value'] as $option_value) {
								if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
									if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
										$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
									} else {
										$price = false;
									}

									if (is_file(DIR_IMAGE . html_entity_decode($option_value['image'], ENT_QUOTES, 'UTF-8'))) {
										$image = $this->model_tool_image->resize(html_entity_decode($option_value['image'], ENT_QUOTES, 'UTF-8'), 50, 50);
									} else {
										$image = '';
									}

									$product_option_value_data[] = [
										'product_option_value_id' => $option_value['product_option_value_id'],
										'option_value_id'         => $option_value['option_value_id'],
										'name'                    => $option_value['name'],
										'image'                   => $image,
										'price'                   => $price,
										'price_prefix'            => $option_value['price_prefix']
									];
								}
							}

							$options[] = [
								'product_option_id'    => $option['product_option_id'],
								'product_option_value' => $product_option_value_data,
								'option_id'            => $option['option_id'],
								'name'                 => $option['name'],
								'type'                 => $option['type'],
								'value'                => $option['value'],
								'required'             => $option['required']
							];
						
					}
					$json['rt_products'][] = array(
						'product_id' => $result['product_id'],
						'options' => $options,
						'name'       => strip_tags(html_entity_decode($result['model']." - ".$result['name'], ENT_QUOTES, 'UTF-8')),
						'thumb'=>$thumb	
					);
				}				
				$json['success'] = true;
			}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
		public function getProductOptions(){
			$this->load->model('catalog/product');
			$json = [];
			if(isset($this->request->post['product_id']) && $this->request->post['product_id'] > 0){
				$options = array();
				
				$product_options = $this->model_catalog_product->getOptions($this->request->post['product_id']);
				//print_r($product_options);exit;
				if(!empty($product_options)){
					foreach ($product_options as $product_option) {
						$product_option_value_data = [];

						foreach ($product_option['product_option_value'] as $product_option_value) {
							$option_value_info = $this->model_catalog_product->getValue($product_option_value['option_value_id']);

							if ($option_value_info) {
								$product_option_value_data[] = [
									'product_option_value_id' => $product_option_value['product_option_value_id'],
									'option_value_id'         => $product_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$product_option_value['price'] ? $product_option_value['price'] : false,
									'price_prefix'            => $product_option_value['price_prefix']
								];
							}
						}

						$option_info = $this->model_catalog_product->getOption($product_option['option_id']);

						$options[] = [
							'product_option_id'    => $product_option['product_option_id'],
							'product_option_value' => $product_option_value_data,
							'option_id'            => $product_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => isset($data['variant'][$product_option['product_option_id']]) ? $data['variant'][$product_option['product_option_id']] : $product_option['value'],
							'required'             => $product_option['required']
						];
					}
					$json['success'] = true;
					$json['product_options'] = $options;
				}else{
					$json['success'] = false;
					$json['product_options'] = $options;
				}
			}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
		
		
	}
?>