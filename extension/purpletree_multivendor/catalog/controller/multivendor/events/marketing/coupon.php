<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Marketing;
class Coupon extends \Opencart\System\Engine\Controller {
	// model/catalog/marketing/coupon/getCoupon/after
	public function getCouponAfter(&$route, &$data, &$output) {
		$code = $data[0];
		if(!empty($output)){
			$status = true; 
		$coupon_id = $output['coupon_id'];
		
		$seller_coupon = $this->db->query("SELECT pvc.seller_id FROM `" . DB_PREFIX . "purpletree_vendor_coupons` pvc  WHERE pvc.seller_id != '0' AND coupon_id = '".$coupon_id."'");
		if ($seller_coupon->num_rows>0) {
			$seller_id = $seller_coupon->row['seller_id'];
		} else {
			$seller_id = 0;
		}
		
		if($seller_id != -1){
			if ($output['total'] > $this->getSellerSubTotal($seller_id)) {
				$status = false;
			}	
		}
		
		
		if($seller_id != -1){
		$seller_coupon_total = $this->getSellerTotalCouponHistoriesByCoupon($output['code']);
			if ($output['uses_total'] > 0 && ($seller_coupon_total >= $output['uses_total'])) {
				$status = false;
			}
		}
		
		// Products
			$coupon_product_data = array();
 
			$coupon_product_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "coupon_product` WHERE coupon_id = '" . (int)$output['coupon_id'] . "'");

			foreach ($coupon_product_query->rows as $product) {
				$coupon_product_data[] = $product['product_id'];
			}

			// Categories
			$coupon_category_data = array();

			$coupon_category_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "coupon_category` cc LEFT JOIN `" . DB_PREFIX . "category_path` cp ON (cc.category_id = cp.path_id) WHERE cc.coupon_id = '" . (int)$output['coupon_id'] . "'");

			foreach ($coupon_category_query->rows as $category) {
				$coupon_category_data[] = $category['category_id'];
			}

		$product_data = array();
		$continueee = true;
		if($seller_id != -1){
		$continueee = false;
		foreach ($this->getsellerProducts($seller_id) as $product) {
			if (in_array($product['product_id'], $coupon_product_data)) {
					$product_data[] = $product['product_id'];
					$continueee = true;
					continue;
				}elseif(empty($coupon_product_data)&& ($product['product_id'] > 0)){
				 $continueee = true;
				}
				foreach ($coupon_category_data as $category_id) {
					$coupon_category_query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "product_to_category` WHERE `product_id` = '" . (int)$product['product_id'] . "' AND category_id = '" . (int)$category_id . "'");

					if ($coupon_category_query->row['total']) {
						$product_data[] = $product['product_id'];
						$continueee = true;
						continue;
					}
				}
				if(!$continueee) {
					$status = false;
				}
			}
		}
		
		if (!$product_data && ($continueee != 1)) {
			$status = false;
		}
		
		if(!$status){
		$output = array();
		}
		}		
	}
	
	public function getSellerSubTotal($seller_id) {
		$total = 0;

		foreach ($this->getSellerProducts($seller_id) as $product) {
			$total += $product['total'];
		}

		return $total;
	}
	
	public function getSellerProducts($seller_id) {
		$cart_proid=array();
		$seller_proid=array();
		$allproid=array();
		$all_products = $this->cart->getProducts();
		foreach ($all_products as $key=>$value) {
			$seller_cart_id=$this->getSellerId($value['cart_id']);
			//$allproid[]=$value['product_id'];	
			$query = $this->db->query("SELECT product_id  FROM " . DB_PREFIX . "purpletree_vendor_products WHERE seller_id='".$seller_id."' AND product_id='".(int)$value['product_id']."'");
			if(empty($query->rows)){
						$query = $this->db->query("SELECT pvt.product_id, pvtp.seller_id FROM " . DB_PREFIX . "purpletree_vendor_template pvt JOIN " . DB_PREFIX . "purpletree_vendor_template_products pvtp ON(pvt.id=pvtp.template_id) WHERE pvtp.seller_id='".$seller_id."' AND pvt.product_id='".(int)$value['product_id']."'");
				$products_id=array();
			if(!empty($query->rows)){
				foreach($query->rows as $key=>$val){
					if($val['seller_id']==$seller_cart_id){
					$products_id[]=	array('product_id'=>$val['product_id']);
					}
				}
			}
				$query->rows=$products_id;
			}		
				foreach ($query->rows as $key1=>$value1) {
				$seller_proid[]=$value1['product_id'];	
			}
		}

		foreach ($all_products as $value) {
			if (in_array($value['product_id'],$seller_proid)){
				$cart_proid[] = $value;	
			}
		}
		return $cart_proid;

	}
	
	public function getSellerId($cart_id) {
		$query = $this->db->query("SELECT seller_id  FROM " . DB_PREFIX . "purpletree_vendor_cart WHERE cart_id='".$cart_id."'");
			if($query->num_rows){
				return $query->row['seller_id'];
			}
		return null;
	}
	public function getSellerTotalCouponHistoriesByCoupon($coupon) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "coupon_history` ch LEFT JOIN `" . DB_PREFIX . "coupon` c ON (ch.coupon_id = c.coupon_id) LEFT JOIN `" . DB_PREFIX . "purpletree_vendor_coupons` pot ON (pot.coupon_id = ch.coupon_id) WHERE c.code = '" . $this->db->escape($coupon) . "'");	
		
		return $query->row['total'];
	}
	public function getsellercounponTotal($product_idd) {
		if (isset($this->session->data['coupon'])) {

		$seller_idby_coupon = $this->db->query("SELECT pvc.seller_id,co.* FROM `" . DB_PREFIX . "coupon` co Inner JOIN `" . DB_PREFIX . "purpletree_vendor_coupons` pvc ON (co.coupon_id = pvc.coupon_id) WHERE code = '" . $this->db->escape($this->session->data['coupon']) . "' AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1' AND pvc.seller_id >= '1'");
		if($seller_idby_coupon->num_rows){
			$seller_id =  $seller_idby_coupon->row['seller_id'];
		}else{
			$seller_id = 0;
		}
		
			$this->load->language('extension/total/coupon', 'coupon');

			$coupon_info = $this->getCoupon($this->session->data['coupon']);

			if ($coupon_info) {
				$discount_total = 0;

				if (!$coupon_info['product']) {

		if ($seller_id!= 0 && $seller_id != -1) {
			$sub_total = $this->cart->getSellerSubTotal($seller_id);
		}else{
		
					$sub_total = $this->cart->getSubTotal();

		}
		
				} else {
					$sub_total = 0;

				if ($seller_id != 0 && $seller_id != -1) {
					foreach ($this->cart->getSellerProducts($seller_id) as $product) {
						if($product_idd == $product['product_id']) {
							if (in_array($product['product_id'], $coupon_info['product'])) {
								$sub_total += $product['total'];
							}
						}
					}
				}else{
		

					foreach ($this->cart->getProducts() as $product) {
						if($product_idd == $product['product_id']) {
							if (in_array($product['product_id'], $coupon_info['product'])) {
								$sub_total += $product['total'];
							}
						}
					}
				}


			}
		
				if ($coupon_info['type'] == 'F') {
					$coupon_info['discount'] = min($coupon_info['discount'], $sub_total);
				}


			  if ($seller_id != 0 && $seller_id != -1) {
			   foreach ($this->cart->getSellerProducts($seller_id) as $product) {
				   if($product_idd == $product['product_id']) {
			   $discount = 0;

					if (!$coupon_info['product']) {
						$status = true;
					} else {
						$status = in_array($product['product_id'], $coupon_info['product']);
					}

					if ($status) {
						if ($coupon_info['type'] == 'F') {
							$discount = $coupon_info['discount'] * ($product['total'] / $sub_total);
						} elseif ($coupon_info['type'] == 'P') {
							$discount = $product['total'] / 100 * $coupon_info['discount'];
						}

						if ($product['tax_class_id']) {
							$tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $discount), $product['tax_class_id']);

							foreach ($tax_rates as $tax_rate) {
								if ($tax_rate['type'] == 'P') {
									//$total['taxes'][$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
								}
							}
						}
					}

					$discount_total += $discount;
				   }
			  }
				   } else{
		
				foreach ($this->cart->getProducts() as $product) {
					if($product_idd == $product['product_id']) {
					$discount = 0;

					if (!$coupon_info['product']) {
						$status = true;
					} else {
						$status = in_array($product['product_id'], $coupon_info['product']);
					}

					if ($status) {
						if ($coupon_info['type'] == 'F') {
							$discount = $coupon_info['discount'] * ($product['total'] / $sub_total);
						} elseif ($coupon_info['type'] == 'P') {
							$discount = $product['total'] / 100 * $coupon_info['discount'];
						}

						if ($product['tax_class_id']) {
							$tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $discount), $product['tax_class_id']);

							foreach ($tax_rates as $tax_rate) {
								if ($tax_rate['type'] == 'P') {
									//$total['taxes'][$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
								}
							}
						}
					}

					$discount_total += $discount;
				}
				}

			}
		

				if ($coupon_info['shipping'] && isset($this->session->data['shipping_method'])) {
					if (!empty($this->session->data['shipping_method']['tax_class_id'])) {
						$tax_rates = $this->tax->getRates($this->session->data['shipping_method']['cost'], $this->session->data['shipping_method']['tax_class_id']);

						foreach ($tax_rates as $tax_rate) {
							if ($tax_rate['type'] == 'P') {
								//$total['taxes'][$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
							}
						}
					}

					$discount_total += $this->session->data['shipping_method']['cost'];
				}

				// If discount greater than total
				//if ($discount_total > $total['total']) {
					//$discount_total = $total['total'];
				//}

				if ($discount_total > 0) {
					return $discount_total;
				}
			}
		}
	}
	
}
?>