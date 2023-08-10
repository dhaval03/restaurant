<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Seatingmanagement extends \Opencart\System\Engine\Controller {
		private $error = array();	
		public function index() {	
				$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			
			$this->load->language('extension/purpletree_multivendor/multivendor/vendor');
			$this->load->language('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			$this->getList();
		}
		
		public function add() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/seatingmanagement');
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST')  && $this->validateForm() ) {
				
				$this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->addSeatingmanagement($this->request->post);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$url = '';
				
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
				
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', 'user_token=' . $this->session->data['user_token'] . $url, true));
			} 
			$this->getForm();
		}
		
		public function edit() {
			$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if (!$validateSeller) {
				$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
				$this->session->data['error_warning'] = $this->language->get('error_license');
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			$this->load->language('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST')  && $this->validateForm() ) {				
				$this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->editSellerArea($this->request->get['area_id'], $this->request->post);
				
				$this->session->data['success'] = $this->language->get('text_success');
				
				$url = '';
				
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
				
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			
			$this->getForm();
		}
		
		public function delete() {
			$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if (!$validateSeller) {
				$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
				$this->session->data['error_warning'] = $this->language->get('error_license');
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			$this->load->language('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				
				$url = '';
				
				foreach ($this->request->post['selected'] as $area_id) {
					$check_area ='';
					//$check_area = $this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->checkSellerArea($area_id);
					
					if(!empty($check_area)){
						$this->session->data['error_warning'] = $this->language->get('error_permission');
						}else{
						try {     
							
							$this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->deleteSellerArea($area_id);		
							
							$this->session->data['success'] = $this->language->get('text_success');
						}
						catch (Exception $e) {
							$this->session->data['error_warning'] = $e->getMessage();
						}
						
					}
					
				}
				
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}
				
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			
			$this->getList();
		}
		protected function getList() {
			$this->document->addStyle('../extension/purpletree_multivendor/admin/view/javascript/purpletreecss/commonstylesheet.css');
			$url = '';
			///Help code///
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/hyperlocal-in-complete-multivendor-marketplace-for-opencart-2";
			$data['helplink'] = "https://cutt.ly/KCo9aEX";
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
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			
			$data['add'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement|add', 'user_token=' . $this->session->data['user_token'] . $url, true);
			$data['delete'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement|delete', 'user_token=' . $this->session->data['user_token'] . $url, true);
			$data['repair'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement|repair', 'user_token=' . $this->session->data['user_token'] . $url, true);
			
			$data['seatingmanagements'] = array();
			
			$results = $this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->getSeatingManagements();
			$text_enabled =  $this->language->get('text_enabled');
			$text_disabled =  $this->language->get('text_disabled');
			foreach ($results as $result) {				
				$data['seatingmanagements'][] = array(
				'seat_capacity' => $result['seat_capacity'],
				'table_no'        => $result['area_name'],
				'status'       	   => ($result['status'])? $text_enabled :$text_disabled,
				'vendor_store_id'    => $result['vendor_store_id'],				
				'edit'        => $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement|edit', 'user_token=' . $this->session->data['user_token'] . '&area_id=' . $result['area_id'] . $url, true),
				'delete'      => $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement|delete', 'user_token=' . $this->session->data['user_token'] . '&area_id=' . $result['area_id'] . $url, true)
				);
			} 
			
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
				}elseif (isset($this->session->data['error_warning'])) {
				$data['error_warning'] = $this->session->data['error_warning'];
				unset($this->session->data['error_warning']);
				} else {
				$data['error_warning'] = '';
			}
			
			
			if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];
				
				unset($this->session->data['success']);
				} else {
				$data['success'] = '';
			}
			
			if (isset($this->request->post['selected'])) {
				$data['selected'] = (array)$this->request->post['selected'];
				} else {
				$data['selected'] = array();
			}
			
			$url = '';
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/seatingmanagement_list', $data));
		}
		
		protected function getForm() {
			$data['text_form'] = !isset($this->request->get['area_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
				} else {
				$data['error_warning'] = '';
			}
			
			
			if (isset($this->error['name'])) {
				$data['error_name'] = $this->error['name'];
				} else {
				$data['error_name'] = array();
			}
			
			
			
			if (isset($this->error['sort_order'])) {
				$data['error_sort_order'] = $this->error['sort_order'];
				} else {
				$data['error_sort_order'] = '';
			}
			
			
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			$this->load->language('extension/purpletree_multivendor/multivendor/seatingmanagement');
			$data['entry_joinning_fee']=$this->language->get('entry_joinning_fee');
			$data['entry_default_subscription_plan']=$this->language->get('entry_default_subscription_plan');
			
			
			
			$data['cancel'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', 'user_token=' . $this->session->data['user_token'] . $url, true);
			
			
			$data['user_token'] = $this->session->data['user_token'];
			
			$this->load->model('localisation/language');
			
			$data['languages'] = $this->model_localisation_language->getLanguages();
			
			$this->load->model('setting/store');

			$data['stores'] = [];

			$data['stores'][] = [
				'store_id' => 0,
				'name'     => $this->language->get('text_default')
			];

			$stores = $this->model_setting_store->getStores();

			foreach ($stores as $store) {
				$data['stores'][] = [
					'store_id' => $store['store_id'],
					'name'     => $store['name']
				];
			}
			
			
			
			if (isset($this->request->get['area_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$seller_area_info = $this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->getArea($this->request->get['area_id']);		
			}
			
			if (isset($this->request->post['status'])) {
				$data['status'] = $this->request->post['status'];
				} elseif (!empty($seller_area_info)) {
				$data['status'] = $seller_area_info['status'];
				} else {
				$data['status'] = '';
			}
			
			if (isset($this->request->post['sort_order'])) {
				$data['sort_order'] = $this->request->post['sort_order'];
				} elseif (!empty($seller_area_info)) {
				$data['sort_order'] = $seller_area_info['sort_order'];
				} else {
				$data['sort_order'] = 0;
			}

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/seatingmanagement_form', $data));
		}
		
		protected function validateForm() {
			foreach ($this->request->post['table_no'] as $language_id => $value) {
				if ((strlen($value['name']) < 1) || (strlen($value['name']) > 255)) {
					$this->error['name'][$language_id] = $this->language->get('error_name');
				}
				
			}
			
			
			
			
			return !$this->error;
		}
		
		protected function validateDelete() {
			if (!$this->user->hasPermission('modify', 'extension/purpletree_multivendor/multivendor/seatingmanagement')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			return !$this->error;
		}
}
?>