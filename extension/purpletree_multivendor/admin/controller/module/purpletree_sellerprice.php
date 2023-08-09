<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Module;
class Purpletreesellerprice extends \Opencart\System\Engine\Controller {
		private $error = array();
		
		public function index() {
			if(!$this->config->get('module_purpletree_multivendor_seller_product_template')){
				$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
			}
			$this->load->language('extension/purpletree_multivendor/module/purpletree_sellerprice');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('setting/setting');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
				
				$this->model_setting_setting->editSetting('module_purpletree_sellerprice', $this->request->post);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
			}
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_edit'] = $this->language->get('text_edit');
			$data['text_enabled'] = $this->language->get('text_enabled');
			$data['text_disabled'] = $this->language->get('text_disabled');
			
			$data['entry_status'] = $this->language->get('entry_status');
			
			$data['button_save'] = $this->language->get('button_save');
			$data['button_cancel'] = $this->language->get('button_cancel');
			
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
				} else {
				$data['error_warning'] = '';
			}
			///Help code///	
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-module";
			$data['helplink'] = "https://cutt.ly/kCoCLjO";
			if (defined ('DISABLED_PTS_HELP')){if(DISABLED_PTS_HELP == 0){$data['helpcheck'] = 1;}else{$data['helpcheck'] = 0;}}else{$data['helpcheck'] = 1;}
			$data['helpimage'] = HTTP_CATALOG . '/extension/purpletree_multivendor/admin/view/image/help.png';
			/// End Help code///
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/module/purpletree_sellerprice', 'user_token=' . $this->session->data['user_token'], true)
			);
			
			$data['action'] = $this->url->link('extension/purpletree_multivendor/module/purpletree_sellerprice', 'user_token=' . $this->session->data['user_token'], true);
			
			$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
			
			if (isset($this->request->post['module_purpletree_sellerprice_status'])) {
				$data['module_purpletree_sellerprice_status'] = $this->request->post['module_purpletree_sellerprice_status'];
				} else {
				$data['module_purpletree_sellerprice_status'] = $this->config->get('module_purpletree_sellerprice_status');
			}
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/module/purpletree_sellerprice', $data));
		}
		
		protected function validate() {
			if (!$this->user->hasPermission('modify', 'extension/purpletree_multivendor/module/purpletree_sellerprice')) {
				
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			return !$this->error;
		}
	}
?>