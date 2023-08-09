<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Common;
class ColumnLeft extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->language('extension/purpletree_multivendor/module/purpletree_sellerpanel');  
		$this->load->language('extension/purpletree_multivendor/multivendor/header');
			$data['module_purpletree_multivendor_status'] =$this->config->get('module_purpletree_multivendor_status');
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			
			$store_detail = $this->model_extension_purpletree_multivendor_multivendor_dashboard->isSeller($this->customer->getId());
			$data['logged'] = $this->customer->isLogged();
			$data['isSeller'] = $this->model_extension_purpletree_multivendor_multivendor_dashboard->isSeller($this->customer->getId());
			$data['becomeseller'] = $this->url->link('extension/account/purpletree_multivendor/sellerregister', 'language=' . $this->config->get('config_language'), true);

			//start left menu icons section //
               $dashboard_menu_icons=$this->config->get('module_purpletree_multivendor_icons_status');
				if(!empty($dashboard_menu_icons)) {
		         foreach($dashboard_menu_icons as $key => $values){
					$data[$key]=0;
					$data[$values]=1;
					}
				}
			 //start left menu icons section //
					
			$data['text_becomeseller'] = $this->language->get('text_becomeseller');
			$stores=array();
						if(isset($store_detail['multi_store_id'])){
							$stores=explode(',',$store_detail['multi_store_id']);
						}
			if(isset($store_detail['store_status']) && in_array($this->config->get('config_store_id'),$stores)){		
				$data['heading_title'] = $this->language->get('heading_title');
				$data['module_purpletree_multivendor_status'] = $this->config->get('module_purpletree_multivendor_status');
				//$data['module_purpletree_multivendor_become_seller'] = $this->config->get('module_purpletree_multivendor_become_seller');
				if ($this->config->get('module_purpletree_multivendor_status')) {
					$store_id = (isset($data['isSeller']['id'])?$data['isSeller']['id']:'');
					$data['text_sellerstore'] 				= $this->language->get('text_sellerstore');
					$data['text_dashboard_icon'] 			= $this->language->get('text_dashboard_icon');
					$data['text_downloads'] 				= $this->language->get('text_downloads');
					$data['text_sellerproduct'] 			= $this->language->get('text_sellerproduct');
					$data['text_seller_template_product'] 	= $this->language->get('text_seller_template_product');
					$data['text_sellerprofile'] 			= $this->language->get('text_sellerprofile');
					$data['text_sellerorder'] 				= $this->language->get('text_sellerorder');
					$data['text_sellercommission'] 			= $this->language->get('text_sellercommission');
					$data['text_seller_enquiries'] 			= $this->language->get('text_seller_enquiries');
					$data['text_removeseller'] 				= $this->language->get('text_removeseller');
					$data['text_becomeseller'] 				= $this->language->get('text_becomeseller');
					$data['text_sellerview'] 				= $this->language->get('text_sellerview');
					$data['text_approval'] 					= $this->language->get('text_approval');
					$data['text_sellerpayment'] 			= $this->language->get('text_sellerpayment');
					$data['text_sellerreview'] 				= $this->language->get('text_sellerreview');
					$data['text_sellerenquiry'] 			= $this->language->get('text_sellerenquiry');
					$data['text_shipping'] 					= $this->language->get('text_shipping');
					$data['text_bulkproductupload'] 		= $this->language->get('text_bulkproductupload');
					$data['text_dashboard'] 				= $this->language->get('text_dashboard');
					$data['text_selleroption'] 				= $this->language->get('text_selleroption');
					$data['text_subscription'] 				= $this->language->get('text_subscription');
					$data['text_subscriptions'] 			= $this->language->get('text_subscriptions');		
					$data['text_options'] 					= $this->language->get('text_options');		
					$data['text_password'] 					= $this->language->get('text_password');
					$data['text_logout'] 					= $this->language->get('text_logout');	
					$data['text_seller_returns'] 			= $this->language->get('text_seller_returns');
					$data['text_attribute'] 				= $this->language->get('text_attribute');
					///BLOG///
					$data['text_blog_post']					= $this->language->get('text_blog_post');
					$data['text_blog_comment'] 				= $this->language->get('text_blog_comment');
					$data['text_sales'] 				= $this->language->get('text_sales');
					$data['text_catalog'] 				= $this->language->get('text_catalog');
					///BLOG///
					$data['text_commissioninvoice'] 		= $this->language->get('text_commissioninvoice');
					$data['sellerprofile'] 			= $this->url->link('account/edit', 'language=' . $this->config->get('config_language'), true);
					$data['downloadsitems'] 		= $this->url->link('extension/purpletree_multivendor/multivendor/downloads', 'language=' . $this->config->get('config_language'), true);
					$data['sellerstore'] 			= $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore', 'language=' . $this->config->get('config_language'), true);
					$data['dashboardicons'] 		= $this->url->link('extension/purpletree_multivendor/multivendor/dashboardicons', 'language=' . $this->config->get('config_language'), true);
					$data['sellerproduct'] 			= $this->url->link('extension/purpletree_multivendor/multivendor/sellerproduct', 'language=' . $this->config->get('config_language'), true);
					$data['seller_product_returns'] = $this->url->link('extension/purpletree_multivendor/multivendor/product_returns', 'language=' . $this->config->get('config_language'), true);
					$data['module_purpletree_multivendor_seller_product_template'] = $this->config->get('module_purpletree_multivendor_seller_product_template');
				if($data['module_purpletree_multivendor_seller_product_template'] == 1){
					$data['seller_template_product'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellertemplateproduct', 'language=' . $this->config->get('config_language'), true);	
				}
					
					$data['sellerenquiries'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerenquiries', 'language=' . $this->config->get('config_language'), true);
					
					$end_date_to = date('Y-m-d');
					$end_date_from = date('Y-m-d', strtotime("-30 days"));				
					$data['sellerorder'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerorder', 'filter_date_from='.$end_date_from.'&filter_date_to=' .$end_date_to.'&language=' . $this->config->get('config_language'), true);
					
					$data['sellercommission'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellercommission', 'language=' . $this->config->get('config_language'), true);
					$data['sellerpayment'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerpayment', 'language=' . $this->config->get('config_language'), true);
					
					$data['removeseller'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|removeseller', 'language=' . $this->config->get('config_language'), true);
					
					$data['sellerview'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|storeview&seller_store_id='.$store_id, 'language=' . $this->config->get('config_language'), true);
					$data['sellerreview'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|sellerreview', 'language=' . $this->config->get('config_language'), true);
					$data['bulkproductupload'] = $this->url->link('extension/purpletree_multivendor/multivendor/bulkproductupload', 'language=' . $this->config->get('config_language'), true);
					if($this->config->get('module_purpletree_multivendor_shippingtype')){
						$data['shipping'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellergeozone','language=' . $this->config->get('config_language'), true);
						}else{
						$data['shipping'] = $this->url->link('extension/purpletree_multivendor/multivendor/shipping','language=' . $this->config->get('config_language'), true);
					}
					$data['sellerenquiry'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellercontact|sellercontactlist', 'language=' . $this->config->get('config_language'), true);
					$data['dashboard'] = $this->url->link('extension/purpletree_multivendor/multivendor/dashboard', 'language=' . $this->config->get('config_language'), true);
					
					if($this->config->get('module_purpletree_multivendor_subscription_plans')){
						$data['subscriptionplan'] = $this->url->link('extension/purpletree_multivendor/multivendor/subscriptionplan', 'language=' . $this->config->get('config_language'), true);
						
						$data['subscriptions'] = $this->url->link('extension/purpletree_multivendor/multivendor/subscriptions', 'language=' . $this->config->get('config_language'), true);
					}
					///BLOG///
					$data['seller_blog_status'] = $this->config->get('module_purpletree_sellerblog_status');
					if($this->config->get('module_purpletree_sellerblog_status')){
						$data['sellerblogpost'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerblogpost', 'language=' . $this->config->get('config_language'), true);
						$data['sellerblogcomment'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerblogcomment', 'language=' . $this->config->get('config_language'), true);
					}
					///Attribute///
					$data['attribute_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattribute', 'language=' . $this->config->get('config_language'), true);
					$data['attribute_groups_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerattributegroups', 'language=' . $this->config->get('config_language'), true);
					$data['options_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/selleroptions', 'language=' . $this->config->get('config_language'), true);
					///BLOG///
					$data['commissioninvoice'] = $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'language=' . $this->config->get('config_language'), true);
					$data['sellercoupons'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellercoupons', 'language=' . $this->config->get('config_language'), true);
					////add password and logout menu////				
					if($this->config->get('module_purpletree_multivendor_hide_user_menu')){
						$data['logout'] = $this->url->link('account/logout', 'language=' . $this->config->get('config_language'), true);
						$data['password'] = $this->url->link('account/password', 'language=' . $this->config->get('config_language'), true);
					}
					////End add password and logout menu////
					//Stirpe connect
					$data['stripe_status']= $stripe_status = $this->config->get('payment_pts_stripe_status');
					$data['a_href']='';	
					$data['a']='';
					$client_id='';
					$payment_mode = $this->config->get('payment_pts_stripe_payment_mode');
					$stripe = array();
					if($payment_mode){
						$client_id=$this->config->get('payment_pts_stripe_client_id_live');
					} else {
						$client_id=$this->config->get('payment_pts_stripe_client_id_test');
					}
					if($client_id!=NULL){
					$stripe_connect = 'https://dashboard.stripe.com/express/oauth/authorize?response_type=code&client_id='.$client_id.'&scope=read_write';
					/* $stripe_connect_standard= 'https://dashboard.stripe.com/oauth/authorize?response_type=code&client_id='.$client_id.'&scope=read_write'; */
					$data['a_href']='<a id="pts-seller-panel-stripe-connect" class="pts-list-group-item" href="'.$stripe_connect.'" >';
					$data['a']='</a>';
				}
		
					//Stirpe connect
			
				}
			}
			$data['newsellerpanel'] = 1;
		return $this->load->view('extension/purpletree_multivendor/module/purpletree_sellerpanel', $data);
	}
}