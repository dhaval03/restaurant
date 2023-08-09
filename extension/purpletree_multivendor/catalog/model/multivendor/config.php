<?php
namespace Opencart\Catalog\Model\Extension\PurpletreeMultivendor\Multivendor;
class Config extends \Opencart\System\Engine\Model{
	public function validateSeller($skipcondition = null) {
		if($_SERVER['HTTP_HOST'] == 'localhost') {
			$domain = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
		} else {
			$domain = 'http://'.$_SERVER['HTTP_HOST'];
		}
		$ip_a = $_SERVER['HTTP_HOST'];
		if(isset($skipcondition)){
		      $domain1 = md5($domain);
			$text = $this->config->get('module_purpletree_multivendor_encypt_text');
			$data_live = $this->config->get('module_purpletree_multivendor_live_validate_text');
			if(($domain1 == $text) && $data_live == 1) {
				return true;
			} else {
				$module	= 'purpletree_multivendor_oc';
				$valuee = $this->config->get('module_purpletree_multivendor_process_data');
				$ip_address = $this->request->server['REMOTE_ADDR'];
				$url = "https://www.process.purpletreesoftware.com/occheckdata.php";
				$handle=curl_init($url);
				curl_setopt($handle, CURLOPT_VERBOSE, true);
				curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($handle, CURLOPT_POSTFIELDS,
							"process_data=$valuee&domain_name=$domain&ip_address=$ip_address&module_name=$module");
				$result = curl_exec($handle);
				$result1 = json_decode($result);
				if(curl_error($handle))
				{
					echo 'error';
					die;
				}
				if ($result1->status == 'success') {
					$query = $this->db->query("UPDATE " . DB_PREFIX . "setting SET value = '1' WHERE " . DB_PREFIX . "setting.key = 'module_purpletree_multivendor_live_validate_text'");
					
				$query1 = $this->db->query("UPDATE " . DB_PREFIX . "setting SET value = '" .$domain1. "' WHERE " . DB_PREFIX . "setting.key = 'module_purpletree_multivendor_encypt_text'");
				
				return true;
				 } else {
					 return false;
				}
			}
		}else{
		     //$ip_a = '103.111.47.26:123';
		   	$ip_a = str_replace(array(':', '.'), '', $ip_a);
				if (is_numeric($ip_a)){
					return true;
			}
		
		if (preg_match('(localhost|demo|test)',$domain)) {
			return true;
		} else {
			$domain1 = md5($domain);
			$text = $this->config->get('module_purpletree_multivendor_encypt_text');
			$data_live = $this->config->get('module_purpletree_multivendor_live_validate_text');
			if(($domain1 == $text) && $data_live == 1) {
				return true;
			} else {
				$module	= 'purpletree_multivendor_oc';
				$valuee = $this->config->get('module_purpletree_multivendor_process_data');
				$ip_address = $this->request->server['REMOTE_ADDR'];
				$url = "https://www.process.purpletreesoftware.com/occheckdata.php";
				$handle=curl_init($url);
				curl_setopt($handle, CURLOPT_VERBOSE, true);
				curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($handle, CURLOPT_POSTFIELDS,
							"process_data=$valuee&domain_name=$domain&ip_address=$ip_address&module_name=$module");
				$result = curl_exec($handle);
				$result1 = json_decode($result);
				if(curl_error($handle))
				{
					echo 'error';
					die;
				}
				if ($result1->status == 'success') {
					$query = $this->db->query("UPDATE " . DB_PREFIX . "setting SET value = '1' WHERE " . DB_PREFIX . "setting.key = 'module_purpletree_multivendor_live_validate_text'");
					
				$query1 = $this->db->query("UPDATE " . DB_PREFIX . "setting SET value = '" .$domain1. "' WHERE " . DB_PREFIX . "setting.key = 'module_purpletree_multivendor_encypt_text'");
				
				return true;
				 } else {
					 return false;
				} 
				}
		}	
		}
	}		
}
?>
