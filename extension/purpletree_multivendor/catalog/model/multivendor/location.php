<?php
namespace Opencart\Catalog\Model\Extension\PurpletreeMultivendor\Multivendor;
class Location extends \Opencart\System\Engine\Model {
	
		
	public function deleteLocation($tl_id) {
		
		$this->db->query("DELETE FROM `" . DB_PREFIX . "seating_location` WHERE `tl_id` = '" . (int)$tl_id . "'");
		
		$this->cache->delete('seating_location');
			
	}
		
	public function getLocation($tl_id) {
			
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "seating_location` WHERE `tl_id` = '" . (int)$tl_id . "'");

		return $query->row;
	}
	
	public function getLocations($data = array()) {			
			
		$sql="SELECT * FROM ". DB_PREFIX ."seating_location ORDER BY tl_id ASC";
			
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
	
	public function getTotalLocations () {
		$query = $this->db->query("SELECT COUNT(*) AS `total` FROM `" . DB_PREFIX . "seating_location`");

		return (int)$query->row['total'];
	}
	public function jxLocations($data){
		if($data['tl_id'] > 0){
			$this->db->query("UPDATE " . DB_PREFIX . "seating_location SET name = '" . $this->db->escape($data['name']) . "',sort_order = '" . (int)$data['sort_order'] . "', status = '" . (bool)(isset($data['status']) ? $data['status'] : 0) . "' WHERE tl_id = '".$data['tl_id']."'");
		}else{
			$this->db->query("INSERT INTO " . DB_PREFIX . "seating_location SET name = '" . $this->db->escape($data['name']) . "',sort_order = '" . (int)$data['sort_order'] . "', status = '" . (bool)(isset($data['status']) ? $data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");
		}
		$this->cache->delete('seating_location');
	}
		
}
?>