<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Location extends \Opencart\System\Engine\Controller {
		private $error = array();
		private $ptsValidateSeller = false;
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
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_extension_purpletree_multivendor_multivendor_location->addSeatingmanagement($this->customer->getId(),$this->request->post);
				
				
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
			
			$this->getForm();
		}
		
		public function edit() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/location');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/location');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				
				$this->model_extension_purpletree_multivendor_multivendor_location->editSeatingmanagement($this->request->get['table_id'], $this->request->post);
				
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
			
			$this->getForm();
		}
		
		public function delete() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/location');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/location');
			
			//$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			
			//$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			
			if (isset($this->request->post['selected'])) {
				foreach ($this->request->post['selected'] as $attribute_id) {
					$this->model_extension_purpletree_multivendor_multivendor_location->deleteSeatingManagement($attribute_id);
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
			
			//$data['attributes'] = array();
			$data['heading_title'] = $this->language->get('heading_title');
			
			$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_pagination_admin'),
			'limit' => $this->config->get('config_pagination_admin')
			);
			
			$atrribute_total = $this->model_extension_purpletree_multivendor_multivendor_location->getTotalSeatingManagements($this->customer->getId());
			
			$results = $this->model_extension_purpletree_multivendor_multivendor_location->getSeatingManagements($filter_data);
			$text_enabled =  $this->language->get('text_enabled');
			$text_disabled =  $this->language->get('text_disabled');
			foreach ($results as $result) {	
				$data['seatingmanagements'][] = array(
				'table_id'        => $result['table_id'],
				'seat_capacity' => $result['seat_capacity'],
				'table_no'        => $result['table_no'],
				'status'       	   => ($result['status'])? $text_enabled :$text_disabled,
				'vendor_store_id'    => $result['vendor_store_id'],				
				//'edit'      => $this->url->link('extension/purpletree_multivendor/multivendor/location|edit', '&table_id=' . $result['table_id'] . $url, true),
				'edit'       => $this->url->link('extension/purpletree_multivendor/multivendor/location|edit', '&table_id=' . $result['table_id'].$url.'&language=' . $this->config->get('config_language'), true),
				'delete'      => $this->url->link('extension/purpletree_multivendor/multivendor/location|delete', '&table_id=' . $result['table_id'] . $url, true)
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
			
			/*$data['sort_name'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement' , $url.'&language=' . $this->config->get('config_language'), true);
			$data['sort_code'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement',  '&sort=code' . $url.'&language=' . $this->config->get('config_language'), true);
			$data['sort_discount'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', '&sort=discount' . $url, true);
			$data['sort_date_start'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', '&sort=date_start' . $url.'&language=' . $this->config->get('config_language'), true);
			$data['sort_date_end'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', '&sort=date_end' . $url.'&language=' . $this->config->get('config_language'), true);
			$data['sort_status'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', '&sort=status' . $url.'&language=' . $this->config->get('config_language'), true);*/
			
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
			
			$data['column_left'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/column_left');
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/location', $data));
		}
		
		protected function getForm() {
			
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
				} else {
				$data['error_warning'] = '';
			}
			
			$url = '';
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
			
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
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
			
			if (!isset($this->request->get['table_id'])) {
				$data['action'] = $this->url->link('extension/purpletree_multivendor/multivendor/location|add','language=' . $this->config->get('config_language'),true);
				} else {
				$data['action'] = $this->url->link('extension/purpletree_multivendor/multivendor/location|edit','&table_id=' . $this->request->get['table_id'].'&language=' . $this->config->get('config_language') , true);
			}
			
			$data['cancel'] = $this->url->link('extension/purpletree_multivendor/multivendor/location','language=' . $this->config->get('config_language'), true);
			
			
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
			
			if (isset($this->request->get['table_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$seating_management_info = $this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->getSeatingManagement($this->request->get['table_id']);		
			}
			
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
		
	}
?>