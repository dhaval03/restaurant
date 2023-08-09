<?php
namespace Opencart\Catalog\Model\Extension\PurpletreeMultivendor\Shipping;
class PurpletreeShipping extends \Opencart\System\Engine\Model {
	function __construct($registry){
		parent::__construct($registry);	
		 $this->logger = $registry->get('log');
	}
	
	function getQuote($address) {
			$this->load->language('extension/purpletree_multivendor/shipping/purpletree_shipping');
			//$this->logger->write('purpletree Shipping');
			$method_data = array();
			$quote_data = array();
			$getshippingcharge = (string)$this->getSellerShippingCharge($address);
			// if($getshippingcharge == '0') {
			// $getshippingcharge = '0';
			// }
			if($getshippingcharge != 'a') {
				if( $getshippingcharge != '') {
					// if($getshippingcharge == '') {
					// $getshippingcharge = 0 ;
					// }
					$quote_data['purpletree_shipping'] = array(
					'code'         => 'purpletree_shipping.purpletree_shipping',
					'title'        => $this->language->get('text_title'),
					'cost'         => $getshippingcharge,
					'tax_class_id' => 0,
					'text'         => $this->currency->format($getshippingcharge, $this->session->data['currency'])
					);
					
					$method_data = array(
					'code'       => 'purpletree_shipping',
					'title'      => $this->language->get('text_title'),
					'quote'      => $quote_data,
					'sort_order' => $this->config->get('shipping_purpletree_shipping_sort_order'),
					'error'      => false
					);
				}
			}
			return $method_data;
		}
	public function getSellerShippingCharge($address){
	
	$total = 'a';
	$orderWiseWeightArray 	= array();
	$weight 				= array();
	$store_shipping_type 	= array();
	$store_shipping_charge  = array();
	$tot 					= array();
	$seller_order_wise 		= array();
	//Seller GeoZone Shipping
	if($this->config->get('module_purpletree_multivendor_shippingtype')){
		$getProducts = $this->load->controller('extension/purpletree_multivendor/multivendor/events/checkout/cart|getCartProducts');
		foreach ($getProducts as $product) {		
			$tot = array();
			$seller_shipping = $this->db->query("SELECT pvs.store_shipping_charge,pvs.store_shipping_order_type,pvs.store_shipping_type,pvs.seller_id FROM " . DB_PREFIX . "purpletree_vendor_stores pvs JOIN " . DB_PREFIX. "purpletree_vendor_products pvp ON(pvp.seller_id=pvs.seller_id) WHERE pvp.product_id = '".$product['product_id']."' AND pvp.is_approved=1")->row;
			
			$template_product = $this->db->query("SELECT * FROM  " . DB_PREFIX. "purpletree_vendor_template WHERE product_id = '".$product['product_id']."'")->num_rows;
		if($template_product){
		if($this->config->get('module_purpletree_multivendor_seller_product_template')){
			$seller_shipping = $this->db->query("SELECT pvs.store_shipping_charge,pvs.store_shipping_order_type,pvs.store_shipping_type,pvs.seller_id FROM " . DB_PREFIX . "purpletree_vendor_stores pvs WHERE pvs.seller_id = '".$product['seller_id']."'")->row;
			}
		}
			//Check Seller id store_shipping_charge
			if(isset($seller_shipping['seller_id'])){
				$shipping_purpletree_shipping_type 			= $seller_shipping['store_shipping_type'] != '' ? $seller_shipping['store_shipping_type']:'pts_flat_rate_shipping' ;
				$shipping_purpletree_shipping_order_type 	= $seller_shipping['store_shipping_order_type'] != '' ? $seller_shipping['store_shipping_order_type']:'pts_product_wise' ;
				$shipping_purpletree_shipping_charge 		= $seller_shipping['store_shipping_charge'];
			} else {
				$seller_shipping['seller_id'] = 0;
				$shipping_purpletree_shipping_type = (null !== $this->config->get('shipping_purpletree_shipping_type'))? $this->config->get('shipping_purpletree_shipping_type') : 'pts_flat_rate_shipping';
				$shipping_purpletree_shipping_order_type = (null !== $this->config->get('shipping_purpletree_shipping_order_type'))? $this->config->get('shipping_purpletree_shipping_order_type') : 'pts_product_wise';
				$shipping_purpletree_shipping_charge = (null !== $this->config->get('shipping_purpletree_shipping_charge'))? $this->config->get('shipping_purpletree_shipping_charge') : '0';
			}
			 if(isset($product['shipping_charge'])){
		    if($total == 'a') {
								$total = '0';
					}
		    if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
					   $total += $product['shipping_charge'];
			}else{
			           $total += $product['shipping_charge']*$product['quantity'];	
			}
		    }else{	
				$store_shipping_type[$seller_shipping['seller_id']] = $shipping_purpletree_shipping_type;
				$store_shipping_charge[$seller_shipping['seller_id']] = $shipping_purpletree_shipping_charge;
				$totalweight = $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
				$getMatrixGeoZoneShippingCharge = $this->getSellerGeoZoneShippingCharge($address,$seller_shipping['seller_id'],$totalweight);
				// if Matric shipping
				if($shipping_purpletree_shipping_type == 'pts_matrix_shipping'){
					if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
						 $seller_order_wise_weight[$seller_shipping['seller_id']][]=$totalweight;
						 
						 
					} else {
						if($getMatrixGeoZoneShippingCharge) {
							if($total == 'a') {
								$total = '0';
							}
							$tot[$seller_shipping['seller_id']] = $getMatrixGeoZoneShippingCharge;
							$total += $tot[$seller_shipping['seller_id']];
						} else {
							return 'a';
						}
						
					} 				
				} elseif($shipping_purpletree_shipping_type  == 'pts_flexible_shipping'){
					// if Flexible shipping
					if($address['postcode'] != '') {
						if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
							   $seller_order_wise_weight[$seller_shipping['seller_id']][]=$totalweight;

						} else {
							if($getMatrixGeoZoneShippingCharge) {
								$tot[$seller_shipping['seller_id']] = $getMatrixGeoZoneShippingCharge;
								if($total == 'a') {
								$total = '0';
							}
								$total += $tot[$seller_shipping['seller_id']];
							} else {
								$tot[$seller_shipping['seller_id']] = $shipping_purpletree_shipping_charge;
								if($total == 'a') {
								$total = '0';
							}
								$total += $tot[$seller_shipping['seller_id']];
							}
						}
					} else {
						if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
						 $seller_order_wise_weight[$seller_shipping['seller_id']][]=$totalweight;
						} else {
							$tot[$seller_shipping['seller_id']] = $shipping_purpletree_shipping_charge;
							if($total == 'a') {
								$total = '0';
							}
							$total += $tot[$seller_shipping['seller_id']];
						}
					}
				} else {
						// if Flat Rate shipping
					if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
						$seller_order_wise_weight[$seller_shipping['seller_id']][]=$totalweight;
					} else {
						$tot[$seller_shipping['seller_id']] = $shipping_purpletree_shipping_charge;
						if($total == 'a') {
								$total = '0';
							}
							if($tot[$seller_shipping['seller_id']]==NULL){
								$total='';
								break;
							}
								$total += $tot[$seller_shipping['seller_id']];
					}
				}
				// if Flat Rate shipping
		}
		}
		// weight wise

		if(!empty($seller_order_wise_weight)){
			foreach($seller_order_wise_weight as $seller_id=>$weightData){
				$tempweight=0;
				foreach($weightData as $weight){
					$tempweight+=$weight;	
				}
				$orderWiseData[$seller_id]=$tempweight;
			}
			
		}
		// weight wise seller_order_wise

		if(!empty($orderWiseData)) {
			foreach($orderWiseData as $sellerid=>$weight) {
				$getSellerGeoZoneShippingCharge1 = $this->getSellerGeoZoneShippingCharge($address,$sellerid,$weight);
				if($store_shipping_type[$sellerid] == 'pts_matrix_shipping') {
						if($getSellerGeoZoneShippingCharge1) {
						if($total == 'a') {
								$total = '0';
							}
							$total += $getSellerGeoZoneShippingCharge1;
						} else {						
							return 'a';
						}
					
				} elseif($store_shipping_type[$sellerid] == 'pts_flexible_shipping') {
					if($getSellerGeoZoneShippingCharge1) {
					if($total == 'a') {
								$total = '0';
							}
							if($getSellerGeoZoneShippingCharge1==NULL){
								$total='';
								break;
							}	
						$total += $getSellerGeoZoneShippingCharge1;
					} else {
					if($total == 'a') {
								$total = '0';
							}
						if($store_shipping_charge[$sellerid]==NULL){
								$total='';
								break;
							}	
						$total += $store_shipping_charge[$sellerid];
					}
				} elseif($store_shipping_type[$sellerid] == 'pts_flat_rate_shipping') {
				if($total == 'a') {
								$total = '0';
							}
					if($store_shipping_charge[$sellerid]==NULL){
								$total='';
								break;
							}		
					$total += $store_shipping_charge[$sellerid];
				}
			}
		
		}
		return $total;
		//End GeoZone Shipping
	} else {
		$total = 'a';
		$orderWiseWeightArray 	= array();
		$weight 				= array();
		$store_shipping_type 	= array();
		$store_shipping_charge  = array();
		$getProducts = $this->load->controller('extension/purpletree_multivendor/multivendor/events/checkout/cart|getCartProducts');
		foreach ($getProducts as $product) {		    
			$tot = array();
			$seller_shipping = $this->db->query("SELECT pvs.store_shipping_charge,pvs.store_shipping_order_type,pvs.store_shipping_type,pvs.seller_id FROM " . DB_PREFIX . "purpletree_vendor_stores pvs JOIN " . DB_PREFIX. "purpletree_vendor_products pvp ON(pvp.seller_id=pvs.seller_id) WHERE pvp.product_id = '".$product['product_id']."' AND pvp.is_approved=1")->row;
			
			$template_product = $this->db->query("SELECT * FROM  " . DB_PREFIX. "purpletree_vendor_template WHERE product_id = '".$product['product_id']."'")->num_rows;
		if($template_product){
		if($this->config->get('module_purpletree_multivendor_seller_product_template')){
			$seller_shipping = $this->db->query("SELECT pvs.store_shipping_charge,pvs.store_shipping_order_type,pvs.store_shipping_type,pvs.seller_id FROM " . DB_PREFIX . "purpletree_vendor_stores pvs WHERE pvs.seller_id = '".$product['seller_id']."'")->row;
			}
		}
			//echo $seller_shipping['store_shipping_order_type'];
			//Check Seller id store_shipping_charge
			if(isset($seller_shipping['seller_id'])){
				$shipping_purpletree_shipping_type 			= $seller_shipping['store_shipping_type'] != '' ? $seller_shipping['store_shipping_type']:'pts_flat_rate_shipping' ;
				$shipping_purpletree_shipping_order_type 	= $seller_shipping['store_shipping_order_type'] != '' ? $seller_shipping['store_shipping_order_type']:'pts_product_wise' ;
				$shipping_purpletree_shipping_charge 		= $seller_shipping['store_shipping_charge'];
			} else {
				$seller_shipping['seller_id'] = 0;
				$shipping_purpletree_shipping_type = (null !== $this->config->get('shipping_purpletree_shipping_type'))? $this->config->get('shipping_purpletree_shipping_type') : 'pts_flat_rate_shipping';
				$shipping_purpletree_shipping_order_type = (null !== $this->config->get('shipping_purpletree_shipping_order_type'))? $this->config->get('shipping_purpletree_shipping_order_type') : 'pts_product_wise';
				$shipping_purpletree_shipping_charge = (null !== $this->config->get('shipping_purpletree_shipping_charge'))? $this->config->get('shipping_purpletree_shipping_charge') : '0';
			}
			  if(isset($product['shipping_charge'])){
			      if($total == 'a') {
								$total = '0';
					}
				if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
						$total += $product['shipping_charge'];
				}else{
						$total += $product['shipping_charge']*$product['quantity'];	
				}		
		    }else{
				$store_shipping_type[$seller_shipping['seller_id']] = $shipping_purpletree_shipping_type;
				$store_shipping_charge[$seller_shipping['seller_id']] = $shipping_purpletree_shipping_charge;
				$totalweight = $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
				$getMatrixShippingCharge = $this->getMatrixShippingCharge($address,$totalweight,$seller_shipping['seller_id']);
				// if Matric shipping
				if($shipping_purpletree_shipping_type == 'pts_matrix_shipping'){
					//if($address['postcode'] != '') {
						if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
							//if { }
							 $weightt = $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
							 //echo $weightt.'--';
							 $weight[$seller_shipping['seller_id']] = $weightt;
							 if(!isset($orderWiseWeightArray[$seller_shipping['seller_id']])){
								$orderWiseWeightArray[$seller_shipping['seller_id']] = $weight[$seller_shipping['seller_id']];
							 } else {
								$orderWiseWeightArray[$seller_shipping['seller_id']] += $weight[$seller_shipping['seller_id']];
							 }
						} else {
						//if($shipping_purpletree_shipping_order_type == 'pts_product_wise'){
							if($getMatrixShippingCharge) {
							if($total == 'a') {
								$total = '0';
							}
								$tot[$seller_shipping['seller_id']] = $getMatrixShippingCharge;
								$total += $tot[$seller_shipping['seller_id']];
							} else {
								//echo "r3";
								return 'a';
							}
						} 
					/* } else {
						//echo "r4";
						return 'a';
					} */					
				}// if Matric shipping
				// if Flexible shipping
				elseif($shipping_purpletree_shipping_type  == 'pts_flexible_shipping'){
					//if($address['postcode'] != '') {
						if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
							  $weightt = $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
							 $weight[$seller_shipping['seller_id']] = $weightt;
							 if(!isset($orderWiseWeightArray[$seller_shipping['seller_id']])){
								$orderWiseWeightArray[$seller_shipping['seller_id']] = $weight[$seller_shipping['seller_id']];
							 } else {
								$orderWiseWeightArray[$seller_shipping['seller_id']] += $weight[$seller_shipping['seller_id']];
							 }
						} else {
						//if($shipping_purpletree_shipping_order_type == 'pts_product_wise'){
							if($getMatrixShippingCharge) {
								$tot[$seller_shipping['seller_id']] = $getMatrixShippingCharge;
								
								if($total == 'a') {
								$total = '0';
							}
								$total += $tot[$seller_shipping['seller_id']];
							} else {
								$tot[$seller_shipping['seller_id']] = $shipping_purpletree_shipping_charge;
								if($total == 'a') {
								$total = '0';
							}
								$total += $tot[$seller_shipping['seller_id']];
							}
						}
					//} else {
						/* if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
						  $weightt = $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
							 $weight[$seller_shipping['seller_id']] = $weightt;
							 if(!isset($orderWiseWeightArray[$seller_shipping['seller_id']])){
								$orderWiseWeightArray[$seller_shipping['seller_id']] = $weight[$seller_shipping['seller_id']];
							 } else {
								$orderWiseWeightArray[$seller_shipping['seller_id']] += $weight[$seller_shipping['seller_id']];
							 }
						} else {
						//if($shipping_purpletree_shipping_order_type == 'pts_product_wise'){
							$tot[$seller_shipping['seller_id']] = $shipping_purpletree_shipping_charge;
							if($total == 'a') {
								$total = '0';
							}
							$total += $tot[$seller_shipping['seller_id']];
						} 
					}*/
				} // if Flexible shipping
				// if Flat Rate shipping
				//elseif($shipping_purpletree_shipping_type  == 'pts_flat_rate_shipping'){
					else {
					if($shipping_purpletree_shipping_order_type == 'pts_order_wise'){
						 $weightt = $this->weight->convert($product['weight'], $product['weight_class_id'], $this->config->get('config_weight_class_id'));
							 $weight[$seller_shipping['seller_id']] = $weightt;
							 if(!isset($orderWiseWeightArray[$seller_shipping['seller_id']])){
								$orderWiseWeightArray[$seller_shipping['seller_id']] = $weight[$seller_shipping['seller_id']];
							 } else {
								$orderWiseWeightArray[$seller_shipping['seller_id']] += $weight[$seller_shipping['seller_id']];
							 }
					} else {
					//if($shipping_purpletree_shipping_order_type == 'pts_product_wise'){
						$tot[$seller_shipping['seller_id']] = $shipping_purpletree_shipping_charge;
						if($total == 'a') {
								$total = '0';
							}
							//var_dump($tot[$seller_shipping['seller_id']]);
							if($tot[$seller_shipping['seller_id']]==NULL){
								$total='';
								break;
							}
								$total += $tot[$seller_shipping['seller_id']];
					}
				}
				// if Flat Rate shipping
		}
		}
		if(!empty($orderWiseWeightArray)) {
			foreach($orderWiseWeightArray as $sellerid => $totalweight) {
				$getMatrixShippingCharge1 = $this->getMatrixShippingCharge($address,$totalweight,$sellerid);
				if($store_shipping_type[$sellerid] == 'pts_matrix_shipping') {
					if($address['postcode'] != '') {
						if($getMatrixShippingCharge1) {
						if($total == 'a') {
								$total = '0';
							}
							$total += $getMatrixShippingCharge1;
						} else {
							//echo "r5";							
							return 'a';
						}
					} else {
						//echo "r6";
						return 'a';
					}
				} elseif($store_shipping_type[$sellerid] == 'pts_flexible_shipping') {
					if($getMatrixShippingCharge1) {
					if($total == 'a') {
								$total = '0';
							}
							if($getMatrixShippingCharge1==NULL){
								$total='';
								break;
							}	
						$total += $getMatrixShippingCharge1;
					} else {
					if($total == 'a') {
								$total = '0';
							}
						if($store_shipping_charge[$sellerid]==NULL){
								$total='';
								break;
							}	
						$total += $store_shipping_charge[$sellerid];
					}
				} elseif($store_shipping_type[$sellerid] == 'pts_flat_rate_shipping') {
				if($total == 'a') {
								$total = '0';
							}
					if($store_shipping_charge[$sellerid]==NULL){
								$total='';
								break;
							}		
					$total += $store_shipping_charge[$sellerid];
				}
			}
		}
		return $total;
	}
}
public function getMatrixShippingCharge($address,$totalweight,$seller_id,$aa = 'bb'){
             $seller_id2 = -1;
			 $sql2 = "SELECT * FROM " . DB_PREFIX . "purpletree_vendor_shipping pvss WHERE pvss.seller_id =".$seller_id2." AND pvss.shipping_country = '".$address['country_id']."'";
			 if($address['postcode'] != '') {
				 if(!is_numeric($address['postcode'])) {
				 $sql2 .= " AND pvss.zipcode_from = '".$address['postcode']."' AND pvss.zipcode_to = '".$address['postcode']."'";
				 }
			 }
			 if($this->db->query($sql2)->num_rows){		
				$shippingqery = $this->db->query($sql2)->rows;
			 }else{
				$sql = "SELECT * FROM " . DB_PREFIX . "purpletree_vendor_shipping pvss WHERE pvss.seller_id =".$seller_id." AND pvss.shipping_country = '".$address['country_id']."'";
				 if($address['postcode'] != '') {
						 if(!is_numeric($address['postcode'])) {
						 $sql .= " AND pvss.zipcode_from = '".$address['postcode']."' AND pvss.zipcode_to = '".$address['postcode']."'";
						 }
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
					       if(is_numeric($address['postcode'])) {
							 if($address['postcode'] >= $shipp['zipcode_from'] && $address['postcode'] <= $shipp['zipcode_to']) {
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
			$sql = "SELECT * FROM " . DB_PREFIX . "purpletree_vendor_shipping pvss WHERE pvss.seller_id =".$seller_id." AND pvss.shipping_country = '".$address['country_id']."'";
				 if($address['postcode'] != '') {
						 if(!is_numeric($address['postcode'])) {
						 $sql .= " AND pvss.zipcode_from = '".$address['postcode']."' AND pvss.zipcode_to = '".$address['postcode']."'";
						 }
				 }
			    $shippingqery = $this->db->query($sql)->rows;
			 
			if(!empty($shippingqery)) {
				$shipprice = array();
				foreach($shippingqery as $shipp) {
					if($totalweight >= $shipp['weight_from'] && $totalweight <= $shipp['weight_to']) {
						 if(($shipp['zipcode_from'] == '')&&($shipp['zipcode_to'] == '')) {
							$shipprice[] = $shipp['shipping_price'];
					 }else{
					       if(is_numeric($address['postcode'])) {
							 if($address['postcode'] >= $shipp['zipcode_from'] && $address['postcode'] <= $shipp['zipcode_to']) {
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
			return '0';
		}
	public function getSellerGeoZoneShippingCharge($address,$seller_id,$weight){
		$sql = "SELECT * FROM  " . DB_PREFIX . "zone_to_geo_zone ztgz INNER JOIN " . DB_PREFIX . "purpletree_vendor_geozone pvz ON (ztgz.geo_zone_id = pvz.geo_zone_id) WHERE pvz.seller_id =".$seller_id." AND ztgz.country_id = '" . (int)$address['country_id'] . "' AND (ztgz.zone_id = '" . (int)$address['zone_id'] . "' OR ztgz.zone_id = '0')";

		$sql.= " AND (pvz.weight_from <=".(float)$weight." AND pvz.weight_to >=".(float)$weight.")";	

		$shippingqery = $this->db->query($sql)->rows;
		if(!empty($shippingqery)) {
			$shipprice = array();
			foreach($shippingqery as $shipp) {
				$shipprice[] = $shipp['price'];
			}
			if(!empty($shipprice)) {
				return max($shipprice);
			}
		}
		return '0';
	}
}
?>