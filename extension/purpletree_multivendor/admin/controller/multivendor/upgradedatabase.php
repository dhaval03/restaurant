<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Upgradedatabase extends \Opencart\System\Engine\Controller {
	private $error = array();	
	public function index(){
		$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if (!$validateSeller) {
				$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
				$this->session->data['error_warning'] = $this->language->get('error_license');
				
			}		
			$this->load->language('extension/purpletree_multivendor/multivendor/upgradedatabase');
			$this->document->setTitle($this->language->get('heading_title'));
			$url = '';
			///Help code///
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-settings";
			$data['helplink'] = "https://cutt.ly/ICo4U9h";
			if (defined ('DISABLED_PTS_HELP')){if(DISABLED_PTS_HELP == 0){$data['helpcheck'] = 1;}else{$data['helpcheck'] = 0;}}else{$data['helpcheck'] = 1;}
			$data['helpimage'] = HTTP_CATALOG . '/extension/purpletree_multivendor/admin/view/image/help.png';
			/// End Help code///
			$data['breadcrumbs'] = array();
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
			);
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/upgradedatabase', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');		
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');        
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_Upgrade'] = $this->language->get('button_Upgrade');
		$data['user_token'] = $this->session->data['user_token'];
		$data['text_upgrade_database'] = $this->language->get('text_upgrade_database');
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		if (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
			unset($this->session->data['error_warning']);
		} else {
			$data['error_warning'] = '';
		}
		$data['url'] = $this->url->link('extension/purpletree_multivendor/multivendor/upgradedatabase|upgrade', 'user_token=' . $this->session->data['user_token'], true);
		$this->document->addStyle('../extension/purpletree_multivendor/admin/view/javascript/purpletreecss/commonstylesheet.css');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/upgrade_database', $data));
	}
	public function upgrade(){
		$livecheck = 1;
		$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
		if (!$validateSeller) {
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
			$this->session->data['error_warning'] = $this->language->get('error_license');
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/upgradedatabase', 'user_token=' . $this->session->data['user_token'] . $url, true));
		}
		$url = '';
		try {
			$this->load->language('extension/purpletree_multivendor/multivendor/upgradedatabase');
			$this->load->model('extension/purpletree_multivendor/multivendor/upgradedatabase');
			$upgradedatabases = $this->model_extension_purpletree_multivendor_multivendor_upgradedatabase->upgradeDatabase();
			$this->session->data['success'] = $this->language->get('text_success');
		}
	    catch (Exception $e) {
			$this->session->data['error_warning'] = $e->getMessage();
		}
		$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/upgradedatabase|index', 'user_token=' . $this->session->data['user_token'] . $url, true));
	}
}?>