<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Startup;
class Seourl extends \Opencart\System\Engine\Controller {	
	public function afterSeoUrlModel(&$route, &$data, &$output) {
		if ($this->config->get('config_seo_url')) {
		$key	=	$data[0];
		$value	=	$data[1];
		$url_string = "extension/purpletree_multivendor/multivendor";
		$mvurl = false;
		if(strstr($value,$url_string) && $key === 'route') {
			$url = str_replace($url_string,'',$value);
			$value = $url_string;		
			$mvurl = true;
		}

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "seo_url` WHERE `key` = '" . $this->db->escape($key) . "' AND `value` = '" . $this->db->escape($value) . "' AND `store_id` = '" . (int)$this->config->get('config_store_id') . "' AND `language_id` = '" . (int)$this->config->get('config_language_id') . "'");

		if($mvurl and $query->num_rows){
			$query->row['keyword'] = $query->row['keyword'].$url;
		}
		return $query->row;
		}
	}
}
?>