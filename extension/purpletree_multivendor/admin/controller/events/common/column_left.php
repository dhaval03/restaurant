<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Events\Common;
class ColumnLeft extends \Opencart\System\Engine\Controller {
		private $error = array();
		public function createMenu(&$route, &$data): void {

		$this->load->model('setting/extension');
		$extension_status = $this->model_setting_extension->getInstallByCode('purpletree_multivendor');
			
	if ($extension_status['status']) {
		$this->load->language('extension/purpletree_multivendor/customer/ptscustomer');
		$purpletree_multivendor = array();
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/module/purpletree_multivendor')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_setting'),
					'href'     => $this->url->link('extension/purpletree_multivendor/module/purpletree_multivendor', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
		//$this->config->get('module_purpletree_multivendor_status')
		if(1) {	
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/vendor')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_vendors'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/vendor', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/stores')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_stores'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/stores', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/sellercustomfield')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_customfield'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/sellercustomfield', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/sellerproducts')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_sellerproducts'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/sellerproducts', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			if($this->config->get('module_purpletree_multivendor_seller_product_template')){
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/admintemplate')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_admintemplate'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/admintemplate', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/admintemplate')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_sellertemplate'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/producttemplate', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			}
			$orderstatus = 0;
			if(null !== $this->config->get('module_purpletree_multivendor_commission_status')) {
				$orderstatus = $this->config->get('module_purpletree_multivendor_commission_status');
			}
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/sellerorders')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_sellerorders'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/sellerorders', 'filter_order_status='."".'&filter_admin_order_status='."".'&user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/commissioninvoice')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_commissioninvoice'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
				}
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/sellercommission')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_sellercommission'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/sellercommission', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}			
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/sellerreviews')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_sellerreviews'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/sellerreviews', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/sellercontacts')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_sellercontacts'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/sellercontacts', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/sellerenquiries')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_seller_enquiries'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/sellerenquiries', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			//***** Seller area ******//
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/sellerarea')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_seller_area'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/sellerarea', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			//***** Seller area ******//
		   /*********   Purpletree Multivendor Seller Bloog   ************/
		   if ($this->config->get('module_purpletree_sellerblog_status')) {
			$purpletree_multivendor_seller_blog = array();
			
				if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/sellerblogpost')) {
				$purpletree_multivendor_seller_blog[] = array(
					'name'	   => $this->language->get('text_blog_post'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/sellerblogpost', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
				if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/sellerblogcomment')) {
				$purpletree_multivendor_seller_blog[] = array(
					'name'	   => $this->language->get('text_blog_comment'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/sellerblogcomment', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
		
			if ($purpletree_multivendor_seller_blog) {
				$purpletree_multivendor[] = array(				
					'name'	   => $this->language->get('text_seller_purpletree_blog'),
					'href'     => '',
					'children' => $purpletree_multivendor_seller_blog
				);	
			}
			}
		  /*********   End Purpletree Multivendor Seller Bloog   ************/
			
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/categoriescommission')) {
				$purpletree_multivendor[] = array(
					'name'	   => $this->language->get('text_pt_categoriescommission'),
					'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/categoriescommission', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			if($this->config->get('module_purpletree_multivendor_shippingtype')){
				if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/geozone')) {
					$purpletree_multivendor[] = array(
						'name'	   => $this->language->get('text_pt_shipping'),
						'href'     => $this->url->link('extension/purpletree_multivendor/multivendor/geozone', 'user_token=' . $this->session->data['user_token'], true),
						'children' => array()		
					);	
				}
			}else{
				if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/shipping')) {
				$purpletree_multivendor[] = array(
			    'name'  => $this->language->get('text_pt_shipping'),
				'href'  => $this->url->link('extension/purpletree_multivendor/multivendor/shipping', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			}
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/bulkproductupload')) {				$purpletree_multivendor[] = array(
			    'name'  => $this->language->get('text_pt_bulkproductupload'),
				'href'  => $this->url->link('extension/purpletree_multivendor/multivendor/bulkproductupload', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			
			
				if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/subscriptionplan')) {
				if($this->config->get('module_purpletree_multivendor_subscription_plans')) {
				$purpletree_multivendor[] = array(
				'name'  => $this->language->get('text_pt_vendor_subscription_plan'),
				'href'  => $this->url->link('extension/purpletree_multivendor/multivendor/subscriptionplan', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
				}
			}
			
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/subscriptionplan')) {
				if($this->config->get('module_purpletree_multivendor_subscription_plans')) {
				$purpletree_multivendor[] = array(
				'name'  => $this->language->get('text_pt_subscription_invoice'),
				'href'  => $this->url->link('extension/purpletree_multivendor/multivendor/subscriptionplan_pendinginvoice', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
				}
			}
			
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/managesubscriptionplan')) {
			if($this->config->get('module_purpletree_multivendor_subscription_plans')) {
			$purpletree_multivendor[] = array(
				'name'  => $this->language->get('text_pt_manage_subscription_plan'),
				'href'  => $this->url->link('extension/purpletree_multivendor/multivendor/managesubscriptionplan', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);
			}				
			}
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/planinvoicestatus')) {
			$purpletree_multivendor[] = array(
				'name'  => $this->language->get('text_pt_plan_invoice_status'),
				'href'  => $this->url->link('extension/purpletree_multivendor/multivendor/planinvoicestatus', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/selleremail')) {				$purpletree_multivendor[] = array(
				'name'  => $this->language->get('text_pt_selleremail'),
				'href'  => $this->url->link('extension/purpletree_multivendor/multivendor/selleremail', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			
			if ($this->user->hasPermission('access', 'extension/purpletree_multivendor/multivendor/upgradedatabase')) {				$purpletree_multivendor[] = array(
				'name'  => $this->language->get('text_pt_upgradedatabase'),
				'href'  => $this->url->link('extension/purpletree_multivendor/multivendor/upgradedatabase', 'user_token=' . $this->session->data['user_token'], true),
					'children' => array()		
				);	
			}
			}
			
			if ($purpletree_multivendor) {
				$data['menus'][] = array(
					'id'       => 'menu-purpletree-multivendor',
					'icon'	   => 'fa fa-users', 
					'name'	   => $this->language->get('text_pt_multivendor'),
					'href'     => '',
					'children' => $purpletree_multivendor
				);	
			}
			}
		}		
}
?>