<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Seatingmanagement extends \Opencart\System\Engine\Controller {
	private $error = array();	
	public function index() {	
			$this->load->language('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			$this->getList();
	}
		
	public function add() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/seatingmanagement');
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm() ) {
				
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
			
			$this->load->language('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST')  && $this->validateForm() ) {				
				$this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->editSeatingmanagement($this->request->get['table_id'], $this->request->post);
				
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
			
			$this->load->language('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/seatingmanagement');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				
				$url = '';
				
				foreach ($this->request->post['selected'] as $table_id) {
					$this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->deleteSeatingManagement($table_id);		
							
					$this->session->data['success'] = $this->language->get('text_success');
						
					
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
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
				} else {
				$sort = 'name';
			}
			
			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
				} else {
				$order = 'ASC';
			}
			
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
				} else {
				$page = 1;
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
			
			$data['add'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement|add', 'user_token=' . $this->session->data['user_token'] . $url, true);
			$data['delete'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement|delete', 'user_token=' . $this->session->data['user_token'] . $url, true);
			
			$data['seatingmanagements'] = array();
			$data['heading_title'] = $this->language->get('heading_title');
			
			$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_pagination_admin'),
			'limit' => $this->config->get('config_pagination_admin')
			);
			$seatingmanagement_total = $this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->getTotalSeatingManagements();
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			
			$sellers = $this->model_extension_purpletree_multivendor_multivendor_vendor->getVendors();
			$results = $this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->getSeatingManagements($filter_data);
			$text_enabled =  $this->language->get('text_enabled');
			$text_disabled =  $this->language->get('text_disabled');
			foreach ($results as $result) {	
				$name = '';
				foreach($sellers as $seller){
					if($seller['seller_id'] == $result['vendor_id']){
						$name = $seller['store_name'];
					}
				}
				$data['seatingmanagements'][] = array(
				'table_id'        => $result['table_id'],
				'seat_capacity' => $result['seat_capacity'],
				'table_no'        => $result['table_no'],
				'status'       	   => ($result['status'])? $text_enabled :$text_disabled,
				'vendor_store_id'    => $result['vendor_store_id'],				
				'vendor_id'    => $name,				
				'edit'        => $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement|edit', 'user_token=' . $this->session->data['user_token'] . '&table_id=' . $result['table_id'] . $url, true),
				'delete'      => $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement|delete', 'user_token=' . $this->session->data['user_token'] . '&table_id=' . $result['table_id'] . $url, true)
				);
			} 
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
			
			if (isset($this->request->post['selected'])) {
				$data['selected'] = (array)$this->request->post['selected'];
				} else {
				$data['selected'] = array();
			}
			
			$url = '';
			
			if ($order == 'ASC') {
				$url .= '&order=DESC';
				} else {
				$url .= '&order=ASC';
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $seatingmanagement_total,
			'page'  => $page,
			'limit' => $this->config->get('config_pagination_admin'),
			'url'   => $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}'.'&language=' . $this->config->get('config_language'), true)
		]);

			$data['results'] = sprintf($this->language->get('text_pagination'), ($seatingmanagement_total) ? (($page - 1) * $this->config->get('config_pagination_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_pagination_admin')) > ($seatingmanagement_total - $this->config->get('config_pagination_admin'))) ? $seatingmanagement_total : ((($page - 1) * $this->config->get('config_pagination_admin')) + $this->config->get('config_pagination_admin')), $seatingmanagement_total, ceil($seatingmanagement_total / $this->config->get('config_pagination_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/seatingmanagement_list', $data));
		}
		
		protected function getForm() {
			$data['text_form'] = !isset($this->request->get['table_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
				} else {
				$data['error_warning'] = '';
			}
			
			if (isset($this->error['error_table_no'])) {
				$data['error_table_no'] = $this->error['error_table_no'];
				} else {
				$data['error_table_no'] = '';
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
			
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			
			$data['sellers'] = $this->model_extension_purpletree_multivendor_multivendor_vendor->getVendors();
			
			$this->load->model('extension/purpletree_multivendor/multivendor/location');
			
			$data['locations'] = $this->model_extension_purpletree_multivendor_multivendor_location->getLocations();
			
			
			if (isset($this->request->get['table_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$seating_management_info = $this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->getSeatingManagement($this->request->get['table_id']);		
			}
			//print_r($seating_management_info);exit;
			
			if (isset($this->request->post['status'])) {
				$data['status'] = $this->request->post['status'];
				} elseif (!empty($seating_management_info)) {
				$data['status'] = $seating_management_info['status'];
				} else {
				$data['status'] = '';
			}
			
			if (isset($this->request->post['table_no'])) {
				$data['table_no'] = $this->request->post['table_no'];
				} elseif (!empty($seating_management_info)) {
				$data['table_no'] = $seating_management_info['table_no'];
				} else {
				$data['table_no'] = '';
			}
			if (isset($this->request->post['vendor_id'])) {
				$data['vendor_id'] = $this->request->post['vendor_id'];
				} elseif (!empty($seating_management_info)) {
				$data['vendor_id'] = $seating_management_info['vendor_id'];
				} else {
				$data['vendor_id'] = '';
			}
			
			if (isset($this->request->post['seat_capacity'])) {
				$data['seat_capacity'] = $this->request->post['seat_capacity'];
				} elseif (!empty($seating_management_info)) {
				$data['seat_capacity'] = $seating_management_info['seat_capacity'];
				} else {
				$data['seat_capacity'] = '';
			}
			
			if (isset($this->request->post['vendor_store_id'])) {
				$data['vendor_store_id'] = $this->request->post['vendor_store_id'];
				} elseif (!empty($seating_management_info)) {
				$data['vendor_store_id'] = $seating_management_info['vendor_store_id'];
				} else {
				$data['vendor_store_id'] = 0;
			}

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/seatingmanagement_form', $data));
		}
		
		protected function validateForm() {
			if (!$this->user->hasPermission('modify', 'extension/purpletree_multivendor/multivendor/seatingmanagement')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			if (empty($this->request->post['table_no']) || !is_numeric($this->request->post['table_no'])) {
				$this->error['error_table_no'] = $this->language->get('error_table_no');
			}elseif(!empty($this->request->post['table_no']) && strlen($this->request->post['table_no']) > 2){				
				$this->error['error_table_no'] = $this->language->get('error_table_numbers');
			}
			if ($this->error && !isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_warning');
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