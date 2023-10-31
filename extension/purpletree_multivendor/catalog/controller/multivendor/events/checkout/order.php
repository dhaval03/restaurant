<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Checkout;
class Order extends \Opencart\System\Engine\Controller {
	public function afterAddOrderHistory(&$route, &$data, &$output) {
		$order_id = $data[0];
		$order_status_id = $data[1];
		$comment = '';
		if(isset($data[2])){
		$comment = $data[2];
		}
		
		$notify = '';
		if(isset($data[3])){
		$notify = $data[3];	
		}
		
		$override = '';
		if(isset($data[4])){
		$override = $data[4];	
		}
			// Update the DB with the new statuses
			/*** update seller order and add order history ***/
			//Commission on Order Status Change
			//Commission on Order Status Change
			$order_products = $this->getVendorOrderProducts($order_id);
				foreach ($order_products as $order_product) {
				if($this->config->get('module_purpletree_multivendor_seller_product_template')){
				    $ppproduct_id = $order_product['product_id'];
					$ssseller_id  = $order_product['seller_id'];
					$productqntity  = $order_product['quantity'];
					$template_idd = $this->getTemplateId($ppproduct_id);
					
					$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_template_products SET quantity = (quantity - " . (int)$productqntity . ") WHERE template_id = '" . (int)$template_idd. "'  AND seller_id = '" . (int)$ssseller_id. "' AND subtract = '1'");
					}
						$dsds1 = "SELECT `seller_id`,`order_status_id` FROM `" . DB_PREFIX . "purpletree_vendor_orders_history` WHERE order_id = '" . (int)$order_id . "' && seller_id = '" . (int)$order_product['seller_id'] . "' order by `id` DESC";
						$query1112 = $this->db->query($dsds1);
						$sdsds11 = $query1112->row;
						if(empty($sdsds11)) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_orders_history SET order_id = '" . (int)$order_id . "', seller_id ='". (int)$order_product['seller_id'] ."', order_status_id = '" . (int)$order_status_id . "', notify = '" . (int)$notify . "', comment = '" . $this->db->escape($comment) . "', created_at = NOW()");
							$ordststid = $order_status_id;
						} else {
							$ordststid = $sdsds11['order_status_id'];
						}
							$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_vendor_orders` SET order_status_id = '" . (int)$ordststid . "', updated_at = NOW() WHERE order_id = '" . (int)$order_id . "' && product_id = '" . (int)$order_product['product_id'] . "'");
			if (null !== $this->config->get('module_purpletree_multivendor_commission_status') && $this->config->get('module_purpletree_multivendor_commission_status') != $order_status_id) {
                    $this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commissions SET commission_shipping = '0', commission_fixed = '0', commission_percent = '0', commission = '0', status = 'Order Cancelled', updated_at = NOW() WHERE order_id = '" . (int)$order_id . "'  AND product_id = '" . (int)$order_product['product_id'] . "'");
                }
			} 
			if (null !== $this->config->get('module_purpletree_multivendor_commission_status') && $this->config->get('module_purpletree_multivendor_commission_status') == $order_status_id) {
				$sellerorders = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_orders` WHERE order_id = '" . (int)$order_id . "'");
				
				$shipcommsvirtial = '0';
				$dsdsds = array();
				if(!empty($sellerorders->rows)) {
					foreach($sellerorders->rows as $sellerorder) {
						$sql1111 = "SELECT `store_commission` FROM `" . DB_PREFIX . "purpletree_vendor_stores` WHERE seller_id = '" . (int)$sellerorder['seller_id'] . "'";
						$totalshipingorder = '0';
								$getShippingOrderTotal = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$order_id . "' AND seller_id = '" . (int)$sellerorder['seller_id'] . "' AND code ='seller_shipping'");
						if($getShippingOrderTotal->num_rows){
							$totalshipingorder = $getShippingOrderTotal->row['value'];
						}
				
						$query = $this->db->query($sql1111);
						$seller_commission = $query->row;
						if($sellerorder['order_status_id'] == $this->config->get('module_purpletree_multivendor_commission_status')) {
							 //category_commission
				        $productid = $sellerorder['product_id'];	
						$catids =$this->getProductCategory($productid );
						$commission_cat = array();
						$catttt = array();
						 $shippingcommision = 0;
							 if($totalshipingorder != 0) {
								 if (null !== $this->config->get('module_purpletree_multivendor_shipping_commission')) {
									 if(!array_key_exists($sellerorder['seller_id'],$dsdsds)) {
									 $shippingcommision = (($this->config->get('module_purpletree_multivendor_shipping_commission')*$totalshipingorder)/100);
									 $dsdsds[$sellerorder['seller_id']] = $shippingcommision;
									 }
								 }
							 }
						if(!empty($catids)){
							foreach($catids as $cat) {
								$sql = "SELECT * FROM " . DB_PREFIX . "purpletree_vendor_categories_commission where category_id = '".(int)$cat['category_id']."'";
								$query = $this->db->query($sql);
								$commission_cat[] = $query->rows;
							}
								
						}
						$commission = -1;
						$commission1 = -1;
						$comipercen = 0;
						$comifixs = 0;
						/// Get fix global Commission /// 
						$globalcomifixs = 0;
						 if(($this->config->get('module_purpletree_multivendor_fix_commission')) && ($this->config->get('module_purpletree_multivendor_fix_commission') > 0)){
							  $globalcomifixs = $this->config->get('module_purpletree_multivendor_fix_commission');
								 }
						//////end fix globle commission ////
						if(!empty($commission_cat)) {
						 foreach($commission_cat as $catts) {
						 foreach($catts as $catt) {
								$comifix = 0;
							 if(isset($catt['commison_fixed']) && $catt['commison_fixed'] != '') {
								$comifix = $catt['commison_fixed'];
							 }else{
							 if(($this->config->get('module_purpletree_multivendor_fix_commission')) && ($this->config->get('module_purpletree_multivendor_fix_commission') > 0)){
							   $comifix =$this->config->get('module_purpletree_multivendor_fix_commission');
								 }							  
							 }
								$comiper = 0;
							 if(isset($catt['commission']) && $catt['commission'] != '') {
								$comiper = $catt['commission'];
							 }
							
							 if (null !== $this->config->get('module_purpletree_multivendor_seller_group') && $this->config->get('module_purpletree_multivendor_seller_group') == 1) {
								$sqlgrop = "Select `customer_group_id` from `" . DB_PREFIX . "customer` where customer_id= ".$sellerorder['seller_id']." ";
								$querygrop = $this->db->query($sqlgrop);
								$sellergrp = $querygrop->row;
								if($catt['seller_group'] == $sellergrp['customer_group_id']) {
									$commipercent = (($comiper*$sellerorder['total_price'])/100);
									$commission1 = $comifix + $commipercent + $shippingcommision;
									if($commission1 > $commission) {
										$comipercen 		= $comiper;
										$comifixs 			= $comifix;
										$shippingcommision 	= $shippingcommision;
										$commission 		= $commission1;
									}
								}
							 } else {
								 $commipercent = (($comiper*$sellerorder['total_price'])/100);
									$commission1 = $comifix + $commipercent + $shippingcommision;
									if($commission1 > $commission) {
										$comipercen 		= $comiper;
										$comifixs 			= $comifix;
										$shippingcommision 	= $shippingcommision;
										$commission 		= $commission1;
									} 
							 }
						   }
						 }
						}
						if($commission != -1) {
							$commission = $commission;
						}
						//category_commission
						elseif(isset($seller_commission['store_commission']) && ($seller_commission['store_commission'] != NULL || $seller_commission['store_commission'] != '')){
							$comipercen = $seller_commission['store_commission'];
							$commission = (($sellerorder['total_price']*$seller_commission['store_commission'])/100)+$shippingcommision+$globalcomifixs;
							$comifixs = $globalcomifixs;
						} else {
							$comipercen = $this->config->get('module_purpletree_multivendor_commission');
							$commission = (($sellerorder['total_price']*$this->config->get('module_purpletree_multivendor_commission'))/100)+$shippingcommision+$globalcomifixs;
							$comifixs = $globalcomifixs;
						}
						$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commissions SET commission_shipping = '".$shippingcommision."', commission_fixed = '".$comifixs."', commission_percent = '".$comipercen."', commission = '" . (float)$commission . "', status = 'Complete', updated_at = NOW() WHERE order_id = '" . (int)$order_id . "' && product_id ='".(int)$sellerorder['product_id']."' && seller_id = '" . (int)$sellerorder['seller_id'] . "' && vendor_order_table_id = '" . (int)$sellerorder['id'] . "'");
						} else {
							$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commissions SET commission_shipping = '0', commission_fixed = '0', commission_percent = '0',  commission = '0', status = 'Pending', updated_at = NOW() WHERE order_id = '" . (int)$order_id . "' && product_id ='".(int)$sellerorder['product_id']."' && seller_id = '" . (int)$sellerorder['seller_id'] . "'");
						}
					}
				}
			}
	}
	public function afterEditOrder(&$route, &$product_data, &$output) {

		$order_id =$product_data[0];
		$data = $product_data[1];
		$this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_vendor_orders WHERE order_id = '" . (int)$order_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_vendor_commissions WHERE order_id = '" . (int)$order_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_order_total WHERE order_id = '" . (int)$order_id . "'");
		
	/*** insert into seller orders ****/
	if ($this->config->get('module_purpletree_multivendor_status')) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

				$cart_products = $this->model_checkout_cart->getProducts();
				/* if(!empty($cart_products)){
					foreach($cart_products as $cart_product){
						
					}
				} */

					foreach($query->rows as $product){	
					$query_pts = $this->db->query("SELECT seller_id FROM " . DB_PREFIX . "purpletree_vendor_orders  WHERE order_id = '" . (int)$product['order_id'] . "' AND product_id='".$product['product_id']."'");
					if($query_pts->num_rows){
						$product['seller_id']=$query_pts->row['seller_id'];
					} else {
						$pts_query = $this->db->query("SELECT pvc.* FROM " . DB_PREFIX . "cart c LEFT JOIN " . DB_PREFIX . "purpletree_vendor_cart pvc ON (c.cart_id = pvc.cart_id) WHERE product_id='".$product['product_id']."'");
						if($pts_query->num_rows){
						$product['seller_id'] = $pts_query->row['seller_id'];
						}
					}

					$seller_id = $this->db->query("SELECT pvp.seller_id, pvs.store_shipping_charge,pvs.store_shipping_order_type,pvs.store_shipping_type,pvs.store_commission, p.tax_class_id FROM " . DB_PREFIX . "purpletree_vendor_products pvp JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON(pvs.seller_id=pvp.seller_id) JOIN " . DB_PREFIX . "product p ON(p.product_id=pvp.product_id) WHERE pvp.product_id='".(int)$product['product_id']."' AND pvp.is_approved=1")->row;
					if($this->config->get('module_purpletree_multivendor_seller_product_template')){
					if(empty($seller_id['seller_id'])) {
						$sseller_id = $product['seller_id'];
						$seller_id = $this->db->query("SELECT pvs.seller_id, pvs.store_shipping_charge,pvs.store_shipping_order_type,pvs.store_shipping_type,pvs.store_commission, p.tax_class_id FROM " . DB_PREFIX . "purpletree_vendor_template_products pvtp JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON(pvs.seller_id=pvtp.seller_id) JOIN " . DB_PREFIX . "purpletree_vendor_template pvt ON(pvt.id=pvtp.template_id) JOIN " . DB_PREFIX . "product p ON(p.product_id=pvt.product_id) WHERE pvt.product_id='".(int)$product['product_id']."' AND pvs.seller_id='".$sseller_id."'")->row;
					}
					}
					if(!empty($seller_id['seller_id'])) {
						$seller_id_coupon = $seller_id['seller_id']; //for ALL type coupon use
						$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_orders SET order_id ='".(int)$order_id."', seller_id = '".(int)$seller_id['seller_id']."', product_id ='".(int)$product['product_id']."', shipping = '".(float)$seller_id['store_shipping_charge']."', quantity = '" . (int)$product['quantity'] . "', unit_price = '" . (float)$product['price'] . "', total_price = '" . (float)$product['total'] . "', created_at =NOW(), updated_at = NOW()");					
						$vendor_or_teb_id = $this->db->getLastId();
						$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_commissions SET order_id = '" . (int)$order_id . "', product_id ='".(int)$product['product_id']."', seller_id = '" . (int)$seller_id['seller_id'] . "',vendor_order_table_id = '" . (int)$vendor_or_teb_id . "',commission_shipping = '0', commission_fixed = '0', commission_percent = '0', commission = '0', status = 'Pending', created_at = NOW(), updated_at = NOW()");
						//
		$proprice = $product['price'];
		$prototal = $product['total'];
		$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
		$coupon_discount = $this->model_extension_purpletree_multivendor_multivendor_vendor->getsellercounponTotal($product['product_id']);
		if($coupon_discount) {
			$proprice = $product['price'] - $coupon_discount;
			$prototal = $product['total']-$coupon_discount;
		}
						//
						if(!isset($seller_sub_total[$seller_id['seller_id']])){
						$seller_sub_total[$seller_id['seller_id']] = $product['total'];
						} else {
							$seller_sub_total[$seller_id['seller_id']] += $product['total'];
						}
						
						if(!isset($seller_final_total[$seller_id['seller_id']])){
							$seller_final_total[$seller_id['seller_id']] = $this->tax->calculate($proprice, $seller_id['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
						} else {
							$seller_final_total[$seller_id['seller_id']] += $this->tax->calculate($proprice, $seller_id['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
						}
						
						$tax_rates = $this->tax->getRates($proprice, $seller_id['tax_class_id']);
			
						foreach ($tax_rates as $tax_rate) {
							if (!isset($seller_tax_data[$seller_id['seller_id']][$tax_rate['tax_rate_id']])) {
								$seller_tax_data[$seller_id['seller_id']][$tax_rate['tax_rate_id']] = ($tax_rate['amount'] * $product['quantity']);
							} else {
								$seller_tax_data[$seller_id['seller_id']][$tax_rate['tax_rate_id']] += ($tax_rate['amount'] * $product['quantity']);
							}
						}
				$shipping_purpletree_shipping_order_type 			= $seller_id['store_shipping_order_type'] != '' ? $seller_id['store_shipping_order_type']:'pts_product_wise' ;
				$shipping_purpletree_shipping_type 			= $seller_id['store_shipping_type'] != '' ? $seller_id['store_shipping_type']:'pts_flat_rate_shipping' ;
				$shipping_purpletree_shipping_charge 		= $seller_id['store_shipping_charge'] != '' ? $seller_id['store_shipping_charge'] : '0';
						$getsellershipping = $this->getsellershipping($seller_id,$product,$data);
						$getsellershipping1 = $this->getsellershipping1($seller_id,$product,$data);
						if(!isset($seller_shipping[$seller_id['seller_id']])){
							$seller_shipping[$seller_id['seller_id']] = $getsellershipping;
							$seller_shipping1[$seller_id['seller_id']] = $getsellershipping1;
						} else {
							$seller_shipping[$seller_id['seller_id']] += $getsellershipping;
							$seller_shipping1[$seller_id['seller_id']] += $getsellershipping1;
						}
					} else {
						$seller_id = array();
						$seller_id['seller_id'] = 0;
						$getsellershipping = $this->getsellershipping($seller_id,$product,$data);
						$getsellershipping1 = $this->getsellershipping1($seller_id,$product,$data);
						if(!isset($seller_shipping[$seller_id['seller_id']])){
							$seller_shipping[$seller_id['seller_id']] = $getsellershipping;
							$seller_shipping1[$seller_id['seller_id']] = $getsellershipping1;
						} else {
							$seller_shipping[$seller_id['seller_id']] += $getsellershipping;
							$seller_shipping1[$seller_id['seller_id']] += $getsellershipping1;
						}
				$shipping_purpletree_shipping_order_type = (null !== $this->config->get('shipping_purpletree_shipping_order_type'))? $this->config->get('shipping_purpletree_shipping_order_type') : 'pts_product_wise';
				$shipping_purpletree_shipping_type = (null !== $this->config->get('shipping_purpletree_shipping_type'))? $this->config->get('shipping_purpletree_shipping_type') : 'pts_flat_rate_shipping';
				$shipping_purpletree_shipping_charge = (null !== $this->config->get('shipping_purpletree_shipping_charge'))? $this->config->get('shipping_purpletree_shipping_charge') : '0';
					}
						
				$store_shipping_type[$seller_id['seller_id']] = $shipping_purpletree_shipping_type;
				$store_shipping_charge[$seller_id['seller_id']] = $shipping_purpletree_shipping_charge;
				$store_shipping_order_type[$seller_id['seller_id']] = $shipping_purpletree_shipping_order_type;
				}
				}
				
									if(!empty($seller_shipping1)) {
			foreach($seller_shipping1 as $sellerid => $totalweight) {
				if($store_shipping_order_type[$sellerid] == 'pts_order_wise')  {
					$getMatrixShippingCharge1 = $this->getMatrixShippingCharge($data,$totalweight,$sellerid);
					if($store_shipping_type[$sellerid] == 'pts_matrix_shipping') {
						if(!$this->config->get('module_purpletree_multivendor_shippingtype')){
							if($data['shipping_postcode'] != '') {
								if($getMatrixShippingCharge1) {
									$seller_shipping[$sellerid] += $getMatrixShippingCharge1;
								}
							} 
						}else{
							if($getMatrixShippingCharge1) {
								$seller_shipping[$sellerid] += $getMatrixShippingCharge1;
							}
						}
					} elseif($store_shipping_type[$sellerid] == 'pts_flexible_shipping') {
						if($getMatrixShippingCharge1) {
							$seller_shipping[$sellerid] += $getMatrixShippingCharge1;
						} else {
							$seller_shipping[$sellerid] += $store_shipping_charge[$sellerid];
						}
					} elseif($store_shipping_type[$sellerid] == 'pts_flat_rate_shipping') {
							$seller_shipping[$sellerid] += $store_shipping_charge[$sellerid];
					}
				}
			}
		}
					$this->load->language('extension/total/total');
			/**************************************** For seller tax*******************************/
		if(! empty($seller_tax_data))
		{
		 $taxxx = 0;
			if (isset($data['totals'])) {
				foreach ($data['totals'] as $total) {
					if($total['code']=='tax'){
						$taxxx = $taxxx + $total['value'];
					}
				}
			}
			if($taxxx != 0) {
			foreach($seller_tax_data as $key=>$value){
				foreach ($value as $key1 => $value1) {
					if ($value1 > 0) {
						$tax_detail[$key][] = array(
							'code'       => 'tax',
							'title'      => $this->tax->getRateName($key1),
							'value'      => $value1,
							'sort_order' => $this->config->get('total_tax_sort_order')
						);
						if(!isset($seller_total_tax[$key])){
							$seller_total_tax[$key] = $value1;
						} else {
							$seller_total_tax[$key] +=$value1 ;
						}
					}
				}
			} 
			}
			}
			/**************************************** For seller shipping*******************************/
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
			if($this->config->get('shipping_purpletree_shipping_status')){
			if($data['shipping_code'] == 'purpletree_shipping.purpletree_shipping') {
				foreach($seller_shipping as $key=>$value) {
					if ($value > 0) {
						$shippingtitle = $this->language->get('text_seller_shipping_total');
						if($key == 0) {
						$shippingtitle = $this->language->get('text_admin_shipping_total');
						}
						$tax_detail[$key][] = array(
							'code'       => 'seller_shipping',
							'title'      => $shippingtitle,
							'value'      => $value,
							'sort_order' => '2'
						);
					}
				}	
			}
			}
		
			/**************************************** For seller total*******************************/
		if(isset($seller_final_total)){	
		if(!empty($seller_final_total)){
			foreach($seller_final_total as $key=>$value) {
				if(!isset($seller_total_tax[$key])){
					$seller_total_tax[$key]=0;
				}
				if(!$this->config->get('shipping_purpletree_shipping_status')){
						$seller_shipping[$key]=0;
				}
				if($data['shipping_code'] != 'purpletree_shipping.purpletree_shipping') {
						$seller_shipping[$key]=0;
				}
				if ($value > 0) { 
					$tax_detail[$key][] = array(
						'code'       => 'total',
						'title'      => $this->language->get('text_total'),
						'value'      => max(0, ($seller_sub_total[$key]+$seller_total_tax[$key]+$seller_shipping[$key])),
						'sort_order' => $this->config->get('total_total_sort_order')
					);
				}
			}
		}
		}
				
			/**************************************** For seller sub-total*******************************/
			if(isset($seller_sub_total)){
			foreach($seller_sub_total as $key=>$value) {
				if ($value > 0) {
					$tax_detail[$key][] = array(
						'code'       => 'sub_total',
						'title'      => $this->language->get('text_sub_total'),
						'value'      => $value,
						'sort_order' => $this->config->get('sub_total_sort_order')
					);
				}
			}
	}
		if (isset($tax_detail)) {
			foreach ($tax_detail as $key=>$value) {
				foreach($value as $data_1){
					$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_order_total SET order_id = '" . (int)$order_id . "', seller_id = '".(int)$key."', code = '" . $this->db->escape($data_1['code']) . "', title = '" . $this->db->escape($data_1['title']) . "', `value` = '" . (float)$data_1['value'] . "', sort_order = '" . (int)$data_1['sort_order'] . "'");
				}
			}
		}
		
		
		if (isset($data['totals'])) {
				foreach ($data['totals'] as $total) {
					if($total['code']=='coupon'){
						//$couponn = substr($total['title'],8,-1);
						preg_match('#\((.*?)\)#', $total['title'], $match);
						$couponn = $match[1];
						$query6 = $this->db->query("SELECT pvc.seller_id,co.discount FROM `" . DB_PREFIX . "coupon` co INNER JOIN " . DB_PREFIX . "purpletree_vendor_coupons pvc ON(co.coupon_id=pvc.coupon_id) WHERE co.code = '".$couponn."'AND pvc.seller_id!=0");
					if($query6->num_rows){
						$seller_id = $query6->row['seller_id'];
						//for ALL type coupon
						if($seller_id == -1){
						  $seller_id = $seller_id_coupon;
							}
						$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_order_total SET order_id = '" . (int)$order_id . "', code = '" . $this->db->escape($total['code']) . "', title = '" . $this->db->escape($total['title']) . "', `value` = '" . (float)$total['value'] . "', sort_order = '" . (int)$total['sort_order'] . "', seller_id = '" .(int)$seller_id."'");
						
						$query7 = $this->db->query("SELECT order_total_id,value FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$order_id . "' AND seller_id = '".(int)$seller_id."' AND code ='total'");
						if($query7->num_rows){
							$order_total_id = $query7->row['order_total_id'];
							$total_value = $query7->row['value'];
						}
						$coupon_amount = $total['value'];
						if(isset($total_value) && isset($coupon_amount)){
							$total_after_apply_coupon = $total_value + ($coupon_amount);
							$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_order_total` SET value = '" . (float)$total_after_apply_coupon . "' WHERE order_total_id='". (int)$order_total_id ."'");
						}
					}
				}
			}
		}
				
		
	}
	public function afterAddOrder(&$route, &$product_data, &$output) {
		$data=$product_data[0];
		if($this->config->get('module_purpletree_multivendor_status')){
			if($output){
				$order_id = $output;
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
				$cart_products = $this->model_checkout_cart->getProducts();
				/* if(!empty($cart_products)){
					foreach($cart_products as $cart_product){
						
					}
				} */

				if($query->num_rows){

					foreach($query->rows as $product){
						
						$query_pts = $this->db->query("SELECT seller_id FROM " . DB_PREFIX . "purpletree_vendor_orders  WHERE order_id = '" . (int)$product['order_id'] . "' AND product_id='".$product['product_id']."'");
					if($query_pts->num_rows){
						$product['seller_id']=$query_pts->row['seller_id'];
					} else {
						$pts_query = $this->db->query("SELECT pvc.* FROM " . DB_PREFIX . "cart c LEFT JOIN " . DB_PREFIX . "purpletree_vendor_cart pvc ON (c.cart_id = pvc.cart_id) WHERE product_id='".$product['product_id']."'");
						if($pts_query->num_rows){
						$product['seller_id'] = $pts_query->row['seller_id'];
						}
					}

						// seller product
						$seller_id = $this->db->query("SELECT pvp.seller_id, pvs.store_shipping_charge,pvs.store_shipping_order_type,pvs.store_shipping_type,pvs.store_commission, p.tax_class_id FROM " . DB_PREFIX . "purpletree_vendor_products pvp JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON(pvs.seller_id=pvp.seller_id) JOIN " . DB_PREFIX . "product p ON(p.product_id=pvp.product_id) WHERE pvp.product_id='".(int)$product['product_id']."' AND pvp.is_approved=1")->row;
					if($this->config->get('module_purpletree_multivendor_seller_product_template')){
						$template_id = $this->getTemplateId($product['product_id']);
					
					if($template_id){
					if(empty($seller_id['seller_id'])) {
						$sseller_id = $product['seller_id'];
						$seller_id = $this->db->query("SELECT pvs.seller_id, pvs.store_shipping_charge,pvs.store_shipping_order_type,pvs.store_shipping_type,pvs.store_commission, p.tax_class_id FROM " . DB_PREFIX . "purpletree_vendor_template_products pvtp JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON(pvs.seller_id=pvtp.seller_id) JOIN " . DB_PREFIX . "purpletree_vendor_template pvt ON(pvt.id=pvtp.template_id) JOIN " . DB_PREFIX . "product p ON(p.product_id=pvt.product_id) WHERE pvt.product_id='".(int)$product['product_id']."' AND pvs.seller_id='".$sseller_id."'")->row;
					}
					}
					}
					if(!empty($seller_id['seller_id'])) {
						$seller_id_coupon = $seller_id['seller_id']; //for ALL type coupon use
						$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_orders SET order_id ='".(int)$order_id."', seller_id = '".(int)$seller_id['seller_id']."', product_id ='".(int)$product['product_id']."', shipping = '".(float)$seller_id['store_shipping_charge']."', quantity = '" . (int)$product['quantity'] . "', unit_price = '" . (float)$product['price'] . "', total_price = '" . (float)$product['total'] . "', created_at =NOW(), updated_at = NOW()");					
						$vendor_or_teb_id = $this->db->getLastId();
						$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_commissions SET order_id = '" . (int)$order_id . "', product_id ='".(int)$product['product_id']."', seller_id = '" . (int)$seller_id['seller_id'] . "',vendor_order_table_id = '" . (int)$vendor_or_teb_id . "',commission_shipping = '0', commission_fixed = '0', commission_percent = '0', commission = '0', status = 'Pending', created_at = NOW(), updated_at = NOW()");
						//
		$proprice = $product['price'];
		$prototal = $product['total'];
		
		$this->load->model('catalog/product');

		$this->load->model('extension/purpletree_multivendor/multivendor/vendor');		
		$coupon_discount = $this->model_extension_purpletree_multivendor_multivendor_vendor->getsellercounponTotal($product['product_id']);
		if($coupon_discount) {
			$proprice = $product['price'] - $coupon_discount;
			$prototal = $product['total']-$coupon_discount;
		}
						//
						if(!isset($seller_sub_total[$seller_id['seller_id']])){
						$seller_sub_total[$seller_id['seller_id']] = $product['total'];
						} else {
							$seller_sub_total[$seller_id['seller_id']] += $product['total'];
						}
						
						if(!isset($seller_final_total[$seller_id['seller_id']])){
							$seller_final_total[$seller_id['seller_id']] = $this->tax->calculate($proprice, $seller_id['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
						} else {
							$seller_final_total[$seller_id['seller_id']] += $this->tax->calculate($proprice, $seller_id['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'];
						}
						
						$tax_rates = $this->tax->getRates($proprice, $seller_id['tax_class_id']);
			
						foreach ($tax_rates as $tax_rate) {
							if (!isset($seller_tax_data[$seller_id['seller_id']][$tax_rate['tax_rate_id']])) {
								$seller_tax_data[$seller_id['seller_id']][$tax_rate['tax_rate_id']] = ($tax_rate['amount'] * $product['quantity']);
							} else {
								$seller_tax_data[$seller_id['seller_id']][$tax_rate['tax_rate_id']] += ($tax_rate['amount'] * $product['quantity']);
							}
						}
				$shipping_purpletree_shipping_order_type 			= $seller_id['store_shipping_order_type'] != '' ? $seller_id['store_shipping_order_type']:'pts_product_wise' ;
				$shipping_purpletree_shipping_type 			= $seller_id['store_shipping_type'] != '' ? $seller_id['store_shipping_type']:'pts_flat_rate_shipping' ;
				$shipping_purpletree_shipping_charge 		= $seller_id['store_shipping_charge'] != '' ? $seller_id['store_shipping_charge'] : '0';
						$getsellershipping = $this->getsellershipping($seller_id,$product,$data);
						$getsellershipping1 = $this->getsellershipping1($seller_id,$product,$data);
						if(!isset($seller_shipping[$seller_id['seller_id']])){
							$seller_shipping[$seller_id['seller_id']] = $getsellershipping;
							$seller_shipping1[$seller_id['seller_id']] = $getsellershipping1;
						} else {
							$seller_shipping[$seller_id['seller_id']] += $getsellershipping;
							$seller_shipping1[$seller_id['seller_id']] += $getsellershipping1;
						}
					} else {
						$seller_id = array();
						$seller_id['seller_id'] = 0;
						$getsellershipping = $this->getsellershipping($seller_id,$product,$data);
						$getsellershipping1 = $this->getsellershipping1($seller_id,$product,$data);
						if(!isset($seller_shipping[$seller_id['seller_id']])){
							$seller_shipping[$seller_id['seller_id']] = $getsellershipping;
							$seller_shipping1[$seller_id['seller_id']] = $getsellershipping1;
						} else {
							$seller_shipping[$seller_id['seller_id']] += $getsellershipping;
							$seller_shipping1[$seller_id['seller_id']] += $getsellershipping1;
						}
				$shipping_purpletree_shipping_order_type = (null !== $this->config->get('shipping_purpletree_shipping_order_type'))? $this->config->get('shipping_purpletree_shipping_order_type') : 'pts_product_wise';
				$shipping_purpletree_shipping_type = (null !== $this->config->get('shipping_purpletree_shipping_type'))? $this->config->get('shipping_purpletree_shipping_type') : 'pts_flat_rate_shipping';
				$shipping_purpletree_shipping_charge = (null !== $this->config->get('shipping_purpletree_shipping_charge'))? $this->config->get('shipping_purpletree_shipping_charge') : '0';
					} 
					}
				$store_shipping_type[$seller_id['seller_id']] = $shipping_purpletree_shipping_type;
				$store_shipping_charge[$seller_id['seller_id']] = $shipping_purpletree_shipping_charge;
				$store_shipping_order_type[$seller_id['seller_id']] = $shipping_purpletree_shipping_order_type;
				// seller product
				
				////////////////
				if(!empty($seller_shipping1)) {
			foreach($seller_shipping1 as $sellerid => $totalweight) {
				if($store_shipping_order_type[$sellerid] == 'pts_order_wise')  {
					$getMatrixShippingCharge1 = $this->getMatrixShippingCharge($data,$totalweight,$sellerid);
					if($store_shipping_type[$sellerid] == 'pts_matrix_shipping') {
						if(!$this->config->get('module_purpletree_multivendor_shippingtype')){
							if($data['shipping_postcode'] != '') {
								if($getMatrixShippingCharge1) {
									$seller_shipping[$sellerid] += $getMatrixShippingCharge1;
								}
							} 
						}else{
							if($getMatrixShippingCharge1) {
								$seller_shipping[$sellerid] += $getMatrixShippingCharge1;
							}
						}
					} elseif($store_shipping_type[$sellerid] == 'pts_flexible_shipping') {
						if($getMatrixShippingCharge1) {
							$seller_shipping[$sellerid] += $getMatrixShippingCharge1;
						} else {
							$seller_shipping[$sellerid] += $store_shipping_charge[$sellerid];
						}
					} elseif($store_shipping_type[$sellerid] == 'pts_flat_rate_shipping') {
							$seller_shipping[$sellerid] += $store_shipping_charge[$sellerid];
					}
				}
			}
		}
					$this->load->language('extension/total/total');
			/**************************************** For seller tax*******************************/
		if(! empty($seller_tax_data))
		{
		 $taxxx = 0;
			if (isset($data['totals'])) {
				foreach ($data['totals'] as $total) {
					if($total['code']=='tax'){
						$taxxx = $taxxx + $total['value'];
					}
				}
			}
			if($taxxx != 0) {
			foreach($seller_tax_data as $key=>$value){
				foreach ($value as $key1 => $value1) {
					if ($value1 > 0) {
						$tax_detail[$key][] = array(
							'code'       => 'tax',
							'title'      => $this->tax->getRateName($key1),
							'value'      => $value1,
							'sort_order' => $this->config->get('total_tax_sort_order')
						);
						if(!isset($seller_total_tax[$key])){
							$seller_total_tax[$key] = $value1;
						} else {
							$seller_total_tax[$key] +=$value1 ;
						}
					}
				}
			} 
			}
			}
			/**************************************** For seller shipping*******************************/
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
			if($this->config->get('shipping_purpletree_shipping_status')){
			if($data['shipping_code'] == 'purpletree_shipping.purpletree_shipping') {
				foreach($seller_shipping as $key=>$value) {
					if ($value > 0) {
						$shippingtitle = $this->language->get('text_seller_shipping_total');
						if($key == 0) {
						$shippingtitle = $this->language->get('text_admin_shipping_total');
						}
						$tax_detail[$key][] = array(
							'code'       => 'seller_shipping',
							'title'      => $shippingtitle,
							'value'      => $value,
							'sort_order' => '2'
						);
					}
				}	
			}
			}
		
			/**************************************** For seller total*******************************/
			if(isset($seller_final_total)){
			foreach($seller_final_total as $key=>$value) {
				if(!isset($seller_total_tax[$key])){
					$seller_total_tax[$key]=0;
				}
				if(!$this->config->get('shipping_purpletree_shipping_status')){
						$seller_shipping[$key]=0;
				}
				if($data['shipping_code'] != 'purpletree_shipping.purpletree_shipping') {
						$seller_shipping[$key]=0;
				}
				if ($value > 0) { 
					$tax_detail[$key][] = array(
						'code'       => 'total',
						'title'      => $this->language->get('text_total'),
						'value'      => max(0, ($seller_sub_total[$key]+$seller_total_tax[$key]+$seller_shipping[$key])),
						'sort_order' => $this->config->get('total_total_sort_order')
					);
				}
			}
			}
				
			/**************************************** For seller sub-total*******************************/
			if(isset($seller_sub_total)){
			foreach($seller_sub_total as $key=>$value) {
				if ($value > 0) {
					$tax_detail[$key][] = array(
						'code'       => 'sub_total',
						'title'      => $this->language->get('text_sub_total'),
						'value'      => $value,
						'sort_order' => $this->config->get('sub_total_sort_order')
					);
				}
			}
			}
		if (isset($tax_detail)) {
			foreach ($tax_detail as $key=>$value) {
				foreach($value as $data_1){
					$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_order_total SET order_id = '" . (int)$order_id . "', seller_id = '".(int)$key."', code = '" . $this->db->escape($data_1['code']) . "', title = '" . $this->db->escape($data_1['title']) . "', `value` = '" . (float)$data_1['value'] . "', sort_order = '" . (int)$data_1['sort_order'] . "'");
				}
			}
		}

		if (isset($data['totals'])) {
				foreach ($data['totals'] as $total) {
					if($total['code']=='coupon'){
						//$couponn = substr($total['title'],8,-1);
						preg_match('#\((.*?)\)#', $total['title'], $match);
						$couponn = $match[1];
						$query6 = $this->db->query("SELECT pvc.seller_id,co.discount FROM `" . DB_PREFIX . "coupon` co INNER JOIN " . DB_PREFIX . "purpletree_vendor_coupons pvc ON(co.coupon_id=pvc.coupon_id) WHERE co.code = '".$couponn."'AND pvc.seller_id!=0");
					if($query6->num_rows){
						$seller_id = $query6->row['seller_id'];
						//for ALL type coupon
						if($seller_id == -1){
						  $seller_id = $seller_id_coupon;
							}
						$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_order_total SET order_id = '" . (int)$order_id . "', code = '" . $this->db->escape($total['code']) . "', title = '" . $this->db->escape($total['title']) . "', `value` = '" . (float)$total['value'] . "', sort_order = '" . (int)$total['sort_order'] . "', seller_id = '" .(int)$seller_id."'");
						
						$query7 = $this->db->query("SELECT order_total_id,value FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$order_id . "' AND seller_id = '".(int)$seller_id."' AND code ='total'");
						if($query7->num_rows){
							$order_total_id = $query7->row['order_total_id'];
							$total_value = $query7->row['value'];
						}
						$coupon_amount = $total['value'];
						if(isset($total_value) && isset($coupon_amount)){
							$total_after_apply_coupon = $total_value + ($coupon_amount);
							$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_order_total` SET value = '" . (float)$total_after_apply_coupon . "' WHERE order_total_id='". (int)$order_total_id ."'");
						}
					}
				}
			}
		}
		
				////////////////
					}	
				}
			}
		}
	
	public function getProductCategory($productid){
		
		$sql = "SELECT category_id FROM " . DB_PREFIX . "product_to_category where 	product_id = '".(int)$productid."'"; 
		
		  $query = $this->db->query($sql);
		  
		  return $query->rows;  
		}
		public function getTemplateId($product_id) {
			$query = $this->db->query("SELECT pvt.id as id FROM " . DB_PREFIX . "purpletree_vendor_template pvt  WHERE pvt.product_id ='". (int)$product_id ."'");
			 if($query->num_rows){		
				return $query->row['id'];
			 }else{
				 return null;
			 }
		
	}
			public function getVendorOrderProducts($order_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_orders WHERE order_id = '" . (int)$order_id . "'");
		
		return $query->rows;
	}
		public function getMatrixShippingCharge($address,$totalweight,$seller_id){
			if(!$this->config->get('module_purpletree_multivendor_shippingtype')){
				$seller_id2 = -1;
			 $sql2 = "SELECT * FROM " . DB_PREFIX . "purpletree_vendor_shipping pvss WHERE pvss.seller_id =".$seller_id2." AND pvss.shipping_country = '".$address['shipping_country_id']."'";
			 if($address['shipping_postcode'] != '') {
				 if(!is_numeric($address['shipping_postcode'])) {
						 $sql2 .= " AND pvss.zipcode_from = '".$address['shipping_postcode']."' AND pvss.zipcode_to = '".$address['shipping_postcode']."'";
						 }
			 }
			 if($this->db->query($sql2)->num_rows){		
				$shippingqery = $this->db->query($sql2)->rows;
			 }else{
				$sql = "SELECT * FROM " . DB_PREFIX . "purpletree_vendor_shipping pvss WHERE pvss.seller_id =".$seller_id." AND pvss.shipping_country = '".$address['shipping_country_id']."'";
						 if(!is_numeric($address['shipping_postcode'])) {
						 $sql .= " AND pvss.zipcode_from = '".$address['shipping_postcode']."' AND pvss.zipcode_to = '".$address['shipping_postcode']."'";
						 }
						 $shippingqery = $this->db->query($sql)->rows;
			}
						if(!empty($shippingqery)) {
							$shipprice = array();
							foreach($shippingqery as $shipp) {
								if($totalweight >= $shipp['weight_from'] && $totalweight <= $shipp['weight_to']) {
								 if(($shipp['zipcode_from'] == '')&&($shipp['zipcode_to'] == '')) {
							$shipprice[] = $shipp['shipping_price'];
					           }else{
									 if(is_numeric($address['shipping_postcode'])) {
										 if($address['shipping_postcode'] >= $shipp['zipcode_from'] && $address['shipping_postcode'] <= $shipp['zipcode_to']) {
											$shipprice[] = $shipp['shipping_price'];
										 }
									 } else {
										$shipprice[] = $shipp['shipping_price'];
									 }
							   }
								}
							}

							if(!empty($shipprice)) {
								return max($shipprice);
							}
								
						}
						if(empty($shipprice)){
						  $sql = "SELECT * FROM " . DB_PREFIX . "purpletree_vendor_shipping pvss WHERE pvss.seller_id =".$seller_id." AND pvss.shipping_country = '".$address['shipping_country_id']."'";
						 if(!is_numeric($address['shipping_postcode'])) {
						 $sql .= " AND pvss.zipcode_from = '".$address['shipping_postcode']."' AND pvss.zipcode_to = '".$address['shipping_postcode']."'";
						 }
						 $shippingqery = $this->db->query($sql)->rows;
			
						if(!empty($shippingqery)) {
							$shipprice = array();
							foreach($shippingqery as $shipp) {
								if($totalweight >= $shipp['weight_from'] && $totalweight <= $shipp['weight_to']) {
								 if(($shipp['zipcode_from'] == '')&&($shipp['zipcode_to'] == '')) {
							$shipprice[] = $shipp['shipping_price'];
					           }else{
									 if(is_numeric($address['shipping_postcode'])) {
										 if($address['shipping_postcode'] >= $shipp['zipcode_from'] && $address['shipping_postcode'] <= $shipp['zipcode_to']) {
											$shipprice[] = $shipp['shipping_price'];
										 }
									 } else {
										$shipprice[] = $shipp['shipping_price'];
									 }
							   }
								}
							}

							if(!empty($shipprice)) {
								return max($shipprice);
							}
								
						}
						}
			}else{
				$sql = "SELECT * FROM  " . DB_PREFIX . "zone_to_geo_zone ztgz INNER JOIN " . DB_PREFIX . "purpletree_vendor_geozone pvz ON (ztgz.geo_zone_id = pvz.geo_zone_id) WHERE pvz.seller_id =".$seller_id." AND ztgz.country_id = '" . (int)$address['shipping_country_id'] . "' AND (ztgz.zone_id = '" . (int)$address['shipping_zone_id'] . "' OR ztgz.zone_id = '0')";

					$shippingqery = $this->db->query($sql)->rows;
					if(!empty($shippingqery)) {
						$shipprice = array();
						foreach($shippingqery as $shipp) {
						if($totalweight >= $shipp['weight_from'] && $totalweight <= $shipp['weight_to']) {
							$shipprice[] = $shipp['price'];
							}
						}
						if(!empty($shipprice)) {
							return max($shipprice);
						}
					}
					return '0';
			}
	}
	public function getoptionsweight($product){
		$productsql = "SELECT weight,weight_class_id FROM ".DB_PREFIX."product WHERE product_id =".$product['product_id']."";
				$productquery = $this->db->query($productsql)->row;
				$totweight = $productquery['weight'];
			if(!empty($product['option'])) {
				foreach($product['option'] as $productsoptin) {
					$productsql1 = "SELECT pov.weight,pov.weight_prefix,p.weight_class_id FROM ".DB_PREFIX."product p JOIN ". DB_PREFIX ."product_option_value pov ON(pov.product_id = p.product_id) WHERE pov.product_option_value_id = '".$productsoptin['product_option_value_id']."' AND pov.product_option_id = '".$productsoptin['product_option_id']."' AND pov.product_id = '".$product['product_id']."' AND pov.option_id = '".$productsoptin['option_id']."' AND pov.option_value_id = '".$productsoptin['option_value_id']."'";
					$productquery1 = $this->db->query($productsql1)->row;
					if(!empty($productquery1)){
						if ($productquery1['weight_prefix'] == '+') {
							$totweight += $totweight+($productquery1['weight'] * $product['quantity']);	
						} elseif ($product_option_value_info['weight_prefix'] == '-') {
							$totweight -= $totweight-($productquery1['weight'] * $product['quantity']);
						}
					}
				}
			} else {
					$totweight = $totweight * $product['quantity'];
			}
		$totalweight = $this->weight->convert($totweight, $productquery['weight_class_id'], $this->config->get('config_weight_class_id'));
		return $totalweight;
	}	
	public function getShippingCharge($productid){		
		$sql = "SELECT 	shipping_charge FROM " . DB_PREFIX . "product WHERE product_id = '".(int)$productid."'"; 
		
		  $query = $this->db->query($sql);
		  
		  if($query->num_rows){		
				return $query->row['shipping_charge'];
			 }else{
				return null;
			 }	
		}
		public function getsellershipping($seller_shipping,$product,$address) {

		if($seller_shipping['seller_id'] == '0'){
	
				$shipping_purpletree_shipping_type = (null !== $this->config->get('shipping_purpletree_shipping_type'))? $this->config->get('shipping_purpletree_shipping_type') : 'pts_flat_rate_shipping';
			$shipping_purpletree_shipping_order_type = (null !== $this->config->get('shipping_purpletree_shipping_order_type'))? $this->config->get('shipping_purpletree_shipping_order_type') : 'pts_product_wise';
			$shipping_purpletree_shipping_charge = (null !== $this->config->get('shipping_purpletree_shipping_charge'))? $this->config->get('shipping_purpletree_shipping_charge') : '0';

		} else {
		$shipping_purpletree_shipping_type 			= $seller_shipping['store_shipping_type'] != '' ? $seller_shipping['store_shipping_type'] : 'pts_flat_rate_shipping';
		$shipping_purpletree_shipping_order_type 	= $seller_shipping['store_shipping_order_type'] != '' ? $seller_shipping['store_shipping_order_type'] : 'pts_product_wise';
		$shipping_purpletree_shipping_charge 		= $seller_shipping['store_shipping_charge'] != '' ? $seller_shipping['store_shipping_charge'] : '0';
		}
		$total = 0;
		$product_shipping_charge = '';
		$product_shipping_charge = $this->getShippingCharge($product['product_id']);
		 if(isset($product_shipping_charge)){
		 if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
						$total += $product_shipping_charge;
			}else{
			           $total += $product_shipping_charge*$product['quantity'];	
			}
		    }else{
		$totalweight = $this->getoptionsweight($product);
		$getMatrixShippingCharge = $this->getMatrixShippingCharge($address,$totalweight,$seller_shipping['seller_id']);
		// if Matric shipping
		
		if($shipping_purpletree_shipping_type == 'pts_matrix_shipping'){
			if(!$this->config->get('module_purpletree_multivendor_shippingtype')){
				//if($address['shipping_postcode'] != '') {
					if($shipping_purpletree_shipping_order_type == 'pts_product_wise'){
						if($getMatrixShippingCharge) {
							$total = $getMatrixShippingCharge;
						}
					} 
				//}	
			} else{
				if($shipping_purpletree_shipping_order_type == 'pts_product_wise'){
					if($getMatrixShippingCharge) {
						$total = $getMatrixShippingCharge;
					}
				} 
			}			
		} // if Matric shipping
		// if Flexible shipping
		elseif($shipping_purpletree_shipping_type  == 'pts_flexible_shipping'){
		if(!$this->config->get('module_purpletree_multivendor_shippingtype')){
			//if($address['shipping_postcode'] != '') {
				if($shipping_purpletree_shipping_order_type == 'pts_product_wise'){
					if($getMatrixShippingCharge) {
						 $total = $getMatrixShippingCharge;
					} else {
						 $total = $shipping_purpletree_shipping_charge;
					}
				}
			/* } else {
				if($shipping_purpletree_shipping_order_type == 'pts_product_wise'){
					 $total = $shipping_purpletree_shipping_charge;
				}
			} */
		} else {
			if($shipping_purpletree_shipping_order_type == 'pts_product_wise'){
				if($getMatrixShippingCharge) {
					 $total = $getMatrixShippingCharge;
				} else {
					$total = $shipping_purpletree_shipping_charge;
				}
			}
		}
	} // if Flexible shipping
		// if Flat Rate shipping
			else {
			if($shipping_purpletree_shipping_order_type == 'pts_product_wise'){
				 $total = $shipping_purpletree_shipping_charge;
			}
		}
		
		// if Flat Rate shipping
		}
		return $total;	
	}
	public function getsellershipping1($seller_shipping,$product,$address) {
		if($seller_shipping['seller_id'] == '0'){
			$shipping_purpletree_shipping_type = (null !== $this->config->get('shipping_purpletree_shipping_type'))? $this->config->get('shipping_purpletree_shipping_type') : 'pts_flat_rate_shipping';
			$shipping_purpletree_shipping_order_type = (null !== $this->config->get('shipping_purpletree_shipping_order_type'))? $this->config->get('shipping_purpletree_shipping_order_type') : 'pts_product_wise';
			$shipping_purpletree_shipping_charge = (null !== $this->config->get('shipping_purpletree_shipping_charge'))? $this->config->get('shipping_purpletree_shipping_charge') : '0';

		} else {
		$shipping_purpletree_shipping_type 			= $seller_shipping['store_shipping_type'] != '' ? $seller_shipping['store_shipping_type'] : 'pts_flat_rate_shipping';
		$shipping_purpletree_shipping_order_type 	= $seller_shipping['store_shipping_order_type'] != '' ? $seller_shipping['store_shipping_order_type'] : 'pts_product_wise';
		$shipping_purpletree_shipping_charge 		= $seller_shipping['store_shipping_charge'] != '' ? $seller_shipping['store_shipping_charge'] : '0';
		}
		$weightt = 0;
		// if Matric shipping
		if($shipping_purpletree_shipping_type == 'pts_matrix_shipping'){
			//if($address['shipping_postcode'] != '') {
				if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
					 $weightt = $this->getoptionsweight($product);
				}
			//}					
		}// if Matric shipping
		// if Flexible shipping
		elseif($shipping_purpletree_shipping_type  == 'pts_flexible_shipping'){
			//if($address['shipping_postcode'] != '') {
				if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
					  $weightt = $this->getoptionsweight($product);
				}
			/* } else {
				if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
				 $weightt = $this->getoptionsweight($product);
				}
			} */
		} // if Flexible shipping
		// if Flat Rate shipping
			else {
			if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
				 
				  $weightt = $this->getoptionsweight($product);
			}
		}
		
		// if Flat Rate shipping
		return $weightt;	
	}
	public function getsellerInfofororder($sellerid) { 	
		    $query = $this->db->query("SELECT pvs.store_name, pvs.id AS store_id FROM " . DB_PREFIX . "purpletree_vendor_stores pvs  WHERE pvs.seller_id = '" . (int)$sellerid . "'");    
		     return $query->row;
		 
	}
	public function getOrderedProductsellerid($order_id,$product_id) {
		$query = $this->db->query("SELECT seller_id FROM `" . DB_PREFIX . "purpletree_vendor_orders` WHERE order_id = '" . (int)$order_id . "' AND product_id = '" . (int)$product_id . "' ");
		if(!empty($query->row['seller_id'])){
			return $query->row['seller_id'];
		}else{
			return null;
		}
	}
}
?>