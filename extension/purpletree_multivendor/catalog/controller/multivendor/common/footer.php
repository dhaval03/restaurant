<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Common;
class Footer extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->language('extension/purpletree_multivendor/multivendor/footer');
		$isSeller =  array();
		$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
		$isSeller = $this->model_extension_purpletree_multivendor_multivendor_dashboard->isSeller($this->customer->getId());

		if ($this->customer->isLogged() && $isSeller) {
			$data['text_version'] = sprintf($this->language->get('text_version'), '3.15.16');
		} else {
			$data['text_version'] = '';
		}
		$data['seller_chat'] = '';
			if(NULL !== $this->config->get('module_purpletree_multivendor_status')){
			if($this->config->get('module_purpletree_multivendor_status')){
				if(NULL !== $this->config->get('module_purpletree_multivendor_allow_live_chat')) {
				if($this->config->get('module_purpletree_multivendor_allow_live_chat')) {	
				if(isset($this->session->data['seller_sto_page'])){
					$seller_store_idd = $this->session->data['seller_sto_page'];
					  $query = $this->db->query("SELECT `store_live_chat_enable` ,`store_live_chat_code` FROM " . DB_PREFIX . "purpletree_vendor_stores WHERE `id` = '" . (int)$seller_store_idd . "'");
					    if ($query->num_rows) {
							if($query->row['store_live_chat_enable']) {
								if($query->row['store_live_chat_code'] != '') {
										unset($this->session->data['seller_sto_page']);
									$data['seller_chat'] = '1';
								}
							}
						}
				}
				}
				}
			}
			}
		return $this->load->view('extension/purpletree_multivendor/multivendor/footer', $data);
	}
}
