<?php
namespace Opencart\Catalog\Model\Extension\PurpletreeMultivendor\Multivendor;
class Pos extends \Opencart\System\Engine\Model {	
	function getPos($category_id){
				
			$sql ="SELECT * FROM `product` p LEFT JOIN `product_description` pd ON (p.`product_id` = pd.`product_id`) LEFT JOIN `product_to_category` pc ON (p.`product_id` = pc.`product_id`) WHERE pc.`category_id` = '".$category_id."'";
		    $query = $this->db->query($sql);
				
				return $query->rows;
	}
}
?>