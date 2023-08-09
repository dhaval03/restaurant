<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Sellerattributegroups extends \Opencart\System\Engine\Controller {
		private $error = array();
		private $ptsValidateSeller = false;
		public function index() {
			if (!$this->customer->isLogged()) {
				$this->session->data['redirect'] = $this->url->link('extension/account/purpletree_multivendor/dashboard','language=' . $this->config->get('config_language'), true);
				$this->response->redirect($this->url->link('account/login', 'language=' . $this->config->get('config_language'), true));
			}
			
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			$store_detail = $this->model_extension_purpletree_multivendor_multivendor_dashboard->isSeller($this->customer->getId());
			
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			
			if(!isset($store_detail['store_status'])){
				$this->response->redirect($this->url->link('account/account', 'language=' . $this->config->get('config_language'), true));
				}else{
				$stores=array();
						if(isset($store_detail['multi_store_id'])){
							$stores=explode(',',$store_detail['multi_store_id']);
						}
				if(isset($store_detail['store_status']) && !in_array($this->config->get('config_store_id'),$stores)){		
					$this->response->redirect($this->url->link('account/account','language=' . $this->config->get('config_language'), true));
				}
			}
			$this->ptsValidateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if(!$this->ptsValidateSeller) {
				$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
				$this->session->data['error_warning'] = $this->language->get('error_license');
				$this->response->redirect($this->url->link('account/account', 'language=' . $this->config->get('config_language'), true));
			}
			$this->load->language('extension/purpletree_multivendor/multivendor/sellerattributegroups');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerattributegroups');
			
			$this->getList();
		}
		
		public function add() {
			$this->load->language('extension/purpletree_multivendor/multivendor/sellerattributegroups');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerattributegroups');
			
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				
				$this->model_extension_purpletree_multivendor_multivendor_sellerattributegroups->addSellerAttributeGroup($this->customer->getId(),$this->request->post);
				
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
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups','language=' . $this->config->get('config_language'), true));
			}
			
			$this->getForm();
		}
		
		public function edit() {
			$this->load->language('extension/purpletree_multivendor/multivendor/sellerattributegroups');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerattributegroups');
			
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
				$this->model_extension_purpletree_multivendor_multivendor_sellerattributegroups->editSellerAttributeGroup($this->request->get['attribute_group_id'],$this->request->post);
				
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
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups','language=' . $this->config->get('config_language'), true));
			}
			
			$this->getForm();
		}
		
		public function delete() {
			$this->load->language('extension/purpletree_multivendor/multivendor/sellerattributegroups');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerattributegroups');
			
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			//echo"<pre>"; print_r($this->request->post['selected']); die;
			if (isset($this->request->post['selected'])) {
				foreach ($this->request->post['selected'] as $attribute_group_id) {
					$this->model_extension_purpletree_multivendor_multivendor_sellerattributegroups->deleteSellerAttributeGroup($attribute_group_id);
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
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups','language=' . $this->config->get('config_language'), true));
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
			///Help code///
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-seller-product";
			$data['helplink'] = "https://cutt.ly/oCpRHgG";
			if (defined ('DISABLED_PTS_HELP')){if(DISABLED_PTS_HELP == 0){$data['helpcheck'] = 1;}else{$data['helpcheck'] = 0;}}else{$data['helpcheck'] = 1;}
			$data['helpimage'] = HTTP_SERVER . 'extension/purpletree_multivendor/catalog/view/assets/image/help.png';
			/// End Help code///
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home','language=' . $this->config->get('config_language'),true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups',  $url.'&language=' . $this->config->get('config_language'), true)
			);
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			
			$data['add'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups|add','language=' . $this->config->get('config_language'),true);
			$data['delete'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups|delete','language=' . $this->config->get('config_language'),true);
			
			$data['attributes'] = array();
			$data['heading_title'] = $this->language->get('heading_title');
			
			$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_pagination_admin'),
			'limit' => $this->config->get('config_pagination_admin')
			);
			
			$atrribute_total = $this->model_extension_purpletree_multivendor_multivendor_sellerattributegroups->getTotalSellerAttributeGroups($this->customer->getId());
			
			$results = $this->model_extension_purpletree_multivendor_multivendor_sellerattributegroups->getSellerAtrributesGroups($this->customer->getId(),$filter_data);
			
			if(!empty($results)){
				foreach ($results as $result) {
					$data['attributes'][] = array(
					'id'  => $result['id'],
					'seller_id'       => $result['seller_id'],
					'attribute_group_id'   => $result['attribute_group_id'],
					'name'   => $result['name'],
					'language_id'   => $result['language_id'],
					'sort_order'   => $result['sort_order'],
					'edit'       => $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups|edit', '&attribute_group_id=' . $result['attribute_group_id'].$url.'&language=' . $this->config->get('config_language'), true)
					);
				}
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
			
			$data['sort_name'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups' , $url.'&language=' . $this->config->get('config_language'), true);
			$data['sort_code'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups',  '&sort=code' . $url.'&language=' . $this->config->get('config_language'), true);
			$data['sort_discount'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups', '&sort=discount' . $url.'&language=' . $this->config->get('config_language'), true);
			$data['sort_date_start'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups', '&sort=date_start' . $url.'&language=' . $this->config->get('config_language'), true);
			$data['sort_date_end'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups', '&sort=date_end' . $url.'&language=' . $this->config->get('config_language'), true);
			$data['sort_status'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups', '&sort=status' . $url.'&language=' . $this->config->get('config_language'), true);
			
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
			'url'   => $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups', '' . $url . '&page={page}'.'language=' . $this->config->get('config_language'), true)
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($atrribute_total) ? (($page - 1) * $this->config->get('config_pagination_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_pagination_admin')) > ($atrribute_total - $this->config->get('config_pagination_admin'))) ? $atrribute_total : ((($page - 1) * $this->config->get('config_pagination_admin')) + $this->config->get('config_pagination_admin')), $atrribute_total, ceil($atrribute_total / $this->config->get('config_pagination_admin')));
			
			$data['sort'] = $sort;
			$data['order'] = $order;
			
			$data['column_left'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/column_left');
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/attribute_groups_list', $data));
		}
		
		protected function getForm() {
			$data['text_form'] = !isset($this->request->get['attribute_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
			
			if (isset($this->request->get['attribute_id'])) {
				$data['attribute_id'] = $this->request->get['attribute_id'];
				} else {
				$data['attribute_id'] = 0;
			}
			
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
			
			if (isset($this->error['code'])) {
				$data['error_code'] = $this->error['code'];
				} else {
				$data['error_code'] = '';
			}
			
			if (isset($this->error['attribute_group'])) {
				$data['error_attribute_group'] = $this->error['attribute_group'];
				} else {
				$data['error_attribute_group'] = '';
			}
			
			if (isset($this->error['date_end'])) {
				$data['error_date_end'] = $this->error['date_end'];
				} else {
				$data['error_date_end'] = '';
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
			///Help code///
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-seller-product";
			$data['helplink'] = "https://cutt.ly/oCpRHgG";
			if (defined ('DISABLED_PTS_HELP')){if(DISABLED_PTS_HELP == 0){$data['helpcheck'] = 1;}else{$data['helpcheck'] = 0;}}else{$data['helpcheck'] = 1;}
			$data['helpimage'] = HTTP_SERVER . 'extension/purpletree_multivendor/catalog/view/assets/image/help.png';
			/// End Help code///
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home','language=' . $this->config->get('config_language'),true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/sellertemplateproduct',  $url.'&language=' . $this->config->get('config_language'), true)
			);
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			
			if (!isset($this->request->get['attribute_group_id'])) {
				$data['action'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups|add','language=' . $this->config->get('config_language'),true);
				} else {
				$data['action'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups|edit','&attribute_group_id=' . $this->request->get['attribute_group_id'].'&language=' . $this->config->get('config_language') , true);
			}
			$data['cancel'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups','language=' . $this->config->get('config_language'), true);
			
			$this->load->model('localisation/language');
			
			$data['languages'] = $this->model_localisation_language->getLanguages();
			
			if (isset($this->request->get['attribute_group_id']) && (!$this->request->server['REQUEST_METHOD'] != 'POST')) {
				$attribute_group_info = $this->model_extension_purpletree_multivendor_multivendor_sellerattributegroups->getSellerAttributeGroup($this->request->get['attribute_group_id']);
			}
			if (isset($this->request->post['attribute_group_description'])) {
				$data['attribute_group_description'] = $this->request->post['attribute_group_description'];
				} elseif (isset($this->request->get['attribute_group_id'])) {
				$data['attribute_group_description'] = $this->model_extension_purpletree_multivendor_multivendor_sellerattributegroups->getAttributeGroupDescriptions($this->request->get['attribute_group_id']);
				} else {
				$data['attribute_group_description'] = array();
			}	
			
			if (isset($this->request->post['seller_id'])) {
				$data['seller_id'] = $this->request->post['seller_id'];
				} elseif (!empty($attribute_group_info)) {
				$data['seller_id'] = $attribute_group_info['seller_id'];
				} else {
				$data['seller_id'] = '';
			}			
			
			if (isset($this->request->post['sort_order'])) {
				$data['sort_order'] = $this->request->post['sort_order'];
				} elseif (!empty($attribute_group_info)) {
				$data['sort_order'] = $attribute_group_info['sort_order'];
				} else {
				$data['sort_order'] = '';
			}	
			
			$data['column_left'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/column_left');
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/attribute_groups_form', $data));
		}
		
		protected function validateForm() {
			
			foreach ($this->request->post['attribute_group_description'] as $language_id => $value) {
				if ((strlen($value['name']) < 1) || (strlen($value['name']) > 64)) {
					$this->error['name'][$language_id] = $this->language->get('error_name');
				}
			}
			
			return !$this->error;
		}
	}
?>