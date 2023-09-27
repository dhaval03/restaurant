<?php
namespace Opencart\Admin\Model\Extension\PurpletreeMultivendor\Multivendor;
class Ordertype extends \Opencart\System\Engine\Model {
	public function addOrdertype($data) {					
		$this->db->query("INSERT INTO " . DB_PREFIX . "order_type SET name = '" . $this->db->escape($data['name']) . "', status = '" . (bool)(isset($data['status']) ? $data['status'] : 0) . "', date_modified = NOW(), date_added = NOW()");
		
		$order_type_id = $this->db->getLastId();	
	}
		
	public function editOrdertype(int $order_type_id, array $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "order_type` SET name = '" . $this->db->escape($data['name']) . "',  status = '" . (bool)(isset($data['status']) ? $data['status'] : 0) . "' WHERE `order_type_id` = '" . (int)$order_type_id . "'");
					
		$this->cache->delete('ordertype');
	}
	
	public function deleteOrdertype(int $order_type_id) {
		
		$this->db->query("DELETE FROM `" . DB_PREFIX . "order_type` WHERE `order_type_id` = '" . (int)$order_type_id . "'");
		
		$this->cache->delete('ordertype');
			
	}
		
	public function getOrderType($order_type_id ) {
			
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "order_type` WHERE `order_type_id` = '" . (int)$order_type_id  . "'");

		return $query->row;
	}
		
	public function getOrderTypes($data = array()) {			
			
		$sql="SELECT * FROM ". DB_PREFIX ."order_type ORDER BY order_type_id  ASC";
			
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
	
	public function getTotalOrderType() {
		
		$query = $this->db->query("SELECT COUNT(*) AS `total` FROM `" . DB_PREFIX . "order_type`");

		return (int)$query->row['total'];
	}
		
		
}