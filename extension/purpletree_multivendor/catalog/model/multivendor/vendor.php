<?php
namespace Opencart\Catalog\Model\Extension\PurpletreeMultivendor\Multivendor;
class Vendor extends \Opencart\System\Engine\Model{
		///seller area /////
	public function getSellerAreass($data = array()) {			
			
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
	public function getSellerAreaByID($area_id) {			
			
			$sql="SELECT pva.*,pvad.area_name AS name FROM ". DB_PREFIX ."purpletree_vendor_area pva LEFT JOIN ". DB_PREFIX ."purpletree_vendor_area_discaription pvad ON (pva.area_id=pvad.area_id) WHERE pvad.language_id='".(int)$this->config->get('config_language_id') ."' AND pva.status = 1 AND pva.area_id = '".(int)$area_id ."'";
			
		
			
			$query = $this->db->query($sql);
			
			return $query->row;
		}
	public function getSellerAreasName($area_id) {			
			
			$sql="SELECT pva.*,pvad.area_name FROM ". DB_PREFIX ."purpletree_vendor_area pva LEFT JOIN ". DB_PREFIX ."purpletree_vendor_area_discaription pvad ON (pva.area_id=pvad.area_id) WHERE pvad.language_id='".(int)$this->config->get('config_language_id') ."' AND pva.area_id='".(int)$area_id."' AND pva.status = 1";			
			$query = $this->db->query($sql);
			if ($query->num_rows) {
				return $query->row['area_name'];
			}			
		}
	 public function getSellerAreas() {			
			
			$sql="SELECT pva.*,pvad.area_name FROM ". DB_PREFIX ."purpletree_vendor_area pva LEFT JOIN ". DB_PREFIX ."purpletree_vendor_area_discaription pvad ON (pva.area_id=pvad.area_id) WHERE pvad.language_id='".(int)$this->config->get('config_language_id') ."'  AND pva.status=1";
			
			
			$query = $this->db->query($sql);
			
			return $query->rows;
		}
		
		 public function getSellerHyperlocal($search_area) {			
			$sql="SELECT pva.*,pvad.area_name FROM ". DB_PREFIX ."purpletree_vendor_area pva LEFT JOIN ". DB_PREFIX ."purpletree_vendor_area_discaription pvad ON (pva.area_id=pvad.area_id) WHERE pvad.language_id='".(int)$this->config->get('config_language_id') ."'  AND pva.status=1";
			$sql .= " AND pvad.area_name LIKE '%".$search_area."%'";

			$sql .= " LIMIT 5";

			$query = $this->db->query($sql);
			if($query->num_rows){
				return $query->rows;
			}
			return null;
		}
		
	 public function getSellerAreaByText($search_area) {			
			$sql="SELECT pva.*,pvad.area_name FROM ". DB_PREFIX ."purpletree_vendor_area pva LEFT JOIN ". DB_PREFIX ."purpletree_vendor_area_discaription pvad ON (pva.area_id=pvad.area_id) WHERE pvad.language_id='".(int)$this->config->get('config_language_id') ."'  AND pva.status=1";
			$sql .= " AND pvad.area_name = '".$search_area."'";

			$query = $this->db->query($sql);
			if($query->num_rows){
				return $query->row;
			}
			return null;
		}
		
	public function getAllSellerInfo() {
			$query = $this->db->query("SELECT pvs.*,c.firstname,c.lastname FROM " . DB_PREFIX . "purpletree_vendor_stores pvs JOIN " . DB_PREFIX . "customer c ON(c.customer_id = pvs.seller_id) where store_status = 1");
			if ($query->num_rows) {
				return $query->rows;
			}
	}	
	/// End seller area ///
	///  vacation
	public function getsellerInfo() {
			$query = $this->db->query("SELECT pvs.*,c.firstname,c.lastname FROM " . DB_PREFIX . "purpletree_vendor_stores pvs JOIN " . DB_PREFIX . "customer c ON(c.customer_id = pvs.seller_id) where seller_id='".$this->customer->getId()."' AND store_status = 1");
			if ($query->num_rows) {
				return $query->row;
			}
	}
	public function updateVacation($store_id,$status) {
		   $query = $this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_stores SET vacation = '" . (int)$status . "' WHERE id = '" . (int)$store_id . "'");
			}
		public function getStoreHoliday($store_id) {
		   $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "purpletree_vendor_holiday WHERE store_id = '" . (int)$store_id . "'");
			if ($query->num_rows > 0) {			 
				return $query->rows;
				} else {	
				return NULL;
			}
			}
		public function getStoreTimeByDay($store_id,$day_id) {
			$query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "purpletree_vendor_store_time WHERE store_id = '" . (int)$store_id . "' AND day_id = '" . (int)$day_id . "'");
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
			if(isset($data['input-date-holiday'])) {
		    foreach ($data['input-date-holiday'] as $key => $value) {
			   
			// Insert
			   $this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_holiday SET store_id = '" . (int)$store_id . "',date = '" . $value . "'");
		     }	
			}			 
			}
		/// vacation
	////quick order////
	public function getCountryName($country_id) {
		$query = $this->db->query("SELECT name FROM ". DB_PREFIX . "country WHERE country_id ='". (int)$country_id ."'");
			if($query->num_rows) {			
				 return $query->row['name'];
			 }else{
				 return null;
			 }
		}
	public function getStateName($state_id,$country_id) {
		$query = $this->db->query("SELECT name FROM ". DB_PREFIX . "zone WHERE zone_id ='". (int)$state_id ."'AND country_id ='". (int)$country_id ."'");
			if($query->num_rows) {			
				 return $query->row['name'];
			 }else{
				 return null;
			 }
		}
	////end quick order ////
		public function isSeller($customer_id){
			if ($this->config->get('module_purpletree_multivendor_status')) {
				$query = $this->db->query("SELECT id, multi_store_id,store_status, is_removed FROM " . DB_PREFIX . "purpletree_vendor_stores where seller_id='".$customer_id."'");
				if($query->num_rows) {
					return $query->row;
				}
			}
			}
		
		public function addSeller($customer_id,$store_name,$filename = ''){
			$this->db->query("INSERT into " . DB_PREFIX . "purpletree_vendor_stores SET seller_id ='".(int)$customer_id."', store_name='".$this->db->escape(trim($store_name))."', multi_store_id='".(int)($this->config->get('config_store_id'))."',store_status='".(int)(!$this->config->get('module_purpletree_multivendor_seller_approval'))."', store_created_at= NOW(), store_updated_at= NOW()");
			return $this->db->getLastId();
		}
		public function getStoreId($sellerid){
			$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE seller_id='". (int)$sellerid."'");
			if ($query->num_rows > 0) {
				return $query->row['id'];
			}	
			return '';
		}
		public function becomeSeller($customer_id,$store_name,$filename = ''){
			if($store_name['become_seller']){
				$this->db->query("INSERT into " . DB_PREFIX . "purpletree_vendor_stores SET seller_id ='".(int)$customer_id."', store_name='".$this->db->escape(trim($store_name['seller_storename']))."', store_status='".(int)(!$this->config->get('module_purpletree_multivendor_seller_approval'))."', store_created_at= NOW(), store_updated_at= NOW()");
				$store_id = $this->db->getLastId();
			}
			else {
				$store_id = 0;
			}
			return $store_id;
			
		}
		
		public function reseller($customer_id,$store_name){
			if($store_name['become_seller']){	
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_stores SET store_status='".(int)(!$this->config->get('module_purpletree_multivendor_seller_approval'))."', is_removed=0 WHERE seller_id='".(int)$customer_id."'");
				$store_id = 1;
			}
			else {
				$store_id = 0;
			}
			return $store_id;
			
		}
		
		public function getSellerStorename($store_name){
			$query = $this->db->query("SELECT id FROM " . DB_PREFIX . "purpletree_vendor_stores where store_name='".$this->db->escape($store_name)."'");
			return $query->num_rows;
		}
		
		public function getStoreRating($seller_id){
			$query = $this->db->query("SELECT AVG(rating) as rating,count(*) as count FROM " . DB_PREFIX . "purpletree_vendor_reviews where seller_id='".(int)$seller_id."' AND status=1");
			return $query->row;
		}
		
		public function getStore($store_id){
			$query = $this->db->query("SELECT pvs.*,CONCAT(c.firstname, ' ', c.lastname) AS seller_name, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "seo_url WHERE `key` = 'seller_store_id' AND `value`='" . (int)$store_id . "' AND `store_id` = '" . (int)$this->config->get('config_store_id') . "') AS store_seo FROM " . DB_PREFIX . "purpletree_vendor_stores pvs JOIN " . DB_PREFIX . "customer c ON(c.customer_id = pvs.seller_id) where pvs.id='".(int)$store_id."'");
			return $query->row;
		} 
		
		public function getStoreDetail($customer_id){
			$query = $this->db->query("SELECT pvs.* FROM " . DB_PREFIX . "purpletree_vendor_stores pvs where pvs.seller_id='".(int)$customer_id."'");
			return $query->row;
		}
		
		public function editStoreImage($store_id,$store_logo = '',$store_banner = ''){	
			$this->db->query("UPDATE " . DB_PREFIX. "purpletree_vendor_stores SET  store_logo='".$this->db->escape($store_logo)."', store_banner='".$this->db->escape($store_banner)."',store_updated_at=NOW() where id='".(int)$store_id."'");
		}
		public function editStore($store_id,$data,$file = ''){
	       $dcument = "";
			if($file != '') {
				$dcument = ",document='".$file."'";
			}
			$store_live_chat_enable = "";
			$store_live_chat_code = "";
			if(isset($data['store_live_chat_enable'])) {
				$store_live_chat_enable = ", store_live_chat_enable=". $data['store_live_chat_enable'];
			}
			if(isset($data['store_live_chat_code'])) {
				$store_live_chat_code = ', store_live_chat_code="'. $this->db->escape($data['store_live_chat_code']).'"';
			}
			if(!isset($data['store_name'])) {
				$data['store_name'] = '';
				}if(!isset($data['store_logo'])) {
				$data['store_logo'] = '';
				}if(!isset($data['store_email'])) {
				$data['store_email'] = '';
				}if(!isset($data['store_phone'])) {
				$data['store_phone'] = '';
				}if(!isset($data['store_banner'])) {
				$data['store_banner'] = '';
				}if(!isset($data['store_address'])) {
				$data['store_address'] = '';
				}if(!isset($data['store_city'])) {
				$data['store_city'] = '';
				}if(!isset($data['store_country'])) {
				$data['store_country'] = '';
				}if(!isset($data['store_state'])) {
				$data['store_state'] = '';
				}if(!isset($data['store_meta_keywords'])) {
				$data['store_meta_keywords'] = '';
				}if(!isset($data['store_meta_description'])) {
				$data['store_meta_description'] = '';
				}if(!isset($data['store_bank_details'])) {
				$data['store_bank_details'] = '';
				}if(!isset($data['store_shipping_type'])) {
				$data['store_shipping_type'] = '';
				}if(!isset($data['store_shipping_order_type'])) {
				$data['store_shipping_order_type'] = '';
				}if(!isset($data['store_shipping_charge'])) {
				$data['store_shipping_charge'] = '';
			}
			if($data['store_shipping_charge'] == '') {
				$store_shipping_charge ='NULL';
				} else {
				$store_shipping_charge = $this->db->escape($data['store_shipping_charge']);
			}
			if(!isset($data['store_description'])) {
				$data['store_description'] = '';
			}
			if(!isset($data['facebook_link'])) {
				$data['facebook_link'] = '';
			}
			if(!isset($data['google_link'])) {
				$data['google_link'] = '';
			}
			if(!isset($data['instagram_link'])) {
				$data['instagram_link'] = '';
			}
			if(!isset($data['twitter_link'])) {
				$data['twitter_link'] = '';
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
			if(!isset($data['vacation'])) {
				$data['vacation'] = 0;
			}
			if(!isset($data['store_shipping_policy'])) {
				$data['store_shipping_policy'] = '';
			}
			if(!isset($data['store_tin'])) {
				$data['store_tin'] = '';
			}
			if(!isset($data['seller_paypal_id'])) {
				$data['seller_paypal_id'] = '';
			}
			if(!isset($data['store_return_policy'])) {
				$data['store_return_policy'] = '';
			}
			if(!isset($data['store_zipcode'])) {
				$data['store_zipcode'] = '';
			}	
			if(empty($data['seller_area'])){
				$data['seller_area'] = "";
			}
			$this->db->query("UPDATE " . DB_PREFIX. "purpletree_vendor_stores SET store_name='".$this->db->escape(trim($data['store_name']))."', store_logo='".$this->db->escape($data['store_logo'])."', store_email='".$this->db->escape($data['store_email'])."', store_phone='".$this->db->escape($data['store_phone'])."', store_image='".$this->db->escape($data['store_image'])."', store_banner='".$this->db->escape($data['store_banner'])."', store_description='".$this->db->escape($data['store_description'])."'".$dcument.$store_live_chat_enable.$store_live_chat_code." , store_address='".$this->db->escape($data['store_address'])."',store_timings='".$this->db->escape($data['store_timings'])."',google_map='".$this->db->escape($data['google_map'])."',google_map_link='".$this->db->escape($data['google_map_link'])."',store_video='".$this->db->escape($data['store_video'])."', store_city='".$this->db->escape($data['store_city'])."',store_country='".(int)$data['store_country']."', store_state='".(int)$data['store_state']."',vacation='".(int)$data['vacation']."',store_state='".(int)$data['store_state']."', store_zipcode='".$this->db->escape($data['store_zipcode'])."',store_area='".$this->db->escape($data['seller_area'])."', store_shipping_policy='".$this->db->escape($data['store_shipping_policy'])."', store_return_policy='".$this->db->escape($data['store_return_policy'])."', store_meta_keywords='".$this->db->escape($data['store_meta_keywords'])."', store_meta_descriptions='".$this->db->escape($data['store_meta_description'])."', store_bank_details='".$this->db->escape($data['store_bank_details'])."', store_tin='".$this->db->escape($data['store_tin'])."', store_shipping_type ='".$this->db->escape($data['store_shipping_type'])."',store_shipping_order_type ='".$this->db->escape($data['store_shipping_order_type'])."',store_shipping_charge =".$store_shipping_charge.",seller_paypal_id ='".$this->db->escape($data['seller_paypal_id'])."',store_updated_at=NOW() where id='".(int)$store_id."'");
		
			$seller_id = $this->customer->getId();
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET custom_field = '" . $this->db->escape(isset($data['custom_field']) ? json_encode($data['custom_field']) : json_encode(array())) . "' WHERE customer_id = '" . (int)$seller_id . "'");
			
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_social_links     WHERE store_id = " . (int)$store_id . "");
			if($query->num_rows > 0){
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_social_links SET store_id = '" . (int)$store_id ."', facebook_link ='".$this->db->escape($data['facebook_link']). "', google_link ='".$this->db->escape($data['google_link']). "',instagram_link ='".$this->db->escape($data['instagram_link'])."', twitter_link ='".$this->db->escape($data['twitter_link'])."', pinterest_link ='".$this->db->escape($data['pinterest_link'])."', wesbsite_link ='".$this->db->escape($data['wesbsite_link']). "',  whatsapp_link ='".$this->db->escape($data['whatsapp_link']). "' where store_id ='".(int)$store_id."'");
				}else{ 
				$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_social_links SET store_id = '" . (int)$store_id ."', facebook_link ='".$this->db->escape($data['facebook_link']). "', google_link ='".$this->db->escape($data['google_link']). "',instagram_link ='".$this->db->escape($data['instagram_link'])."', twitter_link ='".$this->db->escape($data['twitter_link'])."', pinterest_link ='".$this->db->escape($data['pinterest_link'])."', wesbsite_link ='".$this->db->escape($data['wesbsite_link']). "',  whatsapp_link ='".$this->db->escape($data['whatsapp_link']). "'");
				
			}
			
			if ($data['store_seo']) {
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "seo_url` WHERE `key` = 'seller_store_id' AND `value` = '" . (int)$store_id . "'");
				if($query->num_rows > 0){
					$row = $query->row;
					$this->db->query("UPDATE `" . DB_PREFIX . "seo_url` SET `key` = 'seller_store_id', `value`= '" . (int)$store_id . "', `language_id` = '0', `keyword` = '".$this->db->escape($data['store_seo']) . "' WHERE `seo_url_id`=".$row['seo_url_id']);
					$this->db->query("UPDATE `" . DB_PREFIX . "seo_url` SET `key` = 'seller_store_id',`value` = '" . (int)$store_id . "', `language_id` = '".(int)$this->config->get('config_language_id') ."', `keyword` = '" . $this->db->escape($data['store_seo']) . "' WHERE `store_id` = '" . (int)$this->config->get('config_store_id') . "' AND `seo_url_id`=".$this->db->escape($row['seo_url_id']));
					} else{
						$this->db->query("INSERT INTO `" . DB_PREFIX . "seo_url` SET `key` = 'seller_store_id', `value`='" . (int)$store_id . "', `language_id` = '".(int)$this->config->get('config_language_id') ."', `store_id` = '" . (int)$this->config->get('config_store_id') . "', `keyword` = '" . $this->db->escape($data['store_seo']) . "'");
				}
				}else {
				$this->db->query("DELETE FROM `" . DB_PREFIX . "seo_url` WHERE `key` = 'seller_store_id' AND `value` ='" . (int)$store_id ."'");
			}
		}
		public function getStoreByEmail($email) {
			$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE LCASE(store_email) = '" . $this->db->escape(strtolower($email)) . "'");
			
			return $query->row;
			
		}
		
		public function getStoreSeo($seo_url) {
			
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "seo_url WHERE keyword = '".$this->db->escape($seo_url) . "'");
			return $query->row;
		}
		
		public function removeSeller($seller_id){
			$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_products pvp JOIN " . DB_PREFIX . "product p ON(p.product_id=pvp.product_id) SET p.status=0 WHERE pvp.seller_id='".(int)$seller_id."'");
			
			$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_stores SET store_status=0, is_removed=1 WHERE seller_id='".(int)$seller_id."'");
		}
		public function getStoreNameByStoreName($store_name2){
			$sql = "SELECT pvs.id ,pvs.seller_id ,pvs.store_name,c.status FROM " . DB_PREFIX . "purpletree_vendor_stores pvs LEFT JOIN ". DB_PREFIX ."customer c ON(pvs.seller_id = c.customer_id) WHERE pvs.store_name = '" . $this->db->escape(trim($store_name2)) . "' AND c.status=1";
			$query = $this->db->query($sql);    
			return $query->row;	
		}
		public function getStoreSocial($store_id){
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_social_links pvsl where pvsl.store_id='".(int)$store_id."'");
			if($query->num_rows) {
				return $query->row;
			} 
		}
		public function getStoreByIdd($sellerid,$email_id){
			$query = $this->db->query("SELECT count(*) AS num_row FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE seller_id !='". (int)$sellerid."' AND store_email='".$email_id."'");
			if ($query->num_rows > 0) {
				return $query->row['num_row'];
				} else {	
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
		public function getStoresById($sellerid){
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE seller_id='". (int)$sellerid."'");
			if ($query->num_rows > 0) {
				return $query->rows;
			}	
			return array();
		}
		public function getCustomerEmailId($seller_id) {
			
			$query = $this->db->query("SELECT email  FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$seller_id . "'");
			if($query->num_rows>0){
				return $query->row['email'];
				}else {
				return NULL;
			}
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
		public function getAssingedCategories() {
			$seller_id = $this->customer->getId();
			$sql = "SELECT * FROM " . DB_PREFIX . "category_description cd LEFT JOIN " . DB_PREFIX . "purpletree_vendor_allowed_category pvac ON (pvac.category_id = cd.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pvac.seller_id = '" . (int)$seller_id . "' ORDER BY	cd.name";
			
			$query = $this->db->query($sql);
			
			if($query->num_rows > 0){
				return $query->rows;
			}
		}
		public function getSelleRegisterEmailTemplate($email_code) {
			
			$sql1="SELECT lu.code FROM ". DB_PREFIX ."language lu WHERE lu.language_id='".(int)$this->config->get('config_language_id') ."'";
			
			$query2 = $this->db->query($sql1);
			$language_code = $query2->row['code'];	
			
			$query3 = $this->db->query("SELECT count(*) AS total FROM ". DB_PREFIX ."purpletree_vendor_email pve WHERE pve.language_code='".  $this->db->escape($language_code) ."' AND pve.email_code = '".$this->db->escape($email_code)."'");
			if ($query3->row['total'] > 0) {
				   $language_code = $query2->row['code'];	
				} else {	
				  $language_code = 'en-gb';
			}
			$sql="SELECT pve.id,pve.title,pve.new_subject, pve.new_message FROM ". DB_PREFIX ."purpletree_vendor_email pve WHERE pve.language_code='".  $this->db->escape($language_code) ."' AND pve.email_code = '".$this->db->escape($email_code)."'";			
			
			$query = $this->db->query($sql);			
			return $query->row;
		}
		public function getmsgfromarray($replacevar,$templatefromdb){		
			foreach($replacevar as $key => $val) {
			
			$templatefromdb = str_replace($key,$val,$templatefromdb);
			}
			
			return $templatefromdb;
		}
		public function ptsSendMail($reciver,$subject,$message,$attach_file=array()){
		if ($this->config->get('config_mail_engine')) {
		    $mail = new \Opencart\System\Library\Mail($this->config->get('config_mail_engine'));
			//$mail = new Mail($this->config->get('config_mail_engine'));
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$mail->setTo($reciver);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode($subject));
			if(!empty($attach_file)){
				foreach($attach_file as $file){
					$mail->addAttachment($file);
				}
			}
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
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
	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}
	public function getCustomFieldsForSeller($data = array()) {
		if (empty($data['filter_customer_group_id'])) {
			$sql = "SELECT * FROM `" . DB_PREFIX . "custom_field` cf INNER JOIN " . DB_PREFIX . "purpletree_vendor_customfield pvc ON (pvc.custom_field_id = cf.custom_field_id) LEFT JOIN " . DB_PREFIX . "custom_field_description cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cfd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		} else {
			$sql = "SELECT * FROM " . DB_PREFIX . "custom_field_customer_group cfcg INNER JOIN " . DB_PREFIX . "purpletree_vendor_customfield pvc ON (pvc.custom_field_id = cf.custom_field_id) LEFT JOIN `" . DB_PREFIX . "custom_field` cf ON (cfcg.custom_field_id = cf.custom_field_id) LEFT JOIN " . DB_PREFIX . "custom_field_description cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cfd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
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
	public function getCustomField($custom_field_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field` cf LEFT JOIN `" . DB_PREFIX . "custom_field_description` cfd ON (cf.custom_field_id = cfd.custom_field_id) INNER JOIN `" . DB_PREFIX . "purpletree_vendor_customfield` pvc ON (pvc.custom_field_id = cf.custom_field_id) WHERE cf.status = '1' AND cf.custom_field_id = '" . (int)$custom_field_id . "' AND cfd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getCustomFields($customer_group_id = 1) {
		$custom_field_data = array();

		if (!$customer_group_id) {
			$custom_field_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field` cf LEFT JOIN `" . DB_PREFIX . "custom_field_description` cfd ON (cf.custom_field_id = cfd.custom_field_id) INNER JOIN `" . DB_PREFIX . "purpletree_vendor_customfield` pvc ON (cf.custom_field_id = pvc.custom_field_id) WHERE cf.status = '1' AND cfd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cf.status = '1' ORDER BY cf.sort_order ASC");
		} else {
			$custom_field_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "custom_field_customer_group` cfcg LEFT JOIN `" . DB_PREFIX . "custom_field` cf ON (cfcg.custom_field_id = cf.custom_field_id) INNER JOIN `" . DB_PREFIX . "purpletree_vendor_customfield` pvc ON (cf.custom_field_id = pvc.custom_field_id) LEFT JOIN `" . DB_PREFIX . "custom_field_description` cfd ON (cf.custom_field_id = cfd.custom_field_id) WHERE cf.status = '1' AND cfd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cfcg.customer_group_id = '" . (int)$customer_group_id . "' ORDER BY cf.sort_order ASC");
		}

		foreach ($custom_field_query->rows as $custom_field) {
			$custom_field_value_data = array();

			if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio' || $custom_field['type'] == 'checkbox') {
				$custom_field_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custom_field_value cfv LEFT JOIN " . DB_PREFIX . "custom_field_value_description cfvd ON (cfv.custom_field_value_id = cfvd.custom_field_value_id) INNER JOIN " . DB_PREFIX . "purpletree_vendor_customfield pvc ON (pvc.custom_field_id = cfvd.custom_field_id) WHERE cfv.custom_field_id = '" . (int)$custom_field['custom_field_id'] . "' AND cfvd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY cfv.sort_order ASC");

				foreach ($custom_field_value_query->rows as $custom_field_value) {
					$custom_field_value_data[] = array(
						'custom_field_value_id' => $custom_field_value['custom_field_value_id'],
						'name'                  => $custom_field_value['name']
					);
				}
			}

			$custom_field_data[] = array(
				'custom_field_id'    => $custom_field['custom_field_id'],
				'custom_field_value' => $custom_field_value_data,
				'name'               => $custom_field['name'],
				'type'               => $custom_field['type'],
				'value'              => $custom_field['value'],
				'validation'         => $custom_field['validation'],
				'location'           => $custom_field['location'],
				'step_location'      => $custom_field['step_location'],
				'required'           => empty($custom_field['required']) || $custom_field['required'] == 0 ? false : true,
				'sort_order'         => $custom_field['sort_order']
			);
		}

		return $custom_field_data;
	}
	public function getcustomsellerfiled($custom_field_id) {
		$query = $this->db->query("SELECT id FROM `" . DB_PREFIX . "purpletree_vendor_customfield` WHERE `custom_field_id`=".$custom_field_id);

			return $query->num_rows;
		}
		
		public function getAllSellerProducts($data=array()){
			
			$sql = "SELECT pd.*, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating,p.*,pvp.* ,CONCAT(c.firstname, ' ', c.lastname) AS seller_name FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) JOIN " . DB_PREFIX . "purpletree_vendor_products pvp ON(pvp.product_id=p.product_id) JOIN " .DB_PREFIX. "customer c ON(c.customer_id=pvp.seller_id) LEFT JOIN ".DB_PREFIX. "product_to_category ptc ON(ptc.product_id=p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND p.date_available <= NOW()";
			
			if(!empty($data['seller_id'])){
				
				$sql .= " AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pvp.seller_id ='".(int)$data['seller_id']."'";
				} else {
				$sql .= " AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			}	
			//
		if(isset($data['product']) && $data['product']=='' && isset($data['template_product']) && $data['template_product'] && isset($data['p_url']) && $data['p_url']!='all' ){
			$data['product']='9999999';	
		}
			if(isset($data['product'])){
				if(!empty($data['product'])){
					$sql.="AND pvp.product_id IN (".$data['product'].")";		
				}	
			}
			
			if(!empty($data['category_id']))
			{
				$sql .= " AND ptc.category_id = '" . (int)$data['category_id'] . "'";
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
			
			if (isset($data['status']) && !is_null($data['status'])) {
				$sql .= " AND p.status = '" . (int)$data['status'] . "'";
			}
			
			if (isset($data['is_approved']) && !is_null($data['is_approved'])) {
				$sql .= " AND pvp.is_approved = '" . (int)$data['is_approved'] . "'";
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
					$data['limit'] = 5;
				}
				
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}
			//echo $sql;
			//	die;
			$query = $this->db->query($sql);
			
			return $query->rows;
		}
		public function getAllTotalSellerProducts($data = array()) {
			$sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) JOIN " . DB_PREFIX . "purpletree_vendor_products pvp ON(pvp.product_id=p.product_id) JOIN " .DB_PREFIX. "customer c ON(c.customer_id=pvp.seller_id) LEFT JOIN ".DB_PREFIX. "product_to_category ptc ON(ptc.product_id=p.product_id)";
			
			$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
			$sql .= " AND p.date_available <= NOW()";
			if(!empty($data['seller_id'])){
				$sql .= " AND pvp.seller_id ='".(int)$data['seller_id']."'";
			}
			if(isset($data['product'])){
				if(!empty($data['product'])){
					$sql.="AND pvp.product_id IN (".$data['product'].")";		
				}	
			}
			if(!empty($data['category_id']))
			{
				$sql .= " AND ptc.category_id = '" . (int)$data['category_id'] . "'";
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
			
			if (isset($data['status']) && !is_null($data['status'])) {
				$sql .= " AND p.status = '" . (int)$data['status'] . "'";
			}
			
			if (isset($data['is_approved']) && !is_null($data['is_approved'])) {
				$sql .= " AND pvp.is_approved = '" . (int)$data['is_approved'] . "'";
			}
			
			$query = $this->db->query($sql);
			
			return $query->row['total'];
		}
		public function getSellerId($email) {
		$query = $this->db->query("SELECT customer_id FROM `" . DB_PREFIX . "customer` WHERE `email`='".$this->db->escape($email)."'");
		if($query->num_rows){
			return $query->row['customer_id'];
		}
			return NULL;
			
		}
	public function is_seller($seller_id) {
		if($seller_id){
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purpletree_vendor_stores` WHERE `seller_id`=".(int)$seller_id);
			if($query->num_rows){
				return true;
			}
			return false;
		} else {
			return false;	
		}
	}
	public function getAllStoreData() {
		$query = $this->db->query("SELECT multi_store_id FROM `" . DB_PREFIX . "purpletree_vendor_stores`");
			if($query->num_rows){
				return $query->rows;
			}
			return false;
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
	public function getTotalStores($category_id) {

		$sql = "SELECT COUNT(DISTINCT pvs.seller_id) AS total FROM " . DB_PREFIX . "purpletree_vendor_allowed_category pvac INNER JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON (pvs.seller_id = pvac.seller_id) LEFT JOIN " . DB_PREFIX . "country co ON (co.country_id = pvs.store_country) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c2s.category_id = pvac.category_id) WHERE pvac.category_id = '" . (int)$category_id . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getCategoriesBySellerStore($path_id) {
		$query = $this->db->query("SELECT co.name AS country_name,ptc.*,cp.*, c2s.*,pvp.*,pvs.*,co.*,cd.*,c.* FROM " . DB_PREFIX . "product_to_category ptc LEFT JOIN " . DB_PREFIX . "category_path cp ON (ptc.category_id = cp.category_id) LEFT JOIN " . DB_PREFIX . "category c ON (c.category_id = ptc.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) LEFT JOIN " . DB_PREFIX . "purpletree_vendor_products pvp ON (pvp.product_id = ptc.product_id) Inner JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON (pvp.seller_id = pvs.seller_id) LEFT JOIN " . DB_PREFIX . "country co ON (co.country_id = pvs.store_country) WHERE c.parent_id = '" . (int)"0" . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND cp.path_id = '" . (int)$path_id . "'  AND c.status = '1' GROUP BY pvs.id ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}
	
		public function getCategoriesBySellerStoreFromTemplatePro($path_id) {
		$query = $this->db->query("SELECT co.name AS country_name,ptc.*,cp.*, c2s.*,pvt.*,pvs.*,co.*,cd.*,c.* FROM " . DB_PREFIX . "product_to_category ptc LEFT JOIN " . DB_PREFIX . "category_path cp ON (ptc.category_id = cp.category_id) LEFT JOIN " . DB_PREFIX . "category c ON (c.category_id = ptc.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) LEFT JOIN " . DB_PREFIX . "purpletree_vendor_template pvt ON (pvt.product_id = ptc.product_id) LEFT JOIN " . DB_PREFIX . "purpletree_vendor_template_products pvtp ON (pvt.id = pvtp.template_id) Inner JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON (pvtp.seller_id = pvs.seller_id) LEFT JOIN " . DB_PREFIX . "country co ON (co.country_id = pvs.store_country) WHERE c.parent_id = '" . (int)"0" . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND cp.path_id = '" . (int)$path_id . "'  AND c.status = '1' GROUP BY pvs.id ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}
	
		public function getAssinCategoriesSeller($category_id, $data=array()) {
		$sql = "SELECT *,co.name AS country_name FROM " . DB_PREFIX . "purpletree_vendor_allowed_category pvac INNER JOIN " . DB_PREFIX . "purpletree_vendor_stores pvs ON (pvs.seller_id = pvac.seller_id) LEFT JOIN " . DB_PREFIX . "country co ON (co.country_id = pvs.store_country) WHERE category_id = '" . (int)$category_id . "'";
		  
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
	
	public function checkAssignCategory($category_id) {
		$query = $this->db->query("SELECT seller_id FROM " . DB_PREFIX . "purpletree_vendor_allowed_category  WHERE category_id = '" . (int)$category_id . "'");
		return $query->rows;
	}
	public function getCoupon($coupon_id) {
			$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "coupon WHERE coupon_id = '" . (int)$coupon_id . "'");
			
			return $query->row;
		}
	public function getsellerInfofororder($sellerid) { 	
		    $query = $this->db->query("SELECT pvs.store_name, pvs.id AS store_id FROM " . DB_PREFIX . "purpletree_vendor_stores pvs  WHERE pvs.seller_id = '" . (int)$sellerid . "'");    
		     return $query->row;
		 
	}
	
	public function getSellerOrderHistories($order_id) {
		$query = $this->db->query("SELECT pvh.order_id, pvh.seller_id, pvh.created_at, os.name AS status, pvh.comment, pvh.notify FROM " . DB_PREFIX . "purpletree_vendor_orders_history pvh LEFT JOIN " . DB_PREFIX . "order_status os ON pvh.order_status_id = os.order_status_id WHERE pvh.order_id = '" . (int)$order_id . "' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY pvh.id ASC");
		return $query->rows;
	}
	
	public function getUniqueSeller($order_id){
		$query = $this->db->query("SELECT DISTINCT(seller_id) FROM " . DB_PREFIX . "purpletree_vendor_orders_history WHERE order_id='".(int)$order_id."' order by id desc");
		$result = $query->rows;
		$aa = array();
		$aa = $this->getSellerOrderStatus($result, $order_id);
		$dd = array();
		if(!empty($aa)) {
			foreach($aa as $bb) {
			foreach($bb['product'] as $cc) {
				$dd[] = $cc['product_id'];
			}
		}
		}
		
		$query11 = $this->db->query("SELECT '0' AS seller_id,op.product_id,op.name as product_name, os.name AS status FROM `" . DB_PREFIX . "order_product` op LEFT JOIN `" . DB_PREFIX . "order` o ON o.order_id = op.order_id LEFT JOIN `" . DB_PREFIX . "order_status` os ON o.order_status_id = os.order_status_id WHERE op.order_id='" . $order_id . "' GROUP BY op.order_product_id");
		$resul11t = $query11->rows;
			$fdfd = array();
		foreach($resul11t as $ree) {
			if(!empty($aa)) {
				if(!in_array($ree['product_id'],$dd)) {
		$fdfd[$ree['product_id']]['product_name'] = $ree['product_name'];
					foreach($aa as $gg) {
						$aa[0] = array("order_status" =>  $ree['status'],
										"product" => $fdfd
						);
					}
				}
			} else {
		$fdfd[$ree['product_id']]['product_name'] = $ree['product_name'];
				$aa[0] = array("order_status" =>  $ree['status'],
								"seller_id" => '0',
										"product" => $fdfd
						);
			}
		}
		return $aa;
	}
	
	public function getSellerOrderStatus($result, $order_id){
		$order_status = array();
		foreach($result as $result){
			$query = $this->db->query("SELECT pvh.order_id, pvh.seller_id, pvh.created_at, os.name AS status FROM " . DB_PREFIX . "purpletree_vendor_orders_history pvh LEFT JOIN " . DB_PREFIX . "order_status os ON pvh.order_status_id = os.order_status_id WHERE pvh.seller_id='".(int)$result['seller_id']."' AND pvh.order_id='".(int)$order_id."' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY pvh.id DESC limit 1");
					if($query->num_rows) {
			$result1 = $query->row;
			$order_status[$result['seller_id']] = array(
				'order_status' => $result1['status'],
				'seller_id' => $result['seller_id'],
				'product' => $this->getSellerOrderProducts($order_id, $result['seller_id'])
			);
			}
		}
	
		return $order_status;
	}
	
	public function getSellerOrderProducts($order_id, $seller_id){
		$query = $this->db->query("SELECT pvo.product_id,(SELECT op.name FROM " . DB_PREFIX . "order_product op where op.product_id = pvo.product_id AND op.order_id = pvo.order_id LIMIT 0,1) as product_name FROM " . DB_PREFIX . "purpletree_vendor_orders pvo WHERE pvo.seller_id='".(int)$seller_id."' AND pvo.order_id = '".(int)$order_id."'");
    
		return $query->rows;
	}
	public function getStoreName($seller_id) {
		$query = $this->db->query("SELECT store_name FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE seller_id = " . (int)$seller_id );

		if ($query->num_rows > 0) {
			return $query->row['store_name'];
		} else {
			return null;	
		}
		
	}
    public function getOrderedProductsellerid($order_id,$product_id) {
		$query = $this->db->query("SELECT seller_id FROM `" . DB_PREFIX . "purpletree_vendor_orders` WHERE order_id = '" . (int)$order_id . "' AND product_id = '" . (int)$product_id . "' ");
		if($query->num_rows){
		return $query->row['seller_id'];
		}
	}
	
	public function getLatestsellerstatus($order_id, $seller_id){
		$query = $this->db->query("SELECT oh.created_at, os.name AS status, oh.comment, oh.notify,oh.order_status_id FROM " . DB_PREFIX . "purpletree_vendor_orders_history oh LEFT JOIN " . DB_PREFIX . "order_status os ON oh.order_status_id = os.order_status_id WHERE oh.order_id = '" . (int)$order_id . "' AND oh.seller_id= '".(int)$seller_id."' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oh.id DESC LIMIT 1");
		return $query->row;
	}
	public function getOrderProducts($order_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		return $query->rows;
	}
	
}
?>