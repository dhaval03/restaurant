<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Ordertype extends \Opencart\System\Engine\Controller {
	private $error = array();	
	public function index() {	
			$this->load->language('extension/purpletree_multivendor/multivendor/order_type');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/order_type');
			
			$this->getList();
	}
		
	public function add() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/order_type');
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/order_type');
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm() ) {
				
				$this->model_extension_purpletree_multivendor_multivendor_order_type->addOrdertype($this->request->post);
				
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
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/order_type', 'user_token=' . $this->session->data['user_token'] . $url, true));
			} 
			$this->getForm();
	}
		
	public function edit() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/order_type');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/order_type');
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST')  && $this->validateForm() ) {				
				$this->model_extension_purpletree_multivendor_multivendor_order_type->editOrdertype($this->request->get['order_type_id'], $this->request->post);
				
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
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/order_type', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			
			$this->getForm();
	}
		
	public function delete() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/order_type');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/order_type');
			
			if (isset($this->request->post['selected']) && $this->validateDelete()) {
				
				$url = '';
				
				foreach ($this->request->post['selected'] as $order_type_id) {
					$this->model_extension_purpletree_multivendor_multivendor_order_type->deleteOrdertype($order_type_id);		
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
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/order_type', 'user_token=' . $this->session->data['user_token'] . $url, true));
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
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/order_type', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			
			$data['add'] = $this->url->link('extension/purpletree_multivendor/multivendor/order_type|add', 'user_token=' . $this->session->data['user_token'] . $url, true);
			$data['delete'] = $this->url->link('extension/purpletree_multivendor/multivendor/order_type|delete', 'user_token=' . $this->session->data['user_token'] . $url, true);
			
			$data['ordertypes'] = array();
			$data['heading_title'] = $this->language->get('heading_title');
			
			$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_pagination_admin'),
			'limit' => $this->config->get('config_pagination_admin')
			);
			$ordertype_total = $this->model_extension_purpletree_multivendor_multivendor_order_type->getTotalOrderType();
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			
			$results = $this->model_extension_purpletree_multivendor_multivendor_order_type->getOrderTypes($filter_data);
			$text_enabled =  $this->language->get('text_enabled');
			$text_disabled =  $this->language->get('text_disabled');
			
			foreach ($results as $result) {	
			
				$data['ordertypes'][] = array(
				'name' => $result['name'],
				'status'       	   => ($result['status'])? $text_enabled :$text_disabled,
				'order_type_id'    => $result['order_type_id'],							
				'edit'        => $this->url->link('extension/purpletree_multivendor/multivendor/order_type|edit', 'user_token=' . $this->session->data['user_token'] . '&order_type_id=' . $result['order_type_id'] . $url, true),
				'delete'      => $this->url->link('extension/purpletree_multivendor/multivendor/order_type|delete', 'user_token=' . $this->session->data['user_token'] . '&order_type_id=' . $result['order_type_id'] . $url, true)
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
			'total' => $ordertype_total,
			'page'  => $page,
			'limit' => $this->config->get('config_pagination_admin'),
			'url'   => $this->url->link('extension/purpletree_multivendor/multivendor/order_type', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}'.'&language=' . $this->config->get('config_language'), true)
		]);

			$data['results'] = sprintf($this->language->get('text_pagination'), ($ordertype_total) ? (($page - 1) * $this->config->get('config_pagination_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_pagination_admin')) > ($ordertype_total - $this->config->get('config_pagination_admin'))) ? $ordertype_total : ((($page - 1) * $this->config->get('config_pagination_admin')) + $this->config->get('config_pagination_admin')), $ordertype_total, ceil($ordertype_total / $this->config->get('config_pagination_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/order_type_list', $data));
		}
		
		protected function getForm() {
			$data['text_form'] = !isset($this->request->get['order_type_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
				} else {
				$data['error_warning'] = '';
			}
			if (isset($this->error['name'])) {
				$data['error_name'] = $this->error['name'];
				} else {
				$data['error_name'] = '';
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
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/order_type', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			$this->load->language('extension/purpletree_multivendor/multivendor/order_type');
			$data['entry_joinning_fee']=$this->language->get('entry_joinning_fee');
			$data['entry_default_subscription_plan']=$this->language->get('entry_default_subscription_plan');
			
			$data['cancel'] = $this->url->link('extension/purpletree_multivendor/multivendor/order_type', 'user_token=' . $this->session->data['user_token'] . $url, true);
			
			$data['user_token'] = $this->session->data['user_token'];
			
			$this->load->model('localisation/language');
			
			$data['languages'] = $this->model_localisation_language->getLanguages();
			
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');			
			$data['sellers'] = $this->model_extension_purpletree_multivendor_multivendor_vendor->getVendors();
			
			if (isset($this->request->get['order_type_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
				$order_type_info = $this->model_extension_purpletree_multivendor_multivendor_order_type->getOrderType($this->request->get['order_type_id']);		
			}
			
			if (isset($this->request->post['status'])) {
				$data['status'] = $this->request->post['status'];
				} elseif (!empty($order_type_info)) {
				$data['status'] = $order_type_info['status'];
				} else {
				$data['status'] = '';
			}
			
			if (isset($this->request->post['name'])) {
				$data['name'] = $this->request->post['name'];
				} elseif (!empty($order_type_info)) {
				$data['name'] = $order_type_info['name'];
				} else {
				$data['name'] = '';
			}
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/order_type_form', $data));
		}
		protected function validateForm() {
			if (!$this->user->hasPermission('modify', 'extension/purpletree_multivendor/multivendor/order_type')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			if ((strlen($this->request->post['name']) < 1) || (strlen(trim($this->request->post['name'])) > 32)) {
				$this->error['name'] = $this->language->get('error_name');
			}
			
			if ($this->error && !isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_warning');
			}
			return !$this->error;
		}
		
		protected function validateDelete() {
			if (!$this->user->hasPermission('modify', 'extension/purpletree_multivendor/multivendor/order_type')) {
				$this->error['warning'] = $this->language->get('error_permission');
			}
			
			return !$this->error;
		}
}
?>