<?php
namespace Opencart\Catalog\Model\Extension\PurpletreeMultivendor\Payment;
class PpAdaptive extends \Opencart\System\Engine\Model {
private $data = array();
		public function authorizeAndCapture($post = array()) {
			if(!empty($post)){
				$access_token1 = $this->getAccestoken();
				$access_token  = $access_token1;
				if($access_token != '') {
					$ch1 		= curl_init();
					$datttt	 	= array( 
						"amount" => array(
						"currency" => $post['mc_currency'],
						"total" => $post['mc_gross']),
						"is_final_capture" => true 
					);
				$inputs = json_encode($datttt,true);
				if ($this->config->get('payment_pp_adaptive_debug')) {
							$this->log->write('Authorize Payments');
							$this->log->write('access_token');
							$this->log->write($access_token);
							$this->log->write($datttt);
						}
				$authorizeid = $post['txn_id'];
				if (!$this->config->get('payment_pp_adaptive_test')) {
					$curl1 = 'https://api.paypal.com/v1/payments/authorization/'.$authorizeid.'/capture';
				} else {
					$curl1 = 'https://api.sandbox.paypal.com/v1/payments/authorization/'.$authorizeid.'/capture';
				}
				curl_setopt($ch1, CURLOPT_URL, $curl1);
				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch1, CURLOPT_POST, 1);
				curl_setopt($ch1, CURLOPT_POSTFIELDS,$inputs);

				$headers = array();
				$headers[] = 'Content-Type: application/json';
				$headers[] = 'Authorization: Bearer '.$access_token;
				curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);

				$result1 = curl_exec($ch1);
					if (curl_errno($ch1)) {
						echo 'Error:' . curl_error($ch1);
						if ($this->config->get('payment_pp_adaptive_debug')) {
							$this->log->write('Error on Payment Authorize POST: ' . curl_error($ch1));
						}
					curl_close($ch1);
					} else {
					$response1 = json_decode($result1, true);
					curl_close($ch1);
					if ($this->config->get('payment_pp_adaptive_debug')) {
						$this->log->write('Response from Payment Authorize POST: ' . $result1);
					}
					}
				}
		}
	   }
	   	public function getAccestoken() {
		 $tokenreturn = "";
		 $client_id   = $this->config->get('payment_pp_adaptive_client_id');
		 $secret      = $this->config->get('payment_pp_adaptive_admin_secret');
	 	if (!$this->config->get('payment_pp_adaptive_test')) {
				$curl = 'https://api.paypal.com/v1/oauth2/token';
			} else {
				$curl = 'https://api.sandbox.paypal.com/v1/oauth2/token';
			}
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $curl);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
				curl_setopt($ch, CURLOPT_USERPWD, $client_id . ':' . $secret);

				$headers = array();
				$headers[] = 'Accept: application/json';
				$headers[] = 'Accept-Language: en_US';
				$headers[] = 'Content-Type: application/x-www-form-urlencoded';
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 

				$result = curl_exec($ch);
				if (curl_errno($ch)) {
					if ($this->config->get('payment_pp_adaptive_debug')) {
						$this->log->write('Error on get Access Token: ' . curl_error($ch));
						//echo 'Error:' . curl_error($ch);
					}
				curl_close($ch);
				} else {
				$response = json_decode($result, true);
				curl_close($ch);
					if ($this->config->get('payment_pp_adaptive_debug')) {
						$this->log->write('Response with Access Token: ' . $result);
					}
					if(isset($response['access_token'])) {
						$tokenreturn = $response['access_token'];
					}
				}
				return $tokenreturn;
		}
		public function getMethod(array $address): array {
			$log = new \Opencart\System\Library\Log($this->config->get('error_filename'));
			$this->load->language('extension/purpletree_multivendor/payment/pp_adaptive');
			$cartData=array();
			$cartData= $this->getCartProducts();
			$code='pp_adaptive';
			if(!empty($cartData)){
				foreach($cartData as $k=>$v){
					$sellerPayplaEmail=$this->getSellerPayPalId($v['product_id'],$v['cart_id']);
					if(isset($sellerPayplaEmail) && $sellerPayplaEmail == ''){
						$log->write('seller Paypal Email is blank');
						$code='';
						break;
					}
				}
			}
			//echo $code;
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('payment_pp_adaptive_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
			$total = $this->cart->getTotal();
			if ($this->config->get('payment_pp_adaptive_total') > $total) {
				$status = false;
				} elseif (!$this->config->get('payment_pp_adaptive_geo_zone_id')) {
				$status = true;
				} elseif ($query->num_rows) {
				$status = true;
				} else {
				$status = false;
			}
			
			$currencies = array(
			'AUD',
			'CAD',
			'EUR',
			'GBP',
			'JPY',
			'USD',
			'NZD',
			'CHF',
			'HKD',
			'SGD',
			'SEK',
			'DKK',
			'PLN',
			'NOK',
			'HUF',
			'CZK',
			'ILS',
			'MXN',
			'MYR',
			'BRL',
			'PHP',
			'TWD',
			'THB',
			'TRY',
			'RUB',
			'INR'
			);
			
			if (!in_array(strtoupper($this->session->data['currency']), $currencies)) {
				$status = false;
			}
			
			$method_data = array();
			if ($status) {
			if($code != '') {
				$method_data = array(
				'code'       => $code,
				'title'      => $this->language->get('text_title'),
				'terms'      => '',
				'sort_order' => $this->config->get('payment_pp_adaptive_sort_order')
				);
			}
			}
			
			return $method_data;
		}
		public function getSellerDetail($seller_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_stores where seller_id = '".(int)$seller_id."'");
			if($query->num_rows>0){
				return $query->row;
				} else {
				return NULL;
			}		
		}
		public function getorderCurrency($order_id) {
			$query = $this->db->query("SELECT currency_code FROM " . DB_PREFIX . "order WHERE order_id = '" . (int)$order_id . "'");
			
			if($query->num_rows) {
				return $query->row['currency_code'];
			}
		}
		public function getOrderProducts($order_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
			
			return $query->rows;
		}
		public function savelinkid($total_price,$total_commission,$total_pay_amount){
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_commission_invoice SET total_amount='".(float)$total_price."',total_commission='".(float)$total_commission."', total_pay_amount='".(float)$total_pay_amount."', created_at ='".date('Y-m-d')."'");
			return $this->db->getLastId();
		}
		public function saveCommisionInvoice($data=array(),$link_id = NULL){
			$total_commission=0;
			$total_commission=(float)$data['commission_fixed']+(float)$data['commission_shipping']+(float)$data['commission'];
			$this->db->query( "INSERT INTO " . DB_PREFIX . "purpletree_vendor_commission_invoice_items SET order_id ='".(int)$data['order_id']."', product_id='".(int)$data['product_id']."', seller_id='".(int)$data['seller_id']."', commission_fixed='".(float)$data['commission_fixed']."', commission_percent='".(float)$data['commission_percent']."', commission_shipping='".(float)$data['commission_shipping']."', total_commission ='".(float)$total_commission."', link_id ='".(int)$link_id."'");
			$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_vendor_commissions` SET invoice_status=1 WHERE id='".(int)$data['id']."'"); 		
		} 
		
		
		public function totalPrice($seller_id,$order_id){
			
			$query= $this->db->query("SELECT SUM(total_price) AS total_price FROM " . DB_PREFIX . "purpletree_vendor_orders WHERE order_id='".(int)$order_id."' AND seller_id='".(int)$seller_id."'");
			if($query->num_rows>0){
				return $query->row;
				} else {
				return NULL;
			}
		}
		public function getSellerId($paypal_email){
			$query=$this->db->query("SELECT seller_id FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE seller_paypal_id='".$paypal_email."'");
			if($query->num_rows>0){
				return $query->row['seller_id'];
				} else {
				return NULL;
			} 	 
		} 	 
		
		public function saveTranDetail($data=array()){
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_payments SET invoice_id ='".(int)$data['invoice_id']."', seller_id='".(int)$data['seller_id']."', transaction_id='".$this->db->escape($data['transaction_id'])."', amount='".(float)$data['amount']."', payment_mode='".$this->db->escape($data['payment_mode'])."', status='".$this->db->escape($data['status'])."',created_at=NOW(),updated_at=NOW() ");
		} 
		public function saveTranHistory($data=array()){
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_payment_settlement_history SET invoice_id ='".(int)$data['invoice_id']."', transaction_id='".$this->db->escape($data['transaction_id'])."', comment='".$this->db->escape($data['comment'])."', payment_mode='".$this->db->escape($data['payment_mode'])."', status_id='".$this->db->escape($data['status_id'])."',created_date=NOW(),modified_date=NOW()");
		} 		
		
		public function getSellerPayPalId($product_id,$cart_id){
			//$query= $this->db->query("SELECT seller_paypal_id FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE seller_id IN (SELECT seller_id FROM " . DB_PREFIX . "purpletree_vendor_products WHERE product_id='".(int)$product_id."')");
			//
			$seller_id = $this->db->query("SELECT pvp.seller_id,pvs.seller_paypal_id FROM " . DB_PREFIX . "purpletree_vendor_products pvp JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON(pvs.seller_id=pvp.seller_id) JOIN " . DB_PREFIX . "product p ON(p.product_id=pvp.product_id) WHERE pvp.product_id='".(int)$product_id."' AND pvp.is_approved=1")->row;
					if($this->config->get('module_purpletree_multivendor_seller_product_template')){
					if(empty($seller_id['seller_id'])) {
						$sseller_id = $this->getvendorcart($cart_id);

						if(isset($sseller_id['seller_id'])){
						$seller_id = $this->db->query("SELECT pvs.seller_paypal_id FROM " . DB_PREFIX . "purpletree_vendor_template_products pvtp JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON(pvs.seller_id=pvtp.seller_id) JOIN " . DB_PREFIX . "purpletree_vendor_template pvt ON(pvt.id=pvtp.template_id) JOIN " . DB_PREFIX . "product p ON(p.product_id=pvt.product_id) WHERE pvt.product_id='".(int)$product_id."' AND pvs.seller_id='".$sseller_id['seller_id']."'")->row;
					}
					}
					}
			//
		/* 	echo "q<pre>";
			print_r($seller_id);
			echo "r</pre>"; */
			//die;
			if(!empty($seller_id['seller_id'])) {
				return $seller_id['seller_paypal_id'];
				}else {
				return NULL;
			}
		} 
	public function getSellerStoreName($seller_id){
			$query= $this->db->query("SELECT store_name FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE seller_id ='".(int)$seller_id."')");
			
			if($query->num_rows>0){
				return $query->row['store_name'];
				}else {
				return NULL;
			}
		} 
	public function totalCommission($seller_id,$order_id){
			$query= $this->db->query("SELECT SUM(commission) AS commission FROM " . DB_PREFIX . "purpletree_vendor_commissions WHERE order_id='".(int)$order_id."' AND seller_id='".(int)$seller_id."'");
			if($query->num_rows>0){
				return $query->row;
				} else {
				return NULL;
			}
		}
	
	
	public function getCommissionData($order_id){
			
			$query= $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_commissions WHERE order_id='".(int)$order_id."'");
			if($query->num_rows>0){
				return $query->rows;
				}else {
				return NULL;
			}
		}
	public function getPayout_batch_id($order_id){
		$query = $this->db->query("SELECT payment_key FROM " . DB_PREFIX . "purpletree_vendor_adaptive_paykey WHERE order_id = '" . (int)$order_id . "'");
			if($query->num_rows>0){
				return $query->row['payment_key'];
			}
		}	
	public function getvendorcart($cart_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_cart WHERE cart_id='".$cart_id."'");
		if($query->num_rows){
			return $query->row;
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

		return $this->data;
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
}
?>