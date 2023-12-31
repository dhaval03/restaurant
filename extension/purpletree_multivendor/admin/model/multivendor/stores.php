<?php
namespace Opencart\Admin\Model\Extension\PurpletreeMultivendor\Multivendor;
class Stores extends \Opencart\System\Engine\Model {
	     //seller area
		public function getSellerAreaByID($area_id) {			
			
			$sql="SELECT pva.*,pvad.area_name AS name FROM ". DB_PREFIX ."purpletree_vendor_area pva LEFT JOIN ". DB_PREFIX ."purpletree_vendor_area_discaription pvad ON (pva.area_id=pvad.area_id) WHERE pvad.language_id='".(int)$this->config->get('config_language_id') ."' AND pva.status = 1 AND pva.area_id = '".(int)$area_id ."'";
			
		
			
			$query = $this->db->query($sql);
			
			return $query->row;
		}
	    public function getSellerAreas($data = array()) {			
			
			$sql="SELECT pva.*,pvad.area_name AS name FROM ". DB_PREFIX ."purpletree_vendor_area pva LEFT JOIN ". DB_PREFIX ."purpletree_vendor_area_discaription pvad ON (pva.area_id=pvad.area_id) WHERE pvad.language_id='".(int)$this->config->get('config_language_id') ."' AND pva.status = 1";
			
		if (!empty($data['filter_name'])) {
			$sql .= " AND pvad.area_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY pva.area_id";

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			
			$query = $this->db->query($sql);
			
			return $query->rows;
		}
		// end seller area
		///  vacation
		public function getStoreHoliday($store_id) {
		   $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "purpletree_vendor_holiday WHERE store_id = '" . (int)$store_id . "'");
			if ($query->num_rows > 0) {			 
				return $query->rows;
				} else {	
				return NULL;
			}
			}
		public function getStoreTime($store_id) {
			$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "purpletree_vendor_store_time WHERE store_id = '" . (int)$store_id . "'");
			if ($query->num_rows > 0) {			 
				return $query->rows;
				} else {	
				return NULL;
			}
			}
		public function storeTime($store_id,$data = array()) {
			$query = $this->db->query("SELECT count(id) AS total FROM " . DB_PREFIX . "purpletree_vendor_store_time WHERE store_id = '" . (int)$store_id . "'");
			if ($query->row['total']  > 0) {
			//update
			if(isset($data['store_timing'])) {
			   foreach ($data['store_timing'] as $day_id => $value) {
			   if($day_id == 1){
			       $day_name = 'Sunday';
				}elseif($day_id == 2){
				   $day_name = 'Monday';
				}elseif($day_id == 3){
				   $day_name = 'Tuesday';
				}elseif($day_id == 4){
				   $day_name = 'Wednesday';
				}elseif($day_id == 5){
				   $day_name = 'Thursday';
				}elseif($day_id == 6){
				   $day_name = 'Friday';
				}elseif($day_id == 7){
				   $day_name = 'Saturday';
				}else{
				   $day_name = '';
				}			   
			   $this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_store_time SET day_name = '" . $this->db->escape($day_name) . "',open_time = '" . $value['open'] . "', close_time = '" . $value['close'] . "' WHERE day_id = '" . (int)$day_id . "' AND store_id = '" . (int)$store_id . "'");
				   }
			}
				
				} else {	
				// insert
					if(isset($data['store_timing'])) {
				foreach ($data['store_timing'] as $day_id => $value) {
				    if($day_id == 1){
			       $day_name = 'Sunday';
				}elseif($day_id == 2){
				   $day_name = 'Monday';
				}elseif($day_id == 3){
				   $day_name = 'Tuesday';
				}elseif($day_id == 4){
				   $day_name = 'Wednesday';
				}elseif($day_id == 5){
				   $day_name = 'Thursday';
				}elseif($day_id == 6){
				   $day_name = 'Friday';
				}elseif($day_id == 7){
				   $day_name = 'Saturday';
				}else{
				   $day_name = '';
				}			   
				    $this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_store_time SET day_id = '" . (int)$day_id . "',store_id = '" . (int)$store_id . "', day_name = '" . $this->db->escape($day_name) . "', open_time = '" . $value['open'] . "', close_time	 = '" . $value['close'] . "'");
				   }
					}
			}
			}
		public function addHoliday($store_id,$data = array()) {
		    
		    // delete
		    $this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_vendor_holiday WHERE store_id = '" . (int)$store_id . "'");
			if(isset($data['input-date-holiday'])){
		    foreach ($data['input-date-holiday'] as $key => $value) {
			   
			// Insert
			   $this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_holiday SET store_id = '" . (int)$store_id . "',date = '" . $value . "'");
		     }
			}
			}
		/// vacation
		public function getTotalStores($data = array()) { 		
			$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON(pvs.seller_id=c.customer_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status=1";
			$implode = array();
			
			if (!empty($data['filter_name'])) {
				$implode[] = "pvs.store_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			if (!empty($data['filter_email'])) {
				$implode[] = "pvs.store_email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
			}
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$implode[] = "pvs.store_status = '" . (int)$data['filter_status'] . "'";
			}
			
			if (!empty($data['filter_date_added'])) {
				$implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
			}
			
			if ($implode) {
				$sql .= " AND " . implode(" AND ", $implode);
			}
			
			$query = $this->db->query($sql);
			
			return $query->row['total'];
		}
		
		public function getStoreByEmail($email) {
			$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE LCASE(store_email) = '" . $this->db->escape(strtolower($email)) . "'");
			
			return $query->row;
			
		}
		
		public function getStoreSeo($seo_url) {
			
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE LCASE(keyword) = '".$this->db->escape(strtolower($seo_url)) . "'");
			return $query->row;
		}
		
		public function editStore($store_id,$data,$file,$admin_store_id){
			if(!isset($data['store_email'])) {
				$data['store_email'] = '';
			}
			if($data['store_commission'] == '') {
				$datastore_commission = 'NULL';
				} else {
				$datastore_commission = (float)$data['store_commission'];
			}	
			if($data['seller_paypal_id'] == '') {
				$seller_paypal_id = '';
				} else {
				$seller_paypal_id = $data['seller_paypal_id'];
			}
			if($data['store_shipping_charge'] == '') {
				$store_shipping_charge ='NULL';
				} else {
				$store_shipping_charge = $this->db->escape($data['store_shipping_charge']);
			}
			if(empty($data['seller_area'])){
				$data['seller_area'] = "";
			}
			$dcument = "";
			$store_live_chat_enable = "";
			$store_live_chat_code = "";
			if($file != '') {
				$dcument = ",document='".$this->db->escape($file)."'"; 
			}
			
			//social
			if(!isset($data['facebook_link'])) {
				$data['facebook_link'] = '';
			}
			if(!isset($data['twitter_link'])) {
				$data['twitter_link'] = '';
			}
			if(!isset($data['google_link'])) {
				$data['google_link'] = '';
			}
			if(!isset($data['instagram_link'])) {
				$data['instagram_link'] = '';
			}
			if(!isset($data['pinterest_link'])) {
				$data['pinterest_link'] = '';
			}
			if(!isset($data['wesbsite_link'])) {
				$data['wesbsite_link'] = '';
			}
			if(!isset($data['whatsapp_link'])) {
				$data['whatsapp_link'] = '';
			}
			if(!isset($data['store_video'])) {
				$data['store_video'] = '';
			}
			if(!isset($data['store_image'])) {
				$data['store_image'] = '';
			}
			if(!isset($data['store_timings'])) {
				$data['store_timings'] = '';
			}
			if(!isset($data['google_map'])) {
				$data['google_map'] = '';
			}
			if(!isset($data['google_map_link'])) {
				$data['google_map_link'] = '';
			}
			
			//social end
			
			if(isset($data['store_live_chat_enable'])) {
				$store_live_chat_enable = ", store_live_chat_enable=". $this->db->escape($data['store_live_chat_enable']);
			}
			if(isset($data['store_live_chat_code'])) {
				$store_live_chat_code = ', store_live_chat_code="'. $this->db->escape($data['store_live_chat_code']).'"';
			}
			$ptssql="UPDATE " . DB_PREFIX. "purpletree_vendor_stores SET store_name='".$this->db->escape(trim($data['store_name']))."', store_logo='".$this->db->escape($data['store_logo'])."', store_email='".$this->db->escape($data['store_email'])."', store_phone='".$this->db->escape($data['store_phone'])."',store_video='".$data['store_video']."', store_banner='".$this->db->escape($data['store_banner'])."', store_image='".$this->db->escape($data['store_image'])."',store_description='".$this->db->escape($data['store_description'])."' ".$dcument.$store_live_chat_enable.$store_live_chat_code.", store_address='".$this->db->escape($data['store_address'])."', store_city='".$this->db->escape($data['store_city'])."',store_country='".(int)$data['store_country']."', store_state='".(int)$data['store_state']."', store_zipcode='".$this->db->escape($data['store_zipcode'])."',store_area='".$this->db->escape($data['seller_area'])."',google_map ='".$this->db->escape($data['google_map'])."',google_map_link ='".$this->db->escape($data['google_map_link'])."',store_timings ='".$data['store_timings']."', store_shipping_policy='".$this->db->escape($data['store_shipping_policy'])."', store_return_policy='".$this->db->escape($data['store_return_policy'])."', store_meta_keywords='".$this->db->escape($data['store_meta_keywords'])."', store_meta_descriptions='".$this->db->escape($data['store_meta_description'])."', store_bank_details='".$this->db->escape($data['store_bank_details'])."', store_tin='".$this->db->escape($data['store_tin'])."', store_status= '".(int)$data['store_status']."', sort_order= '".(int)$data['sort_order']."',vacation= '".(int)$data['vacation']."', store_shipping_type ='".$this->db->escape($data['store_shipping_type'])."',store_shipping_order_type ='".$this->db->escape($data['store_shipping_order_type'])."', store_shipping_charge='".$store_shipping_charge."',store_commission=".$datastore_commission.",seller_paypal_id='".$seller_paypal_id."'";
			if(isset($data['multi_store'])){
				$ptssql.=",multi_store_id='".$this->db->escape($data['multi_store'])."'";
			}
			$ptssql.=",store_updated_at=NOW() where id='".(int)$store_id."'";
			
			$this->db->query($ptssql);
			$seller_id = $data['seller_id'];
			
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : json_encode(array())) . "' WHERE customer_id = '" . (int)$seller_id . "'");
			
			//social icon
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_social_links  WHERE store_id = " . (int)$store_id . "");
			if($query->num_rows > 0){
				$this->db->query("UPDATE " . DB_PREFIX. "purpletree_vendor_social_links SET facebook_link='".$this->db->escape($data['facebook_link'])."', twitter_link='".$this->db->escape($data['twitter_link'])."', google_link='".$this->db->escape($data['google_link'])."', instagram_link='".$this->db->escape($data['instagram_link'])."', pinterest_link='".$this->db->escape($data['pinterest_link'])."', wesbsite_link='".$this->db->escape($data['wesbsite_link'])."', whatsapp_link='".$this->db->escape($data['whatsapp_link'])."' where store_id='" .(int)$store_id."'");
				
				}else{ 
				$this->db->query("INSERT into " . DB_PREFIX . "purpletree_vendor_social_links SET facebook_link ='".$this->db->escape($data['facebook_link'])."', twitter_link='".$this->db->escape($data['twitter_link'])."', google_link='".$this->db->escape($data['google_link'])."', instagram_link='".$this->db->escape($data['instagram_link'])."', pinterest_link='".$this->db->escape($data['pinterest_link'])."', wesbsite_link='".$this->db->escape($data['wesbsite_link'])."', whatsapp_link='".$this->db->escape($data['whatsapp_link'])."', store_id = " . (int)$store_id . "");
			}
			//end social icon
		// Assign store to product
		if($this->config->get('module_purpletree_multivendor_multi_store')){
			$ptsSql=$this->db->query("SELECT pvp.product_id FROM " . DB_PREFIX . "purpletree_vendor_stores pvs LEFT JOIN " . DB_PREFIX . "purpletree_vendor_products pvp ON(pvs.seller_id=pvp.seller_id)  WHERE pvs.id = '" . (int)$store_id . "'");
			if($ptsSql->num_rows){
				foreach($ptsSql->rows as $productid){
					$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$productid['product_id']. "'");
					foreach($data['multiple_store'] as $multiStoreId){
						$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$productid['product_id'] . "', store_id = '" . (int)$multiStoreId . "'");	
					}
				}
			}
		}
		// Assign store to product
			
			if($this->config->get('module_purpletree_multivendor_product_approval')){
				$is_approved = 0;
				} else{
				$is_approved = 1;
			}
			if(!isset($data['multiple_store'])){
			     $data['multiple_store'] = '';
			}
			if($this->config->get('module_purpletree_multivendor_subscription_plans')!=1){
							if(!empty($data['product_ids'])){
					foreach($data['product_ids'] as $product_id){
						$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_products SET seller_id='".(int)$data['seller_id']."',product_id='".(int)$product_id."', is_approved='".(int)$is_approved."', created_at =NOW(), updated_at =NOW()");
						// $multiple_stores=explode(',',$admin_store_id);
						$multiple_stores=$data['multiple_store'];
						if(!empty($multiple_stores)){
							$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "'");
							foreach($multiple_stores as $storeId){
						// $found_store = $this->checkStoreID($storeId, $product_id);
						// if($found_store){
							$this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int)$product_id . "', store_id = '" . (int)$storeId . "'");
						// }
						}
					}
					}
				}
			}
			if(!empty($data['vendor_category_ids']))
			{
				foreach($data['vendor_category_ids'] as $vendor_category_id)
				{
					$sql=$this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_categories WHERE vendor_id='".(int)$store_id."' AND vendor_category_id='".(int)$vendor_category_id."'");
					
					if($sql->num_rows==0)
					{
						$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_categories SET vendor_id='".(int)$store_id."', vendor_category_id='".(int)$vendor_category_id."'");
					}
				}
			}
			
			
			
			if(!empty($data['seller_amount'])){
				$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_payments SET seller_id='".(int)$data['seller_id']."',transaction_id='".$this->db->escape($data['seller_transaction'])."',amount ='".(float)$data['seller_amount']."', payment_mode ='".$this->db->escape($data['seller_payment'])."', status ='success' , created_at =NOW(), updated_at =NOW()");
			}
				
			if ($data['store_seo']) {
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "seo_url` WHERE `key` = 'seller_store_id' AND `value` = '" . (int)$store_id . "'");
				if($query->num_rows > 0){
					$row = $query->row;					
					if($this->config->get('module_purpletree_multivendor_multi_store')){
					$multi_store_ids = array();
					$multi_store_ids = explode(',',$data['multi_store']);
					if(!empty($multi_store_ids)){
					foreach($multi_store_ids as $multi_store_id){	
					   $this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE `key` = 'seller_store_id' AND `value` = '" . (int)$store_id . "' AND `store_id` = '" . (int)$multi_store_id . "'");
					   
						$this->db->query("INSERT INTO `" . DB_PREFIX . "seo_url` SET `key` = 'seller_store_id', `value` = '" . (int)$store_id . "', `language_id` = '".(int)$this->config->get('config_language_id') ."', `store_id` = '" . (int)$multi_store_id . "', `keyword` = '" . $this->db->escape($data['store_seo']) . "'");
					  }
					}
					}else{
					 $this->db->query("UPDATE `" . DB_PREFIX . "seo_url` SET `key` = 'seller_store_id', `value` = '" . (int)$store_id . "', `language_id` = '".(int)$this->config->get('config_language_id') ."', `keyword` = '" . $this->db->escape($data['store_seo']) . "' WHERE `seo_url_id` =".$this->db->escape($row['seo_url_id']));
					}
					
					} else{
					
						$this->db->query("INSERT INTO `" . DB_PREFIX . "seo_url` SET `key` = 'seller_store_id', `value` = '" . (int)$store_id . "', `language_id` = '".(int)$this->config->get('config_language_id') ."', `keyword` = '" . $this->db->escape($data['store_seo']) . "'");
					
				}
				}else {
				$this->db->query("DELETE FROM `" . DB_PREFIX . "seo_url` WHERE `key` = 'seller_store_id' AND `value` = '" . (int)$store_id . "'");
			}
		}
		
		public function getStores($data = array()) {
			$sql = "SELECT *, CONCAT(c.firstname, ' ', c.lastname) AS name, cgd.name AS customer_group FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON(pvs.seller_id=c.customer_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c.status=1";
			
			$implode = array();
			
			if (!empty($data['filter_name'])) {
				$implode[] = "pvs.store_name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			if (!empty($data['filter_email'])) {
				$implode[] = "pvs.store_email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
			}
			
			if (!empty($data['filter_ip'])) {
				$implode[] = "c.customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
			}
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$implode[] = "pvs.store_status = '" . (int)$data['filter_status'] . "'";
			}
			
			if (!empty($data['filter_date_added'])) {
				$implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
			}
			
			if ($implode) {
				$sql .= " AND " . implode(" AND ", $implode);
			}
			
			$sort_data = array(
			'name',
			'c.email',
			'customer_group',
			'c.status',
			'c.approved',
			'c.ip',
			'c.date_added'
			);
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $this->db->escape($data['sort']);
				} else {
				$sql .= " ORDER BY name";
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
				} else {
				$sql .= " ASC";
			}
			
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}
				
				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}
				
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
			
			$query = $this->db->query($sql);
			
			return $query->rows;
		}
		
		public function getStoreSocial($store_id){
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_social_links pvsl where pvsl.store_id='".(int)$store_id."'");
			if($query->num_rows) {
				return $query->row;
			}
		}
		/*
		public function getStore($store_id){
			$query = $this->db->query("SELECT pvs.*,CONCAT(c.firstname, ' ', c.lastname) AS seller_name FROM " . DB_PREFIX . "purpletree_vendor_stores pvs JOIN " . DB_PREFIX . "customer c ON(c.customer_id = pvs.seller_id) where pvs.id='".(int)$store_id."'");
			return $query->row;
		} */
		
		 public function getStore($store_id){
			$query = $this->db->query("SELECT pvs.*,CONCAT(c.firstname, ' ', c.lastname) AS seller_name, (SELECT DISTINCT keyword FROM `" . DB_PREFIX . "seo_url` WHERE `key` = 'seller_store_id' AND `value` = '" . (int)$store_id . "' AND `store_id` = '" . (int)$this->config->get('config_store_id') . "') AS store_seo FROM `" . DB_PREFIX . "purpletree_vendor_stores` pvs JOIN `" . DB_PREFIX . "customer` c ON(c.customer_id = pvs.seller_id) where pvs.id='".(int)$store_id."'");
			return $query->row;
		}  
		
		public function getStoreDetail($customer_id){
			$query = $this->db->query("SELECT pvs.* FROM " . DB_PREFIX . "purpletree_vendor_stores pvs where pvs.seller_id='".(int)$customer_id."'");
			if($query->num_rows){
				return $query->row;
			}
			return null;
		}
		
		public function getSellerIdByCouponId($coupon_id){
			$query = $this->db->query("SELECT seller_id FROM " . DB_PREFIX . "purpletree_vendor_coupons pvc where pvc.coupon_id='".(int)$coupon_id."'");
			if($query->num_rows){
				return $query->row['seller_id'];
			} 
			return null;
		}
		
		public function addSeller($customer_id,$store_name){
			$this->db->query("INSERT into " . DB_PREFIX . "purpletree_vendor_stores SET seller_id ='".(int)$customer_id."', store_name='".$this->db->escape($store_name)."', store_status='0'");
		}
		
		public function editSeller($customer_id,$store_name,$become_seller){		
			$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE seller_id = '".(int)$customer_id."'");
			if($query->num_rows){
				$seller_status = (($become_seller=="1")?'1':'0');
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_stores SET seller_id ='".(int)$customer_id."', store_name='".$this->db->escape($store_name)."', store_status='".(int)$seller_status."'");
				} else {
				if($become_seller=="1"){
					$this->db->query("INSERT into " . DB_PREFIX . "purpletree_vendor_stores SET seller_id ='".(int)$customer_id."', store_name='".$this->db->escape($store_name)."', store_status='1'");
				}
			}
		}
		
		public function getSellerStorename($store_name){
			$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "purpletree_vendor_stores");
			return $query->num_rows;
		}
		
		public function getProductList($data = array()){
			
			$sql = "SELECT p.product_id,p.model,p.price,p.quantity,pd.name,p.status FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";
			
			if(empty($data['category_type'])){
				$sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category pc ON(pc.product_id=p.product_id)";
			} 
			$sql.="	LEFT JOIN " . DB_PREFIX . "purpletree_vendor_products pvp ON(pvp.product_id=p.product_id)";
			
			$sql .= " where pvp.id IS NULL AND pd.name IS NOT NULL";
			
			if(empty($data['category_type'])){
				if($this->db->escape($data['category_allow'])){
					$sql .=" AND pc.category_id IN (" . $this->db->escape($data['category_allow']).")";
				}
			}
			$sql .=" group by p.product_id";
			
			$query = $this->db->query($sql);
			
			return $query->rows;
		}
		
		public function getSellerProducts($data=array()){
			
			$sql = "SELECT * ,CONCAT(c.firstname, ' ', c.lastname) AS seller_name,p.status as product_status, p.image FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) JOIN " .DB_PREFIX. "purpletree_vendor_products pvp ON(pvp.product_id=p.product_id) JOIN " .DB_PREFIX. "customer c ON(c.customer_id=pvp.seller_id)";
			
			if(!empty($data['seller_id'])){
				
				$sql .= "WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pvp.seller_id ='".(int)$data['seller_id']."'";
				} else {
				$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			}
			if (!empty($data['filter_name'])) {
				$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			if (!empty($data['filter_model'])) {
				$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
			}
			
			if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
				$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
			}
			
			if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
				$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
			}
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
			}
			
			if (isset($data['filter_approval']) && !is_null($data['filter_approval'])) {
				$sql .= " AND pvp.is_approved = '" . (int)$data['filter_approval'] . "'";
			}
			
			if (isset($data['filter_image']) && !is_null($data['filter_image'])) {
				if ($data['filter_image'] == 1) {
					$sql .= " AND (p.image IS NOT NULL AND p.image <> '' AND p.image <> 'no_image.png')";
					} else {
					$sql .= " AND (p.image IS NULL OR p.image = '' OR p.image = 'no_image.png')";
				}
			}
			
			$sql .= " GROUP BY p.product_id";
			
			$sort_data = array(
			'pd.name',
			'p.model',
			'p.price',
			'p.quantity',
			'p.status',
			'p.sort_order'
			);
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $this->db->escape($data['sort']);
				} else {
				$sql .= " ORDER BY pd.name";
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
				} else {
				$sql .= " ASC";
			}
			
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}
				
				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}
				
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
			
			$query = $this->db->query($sql);
			
			return $query->rows;
		}
		
		
		
		
		public function getTotalSellerProducts($data = array()) {
			$sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) JOIN " . DB_PREFIX . "purpletree_vendor_products pvp ON(pvp.product_id=p.product_id)";
			
			$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			
			if(!empty($data['seller_id'])){
				$sql .= " AND pvp.seller_id ='".(int)$data['seller_id']."'";
			}
			if (!empty($data['filter_name'])) {
				$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			if (!empty($data['filter_model'])) {
				$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
			}
			
			if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
				$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
			}
			
			if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
				$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
			}
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
			}
			if (isset($data['filter_approval']) && !is_null($data['filter_approval'])) {
				$sql .= " AND pvp.is_approved = '" . (int)$data['filter_approval'] . "'";
			}
			if (isset($data['filter_image']) && !is_null($data['filter_image'])) {
				if ($data['filter_image'] == 1) {
					$sql .= " AND (p.image IS NOT NULL AND p.image <> '' AND p.image <> 'no_image.png')";
					} else {
					$sql .= " AND (p.image IS NULL OR p.image = '' OR p.image = 'no_image.png')";
				}
			}
			
			$query = $this->db->query($sql);
			
			return $query->row['total'];
		}
		
		public function delete_vendor_categories($id){ 
			
			$this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_vendor_categories WHERE id='".(int)$id."'");
		}
		
		public function getTotalSellerOrders($data= array()){
			
			$sql = "SELECT COUNT(DISTINCT(pvo.order_id)) AS total FROM `" . DB_PREFIX . "order` o JOIN " . DB_PREFIX . "purpletree_vendor_orders pvo ON(pvo.order_id=o.order_id)";
			
			if (isset($data['filter_order_status']) && $data['filter_order_status']!='') {
				$implode = array();
				
				$order_statuses = explode(',', $data['filter_order_status']);
				
				foreach ($order_statuses as $order_status_id) {
					$implode[] = "pvo.order_status_id = '" . (int)$order_status_id . "'";
				}
				
				if ($implode) {
					$sql .= " WHERE (" . implode(" OR ", $implode) . ")";
				}
				} else {
				$sql .= " WHERE pvo.order_status_id > 0";
			}
			if (isset($data['filter_admin_order_status']) && $data['filter_admin_order_status']!='') {
				$implode1 = array();
				
				$order_statuses1 = explode(',', $data['filter_admin_order_status']);
				
				foreach ($order_statuses1 as $order_status_id1) {
					$implode1[] = "o.order_status_id = '" . (int)$order_status_id1 . "'";
				}
				
				if ($implode1) {
					$sql .= " AND (" . implode(" OR ", $implode1) . ")";
				}
				} else {
				$sql .= " AND o.order_status_id > 0";
			}
			
			if(!empty($data['seller_id'])){
				$sql .= " AND pvo.seller_id ='".(int)$data['seller_id']."'";
			}
			
			if(!empty($data['seller_id_filter'])){
				$sql .= " AND pvo.seller_id ='".(int)$data['seller_id_filter']."'";
			}
			
			if (!empty($data['filter_date_from'])) {
				$sql .= " AND DATE(o.date_added) >= DATE('" . $this->db->escape($data['filter_date_from']) . "')";
			}
			
			if (!empty($data['filter_date_to'])) {
				$sql .= " AND DATE(o.date_added) <= DATE('" . $this->db->escape($data['filter_date_to']) . "')";
			}
			if(!isset($data['filter_date_from']) && !isset($data['filter_date_to'])){
				$end_date = date('Y-m-d', strtotime("-30 days"));
				$sql .= " AND DATE(o.date_added) >= '".$end_date."'";
				$sql .= " AND DATE(o.date_added) <= '".date('Y-m-d')."'";
			}
			$query = $this->db->query($sql);
			if($query->num_rows > 0 ){
				return $query->row['total'];
				} else{
				return 0;
			}
		}
		
		public function getSellerOrders($data = array()) {
			$sql = "SELECT pvo.*, o.order_status_id AS admin_order_status_idd,o.order_id, CONCAT(o.firstname, ' ', o.lastname) AS customer, (SELECT os.name FROM " . DB_PREFIX . "order_status os WHERE os.order_status_id = pvo.order_status_id AND os.language_id = '" . (int)$this->config->get('config_language_id') . "') AS order_status,(SELECT os.name FROM " . DB_PREFIX . "order_status os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . (int)$this->config->get('config_language_id') . "') AS admin_order_status, o.shipping_code, o.total, o.currency_code, o.currency_value, o.date_added, o.date_modified FROM `" . DB_PREFIX . "order` o JOIN " . DB_PREFIX . "purpletree_vendor_orders pvo ON(pvo.order_id=o.order_id)";
			
			if (isset($data['filter_order_status']) && $data['filter_order_status']!='') {
				$implode = array();
				
				$order_statuses = explode(',', $data['filter_order_status']);
				
				foreach ($order_statuses as $order_status_id) {
					$implode[] = "pvo.order_status_id = '" . (int)$order_status_id . "'";
				}
				
				if ($implode) {
					$sql .= " WHERE (" . implode(" OR ", $implode) . ")";
				}
				} else {
				$sql .= " WHERE pvo.order_status_id > 0";
			}
			if (isset($data['filter_admin_order_status']) && $data['filter_admin_order_status']!='') {
				$implode1 = array();
				
				$order_statuses1 = explode(',', $data['filter_admin_order_status']);
				
				foreach ($order_statuses1 as $order_status_id1) {
					$implode1[] = "o.order_status_id = '" . (int)$order_status_id1 . "'";
				}
				
				if ($implode1) {
					$sql .= " AND (" . implode(" OR ", $implode1) . ")";
				}
				} else {
				$sql .= " AND o.order_status_id > 0";
			}
			
			if(!empty($data['seller_id'])){
				$sql .= " AND pvo.seller_id ='".(int)$data['seller_id']."'";
			}
			
			if(!empty($data['seller_id_filter'])){
				$sql .= " AND pvo.seller_id ='".(int)$data['seller_id_filter']."'";
			}
			
			
			if (!empty($data['filter_date_from'])) {
				$sql .= " AND DATE(o.date_added) >= DATE('" . $this->db->escape($data['filter_date_from']) . "')";
			}
			
			if (!empty($data['filter_date_to'])) {
				$sql .= " AND DATE(o.date_added) <= DATE('" . $this->db->escape($data['filter_date_to']) . "')";
			}
			if(!isset($data['filter_date_from']) && !isset($data['filter_date_to'])){
				$end_date = date('Y-m-d', strtotime("-30 days"));
				$sql .= " AND DATE(o.date_added) >= '".$end_date."'";
				$sql .= " AND DATE(o.date_added) <= '".date('Y-m-d')."'";
			}
			
			$sort_data = array(
			'o.order_id',
			'customer',
			'order_status',
			'o.date_added',
			'o.date_modified',
			'o.total'
			);
			
			$sql .= " group by o.order_id";
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $this->db->escape($data['sort']);
				} else {
				$sql .= " ORDER BY o.order_id";
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
				} else {
				$sql .= " DESC";
			}
			
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}
				
				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}
				
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			};
			$query = $this->db->query($sql);
			
			return $query->rows;
		}
		
		public function getSellerOrdersProductTotal($seller_id,$order_id){
			$query = $this->db->query("SELECT SUM(total_price) AS total, SUM(shipping) AS total_shipping  FROM " . DB_PREFIX . "purpletree_vendor_orders WHERE seller_id = '".(int)$seller_id."' AND order_id = '".(int)$order_id."'");
			
			return $query->rows;
		}
		
		public function getSellerOrdersTotal($seller_id,$order_id){
			$query = $this->db->query("SELECT value AS total  FROM " . DB_PREFIX . "purpletree_order_total WHERE seller_id = '".(int)$seller_id."' AND order_id = '".(int)$order_id."' AND code='sub_total'");
			return $query->row;
		}
		
		public function getSellerOrdersCommission($order_id,$seller_id=NULL){
			
			$sql = "SELECT SUM(commission) AS total_commission  FROM " . DB_PREFIX . "purpletree_vendor_commissions WHERE order_id = '".(int)$order_id."'";		
			if(isset($seller_id)){
				$sql .= " AND seller_id = '".(int)$seller_id."'";
			}
			$query = $this->db->query($sql);
			
			return $query->row;
		}
		
		public function getSellerOrdersCommissionTotal($seller_id=NULL){
			
			$sql = "SELECT SUM(pvc.commission) AS total_commission  FROM " . DB_PREFIX . "purpletree_vendor_commissions pvc JOIN `" . DB_PREFIX . "order` o ON(o.order_id=pvc.order_id) WHERE o.order_status_id = '5'";		
			if(!empty($seller_id)){
				$sql .= " AND pvc.seller_id = '".(int)$seller_id."'";
			}
			$query = $this->db->query($sql);
			return $query->row;
		}
		
		public function getSellerCompleteAmount($seller_id=NULL){
			
			$sql = "SELECT SUM(pvo.total_price) AS total  FROM " . DB_PREFIX . "purpletree_vendor_orders pvo JOIN `" . DB_PREFIX . "order` o ON(o.order_id=pvo.order_id) WHERE o.order_status_id = '5'";		
			if(!empty($seller_id)){
				$sql .= " AND pvo.seller_id = '".(int)$seller_id."'";
			}
			$query = $this->db->query($sql);
			return $query->row;
		}
		
		public function getSellerPaidTotal($data){
			
			$sql = "SELECT SUM(amount) AS total  FROM " . DB_PREFIX . "purpletree_vendor_payments pvp WHERE";	
			if($data['seller_id'] != 0) {
				$sql .= " seller_id = '".(int)$data['seller_id']."'  AND";
			}
			if (!empty($data['filter_date_from'])) {
				$sql .= " DATE(pvp.created_at) >= DATE('" . $this->db->escape($data['filter_date_from']) . "') AND ";
			}
			
			if (!empty($data['filter_date_to'])) {
				$sql .= " DATE(pvp.created_at) <= DATE('" . $this->db->escape($data['filter_date_to']) . "') ";
			}
			if(!isset($data['filter_date_from']) && !isset($data['filter_date_to'])){
				$end_date = date('Y-m-d', strtotime("-30 days"));
				$sql .= " DATE(pvp.created_at) >= '".$end_date."' AND";
				$sql .= " DATE(pvp.created_at) <= '".date('Y-m-d')."'";
			}
			$query = $this->db->query($sql);
			return $query->row;
		}
		
		public function getOrder($order_id,$seller_id){
			$sql = "SELECT *, (SELECT CONCAT(c.firstname, ' ', c.lastname) FROM " . DB_PREFIX . "customer c WHERE c.customer_id = o.customer_id) AS customer, (SELECT os.name FROM " . DB_PREFIX . "order_status os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . (int)$this->config->get('config_language_id') . "') AS order_status FROM `" . DB_PREFIX . "order` o JOIN " . DB_PREFIX . "purpletree_vendor_orders pvo ON(pvo.order_id=o.order_id) WHERE o.order_id = '" . (int)$order_id . "'";
			
			if(!empty($seller_id)){
				$sql .=" AND pvo.seller_id = '".(int)$seller_id."'";
			}
			$order_query = $this->db->query($sql);
			if ($order_query->num_rows) {
				$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['payment_country_id'] . "'");
				
				if ($country_query->num_rows) {
					$payment_iso_code_2 = $country_query->row['iso_code_2'];
					$payment_iso_code_3 = $country_query->row['iso_code_3'];
					} else {
					$payment_iso_code_2 = '';
					$payment_iso_code_3 = '';
				}
				
				$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['payment_zone_id'] . "'");
				
				if ($zone_query->num_rows) {
					$payment_zone_code = $zone_query->row['code'];
					} else {
					$payment_zone_code = '';
				}
				
				$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['shipping_country_id'] . "'");
				
				if ($country_query->num_rows) {
					$shipping_iso_code_2 = $country_query->row['iso_code_2'];
					$shipping_iso_code_3 = $country_query->row['iso_code_3'];
					} else {
					$shipping_iso_code_2 = '';
					$shipping_iso_code_3 = '';
				}
				
				$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['shipping_zone_id'] . "'");
				
				if ($zone_query->num_rows) {
					$shipping_zone_code = $zone_query->row['code'];
					} else {
					$shipping_zone_code = '';
				}
				
				$reward = 0;
				
				$order_product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");
				
				foreach ($order_product_query->rows as $product) {
					$reward += $product['reward'];
				}
				
				if ($order_query->row['affiliate_id']) {
					$affiliate_id = $order_query->row['affiliate_id'];
					} else {
					$affiliate_id = 0;
				}
				
				$this->load->model('customer/customer');
				
				$affiliate_info = $this->model_customer_customer->getCustomer($order_query->row['affiliate_id']);
				
				if ($affiliate_info) {
					$affiliate_firstname = $affiliate_info['firstname'];
					$affiliate_lastname = $affiliate_info['lastname'];
					} else {
					$affiliate_firstname = '';
					$affiliate_lastname = '';
				}
				
				$this->load->model('localisation/language');
				
				$language_info = $this->model_localisation_language->getLanguage($order_query->row['language_id']);
				
				if ($language_info) {
					$language_code = $language_info['code'];
					} else {
					$language_code = $this->config->get('config_language');
				}
				
				return array(
				'order_id'                => $order_query->row['order_id'],
				'invoice_no'              => $order_query->row['invoice_no'],
				'invoice_prefix'          => $order_query->row['invoice_prefix'],
				'store_id'                => $order_query->row['store_id'],
				'store_name'              => $order_query->row['store_name'],
				'store_url'               => $order_query->row['store_url'],
				'customer_id'             => $order_query->row['customer_id'],
				'customer'                => $order_query->row['customer'],
				'customer_group_id'       => $order_query->row['customer_group_id'],
				'firstname'               => $order_query->row['firstname'],
				'lastname'                => $order_query->row['lastname'],
				'email'                   => $order_query->row['email'],
				'telephone'               => $order_query->row['telephone'],
				//'fax'                     => $order_query->row['fax'],
				'custom_field'            => json_decode($order_query->row['custom_field'], true),
				'payment_firstname'       => $order_query->row['payment_firstname'],
				'payment_lastname'        => $order_query->row['payment_lastname'],
				'payment_company'         => $order_query->row['payment_company'],
				'payment_address_1'       => $order_query->row['payment_address_1'],
				'payment_address_2'       => $order_query->row['payment_address_2'],
				'payment_postcode'        => $order_query->row['payment_postcode'],
				'payment_city'            => $order_query->row['payment_city'],
				'payment_zone_id'         => $order_query->row['payment_zone_id'],
				'payment_zone'            => $order_query->row['payment_zone'],
				'payment_zone_code'       => $payment_zone_code,
				'payment_country_id'      => $order_query->row['payment_country_id'],
				'payment_country'         => $order_query->row['payment_country'],
				'payment_iso_code_2'      => $payment_iso_code_2,
				'payment_iso_code_3'      => $payment_iso_code_3,
				'payment_address_format'  => $order_query->row['payment_address_format'],
				'payment_custom_field'    => json_decode($order_query->row['payment_custom_field'], true),
				'payment_method'          => $order_query->row['payment_method'],
				'payment_code'            => $order_query->row['payment_code'],
				'shipping_firstname'      => $order_query->row['shipping_firstname'],
				'shipping_lastname'       => $order_query->row['shipping_lastname'],
				'shipping_company'        => $order_query->row['shipping_company'],
				'shipping_address_1'      => $order_query->row['shipping_address_1'],
				'shipping_address_2'      => $order_query->row['shipping_address_2'],
				'shipping_postcode'       => $order_query->row['shipping_postcode'],
				'shipping_city'           => $order_query->row['shipping_city'],
				'shipping_zone_id'        => $order_query->row['shipping_zone_id'],
				'shipping_zone'           => $order_query->row['shipping_zone'],
				'shipping_zone_code'      => $shipping_zone_code,
				'shipping_country_id'     => $order_query->row['shipping_country_id'],
				'shipping_country'        => $order_query->row['shipping_country'],
				'shipping_iso_code_2'     => $shipping_iso_code_2,
				'shipping_iso_code_3'     => $shipping_iso_code_3,
				'shipping_address_format' => $order_query->row['shipping_address_format'],
				'shipping_custom_field'   => json_decode($order_query->row['shipping_custom_field'], true),
				'shipping_method'         => $order_query->row['shipping_method'],
				'shipping_code'           => $order_query->row['shipping_code'],
				'comment'                 => $order_query->row['comment'],
				'total'                   => $order_query->row['total'],
				'reward'                  => $reward,
				'order_status_id'         => $order_query->row['order_status_id'],
				'order_status'            => $order_query->row['order_status'],
				'affiliate_id'            => $order_query->row['affiliate_id'],
				'affiliate_firstname'     => $affiliate_firstname,
				'affiliate_lastname'      => $affiliate_lastname,
				'commission'              => $order_query->row['commission'],
				'language_id'             => $order_query->row['language_id'],
				'language_code'           => $language_code,
				'currency_id'             => $order_query->row['currency_id'],
				'currency_code'           => $order_query->row['currency_code'],
				'currency_value'          => $order_query->row['currency_value'],
				'ip'                      => $order_query->row['ip'],
				'forwarded_ip'            => $order_query->row['forwarded_ip'],
				'user_agent'              => $order_query->row['user_agent'],
				'accept_language'         => $order_query->row['accept_language'],
				'date_added'              => $order_query->row['date_added'],
				'date_modified'           => $order_query->row['date_modified']
				);
				} else {
				return;
			}
		}
		
		public function getOrderProducts($order_id,$seller_id) {
			$query = $this->db->query("SELECT op.* ,(SELECT CONCAT(c.firstname, ' ', c.lastname) FROM " . DB_PREFIX . "customer c WHERE c.customer_id = pvo.seller_id) as seller_name,pvo.seller_id FROM " . DB_PREFIX . "order_product op LEFT JOIN " . DB_PREFIX . "purpletree_vendor_orders pvo ON(pvo.order_id=op.order_id AND pvo.product_id=op.product_id) WHERE op.order_id = '" . (int)$order_id . "' GROUP BY op.order_product_id");		
			
			return $query->rows;
		}
		
		public function getSellerOrderProducts($order_id,$seller_id){
			$query = $this->db->query("SELECT op.* ,(SELECT CONCAT(c.firstname, ' ', c.lastname) FROM " . DB_PREFIX . "customer c WHERE c.customer_id = pvo.seller_id) as seller_name, pvo.seller_id, pvo.shipping FROM " . DB_PREFIX . "order_product op JOIN " . DB_PREFIX . "purpletree_vendor_orders pvo ON(pvo.order_id=op.order_id AND pvo.product_id=op.product_id) WHERE op.order_id = '" . (int)$order_id . "' AND pvo.seller_id = '".(int)$seller_id."'GROUP BY op.order_product_id");
			return $query->rows;
		}
		
		public function getOrderOptions($order_id, $order_product_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product_id . "'");
			
			return $query->rows;
		}
		
		public function getOrderVouchers($order_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_voucher WHERE order_id = '" . (int)$order_id . "'");
			
			return $query->rows;
		}
		
		public function getOrderTotals($order_id,$seller_id) { 
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_order_total WHERE order_id = '" . (int)$order_id . "' AND seller_id = '".(int)$seller_id."' ORDER BY sort_order");
			
			return $query->rows;
		}
		public function getOrderTotalsfromorder($order_id) { 
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_order_total WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order");
			
			return $query->rows;
		}
		public function getsellerInfofororder($sellerid) { 
			$query = $this->db->query("SELECT CONCAT(c.firstname, ' ', c.lastname) AS seller_name, pvs.id AS store_id FROM " . DB_PREFIX . "purpletree_vendor_stores pvs JOIN " . DB_PREFIX . "customer c ON(pvs.seller_id=c.customer_id) WHERE pvs.seller_id = '" . (int)$sellerid . "'");
			
			return $query->row;
		}
		
		public function getOrderHistories($order_id, $seller_id, $start = 0, $limit = 10) {
			if ($start < 0) {
				$start = 0;
			}
			
			if ($limit < 1) {
				$limit = 10;
			}
			
			$query = $this->db->query("SELECT oh.created_at, os.name AS status, oh.comment, oh.notify FROM " . DB_PREFIX . "purpletree_vendor_orders_history oh LEFT JOIN " . DB_PREFIX . "order_status os ON oh.order_status_id = os.order_status_id WHERE oh.order_id = '" . (int)$order_id . "' AND oh.seller_id= '".(int)$seller_id."' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oh.created_at ASC LIMIT " . (int)$start . "," . (int)$limit);
			
			return $query->rows;
		}
		
		public function getTotalOrderHistories($order_id,$seller_id) {
			$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "purpletree_vendor_orders_history WHERE order_id = '" . (int)$order_id . "' AND seller_id='".(int)$seller_id."'");
			
			return $query->row['total'];
		}
		
		public function approveProduct($product_id){
			$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_products SET is_approved=1 WHERE product_id='".(int)$product_id."'");
			$this->db->query("UPDATE " . DB_PREFIX . "product SET status=1,date_modified=NOW() WHERE product_id='".(int)$product_id."'");
		}
		
		public function approveSeller($store_id){
			$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_stores SET store_status=1, is_removed=0, store_updated_at=NOW() WHERE id='".(int)$store_id."'");
			
		}
		
		public function disapproveSeller($store_id){ 
			$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_stores SET store_status=0, is_removed=0, store_updated_at=NOW() WHERE id='".(int)$store_id."'");
			
			$query = $this->db->query("select product_id FROM " . DB_PREFIX . "purpletree_vendor_products pvp JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON pvp.seller_id=pvs.seller_id WHERE pvs.id='".(int)$store_id."'");
			
			if($query->num_rows > 0){
				foreach($query->rows as $product){
					$this->db->query("UPDATE " . DB_PREFIX . "product SET status=0,date_modified=NOW() WHERE product_id='".(int)$product['product_id']."'");
				}
			}
		}
		
		public function unAssign($product_id){ 
			$this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_vendor_products WHERE product_id='".(int)$product_id."'");
		}
		
		public function getLatestsellerstatus($order_id, $seller_id){
			$query = $this->db->query("SELECT oh.created_at, os.name AS status, oh.comment, oh.notify FROM " . DB_PREFIX . "purpletree_vendor_orders_history oh LEFT JOIN " . DB_PREFIX . "order_status os ON oh.order_status_id = os.order_status_id WHERE oh.order_id = '" . (int)$order_id . "' AND oh.seller_id= '".(int)$seller_id."' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oh.id DESC LIMIT 1");
			return $query->row;
		}
		
		public function getUniqueSeller($order_id){
			$query = $this->db->query("SELECT DISTINCT(seller_id) FROM " . DB_PREFIX . "purpletree_vendor_orders_history WHERE order_id='".(int)$order_id."' order by id desc");
			$result = $query->rows;
			return $this->getSellerOrderStatus($result, $order_id);
		}
		
		public function getSellerOrderStatus($result, $order_id){
			$order_status = array();
			foreach($result as $result){
				$query = $this->db->query("SELECT pvs.id AS store_id ,pvs.store_name, pvh.order_id, pvh.seller_id, pvh.created_at,pvh.order_status_id, os.name AS status FROM " . DB_PREFIX . "purpletree_vendor_orders_history pvh JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON pvh.seller_id=pvs.seller_id LEFT JOIN " . DB_PREFIX . "order_status os ON pvh.order_status_id = os.order_status_id WHERE pvh.seller_id='".(int)$result['seller_id']."' AND pvh.order_id='".(int)$order_id."' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY pvh.id DESC limit 1");
				$result1 = $query->row;
				$shipping = 0;
				$curency = $this->config->get('config_currency');
				$this->load->model('extension/purpletree_multivendor/multivendor/sellerpayment');
				$currency_detail = $this->model_extension_purpletree_multivendor_multivendor_sellerpayment->getCurrencySymbol($curency);
				$shipping = $this->currency->format($shipping, $currency_detail['code'], $currency_detail['value']);
				$storeurll = "#";
				$result1status = "";
				$result1store_name  = "";
				$result1order_status_id = "";
				if($query->num_rows == 1) {
					$storeurll = $this->url->link('extension/purpletree_multivendor/stores/edit&store_id='.$result1['store_id'], 'user_token=' . $this->session->data['user_token'], true);
					$result1status = $result1['status'];
					$result1order_status_id = $result1['order_status_id'];
					$result1store_name = $result1['store_name'];
					$sql11 = "SELECT o.currency_value,o.currency_code,pot.value as shipping_value FROM `" . DB_PREFIX . "purpletree_vendor_stores` pvs JOIN `" . DB_PREFIX . "purpletree_order_total` pot ON pvs.seller_id = pot.seller_id JOIN `" . DB_PREFIX . "order` o ON o.order_id = pot.order_id WHERE pvs.id= '". (int)$result1['store_id'] ."' AND pot.order_id = '". (int)$order_id ."' AND pot.code ='seller_shipping'";
					$quer11 = $this->db->query($sql11);
					//$result12 = $query->rows;
					if($quer11->num_rows == 1) {
						$shipping = $quer11->row['shipping_value'];
						$shipping = $this->currency->format($shipping, $quer11->row['currency_code'], $quer11->row['currency_value']);
					}
				}
				$order_status[] = array(
				'shipping' => $shipping,
				'store_name' => $result1store_name ,
				'store_url' => $storeurll,
				'order_status' => $result1status,
				'order_status_id' => $result1order_status_id ,
				'product' => $this->getSelleradminOrderProducts($order_id, $result['seller_id'])
				);
			}
			
			return $order_status;
		}
		
		public function getSelleradminOrderProducts($order_id, $seller_id){
			$query = $this->db->query("SELECT (SELECT name FROM " . DB_PREFIX . "product_description where product_id = pvo.product_id AND language_id = '" . (int)$this->config->get('config_language_id') . "') as product_name, total_price FROM " . DB_PREFIX . "purpletree_vendor_orders pvo WHERE pvo.seller_id='".(int)$seller_id."' AND pvo.order_id = '".(int)$order_id."'");
			return $query->rows;
		}
		
		public function getVendors($data = array()) {
			$sql = "SELECT id,store_name FROM " . DB_PREFIX . "purpletree_vendor_stores";
			
			if (!empty($data['filter_name'])) {
				$implode[] = " LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			}
			$sort_data = array(
			'store_name',
			
			);
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $this->db->escape($data['sort']);
				} else {
				$sql .= " ORDER BY store_name";
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
				} else {
				$sql .= " ASC";
			}
			
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}
				
				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}
				
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
			
			$query = $this->db->query($sql);
			
			return $query->rows;
		}
		public function getSellerId($store_id) {
			
			$query = $this->db->query("SELECT seller_id,store_status FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE id = '" . (int)$store_id . "'");
			
			return $query->row;
		}
		public function getAdminStoreId($store_id) {
			
			$query = $this->db->query("SELECT multi_store_id FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE id = '" . (int)$store_id . "'");
			return $query->row['multi_store_id'];
		}
		public function getCustomerId($seller_id) {
			$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$seller_id . "'");
			
			return $query->row;
		}	
		public function getSellerstore($store_name1) {
			$sql = "SELECT pvs.seller_id,pvs.store_name FROM " . DB_PREFIX . "purpletree_vendor_stores pvs LEFT JOIN " . DB_PREFIX . "customer c ON (c.customer_id = pvs.seller_id) WHERE pvs.store_name  LIKE '%" . $this->db->escape($store_name1) . "%' AND c.status=1 AND pvs.store_status=1";
			
			$query = $this->db->query($sql);
			return $query->rows;
			
		}
		public function getStoreNameByStoreName($store_name2){
			
			$sql = "SELECT pvs.id ,pvs.seller_id ,pvs.store_name,c.status FROM " . DB_PREFIX . "purpletree_vendor_stores pvs LEFT JOIN ". DB_PREFIX ."customer c ON(pvs.seller_id = c.customer_id) WHERE pvs.store_name = '" . $this->db->escape(trim($store_name2)) . "' AND c.status=1";
			$query = $this->db->query($sql);       
			return $query->row;	
		}
		public function getProducts($data = array()) {
			$sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) RIGHT JOIN  " . DB_PREFIX . "purpletree_vendor_products pvp ON (p.product_id = pvp.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			
			if (!empty($data['filter_name'])) {
				$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			}
			
			if (!empty($data['filter_model'])) {
				$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
			}
			
			if (!empty($data['filter_price'])) {
				$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
			}
			
			if (isset($data['filter_quantity']) && $data['filter_quantity'] !== '') {
				$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
			}
			
			if (isset($data['filter_status']) && $data['filter_status'] !== '') {
				$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
			}
			
			if (isset($data['filter_approval']) && $data['filter_approval'] !== '') {
				$sql .= " AND pvp.is_approved = '" . (int)$data['filter_approval'] . "'";
			}
			
			$sql .= " GROUP BY p.product_id";
			
			$sort_data = array(
			'pd.name',
			'p.model',
			'p.price',
			'p.quantity',
			'p.status',
			'p.sort_order'
			);
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
				} else {
				$sql .= " ORDER BY pd.name";
			}
			
			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
				} else {
				$sql .= " ASC";
			}
			
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}
				
				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}
				
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
			
			$query = $this->db->query($sql);
			
			return $query->rows;
		}
		public function getSellerSubscriptionPlan($seller_id) {	
			$status='status';
			if($this->config->get('module_purpletree_multivendor_multiple_subscription_plan_active')){
				$status='new_status';	
			}
			$sql = "SELECT pvsp.plan_id,pvpd.plan_name FROM " . DB_PREFIX . "purpletree_vendor_seller_plan pvsp LEFT JOIN  " . DB_PREFIX . "purpletree_vendor_plan_subscription pvps ON(pvsp.seller_id=pvps.seller_id) LEFT JOIN " . DB_PREFIX . "purpletree_vendor_plan_description pvpd ON(pvsp.plan_id=pvpd.plan_id) LEFT JOIN " . DB_PREFIX . "purpletree_vendor_plan pvp  ON(pvp.plan_id=pvpd.plan_id) WHERE pvsp.seller_id='".(int)$seller_id."' AND pvsp.".$status."=1 AND pvps.status_id=1 AND pvpd.language_id='".(int)$this->config->get('config_language_id')."' AND pvp.status=1 ";
			
			$query = $this->db->query($sql);
			if($query->num_rows>0){
				return $query->rows;
				}else {
				return NULL;
			}
			
		}
		public function checkSubscriptionPlan($data=array()) {	
			$assignedProduct=$this->db->query("SELECT pvp.* FROM " . DB_PREFIX . "purpletree_vendor_products pvp RIGHT JOIN  " . DB_PREFIX . "purpletree_vendor_subscription_products pvsp ON(pvp.product_id=pvsp.product_id) WHERE pvp.seller_id='".(int)$data['seller_id']."' AND product_plan_id='".(int)$data['plan_id']."'")->num_rows;
			
			$no_of_product=$this->db->query("SELECT no_of_product FROM " . DB_PREFIX . "purpletree_vendor_plan WHERE plan_id='".(int)$data['plan_id']."'")->row['no_of_product'];
			if($assignedProduct<$no_of_product){
				return true;
				} else {
				return false;
			}
			
			
		}
		public function assignSellerProduct($data=array()) {	
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_products SET seller_id='".(int)$data['seller_id']."',product_id='".(int)$data['product_id']."',is_approved=1,created_at=NOW(),updated_at=NOW()");
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_subscription_products SET product_id='".(int)$data['product_id']."',product_plan_id='".(int)$data['plan_id']."'");
			
		}
		public function getCustomerEmailId($seller_id) {
			
			$query = $this->db->query("SELECT email  FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$seller_id . "'");
			if($query->num_rows>0){
				return $query->row['email'];
				}else {
				return NULL;
			}
		}
		public function getStoreById($sellerid){
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE seller_id='". (int)$sellerid."'");
			if ($query->num_rows > 0) {
				return $query->row;
			}	
			return '';
		}
		public function getSellerIdc($store_id) {
			
			$query = $this->db->query("SELECT seller_id,store_status FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE id = '" . (int)$store_id . "'");
			if($query->num_rows>0){
				return $query->row['seller_id'];
				}else {
				return NULL;
			}
			
		}
	/* 	public function checkStoreID($store_id,$product_id) {
			
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . (int)$store_id . "'");
			if($query->num_rows>0){
				return false;
				}else {
				return true;
			}
		} */
		public function updateRefund($data) {		
			$refund = - $data['refund_value'];
			$ids = explode('_',$data['code']);
			$product_id = $ids[2];
			$seller_id_return =  $ids[1];
			
		    $total_after_refund = "";
			$order_total_sid = "";
			$total_refund = "";
			$total_value = "";
			$total_refundd = "";
			$id_codes = $data['code'];
			$order_total_id = "";
			
			$query6 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$data['refund_order_id'] . "' AND seller_id = '".(int)$seller_id_return."' AND code ='refunded_".$product_id."' ");
			
			if($query6->num_rows){
				$order_total_sid = $query6->row['order_total_id'];
				$total_refund = $query6->row['value'];
			}
			
			$query7 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "purpletree_order_total` WHERE order_id = '" . (int)$data['refund_order_id'] . "' AND seller_id = '".(int)$seller_id_return."' AND code ='total' ");
			
			if($query7->num_rows){
				$order_total_id = $query7->row['order_total_id'];
				$total_value = $query7->row['value'];
			}
			
			$total_after_refund = ($total_value - $total_refund) + $refund ;	
			
			$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_order_total` SET value = '" . (int)$total_after_refund . "' WHERE order_total_id='". (int)$order_total_id ."'");
			$query3 = $this->db->query("SELECT total_price, unit_price, quantity FROM `" . DB_PREFIX . "purpletree_vendor_orders` WHERE order_id = '" . (int)$data['refund_order_id'] . "' AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$product_id . "'");
			if($query3->num_rows) {
				$product_pricee = $query3->row['total_price'];
				$unit_product_price = $query3->row['unit_price'];
				$ruquantity = $query3->row['quantity'];
			}
			$total_after_refundd = ($unit_product_price * $ruquantity) - $product_pricee;
			$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_vendor_orders` SET  	total_price  = '" . (int)$total_after_refundd . "' WHERE order_id = '" . (int)$data['refund_order_id'] . "' AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$product_id . "'");
			
			///#####___Start refund after commission____######///
				$queryc = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_commissions` WHERE order_id = '" . (int)$data['refund_order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$product_id . "'");
				if($queryc->num_rows){
					$commission_shipping = $queryc->row['commission_shipping'];
					$commission_fixed = $queryc->row['commission_fixed'];
					$commission_percent = $queryc->row['commission_percent'];
					$commission = (($total_after_refundd*$commission_percent)/100)+$commission_shipping+$commission_fixed;
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commissions SET commission = '" . (float)$commission . "', updated_at = NOW() WHERE order_id = '" . (int)$data['refund_order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$product_id . "'");
				
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commission_invoice_items SET total_commission = '" . (float)$commission . "' WHERE order_id = '" . (int)$data['refund_order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$product_id . "'");
				}
				$querycc = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_commission_invoice_items` WHERE order_id = '" . (int)$data['refund_order_id'] . "'  AND seller_id = '".(int)$seller_id_return."' AND product_id = '" . (int)$product_id . "'");
					
				if($querycc->num_rows){
					$link_id = $querycc->row['link_id'];
				$queryccc = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_commission_invoice` WHERE id = '" . (int)$link_id . "'");
					
				if($queryccc->num_rows){
				  $total_amt = $queryccc->row['total_amount'];						
				  $total_comm = $queryccc->row['total_commission'];						
				  $total_pay_amountt = $queryccc->row['total_pay_amount'];						
				}	if($total_amt > 0){
					$total_pay_amount = $total_after_refundd - $commission;
					$total_pay_amounttt = $total_pay_amountt - $total_pay_amount;			
					$total_amtt = $total_amt - $total_after_refundd;
					$total_commm = $total_comm - $commission;
				    $this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_commission_invoice SET total_amount = '" . (float)$total_amtt . "', total_commission = '" . (float)$total_commm . "', total_pay_amount='".(float)$total_pay_amounttt."' WHERE id = '" . (int)$link_id . "'");
				  }
				}
				
								
				///#####___end refund after commission____######///
			
			$this->db->query("UPDATE `" . DB_PREFIX . "purpletree_order_total` SET value = '" . (int)$refund . "' WHERE code ='refunded_".(int)$product_id."'");
			
		    // For admin total
			$query8 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$data['refund_order_id'] . "'  AND code ='" . $this->db->escape($id_codes) . "'");
			
			if($query8->num_rows){
				$order_total_sidd = $query8->row['order_total_id'];
				$total_refundd = $query8->row['value'];
			}
			$query9 = $this->db->query("SELECT order_total_id, value FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . (int)$data['refund_order_id'] . "' AND code ='total' ");
			
			if($query9->num_rows){
				$order_total_idd = $query9->row['order_total_id'];
				$total_valuee = $query9->row['value'];
			}
			
			$total_after_refundd = ($total_valuee - $total_refundd) + $refund;	
			
			$this->db->query("UPDATE `" . DB_PREFIX . "order_total` SET value = '" . (int)$total_after_refundd . "' WHERE order_total_id='". (int)$order_total_idd ."'"); 
			$this->db->query("UPDATE `" . DB_PREFIX . "order_total` SET value = '" . (int)$refund . "' WHERE code ='". $this->db->escape($data['code']) ."'");
			
			
			
		}
		public function assignCategories($seller_id,$datas=array()) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_vendor_allowed_category WHERE seller_id = '" . (int)$seller_id . "'");
			if(!empty($datas)){	
				foreach($datas['allow_category'] as $data){
					$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_allowed_category SET category_id = '" . (int)$data . "' , type = '" . (int)$datas['type'] . "' ,seller_id = '" . (int)$seller_id . "'");
				}
			}
		}
		public function getCateType($seller_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_allowed_category WHERE seller_id = '" . (int)$seller_id . "'");
			return $query->rows;
		} 
		
		public function getSellerProduct($seller_id) {
			$query = $this->db->query("SELECT pvp.product_id,p.status FROM " . DB_PREFIX . "product p LEFT JOIN ". DB_PREFIX ."purpletree_vendor_products pvp ON(p.product_id = pvp.product_id) WHERE pvp.seller_id = '" . (int)$seller_id . "'");
			if($query->num_rows>0){
				return $query->rows;
			}
		}	
		public function getSellerProductBystatus($seller_id) {
			$query = $this->db->query("SELECT pvp.product_id,p.status FROM " . DB_PREFIX . "product p LEFT JOIN ". DB_PREFIX ."purpletree_vendor_products pvp ON(p.product_id = pvp.product_id) WHERE pvp.seller_id = '" . (int)$seller_id . "' AND pvp.vacation=1 ");
			if($query->num_rows>0){
				return $query->rows;
			}
		}
		public function updateVacationProduct($product_id,$status,$seller_id){
			if($status==1){	
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_products SET vacation=1 WHERE seller_id='".(int)$seller_id."' AND product_id='".(int)$product_id."'");
				}elseif($status==0){
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_products SET vacation=2 WHERE seller_id='".(int)$seller_id."' AND product_id='".(int)$product_id."'");
				}else{
				return NULL;
			}
		}	
		public function updateVacationProductByOff($seller_id){
			$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_products SET vacation=0 WHERE seller_id='".(int)$seller_id."'");
		}	
		public function updateProductAccrVacation($product_id){
			$this->db->query("UPDATE " . DB_PREFIX . "product SET status=0 WHERE product_id='".(int)$product_id."'");
		}	
		public function updateProductAccrVacationn($product_id){
			$this->db->query("UPDATE " . DB_PREFIX . "product SET status=1 WHERE product_id='".(int)$product_id."'");
		}	
		public function checkSellerVacation($store_id){
			$query = $this->db->query("SELECT count(id) AS num_row FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE id = '" . (int)$store_id . "' AND vacation = 1");
			if ($query->num_rows > 0) {
				return $query->row['num_row'];
				} else {	
				return NULL;
			}
		}
		public function getCustomFieldValues($custom_field_id) {
			$custom_field_value_data = array();

			$custom_field_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_value cfv LEFT JOIN " . DB_PREFIX . "custom_field_value_description cfvd ON (cfv.custom_field_value_id = cfvd.custom_field_value_id) WHERE cfv.custom_field_id = '" . (int)$custom_field_id . "' AND cfvd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY cfv.sort_order ASC");

			foreach ($custom_field_value_query->rows as $custom_field_value) {
				$custom_field_value_data[$custom_field_value['custom_field_value_id']] = array(
					'custom_field_value_id' => $custom_field_value['custom_field_value_id'],
					'name'                  => $custom_field_value['name']
				);
			}

			return $custom_field_value_data;
		}
		public function getCustomFields($data = array()) {
		if (empty($data['filter_customer_group_id'])) {
			$sql = "SELECT * FROM `" . DB_PREFIX . "custom_field` cf LEFT JOIN " . DB_PREFIX . "custom_field_description cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cfd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		} else {
			$sql = "SELECT * FROM " . DB_PREFIX . "custom_field_customer_group cfcg LEFT JOIN `" . DB_PREFIX . "custom_field` cf ON (cfcg.custom_field_id = cf.custom_field_id) LEFT JOIN " . DB_PREFIX . "custom_field_description cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cfd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " AND cfd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_customer_group_id'])) {
			$sql .= " AND cfcg.customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
		}

		$sort_data = array(
			'cfd.name',
			'cf.type',
			'cf.location',
			'cf.status',
			'cf.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY cfd.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
		}
		public function updateIncompletePayment($order_id){

			$query = $this->db->query("SELECT pvp.transaction_id AS txn_id, pvp.invoice_id FROM " . DB_PREFIX . "purpletree_vendor_payments pvp WHERE pvp.invoice_id IN(SELECT pvcii.link_id AS invoice_id FROM " . DB_PREFIX . "purpletree_vendor_commissions pvc LEFT JOIN " . DB_PREFIX . "purpletree_vendor_commission_invoice_items pvcii ON (pvc.order_id=pvcii.order_id) WHERE pvc.order_id = '" . (int)$order_id . "' AND invoice_status=1 GROUP BY pvcii.link_id) AND pvp.payment_mode='Online' AND pvp.status!='Complete'"); 

			if ($query->num_rows > 0) {
				return $query->rows;
				} else {	
				return NULL;
			}
		}
		
		public function getDataByInvoiceId($invoice_d){
			
			$query=$this->db->query("SELECT pvcii.seller_id AS seller_id, pvci.total_pay_amount AS pay_amount FROM " . DB_PREFIX . "purpletree_vendor_commission_invoice pvci LEFT JOIN " . DB_PREFIX . "purpletree_vendor_commission_invoice_items pvcii ON (pvci.id=pvcii.link_id) WHERE pvci.id = '" . (int)$invoice_d . "' GROUP BY pvcii.link_id");
			
			if ($query->num_rows > 0) {
				return $query->row;
				} else {	
				return NULL;
			}
		}
		
		public function insertPaymentHistory($data=array()){
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_payment_settlement_history SET invoice_id ='".(int)$data['invoice_id']."', transaction_id='".$this->db->escape($data['transaction_id'])."', comment='".$this->db->escape($data['comment'])."', payment_mode='".$this->db->escape($data['payment_mode'])."', status_id='".$this->db->escape($data['status_id'])."',created_date=NOW(),modified_date=NOW()");
		}
		public function updateTranDetail($data=array()){
			$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_payments SET status='".$this->db->escape($data['status'])."',updated_at=NOW() WHERE invoice_id ='".(int)$data['invoice_id']."' AND seller_id='".(int)$data['seller_id']."'");
		} 
		
		public function getPaymentStatus($invoice_id='',$seller_id=''){
			$query= $this->db->query("SELECT status FROM " . DB_PREFIX . "purpletree_vendor_payments  WHERE invoice_id ='".(int)$invoice_id."' AND seller_id='".(int)$seller_id."'");
			if ($query->num_rows > 0) {
				return $query->row['status'];
				} else {	
				return NULL;
			}
		} 
		public function saveTranDetail($data=array()){
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_payments SET invoice_id ='".(int)$data['invoice_id']."', seller_id='".(int)$data['seller_id']."', transaction_id='".$this->db->escape($data['transaction_id'])."', amount='".(float)$data['amount']."', payment_mode='".$this->db->escape($data['payment_mode'])."', status='".$this->db->escape($data['status'])."',created_at=NOW(),updated_at=NOW() ");
		}
		public function getStripeAccountID($seller_id) {
		$query = $this->db->query("SELECT account_id FROM " . DB_PREFIX . "purpletree_stripe_account WHERE seller_id = '" . (int)$seller_id . "'");
			if($query->num_rows){
				return $query->row['account_id'];
			} else {
				return NULL;
			}
		}
		public function getInvoieData($invoice_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_commission_invoice WHERE id = '" . (int)$invoice_id . "'");
			if($query->num_rows){
				return $query->row;
			} else {
				return NULL;
			}
		}
		
		public function getCurrenyCode($order_id) {
		$sql = "SELECT *, (SELECT CONCAT(c.firstname, ' ', c.lastname) FROM " . DB_PREFIX . "customer c WHERE c.customer_id = o.customer_id) AS customer, (SELECT os.name FROM " . DB_PREFIX . "order_status os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . (int)$this->config->get('config_language_id') . "') AS order_status FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '" . (int)$order_id . "'";
			$order_query = $this->db->query($sql);
			
			if($order_query->num_rows){
				return $order_query->row['currency_code'];
			} else {
				return NULL;
			}
		}
		public function saveTranHistory($data=array()){
			$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_payment_settlement_history SET invoice_id ='".(int)$data['invoice_id']."', transaction_id='".$this->db->escape($data['transaction_id'])."', comment='".$this->db->escape($data['comment'])."', payment_mode='".$this->db->escape($data['payment_mode'])."', status_id='".$this->db->escape($data['status_id'])."',created_date=NOW(),modified_date=NOW()");
		} 
		public function getCustomFieldValue($custom_field_value_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_value cfv LEFT JOIN " . DB_PREFIX . "custom_field_value_description cfvd ON (cfv.custom_field_value_id = cfvd.custom_field_value_id) WHERE cfv.custom_field_value_id = '" . (int)$custom_field_value_id . "' AND cfvd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	
	//module_purpletree_product_designer_status
				public function getCanvasFromOrder($order_id,$product_id){
					$sql   = "SELECT * FROM " . DB_PREFIX . "purpletree_canvas_order_image pcoi WHERE order_id = '" . $order_id . "' AND product_id = '" . $product_id . "' ORDER BY `id` ASC";
					$query = $this->db->query($sql);
					$data  = array();
						if($query->num_rows>0){	
							$data = $query->rows;
						} 
					return $data;
					}
					
						public function getProductDesignStatus($product_id){
					$sql   = "SELECT status FROM " . DB_PREFIX . "purpletree_product_design  WHERE product_id = '" . $product_id . "'";
					$query = $this->db->query($sql);
					$data  = array();
						if($query->num_rows>0){	
							return $query->row['status'];
							
						} else {
							return NULL;
						}
					
					}
				//module_purpletree_product_designer_status
}
?>