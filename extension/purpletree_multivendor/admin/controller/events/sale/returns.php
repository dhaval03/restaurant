<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Events\Sale;
class Returns extends \Opencart\System\Engine\Controller {
		public function addReturnAfter(&$route, &$return_data, &$return_id): void {
	if(!empty($return_data)){
		foreach($return_data as $data){
		if ($this->config->get('module_purpletree_multivendor_status')) {
		$query = $this->db->query("SELECT pvo.seller_id FROM `" . DB_PREFIX . "purpletree_vendor_orders` pvo WHERE pvo.order_id  = '" . (int)$data['order_id'] . "' AND pvo.product_id = '" .(int)$data['product_id'] . "'");
		
		if($query->num_rows > 0) {
		$data['seller_id'] = $query->row['seller_id'];
		
		if(isset($data['seller_id'])) {
			if(!empty($data['seller_id']) ||($data['seller_id'] != 0)){
			$this->db->query("INSERT INTO `" . DB_PREFIX . "purpletree_vendor_products_return` SET return_id = '" . (int)$return_id . "',order_id = '" . (int)$data['order_id'] . "',product_id  = '" . (int)$data['product_id'] . "',seller_id  = '" . (int)$data['seller_id'] . "',status   = 0, created_date = NOW(), modified_date = NOW()");	
			}
		}
		}
			  if($this->config->get('module_purpletree_multivendor_refund_status')== $data['return_action_id'] ){
			$proudct_return_statuss = '';
			$seller_id_returnn = '';
		     $query10 = $this->db->query("SELECT status FROM `" . DB_PREFIX . "purpletree_vendor_products_return` WHERE return_id = '" . (int)$return_id . "'");
				  if($query10->num_rows){
					$proudct_return_statuss = $query10->row['status'];
				  }
			
			$product_price = '';
			
			if(isset($proudct_return_statuss) && $proudct_return_statuss == 0){
			$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_vendor_products_return` SET status = 1, modified_date = NOW() WHERE return_id = '" . (int)$return_id . "'");
			
			 $query1 = $this->db->query("SELECT  seller_id FROM `" . DB_PREFIX . "purpletree_vendor_products_return` WHERE return_id = '" . (int)$return_id . "'");
			if($query1->num_rows) {
				$seller_id_returnn = $query1->row['seller_id'];
			} 
			
			if($seller_id_returnn != '') {
				// vendor_order_total
				$query3 = $this->db->query("SELECT total_price, unit_price, quantity FROM `" . DB_PREFIX . "purpletree_vendor_orders` WHERE order_id = '" . (int)$data['order_id'] . "' AND seller_id = '".(int)$seller_id_returnn."' AND product_id = '" . (int)$data['product_id'] . "'");
				if($query3->num_rows) {
				$product_price = -($query3->row['total_price']);
				$product_pricee = $query3->row['total_price'];
				$unit_product_price = $query3->row['unit_price'];
				$ruquantity = $query3->row['quantity'];
			    }
				$product_id = (int)$data['product_id'];
				$query2 = $this->db->query("SELECT order_total_id FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$data['order_id'] . "' AND seller_id = '".(int)$seller_id_returnn."' AND code ='refunded_".$product_id."' ");
					
				if($query2->num_rows){
					$order_total = $query2->row['order_total_id'];
					
					$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_order_total` SET order_id = '" . (int)$data['order_id'] . "', seller_id = '" . (int)$seller_id_returnn . "', code = 'refunded_".$product_id."', title  = 'Refunded', value = '" . (float)$product_price . "', sort_order = 8 WHERE order_total_id='".(int)$order_total ."'");
				} else {
					$this->db->query("INSERT INTO `" . DB_PREFIX . "purpletree_order_total` SET order_id = '" . (int)$data['order_id'] . "', seller_id = '" . (int)$seller_id_returnn . "', code = 'refunded_".$product_id."', title  = 'Refunded', value = '" . (float)$product_price . "', sort_order = 8");
				}
				  
					// order_total
					$query4 = $this->db->query("SELECT *  FROM `" . DB_PREFIX . "order_total` WHERE `order_id` = '" . (int)$data['order_id'] . "' AND `code` LIKE '%refunded%' ORDER BY `order_total_id`  DESC");				    
					if($query4->num_rows){
						$order_total_id = $query4->row['order_total_id'];
						$ids = explode('_',$query4->row['code']);
						
						$seller_idd = $ids[1];
						$product_id = $ids[2];
						
						$id_code = array();
						
						$id_code = array(
						'0' => 'refunded',
						'1' => $seller_id_returnn,
						'2' => $data['product_id']						
						);
						
						$id_codes = implode('_',$id_code);
                
						if($seller_id_returnn == $seller_idd && $product_id == $data['product_id']) { 
						  $this->db->query("UPDATE `" . DB_PREFIX . "order_total` SET order_id = '" . (int)$data['order_id'] . "', code = '" . (int)$ids . "', title  = 'Refunded', value = '" . (float)$product_price . "', sort_order = 8 WHERE order_total_id='".(int)$order_total ."'");
						} else {
							$this->db->query("INSERT INTO `" . DB_PREFIX . "order_total` SET order_id = '" . (int)$data['order_id'] . "', code = '" . $this->db->escape($id_codes). "', title  = 'Refunded', value = '" . (float)$product_price . "', sort_order = 8");
							
						}
					} else {
						$id_code = array();
						$id_code = array(
							'0' => 'refunded',
							'1' => $seller_id_returnn,
							'2' => $data['product_id']						
						);
						$id_codes = implode('_',$id_code);
						$this->db->query("INSERT INTO `" . DB_PREFIX . "order_total` SET order_id = '" . (int)$data['order_id'] . "', code = '" . $this->db->escape($id_codes). "', title  = 'Refunded', value = '" . (float)$product_price . "', sort_order = 8");
					}
					// order_total
			}
		 }
		}
		
		///Calculate refund total
		$seller_id_return = '';
		$proudct_return_status = '';
		$query1 = $this->db->query("SELECT  seller_id FROM `" . DB_PREFIX . "purpletree_vendor_products_return` WHERE return_id = '" . (int)$return_id . "'");
			if($query1->num_rows) {
				$seller_id_return = $query1->row['seller_id'];
			}
		$query5 = $this->db->query("SELECT status FROM `" . DB_PREFIX . "purpletree_vendor_products_return` WHERE return_id = '" . (int)$return_id . "'");
				  if($query5->num_rows){
					$proudct_return_status = $query5->row['status'];
				  }
				 
				 
		if(isset($proudct_return_status) && $proudct_return_status == 1){			
			// For vendor total 
			$total_after_refund = "";
			$order_total_sid = "";
			$total_refund = "";
			$total_value = "";
			$total_refundd = "";
			$id_codes = "";
			$order_total_id = "";
			$product_id = (int)$data['product_id'];
			$id_code = array();
						$id_code = array(
							'0' => 'refunded',
							'1' => $seller_id_return,
							'2' => $data['product_id']						
						);
			$id_codes = implode('_',$id_code);
			$query6 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$data['order_id'] . "' AND seller_id = '".(int)$seller_id_return."' AND code ='refunded_".$product_id."' ");
					
				if($query6->num_rows){
					$order_total_sid = $query6->row['order_total_id'];
					$total_refund = $query6->row['value'];
				}
				
				$query7 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$data['order_id'] . "' AND seller_id = '".(int)$seller_id_return."' AND code ='total' ");
					
				if($query7->num_rows){
					$order_total_id = $query7->row['order_total_id'];
					$total_value = $query7->row['value'];
				}
						
			    $total_after_refund = $total_value + $total_refund;	
			 
				$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_order_total` SET value = '" . (float)$total_after_refund . "' WHERE order_total_id='". (int)$order_total_id ."'");
				$total_after_refundd = ($unit_product_price * $ruquantity) - $product_pricee;
				$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_vendor_orders` SET  	total_price  = '" . (int)$total_after_refundd . "' WHERE order_id = '" . (int)$data['order_id'] . "' AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$data['product_id'] . "'");
				
				 ///#####___Start refund after commission____######///
				$queryc = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_commissions` WHERE order_id = '" . (int)$data['order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$data['product_id'] . "'");
				if($queryc->num_rows){
					$commission_shipping = $queryc->row['commission_shipping'];
					$commission_fixed = $queryc->row['commission_fixed'];
					$commission_percent = $queryc->row['commission_percent'];
					$commission = (($total_after_refundd*$commission_percent)/100)+$commission_shipping+$commission_fixed;
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commissions SET commission = '" . (float)$commission . "', updated_at = NOW() WHERE order_id = '" . (int)$data['order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$data['product_id'] . "'");
				
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commission_invoice_items SET total_commission = '" . (float)$commission . "' WHERE order_id = '" . (int)$data['order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$data['product_id'] . "'");
				}
				$querycc = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_commission_invoice_items` WHERE order_id = '" . (int)$data['order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$data['product_id'] . "'");
					
				if($querycc->num_rows){
					$link_id = $querycc->row['link_id'];
                 $queryccc = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_commission_invoice` WHERE id = '" . (int)$link_id . "'");
					
				if($queryccc->num_rows){
				  $total_amt = $queryccc->row['total_amount'];						
				  $total_comm = $queryccc->row['total_commission'];						
				  $total_pay_amountt = $queryccc->row['total_pay_amount'];						
				}	
					
				if($total_amt > 0){
					$total_pay_amount = $total_after_refundd - $commission;
					$total_pay_amounttt = $total_pay_amountt - $total_pay_amount;			
					$total_amtt = $total_amt - $total_after_refundd;
					$total_commm = $total_comm - $commission;
				    $this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commission_invoice SET total_amount = '" . (float)$total_amtt . "', total_commission = '" . (float)$total_commm . "', total_pay_amount='".(float)$total_pay_amounttt."' WHERE id = '" . (int)$link_id . "'");
				  }
				}					
				///#####___end refund after commission____######///
				
		    // For admin total
			$query8 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$data['order_id'] . "'  AND code ='" . $this->db->escape($id_codes) . "'");
					
				if($query8->num_rows){
					$order_total_sidd = $query8->row['order_total_id'];
					$total_refundd = $query8->row['value'];
				}
				$query9 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$data['order_id'] . "' AND code ='total' ");
					
				if($query9->num_rows){
					$order_total_idd = $query9->row['order_total_id'];
					$total_valuee = $query9->row['value'];
				}
	
				$total_after_refundd = $total_valuee + $total_refundd;				
				
				$this->db->query("UPDATE `" . DB_PREFIX . "order_total` SET value = '" . (float)$total_after_refundd . "' WHERE order_total_id='". (int)$order_total_idd ."'");	
                			
			    $this->db->query("UPDATE `" . DB_PREFIX . "purpletree_vendor_products_return` SET status = 2, modified_date = NOW() WHERE return_id = '" . (int)$return_id . "'");
		}
		}
		}
		}
		
	}
	public function editReturnAfter(&$route, &$return_data, &$output): void {
		$return_id = $return_data[0];
		$data = $return_data[1];
		if ($this->config->get('module_purpletree_multivendor_status')) {
			  if($this->config->get('module_purpletree_multivendor_refund_status')== $data['return_action_id'] ){
			$proudct_return_statuss = '';
			$seller_id_returnn = '';
		     $query10 = $this->db->query("SELECT status FROM `" . DB_PREFIX . "purpletree_vendor_products_return` WHERE return_id = '" . (int)$return_id . "'");
				  if($query10->num_rows){
					$proudct_return_statuss = $query10->row['status'];
				  }
			
			$product_price = '';
			
			if(isset($proudct_return_statuss) && $proudct_return_statuss == 0){
			$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_vendor_products_return` SET status = 1, modified_date = NOW() WHERE return_id = '" . (int)$return_id . "'");
			
			 $query1 = $this->db->query("SELECT  seller_id FROM `" . DB_PREFIX . "purpletree_vendor_products_return` WHERE return_id = '" . (int)$return_id . "'");
			if($query1->num_rows) {
				$seller_id_returnn = $query1->row['seller_id'];
			} 
			
			if($seller_id_returnn != '') {
				// vendor_order_total
				$query3 = $this->db->query("SELECT total_price, unit_price, quantity FROM `" . DB_PREFIX . "purpletree_vendor_orders` WHERE order_id = '" . (int)$data['order_id'] . "' AND seller_id = '".(int)$seller_id_returnn."' AND product_id = '" . (int)$data['product_id'] . "'");
				if($query3->num_rows) {
				$product_price = -($query3->row['total_price']);
				$product_pricee = $query3->row['total_price'];
				$unit_product_price = $query3->row['unit_price'];
				$ruquantity = $query3->row['quantity'];
			    }
				$product_id = (int)$data['product_id'];
				$query2 = $this->db->query("SELECT order_total_id FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$data['order_id'] . "' AND seller_id = '".(int)$seller_id_returnn."' AND code ='refunded_".$product_id."' ");
					
				if($query2->num_rows){
					$order_total = $query2->row['order_total_id'];
					
					$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_order_total` SET order_id = '" . (int)$data['order_id'] . "', seller_id = '" . (int)$seller_id_returnn . "', code = 'refunded_".$product_id."', title  = 'Refunded', value = '" . (float)$product_price . "', sort_order = 8 WHERE order_total_id='".(int)$order_total ."'");
				} else {
					$this->db->query("INSERT INTO `" . DB_PREFIX . "purpletree_order_total` SET order_id = '" . (int)$data['order_id'] . "', seller_id = '" . (int)$seller_id_returnn . "', code = 'refunded_".$product_id."', title  = 'Refunded', value = '" . (float)$product_price . "', sort_order = 8");
				}
				  
					// order_total
					$query4 = $this->db->query("SELECT *  FROM `" . DB_PREFIX . "order_total` WHERE `order_id` = '" . (int)$data['order_id'] . "' AND `code` LIKE '%refunded%' ORDER BY `order_total_id`  DESC");				    
					if($query4->num_rows){
						$order_total_id = $query4->row['order_total_id'];
						$ids = explode('_',$query4->row['code']);
						
						$seller_idd = $ids[1];
						$product_id = $ids[2];
						
						$id_code = array();
						
						$id_code = array(
						'0' => 'refunded',
						'1' => $seller_id_returnn,
						'2' => $data['product_id']						
						);
						
						$id_codes = implode('_',$id_code);
                
						if($seller_id_returnn == $seller_idd && $product_id == $data['product_id']) { 
						  $this->db->query("UPDATE `" . DB_PREFIX . "order_total` SET order_id = '" . (int)$data['order_id'] . "', code = '" . (int)$ids . "', title  = 'Refunded', value = '" . (float)$product_price . "', sort_order = 8 WHERE order_total_id='".(int)$order_total ."'");
						} else {
							$this->db->query("INSERT INTO `" . DB_PREFIX . "order_total` SET order_id = '" . (int)$data['order_id'] . "', code = '" . $this->db->escape($id_codes). "', title  = 'Refunded', value = '" . (float)$product_price . "', sort_order = 8");
							
						}
					} else {
						$id_code = array();
						$id_code = array(
							'0' => 'refunded',
							'1' => $seller_id_returnn,
							'2' => $data['product_id']						
						);
						$id_codes = implode('_',$id_code);
						$this->db->query("INSERT INTO `" . DB_PREFIX . "order_total` SET order_id = '" . (int)$data['order_id'] . "', code = '" . $this->db->escape($id_codes). "', title  = 'Refunded', value = '" . (float)$product_price . "', sort_order = 8");
					}
					// order_total
			}
		 }
		}
		
		///Calculate refund total
		$seller_id_return = '';
		$proudct_return_status = '';
		$query1 = $this->db->query("SELECT  seller_id FROM `" . DB_PREFIX . "purpletree_vendor_products_return` WHERE return_id = '" . (int)$return_id . "'");
			if($query1->num_rows) {
				$seller_id_return = $query1->row['seller_id'];
			}
		$query5 = $this->db->query("SELECT status FROM `" . DB_PREFIX . "purpletree_vendor_products_return` WHERE return_id = '" . (int)$return_id . "'");
				  if($query5->num_rows){
					$proudct_return_status = $query5->row['status'];
				  }
				 
				 
		if(isset($proudct_return_status) && $proudct_return_status == 1){			
			// For vendor total 
			$total_after_refund = "";
			$order_total_sid = "";
			$total_refund = "";
			$total_value = "";
			$total_refundd = "";
			$id_codes = "";
			$order_total_id = "";
			$product_id = (int)$data['product_id'];
			$id_code = array();
						$id_code = array(
							'0' => 'refunded',
							'1' => $seller_id_return,
							'2' => $data['product_id']						
						);
			$id_codes = implode('_',$id_code);
			$query6 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$data['order_id'] . "' AND seller_id = '".(int)$seller_id_return."' AND code ='refunded_".$product_id."' ");
					
				if($query6->num_rows){
					$order_total_sid = $query6->row['order_total_id'];
					$total_refund = $query6->row['value'];
				}
				
				$query7 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$data['order_id'] . "' AND seller_id = '".(int)$seller_id_return."' AND code ='total' ");
					
				if($query7->num_rows){
					$order_total_id = $query7->row['order_total_id'];
					$total_value = $query7->row['value'];
				}
						
			    $total_after_refund = $total_value + $total_refund;	
			 
				$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_order_total` SET value = '" . (float)$total_after_refund . "' WHERE order_total_id='". (int)$order_total_id ."'");
				$total_after_refundd = ($unit_product_price * $ruquantity) - $product_pricee;
				$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_vendor_orders` SET  	total_price  = '" . (int)$total_after_refundd . "' WHERE order_id = '" . (int)$data['order_id'] . "' AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$data['product_id'] . "'");
				
				 ///#####___Start refund after commission____######///
				$queryc = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_commissions` WHERE order_id = '" . (int)$data['order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$data['product_id'] . "'");
				if($queryc->num_rows){
					$commission_shipping = $queryc->row['commission_shipping'];
					$commission_fixed = $queryc->row['commission_fixed'];
					$commission_percent = $queryc->row['commission_percent'];
					$commission = (($total_after_refundd*$commission_percent)/100)+$commission_shipping+$commission_fixed;
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commissions SET commission = '" . (float)$commission . "', updated_at = NOW() WHERE order_id = '" . (int)$data['order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$data['product_id'] . "'");
				
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commission_invoice_items SET total_commission = '" . (float)$commission . "' WHERE order_id = '" . (int)$data['order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$data['product_id'] . "'");
				}
				$querycc = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_commission_invoice_items` WHERE order_id = '" . (int)$data['order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$data['product_id'] . "'");
					
				if($querycc->num_rows){
					$link_id = $querycc->row['link_id'];
                 $queryccc = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_commission_invoice` WHERE id = '" . (int)$link_id . "'");
					
				if($queryccc->num_rows){
				  $total_amt = $queryccc->row['total_amount'];						
				  $total_comm = $queryccc->row['total_commission'];						
				  $total_pay_amountt = $queryccc->row['total_pay_amount'];						
				}	
					
				if($total_amt > 0){
					$total_pay_amount = $total_after_refundd - $commission;
					$total_pay_amounttt = $total_pay_amountt - $total_pay_amount;			
					$total_amtt = $total_amt - $total_after_refundd;
					$total_commm = $total_comm - $commission;
				    $this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commission_invoice SET total_amount = '" . (float)$total_amtt . "', total_commission = '" . (float)$total_commm . "', total_pay_amount='".(float)$total_pay_amounttt."' WHERE id = '" . (int)$link_id . "'");
				  }
				}					
				///#####___end refund after commission____######///
				
		    // For admin total
			$query8 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$data['order_id'] . "'  AND code ='" . $this->db->escape($id_codes) . "'");
					
				if($query8->num_rows){
					$order_total_sidd = $query8->row['order_total_id'];
					$total_refundd = $query8->row['value'];
				}
				$query9 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$data['order_id'] . "' AND code ='total' ");
					
				if($query9->num_rows){
					$order_total_idd = $query9->row['order_total_id'];
					$total_valuee = $query9->row['value'];
				}
	
				$total_after_refundd = $total_valuee + $total_refundd;				
				
				$this->db->query("UPDATE `" . DB_PREFIX . "order_total` SET value = '" . (float)$total_after_refundd . "' WHERE order_total_id='". (int)$order_total_idd ."'");	
                			
			    $this->db->query("UPDATE `" . DB_PREFIX . "purpletree_vendor_products_return` SET status = 2, modified_date = NOW() WHERE return_id = '" . (int)$return_id . "'");
		}
		}
		
	}
	public function viewRetrunHistoryAfter(&$route, &$data, &$output): void {
	
	if (isset($this->request->get['return_id'])) {
			$return_id = (int)$this->request->get['return_id'];
		} else {
			$return_id = 0;
		}

		if (isset($this->request->get['page'])) {
			$page = (int)$this->request->get['page'];
		} else {
			$page = 1;
		}	
		
		$data['histories'] = [];

		$this->load->model('sale/returns');

		$results = $this->model_sale_returns->getHistories($return_id, ($page - 1) * 10, 10);
		foreach ($results as $result) {
			$data['histories'][] = [
				'notify'     => $result['notify'] ? $this->language->get('text_yes') : $this->language->get('text_no'),
				'seller_id'     => $result['seller_id'],
				'status'     => $result['status'],
				'comment'    => nl2br($result['comment']),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			];
		}
		$data['column_updated_by'] = 'Updated by';
		$find = '<td class="text-start">'. $data['column_notify'] .'</td>';
		$replace = '<td class="text-start">'. $data['column_notify'] .'</td>';
		$replace .= '<td class="text-start">'. $data['column_updated_by'] .'</td>';
		
		$output = str_replace($find,$replace,$output);
		/* if(!empty($data['histories'])){
			foreach($data['histories'] as $history){
				$find1 = '<td class="text-start">'. $history['notify'] .'</td>';
				$replace1 = '<td class="text-start">'. $history['notify'] .'</td>';
				$replace1 .= '<td class="text-start">'. $history['seller_id'] .'</td>';
				$output = str_replace($find1,$replace1,$output);
			}
		} */
		
	}
	
	public function getHistoriesAfter(&$route, &$data) {
		
		$return_id = $data[0];
		$start = $data[1];
		$limit = $data[2];

		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}
		
		$query = $this->db->query("SELECT rh.`date_added`, rs.`name` AS status, rh.`comment`, rh.`notify`,rh.`seller_id` FROM `" . DB_PREFIX . "return_history` rh LEFT JOIN `" . DB_PREFIX . "return_status` rs ON rh.`return_status_id` = rs.`return_status_id` WHERE rh.`return_id` = '" . (int)$return_id . "' AND rs.`language_id` = '" . (int)$this->config->get('config_language_id') . "' ORDER BY rh.`date_added` DESC LIMIT " . (int)$start . "," . (int)$limit);
		return $query->rows;

	}
	
}
