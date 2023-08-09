<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
use \Opencart\System\Helper as Helper;
class Sellerlogin extends \Opencart\System\Engine\Controller {
		private $error = array();
		private $ptsValidateSeller = false;
		public function index() {	
			
			/* 		if(!$this->ptsValidateSeller) {
				$this->load->language('extension/purpletree_multivendor/ptsmultivendor');
				$this->session->data['error_warning'] = $this->language->get('error_license');
				$this->response->redirect($this->url->link('account/account', '', true));
			} */
			$data['loggedcus'] = '';
			if ($this->customer->isLogged()) {
				
				$data['loggedcus'] = $this->customer->getId();
				$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
				
				$store_detail = $this->model_extension_purpletree_multivendor_multivendor_vendor->isSeller($this->customer->getId());				   
				if($store_detail){
					if($store_detail['is_removed']==1){
						$this->response->redirect($this->url->link(	'extension/purpletree_multivendor/multivendor/sellerstore/becomeseller','language=' . $this->config->get('config_language'), true));
						} else {
						if($store_detail['store_status']==1){
							$stores=array();
							if(isset($store_detail['multi_store_id'])){
								$stores=explode(',',$store_detail['multi_store_id']);
							}
							if(in_array($this->config->get('config_store_id'),$stores)){
								$this->response->redirect($this->url->link(	'extension/purpletree_multivendor/multivendor/dashboardicons','language=' . $this->config->get('config_language'), true));
								} else {
								$this->response->redirect($this->url->link(	'account/account','language=' . $this->config->get('config_language'), true));
							}							
							} else {
							$this->response->redirect($this->url->link(	'account/account','language=' . $this->config->get('config_language'), true));
						}
					}
				}
				$this->response->redirect($this->url->link(	'extension/purpletree_multivendor/multivendor/sellerregister','language=' . $this->config->get('config_language'), true));
			} 
			
			$this->load->model('account/customer');
			
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			//$this->load->language('account/login');
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
			$this->load->language('extension/purpletree_multivendor/multivendor/sellerregister');
			
			$this->document->setTitle($this->language->get('text_seller_login'));
			$this->session->data['login_token'] = substr(bin2hex(openssl_random_pseudo_bytes(26)), 0, 26);
			$data['action'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerlogin|login', 'language=' . $this->config->get('config_language') . '&login_token=' . $this->session->data['login_token']);
			
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
			);
			$data['breadcrumbs'][] = array(
			'text' =>$this->language->get('text_seller_login_page'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/sellerlogin','language=' . $this->config->get('config_language'), true)
			);
			
			if (isset($this->session->data['error'])) {
				$data['error_warning'] = $this->session->data['error'];
				
				unset($this->session->data['error']);
				} elseif (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
				} else {
				$data['error_warning'] = '';
			}
			
			$data['sellerregister'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerregister','language=' . $this->config->get('config_language'), true);
			$data['register'] = $this->url->link('account/register','language=' . $this->config->get('config_language'), true);
			$data['forgotten'] = $this->url->link('account/forgotten','language=' . $this->config->get('config_language'), true);
			
			if (isset($this->session->data['redirect'])) {
				$data['redirect'] = $this->session->data['redirect'];
				
				unset($this->session->data['redirect']);
				} else {
				$data['redirect'] = '';
			}
			
			if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];
				
				unset($this->session->data['success']);
				} else {
				$data['success'] = '';
			}
			
			if (isset($this->request->post['email'])) {
				$data['email'] = $this->request->post['email'];
				} else {
				$data['email'] = '';
			}
			
			if (isset($this->request->post['password'])) {
				$data['password'] = $this->request->post['password'];
				} else {
				$data['password'] = '';
			}
			
			$data['heading_title'] = $this->language->get('text_seller_login');
			
			$data['text_new_customer'] = $this->language->get('text_new_customer');
			$data['text_register'] = $this->language->get('text_register');
			$data['text_register_account'] = $this->language->get('text_register_account');
			$data['text_returning_customer'] = $this->language->get('text_returning_customer');
			$data['text_i_am_returning_customer'] = $this->language->get('text_i_am_returning_customer');
			$data['text_forgotten'] = $this->language->get('text_forgotten');
			
			$data['entry_email'] = $this->language->get('entry_email');
			$data['entry_password'] = $this->language->get('entry_password');
			
			$data['button_continue'] = $this->language->get('button_continue');
			$data['button_login'] = $this->language->get('button_login');
			
			$data['text_seller_login_page'] = $this->language->get('text_seller_login_page');
			$data['text_new_seller'] = $this->language->get('text_new_seller');
			$data['text_register_new'] = $this->language->get('text_register_new');
			$data['text_seller_login'] = $this->language->get('text_seller_login');
			$data['error_seller_not_found'] = $this->language->get('error_seller_not_found');
			$data['text_seller_register_page'] = $this->language->get('text_seller_register_page');
			
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/sellerlogin', $data));
		}
		
		public function login(): void {
		$this->load->language('account/login');

		$json = [];

		if (!isset($this->request->get['login_token']) || !isset($this->session->data['login_token']) || ($this->request->get['login_token'] != $this->session->data['login_token'])) {
			$json['redirect'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerlogin', 'language=' . $this->config->get('config_language'), true);
		}

		if ($this->customer->isLogged()) {
			$store_detail = $this->model_extension_purpletree_multivendor_multivendor_vendor->isSeller($this->customer->getId());
			if(!empty($store_detail)){
			$json['redirect'] = $this->url->link('extension/purpletree_multivendor/multivendor/dashboardicons', 'language=' . $this->config->get('config_language') . '&customer_token=' . $this->session->data['customer_token'], true);
			}
		}

		if (!$json) {
			$keys = [
				'email',
				'password',
				'redirect'
			];

			foreach ($keys as $key) {
				if (!isset($this->request->post[$key])) {
					$this->request->post[$key] = '';
				}
			}

			// Check how many login attempts have been made.
			$this->load->model('account/customer');

			$login_info = $this->model_account_customer->getLoginAttempts($this->request->post['email']);

			if ($login_info && ($login_info['total'] >= $this->config->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
				$json['error']['warning'] = $this->language->get('error_attempts');
			}

			// Check if customer has been approved.
			$customer_info = $this->model_account_customer->getCustomerByEmail($this->request->post['email']);

			if ($customer_info && !$customer_info['status']) {
				$json['error']['warning'] = $this->language->get('error_approved');
			} elseif (!$this->customer->login($this->request->post['email'], html_entity_decode($this->request->post['password'], ENT_QUOTES, 'UTF-8'))) {
				$json['error']['warning'] = $this->language->get('error_login');

				$this->model_account_customer->addLoginAttempt($this->request->post['email']);
			}
		$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			if(!empty($customer_info['customer_id'])){
				$store_detail = $this->model_extension_purpletree_multivendor_multivendor_vendor->isSeller($customer_info['customer_id']);	
					$stores=array();
						if(isset($store_detail['multi_store_id'])){
							$stores=explode(',',$store_detail['multi_store_id']);
						}				
				if(isset($store_detail['store_status']) && (!in_array($this->config->get('config_store_id'),$stores))){
					$json['error']['warning'] = $this->language->get('error_seller_not_found');
				
				}
			}
		}

		if (!$json) {
			// Add customer details into session
			$this->session->data['customer'] = [
				'customer_id'       => $customer_info['customer_id'],
				'customer_group_id' => $customer_info['customer_group_id'],
				'firstname'         => $customer_info['firstname'],
				'lastname'          => $customer_info['lastname'],
				'email'             => $customer_info['email'],
				'telephone'         => $customer_info['telephone'],
				'custom_field'      => $customer_info['custom_field']
			];

			// Default address
			$this->load->model('account/address');

			$address_info = $this->model_account_address->getAddress($this->customer->getAddressId());

			if ($address_info) {
				$this->session->data['shipping_address'] = $address_info;
			}

			// Wishlist
			if (isset($this->session->data['wishlist']) && is_array($this->session->data['wishlist'])) {
				$this->load->model('account/wishlist');

				foreach ($this->session->data['wishlist'] as $key => $product_id) {
					$this->model_account_wishlist->addWishlist($product_id);

					unset($this->session->data['wishlist'][$key]);
				}
			}

			// Log the IP info
			$this->model_account_customer->addLogin($this->customer->getId(), $this->request->server['REMOTE_ADDR']);

			// Create customer token
			if(version_compare(VERSION, '4.0.0.0', '>')){
				$this->session->data['customer_token'] = Helper\General\token(26);
			} else {
				$this->session->data['customer_token']=token(26);
			}

			$this->model_account_customer->deleteLoginAttempts($this->request->post['email']);

			// Added strpos check to pass McAfee PCI compliance test (http://forum.opencart.com/viewtopic.php?f=10&t=12043&p=151494#p151295)
			if (isset($this->request->post['redirect']) && (strpos($this->request->post['redirect'], $this->config->get('config_url')) !== false)) {
				$json['redirect'] = str_replace('&amp;', '&', $this->request->post['redirect']) . '&customer_token=' . $this->session->data['customer_token'];
			} else {
				$json['redirect'] = $this->url->link('extension/purpletree_multivendor/multivendor/dashboardicons', 'language=' . $this->config->get('config_language') . '&customer_token=' . $this->session->data['customer_token'], true);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function token(): void {
		$this->load->language('account/login');

		if (isset($this->request->get['email'])) {
			$email = $this->request->get['email'];
		} else {
			$email = '';
		}

		if (isset($this->request->get['login_token'])) {
			$token = $this->request->get['login_token'];
		} else {
			$token = '';
		}

		// Login override for admin users
		$this->customer->logout();
		$this->cart->clear();

		unset($this->session->data['order_id']);
		unset($this->session->data['payment_address']);
		unset($this->session->data['payment_method']);
		unset($this->session->data['payment_methods']);
		unset($this->session->data['shipping_address']);
		unset($this->session->data['shipping_method']);
		unset($this->session->data['shipping_methods']);
		unset($this->session->data['comment']);
		unset($this->session->data['coupon']);
		unset($this->session->data['reward']);
		unset($this->session->data['voucher']);
		unset($this->session->data['vouchers']);
		unset($this->session->data['customer_token']);

		$this->load->model('account/customer');

		$customer_info = $this->model_account_customer->getCustomerByEmail($email);
		$warning = false;
		$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			if(!empty($customer_info['customer_id'])){
				$store_detail = $this->model_extension_purpletree_multivendor_multivendor_vendor->isSeller($customer_info['customer_id']);	
					$stores=array();
						if(isset($store_detail['multi_store_id'])){
							$stores=explode(',',$store_detail['multi_store_id']);
						}				
				if(isset($store_detail['store_status']) && (!in_array($this->config->get('config_store_id'),$stores))){
					$warning = true;
					//$warning = $this->language->get('error_seller_not_found');
					
				}
			}

		if ($customer_info && $customer_info['token'] && $customer_info['token'] == $token && $this->customer->login($customer_info['email'], '', true) && !$warning) {
			// Default Addresses
			$this->load->model('account/address');

			$address_info = $this->model_account_address->getAddress($customer_info['address_id']);

			if ($this->config->get('config_tax_customer') && $address_info) {
				$this->session->data[$this->config->get('config_tax_customer') . '_address'] = $address_info;
			}

			$this->model_account_customer->editToken($email, '');

			// Create customer token
		if(version_compare(VERSION, '4.0.0.0', '>')){
		$this->session->data['customer_token'] = Helper\General\token(26);
		} else {
		$this->session->data['customer_token']=token(26);
		}

			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/dashboardicons', 'language=' . $this->config->get('config_language') . '&customer_token=' . $this->session->data['customer_token']));
		} else {
			$this->session->data['error'] =$this->language->get('error_seller_not_found');

			$this->model_account_customer->editToken($email, '');

			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/sellerlogin', 'language=' . $this->config->get('config_language')));
		}
	}
}?>