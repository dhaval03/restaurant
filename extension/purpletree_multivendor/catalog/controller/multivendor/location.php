<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Location extends \Opencart\System\Engine\Controller {
		private $error = array();
		public function index() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/location');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/location');
			
			$this->getList();
		}
		
		public function delete() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/location');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/location');
			if (isset($this->request->post['selected'])) {
				foreach ($this->request->post['selected'] as $tl_id) {
					$this->model_extension_purpletree_multivendor_multivendor_location->deleteLocation($tl_id);
				}
				
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
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/location','language=' . $this->config->get('config_language'), true));
			}
			
			$this->getList();
		}
		
		protected function getList() {
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
		
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
			'href' => $this->url->link('common/home','language=' . $this->config->get('config_language'),true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/location',  $url.'&language=' . $this->config->get('config_language'), true)
			);
			
			$data['add'] = $this->url->link('extension/purpletree_multivendor/multivendor/location|add','language=' . $this->config->get('config_language'),true);
			$data['delete'] = $this->url->link('extension/purpletree_multivendor/multivendor/location|delete','language=' . $this->config->get('config_language'),true);
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_pagination_admin'),
			'limit' => $this->config->get('config_pagination_admin')
			);
			
			$atrribute_total = $this->model_extension_purpletree_multivendor_multivendor_location->getTotalLocations($this->customer->getId());
			
			$results = $this->model_extension_purpletree_multivendor_multivendor_location->getLocations($filter_data);
			$text_enabled =  $this->language->get('text_enabled');
			$text_disabled =  $this->language->get('text_disabled');
			foreach ($results as $result) {	
			
				$data['locations'][] = array(
					'tl_id'        => $result['tl_id'],	
					'sort_order' => $result['sort_order'],
					'name'        => $result['name'],
					'status'       	   => ($result['status'])? $text_enabled :$text_disabled,
					'location' => $this->model_extension_purpletree_multivendor_multivendor_location->getLocation($result['tl_id']),
					'delete'      => $this->url->link('extension/purpletree_multivendor/multivendor/location|delete', '&tl_id=' . $result['tl_id'] . $url, true)
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
			'total' => $atrribute_total,
			'page'  => $page,
			'limit' => $this->config->get('config_pagination_admin'),
			'url'   => $this->url->link('extension/purpletree_multivendor/multivendor/location', '' . $url . '&page={page}'.'&language=' . $this->config->get('config_language'), true)
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($atrribute_total) ? (($page - 1) * $this->config->get('config_pagination_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_pagination_admin')) > ($atrribute_total - $this->config->get('config_pagination_admin'))) ? $atrribute_total : ((($page - 1) * $this->config->get('config_pagination_admin')) + $this->config->get('config_pagination_admin')), $atrribute_total, ceil($atrribute_total / $this->config->get('config_pagination_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			$data['languages'] = $this->model_localisation_language->getLanguages();
			$data['column_left'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/column_left');
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/location', $data));
		}
		
		protected function validateForm() {
		
			/*foreach ($this->request->post['table_no'] as $language_id => $value) {
				if ((strlen($value['name']) < 1) || (strlen($value['name']) > 64)) {
					$this->error['name'][$language_id] = $this->language->get('error_name');
				}
			}*/
			
			return !$this->error;
		}
	public function jxLocations(){
		$this->load->language('extension/purpletree_multivendor/multivendor/location');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('extension/purpletree_multivendor/multivendor/location');
		
		$json = array();
		if(isset($this->request->post['name']) && isset($this->request->post['status'])){
			$tl_id = $this->model_extension_purpletree_multivendor_multivendor_location->jxLocations($this->request->post);
			$json['success'] = true;
			$this->session->data['success'] = $this->language->get('text_success');			
			//$json['text_success'] = $this->language->get('text_success');
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