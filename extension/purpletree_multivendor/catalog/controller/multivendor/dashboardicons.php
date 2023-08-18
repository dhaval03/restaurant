<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Dashboardicons extends \Opencart\System\Engine\Controller {
		private $error = array();
		
		public function index(){
			
			if (!$this->customer->isLogged()) {
				$this->session->data['redirect'] = $this->url->link('extension/purpletree_multivendor/multivendor/dashboardicons','language=' . $this->config->get('config_language'), true);
				
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/sellerlogin', 'language=' . $this->config->get('config_language'), true));
			}
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			$store_detail = $this->model_extension_purpletree_multivendor_multivendor_dashboard->isSeller($this->customer->getId());
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
			
			$this->load->language('extension/purpletree_multivendor/multivendor/dashboard');
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			$data['seller_orders'] = array();
			
			
			if (isset($this->session->data['error_warning'])) {
				$data['error_warning'] = $this->session->data['error_warning'];
				
				unset($this->session->data['error_warning']);
				} else {
				$data['error_warning'] = '';
			}
			if (isset($this->session->data['success_stripe_connect'])) {
				$data['success'] = $this->session->data['success_stripe_connect'];
				
				unset($this->session->data['success_stripe_connect']);
				} else {
				$data['success'] = '';
			}
			
			if (isset($this->session->data['error_stripe_connect_warning'])) {
				$data['error_warning'] = $this->session->data['error_stripe_connect_warning'];
				
				unset($this->session->data['error_stripe_connect_warning']);
				} else {
				$data['error_warning'] = '';
			}
			$url ='';
			///Help code///	
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-seller";
			$data['helplink'] = "https://cutt.ly/WCoMvAX";
			if (defined ('DISABLED_PTS_HELP')){if(DISABLED_PTS_HELP == 0){$data['helpcheck'] = 1;}else{$data['helpcheck'] = 0;}}else{$data['helpcheck'] = 1;}
			$data['helpimage'] = HTTP_SERVER . 'extension/purpletree_multivendor/catalog/view/assets/image/help.png';
			/// End Help code///
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home','language=' . $this->config->get('config_language'),true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title1'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/dashboardicons', $url.'&language=' . $this->config->get('config_language'), true)
			);
			
			$data['totalorders'] = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getCountSeen($this->customer->getId());

			 // start Dashboard icons  section//

				$dashboard_icons=array();
                $dashboard_icons=$this->config->get('module_purpletree_multivendor_icons_status');
				if(!empty($dashboard_icons)) {
		         foreach($dashboard_icons as $key => $value){
					$data[$key]=0;
					$data[$value]=1;
				}
				}
		    // End Dashboard icons  section//

			$data['totaladminmessages'] = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getCountAdminMessageSeen($this->customer->getId());
			$data['totalenqures'] = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getCountSeen1($this->customer->getId());
			$data['isSeller'] = $this->model_extension_purpletree_multivendor_multivendor_dashboard->isSeller($this->customer->getId());
			$store_id = (isset($data['isSeller']['id'])?$data['isSeller']['id']:'');
			$this->load->model('localisation/order_status');
			$this->document->setTitle($this->language->get('heading_title1'));
			$data['heading_title']=$this->language->get('heading_title1');
			/////////////////////////
			$data['text_Manage_Downloads'] = $this->language->get('text_Manage_Downloads');
			$data['text_reviews'] = $this->language->get('text_reviews');
			$data['text_Seller_Account'] = $this->language->get('text_Seller_Account');
			$data['text_Customer_Enquiries'] = $this->language->get('text_Customer_Enquiries');
			$data['text_Bulk_product_upload'] = $this->language->get('text_Bulk_product_upload');
			$data['text_Orders'] = $this->language->get('text_Orders');
			$data['text_Seller_Store'] = $this->language->get('text_Seller_Store');
			$data['text_Store_information'] = $this->language->get('text_Store_information');
			$data['text_View_Store'] = $this->language->get('text_View_Store');
			$data['text_Subscription_Invoice'] = $this->language->get('text_Subscription_Invoice');
			$data['text_Seller_Payments'] = $this->language->get('text_Seller_Payments');
			$data['text_Subscription_plan'] = $this->language->get('text_Subscription_plan');
			$data['text_Payments'] = $this->language->get('text_Payments');
			$data['text_Commisions'] = $this->language->get('text_Commisions');
			$data['text_shiiping_rate'] = $this->language->get('text_shiiping_rate');
			$data['text_Manage_products'] = $this->language->get('text_Manage_products');
			$data['text_seller_template_product'] = $this->language->get('text_seller_template_product');
			$data['text_blog_post'] = $this->language->get('text_blog_post');
			$data['text_blog_comment'] = $this->language->get('text_blog_comment');
			$data['text_commissioninvoice'] = $this->language->get('text_commissioninvoice');
			$data['text_sellerenquiries'] = $this->language->get('text_sellerenquiries');
			$data['text_sellercoupons'] = $this->language->get('text_sellercoupons');
			$data['text_seller_returns'] = $this->language->get('text_seller_returns');
			///////////////////
			$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
			$data['column_left'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/column_left');
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			
			
			$data['sellerprofile'] = $this->url->link('extension/purpletree_multivendor/multivendor/edit','language=' . $this->config->get('config_language'), true);
			$data['downloadsitems'] = $this->url->link('extension/purpletree_multivendor/multivendor/downloads','language=' . $this->config->get('config_language'), true);
			$data['sellerstore'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore','language=' . $this->config->get('config_language'), true);
			$data['sellerproduct'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerproduct','language=' . $this->config->get('config_language'), true);
			$orderstatus = 0;
			$end_date_to = date('Y-m-d');
			$end_date_from = date('Y-m-d', strtotime("-30 days"));				
			$data['sellerorder'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerorder', 'filter_date_from='.$end_date_from.'&filter_date_to=' .$end_date_to.'&language=' . $this->config->get('config_language'), true);
			$data['sellercommission'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellercommission', 'language=' . $this->config->get('config_language'), true);
			$data['sellerpayment'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerpayment','language=' . $this->config->get('config_language'), true);
			$data['removeseller'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|removeseller','language=' . $this->config->get('config_language'), true);
			$data['becomeseller'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|becomeseller','language=' . $this->config->get('config_language'), true);
			$data['sellerview'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|storeview&seller_store_id='.$store_id,'&language=' . $this->config->get('config_language'), true);
			$data['sellerreview'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|sellerreview','language=' . $this->config->get('config_language'), true);
			$data['sellerenquiry'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellercontact|sellercontactlist','language=' . $this->config->get('config_language'), true);
			$data['dashboardicons'] = $this->url->link('extension/purpletree_multivendor/multivendor/dashboardicons','language=' . $this->config->get('config_language'), true);
			$data['dashboard'] = $this->url->link('extension/purpletree_multivendor/multivendor/dashboard','language=' . $this->config->get('config_language'), true);
			if($this->config->get('module_purpletree_multivendor_shippingtype')){
				$data['shipping'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellergeozone', 'language=' . $this->config->get('config_language'), true);
				}else{
				$data['shipping'] = $this->url->link(	'extension/purpletree_multivendor/multivendor/shipping','language=' . $this->config->get('config_language'), true);
			}
			$data['bulkproductupload'] = $this->url->link('extension/purpletree_multivendor/multivendor/bulkproductupload', 'language=' . $this->config->get('config_language'), true);
			
			$data['seatingmanagement'] = $this->url->link('extension/purpletree_multivendor/multivendor/seatingmanagement', 'language=' . $this->config->get('config_language'), true);
			
			$data['location'] = $this->url->link('extension/purpletree_multivendor/multivendor/location', 'language=' . $this->config->get('config_language'), true);
			
			$data['purpletree_multivendor_subscription_plans'] = $this->config->get('module_purpletree_multivendor_subscription_plans');
			if($this->config->get('module_purpletree_multivendor_subscription_plans')==1){
				
				$data['subscriptionplan'] = $this->url->link('extension/purpletree_multivendor/multivendor/subscriptionplan','language=' . $this->config->get('config_language'), true);
				
				$data['subscriptions'] = $this->url->link('extension/purpletree_multivendor/multivendor/subscriptions', 'language=' . $this->config->get('config_language'), true);
				
			}
			$data['seller_blog_status'] = $this->config->get('module_purpletree_sellerblog_status');
			if($this->config->get('module_purpletree_sellerblog_status')){
				$data['sellerblogpost'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerblogpost','language=' . $this->config->get('config_language'), true);
				$data['sellerblogcomment'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerblogcomment', '', true);
			}
			$data['commissioninvoice'] = $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'language=' . $this->config->get('config_language'), true);
			$data['module_purpletree_multivendor_seller_product_template'] = $this->config->get('module_purpletree_multivendor_seller_product_template');
			if($data['module_purpletree_multivendor_seller_product_template'] == 1){
				$data['seller_template_product'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellertemplateproduct','language=' . $this->config->get('config_language'), true);
			}
			//stripe connect	
			
			$data['text_stripe_connect']= $this->language->get('text_stripe_connect');
			$data['stripe_status'] = $stripe_status = $this->config->get('payment_pts_stripe_status');
			
			if ($this->config->get('payment_pts_stripe_debug')) {
				if($stripe_status){
					$this->log->write('Stripe payment mathod is enable');
				} else {
					$this->log->write('Stripe payment mathod is disable');
				}
			 }
			if($stripe_status){
				$data['a_href']='';	
				$data['a']='';
				$payment_mode = $this->config->get('payment_pts_stripe_payment_mode');
				$stripe = array();
				if($payment_mode){
					$client_id=$this->config->get('payment_pts_stripe_client_id_live');
				} else {
					$client_id=$this->config->get('payment_pts_stripe_client_id_test');
				}
				
				if ($client_id==NULL) {
					if ($this->config->get('payment_pts_stripe_debug')) {
						$this->log->write('Client Id is blank. Please enter client id in stripe payment setting');
					}
				}
				if($client_id!=NULL){
				$stripe_connect = 'https://dashboard.stripe.com/express/oauth/authorize?response_type=code&client_id='.$client_id.'&scope=read_write';
				
				/* $stripe_connect_standard= 'https://dashboard.stripe.com/oauth/authorize?response_type=code&client_id='.$client_id.'&scope=read_write'; */
				$data['a_href']='<a href="'.$stripe_connect.'">';	
				$data['a']='</a>';	
					$this->load->model('extension/purpletree_multivendor/multivendor/stripeconnect');
	$num_of_acc1 = $this->model_extension_purpletree_multivendor_multivendor_stripeconnect->checkAccountExistwithsellerid($this->customer->getId());
			if($num_of_acc1){
				$data['text_stripe_connect']= $this->language->get('text_stripe_connected');
				$data['a_href']='';	
				$data['a']='';	
			}
				}
			}
	//stripe connect		
			
			$data['sellerenquiries'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerenquiries', 'language=' . $this->config->get('config_language'), true);
			$data['sellercoupons'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellercoupons','language=' . $this->config->get('config_language'), true);
			$data['seller_product_returns'] = $this->url->link('extension/purpletree_multivendor/multivendor/product_returns', 'language=' . $this->config->get('config_language'), true);

			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/dashboardicons', $data));
		}	
}?>