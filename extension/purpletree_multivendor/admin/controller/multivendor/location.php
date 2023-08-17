<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Location extends \Opencart\System\Engine\Controller {
	private $error = array();	
	public function index() {	
			$this->load->language('extension/purpletree_multivendor/multivendor/location');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/location');
			
			$this->getList();
	}
		
	public function add() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/location');
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/location');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST')  /*&& $this->validateForm()*/ ) {
				
				$this->model_extension_purpletree_multivendor_multivendor_location->editLocation($this->request->post);
				
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
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/location', 'user_token=' . $this->session->data['user_token'] . $url, true));
			} 
			$this->getForm();
	}
		
	public function edit() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/location');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/location');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST')  && $this->validateForm() ) {				
				$this->model_extension_purpletree_multivendor_multivendor_location->deleteLocation($this->request->get['tl_id'], $this->request->post);
				
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
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/location', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			
			$this->getForm();
	}
		
	public function delete() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/location');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/location');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				
				$url = '';
				
				foreach ($this->request->post['selected'] as $tl_id) {
					$this->model_extension_purpletree_multivendor_multivendor_location->deleteLocation($tl_id);		
							
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
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/location', 'user_token=' . $this->session->data['user_token'] . $url, true));
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
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/location', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			
			$data['add'] = $this->url->link('extension/purpletree_multivendor/multivendor/location|add', 'user_token=' . $this->session->data['user_token'] . $url, true);
			$data['delete'] = $this->url->link('extension/purpletree_multivendor/multivendor/location|delete', 'user_token=' . $this->session->data['user_token'] . $url, true);
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			
			$data['sellers'] = $this->model_extension_purpletree_multivendor_multivendor_vendor->getVendors();

			$data['locations'] = array();
			$data['heading_title'] = $this->language->get('heading_title');
			
			$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_pagination_admin'),
			'limit' => $this->config->get('config_pagination_admin')
			);
			$location_total = $this->model_extension_purpletree_multivendor_multivendor_location->getTotalLocations();
			
			$sellers = $this->model_extension_purpletree_multivendor_multivendor_vendor->getVendors();
			$results = $this->model_extension_purpletree_multivendor_multivendor_location->getLocations($filter_data);
			$text_enabled =  $this->language->get('text_enabled');
			$text_disabled =  $this->language->get('text_disabled');
			foreach ($results as $result) {	
			$name = '';
				foreach($sellers as $seller){
					if($seller['seller_id'] == $result['vendor_id']){
						$name = $seller['store_name'];
					}
				}
				$data['locations'][] = array(
				'tl_id'        => $result['tl_id'],
				'vendor_id'    =>$name,				
				'sort_order' => $result['sort_order'],
				'name'        => $result['name'],
				'status'       	   => ($result['status'])? $text_enabled :$text_disabled,
				'location' => $this->model_extension_purpletree_multivendor_multivendor_location->getLocation($result['tl_id']),
				'delete'      => $this->url->link('extension/purpletree_multivendor/multivendor/location|delete', 'user_token=' . $this->session->data['user_token'] . '&tl_id=' . $result['tl_id'] . $url, true)
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
			'total' => $location_total,
			'page'  => $page,
			'limit' => $this->config->get('config_pagination_admin'),
			'url'   => $this->url->link('extension/purpletree_multivendor/multivendor/location', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}'.'&language=' . $this->config->get('config_language'), true)
		]);
		
		
			$data['results'] = sprintf($this->language->get('text_pagination'), ($location_total) ? (($page - 1) * $this->config->get('config_pagination_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_pagination_admin')) > ($location_total - $this->config->get('config_pagination_admin'))) ? $location_total : ((($page - 1) * $this->config->get('config_pagination_admin')) + $this->config->get('config_pagination_admin')), $location_total, ceil($location_total / $this->config->get('config_pagination_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			
			$data['user_token'] = $this->session->data['user_token'];
			$data['languages'] = $this->model_localisation_language->getLanguages();
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/location', $data));
		}
		
		protected function getForm() {
			$data['text_form'] = !isset($this->request->get['tl_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			
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
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/location', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			$this->load->language('extension/purpletree_multivendor/multivendor/location');
			$data['entry_joinning_fee']=$this->language->get('entry_joinning_fee');
			$data['entry_default_subscription_plan']=$this->language->get('entry_default_subscription_plan');
			
			$data['cancel'] = $this->url->link('extension/purpletree_multivendor/multivendor/location', 'user_token=' . $this->session->data['user_token'] . $url, true);
			
			
			$data['user_token'] = $this->session->data['user_token'];
			
			$this->load->model('localisation/language');
			
			$data['languages'] = $this->model_localisation_language->getLanguages();
			
			if (isset($this->request->post['status'])) {
				$data['status'] = $this->request->post['status'];
				} elseif (!empty($seating_management_info)) {
				$data['status'] = $seating_management_info['status'];
				} else {
				$data['status'] = '';
			}
			
			
			if (isset($this->request->post['vendor_id'])) {
				$data['vendor_id'] = $this->request->post['vendor_id'];
				} elseif (!empty($seating_management_info)) {
				$data['vendor_id'] = $seating_management_info['vendor_id'];
				} else {
				$data['vendor_id'] = '';
			}
			
			

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/location', $data));
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
			if (!$this->user->hasPermission('modify', 'extension/purpletree_multivendor/multivendor/location')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			return !$this->error;
		}
	public function jxLocations(){
		$this->load->language('extension/purpletree_multivendor/multivendor/location');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('extension/purpletree_multivendor/multivendor/location');
		
		$json = array();
		if(isset($this->request->post['name']) && isset($this->request->post['vendor_id'])){
			$tl_id = $this->model_extension_purpletree_multivendor_multivendor_location->jxLocations($this->request->post);
			$json['success'] = true;			
			$json['text_success'] = $this->language->get('text_success');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}	
	public function jxGetLocation(){
		$this->load->language('extension/purpletree_multivendor/multivendor/location');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('extension/purpletree_multivendor/multivendor/location');
		
		$json = array();
		if(isset($this->request->post['tl_id']) && $this->request->post['tl_id'] > 0){
			$location_info = $this->model_extension_purpletree_multivendor_multivendor_location->getLocation($this->request->post['tl_id']);
			if(!empty($location_info)){
				$json['data'] = array(
					"tl_id"=>$location_info['tl_id'],
					"name"=>$location_info['name'],
					"vendor_id"=>$location_info['vendor_id'],
					"status"=>$location_info['status'],
					"sort_order"=>$location_info['sort_order']					
				);
				$json['success'] = true;
			}
		}else{
			$json['data'] = array();
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>