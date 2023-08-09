<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Common;
class  Header extends \Opencart\System\Engine\Controller {
	public function index() {
		$data = array();
				// Analytics
		$this->load->model('setting/extension');

		$data['analytics'] = array();

		$analytics = $this->model_setting_extension->getExtensionsByType('analytics');
		foreach ($analytics as $analytic) {
			if ($this->config->get('analytics_' . $analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get('analytics_' . $analytic['code'] . '_status'));
			}
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['base'] = $this->config->get('config_url');
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['heading_title1'] = $this->document->getTitle();
		$data['seller_logo'] = '/admin/view/image/logo.png';
		
		$this->load->language('extension/purpletree_multivendor/module/purpletree_sellerpanel');  
		$this->load->language('extension/purpletree_multivendor/multivendor/header');  
		$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');  
		$data['name'] = $this->config->get('config_name');

			if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
				$data['logo'] = $this->config->get('config_url') . 'image/' . $this->config->get('config_logo');
			} else {
				$data['logo'] = '';
			}
		$data['home'] = $this->url->link('common/home', 'language=' . $this->config->get('config_language'));	
		$isSeller =  array();
		$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
		$isSeller = $this->model_extension_purpletree_multivendor_multivendor_dashboard->isSeller($this->customer->getId());
		if($this->customer->isLogged() && $seller_store = $isSeller) {
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			$data['logged'] = 1;
			$seller = $this->model_extension_purpletree_multivendor_multivendor_vendor->getsellerInfo();
				$data['firstname'] = '';
					$data['lastname'] = '';
			if($seller) {
				if(isset($seller['store_logo']) && $seller['store_logo'] != '') {
					//$data['seller_logo'] = 'image/'.$seller['store_logo'];
				}
				if(isset($seller['firstname'])) {
					$data['firstname'] = $seller['firstname'];
					} 
			 
				if(isset($seller['lastname'])) {
					$data['lastname']  = $seller['lastname'];
				}
				}
				$data['profile'] 			= $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore', 'language=' . $this->config->get('config_language'), true);
				$data['storename'] 				= '';
			if(isset($seller['store_name'])) {
				$data['storename'] 				= $seller['store_name'];
			}
			$data['storeurl'] 				= 	'';
			if(isset($seller["id"])) {
				$data['storeurl'] 				= $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|storeview&seller_store_id='.$seller["id"], 'language=' . $this->config->get('config_language'), true);
			}
				$data['currency'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/currency');
			}
			
			$data['dashboardpageurl'] 			= $this->url->link('extension/purpletree_multivendor/multivendor/dashboardicons', 'language=' . $this->config->get('config_language'), true);
			$data['logout'] 				= $this->url->link('account/logout','language=' . $this->config->get('config_language'), true);
			
			$this->load->model('tool/image');
			$data['image'] = $this->model_tool_image->resize('catalog/no_image_seller.png', 40, 40);
			$data['sellerprofile'] 			= $this->url->link('account/edit','language=' . $this->config->get('config_language'), true);
			$data['direction'] = $this->language->get('direction');
		
			$data['lang'] = $this->language->get('code');
			$data['language'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/language');
			
			// $data['stylespts'] = $this->document->getStylespts();
			// $data['scriptspts'] = $this->document->getScriptspts('header');
			
	
		return $this->load->view('extension/purpletree_multivendor/multivendor/header', $data);
	}
	public function seachText() {
		
			$search_area = $this->request->get['search_area'];
				$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
				$results = $this->model_extension_purpletree_multivendor_multivendor_vendor->getSellerAreaByText($search_area);
				$json=array();
				if(!empty($results)){
					$json['area_id']=$results['area_id'];
					$json['area_name']=$results['area_name'];
				}

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}	
			
		public function seachArea() {
		$search_area = $this->request->get['search_area'];
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			$results = $this->model_extension_purpletree_multivendor_multivendor_vendor->getSellerHyperlocal($search_area);
			$sellerareas[] = array(
									'area_id'=> 0,
									'area_name'=> "All"
								);
			if(!empty($results)){
			foreach ($results as $result) {	
				$sellerareas[] = array(
								'area_id'=> $result['area_id'],
								'area_name'=> $result['area_name']);
								} 
			}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($sellerareas));
	}
}