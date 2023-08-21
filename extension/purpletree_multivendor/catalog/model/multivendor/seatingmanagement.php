<?php
namespace Opencart\Catalog\Model\Extension\PurpletreeMultivendor\Multivendor;
class Seatingmanagement extends \Opencart\System\Engine\Model {
	public function addSeatingmanagement(int $table_id, array $data) {
			
		$this->db->query("INSERT INTO " . DB_PREFIX . "seatingmanagement SET table_no = '" . $this->db->escape($data['table_no']) . "', seat_capacity = '" . (int)$data['seat_capacity'] . "', vendor_store_id = '" . (int)$data['vendor_store_id'] . "',location = '" . (int)$data['location'] . "', status = '" . (bool)(isset($data['status']) ? $data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");
		
		$table_id = $this->db->getLastId();
	}
		
	public function editSeatingmanagement(int $table_id, array $data) {
		//print_r($data);exit;
			
		$this->db->query("UPDATE `" . DB_PREFIX . "seatingmanagement` SET table_no = '" . $this->db->escape($data['table_no']) . "', seat_capacity = '" . (int)$data['seat_capacity'] . "', vendor_store_id = '" . (int)$data['vendor_store_id'] . "',location = '" . (int)$data['location'] . "', status = '" . (bool)(isset($data['status']) ? $data['status'] : 0) . "' WHERE `table_id` = '" . (int)$table_id . "'");
					
		$this->cache->delete('seatingmanagement');
	}
		
	public function deleteSeatingManagement(int $table_id) {
		
		$this->db->query("DELETE FROM `" . DB_PREFIX . "seatingmanagement` WHERE `table_id` = '" . (int)$table_id . "'");
		
		$this->cache->delete('seatingmanagement');
			
	}
		
	public function getSeatingManagement($table_id) {
			
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "seatingmanagement` WHERE `table_id` = '" . (int)$table_id . "'");

		return $query->row;
	}
	public function getSeatingManagements($data = array()) {			
			
		$sql="SELECT * FROM ". DB_PREFIX ."seatingmanagement ORDER BY table_id DESC";
			
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
	public function getTotalSeatingManagements () {
		$query = $this->db->query("SELECT COUNT(*) AS `total` FROM `" . DB_PREFIX . "seatingmanagement`");

		return (int)$query->row['total'];
	}
		
		

	
}
?>