<?php
namespace Opencart\Admin\Model\Extension\PurpletreeMultivendor\Multivendor;
class Seatingmanagement extends \Opencart\System\Engine\Model {
		public function addSeatingmanagement($data) {
			
			$this->db->query("INSERT INTO " . DB_PREFIX . "seatingmanagement SET table_no = '" . $this->db->escape($data['table_no']) . "', seat_capacity = '" . (int)$data['seat_capacity'] . "', vendor_store_id = '" . (int)$data['vendor_store_id'] . "', status = '" . (bool)(isset($data['status']) ? $data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");
			$table_id = $this->db->getLastId();
			
			
		}
		
		
		public function editSeatingmanagement($table_id,$data) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "seatingmanagement SET table_no = '" . $this->db->escape($data['table_no']) . "', seat_capacity = '" . (int)$data['seat_capacity'] . "', vendor_store_id = '" . (int)$data['vendor_store_id'] . "', status = '" . (bool)(isset($data['status']) ? $data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");
			
			$table_id = $this->db->getLastId();
		}
		
		
		
		public function getSeatingManagements($data = array()) {			
			
			$sql="SELECT pva.*,pvad.area_name FROM ". DB_PREFIX ."purpletree_vendor_area pva LEFT JOIN ". DB_PREFIX ."purpletree_vendor_area_discaription pvad ON (pva.area_id=pvad.area_id) WHERE pvad.language_id='".(int)$this->config->get('config_language_id') ."'";
			
			
			$query = $this->db->query($sql);
			
			return $query->rows;
		}
		
		
		public function getSellerAreaDescriptions($area_id) {
			$seller_area_description_data = array();
			
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_area_discaription WHERE area_id = '" . (int)$area_id . "'");
			
			foreach ($query->rows as $result) {
				$seller_area_description_data[$result['language_id']] = array(
				'name'             => $result['area_name']				
				);
			}
			
			return $seller_area_description_data;
		}
		
		public function getArea($area_id) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_area WHERE area_id = '" . (int)$area_id . "'");
			
			return $query->row;
		}
		public function deleteSellerArea($area_id) {
			$this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_vendor_area_discaription WHERE area_id = '" . (int)$area_id . "'");
			$this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_vendor_area WHERE area_id = '" . (int)$area_id . "'");		
			
		}
		public function checkSellerArea($area_id) {
			//$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_seller_plan WHERE area_id = '" . (int)$area_id . "'");
			
			if($query->rows){
				return $query->row;
				}else{
				return NULL;
			}
		}
		
		
}