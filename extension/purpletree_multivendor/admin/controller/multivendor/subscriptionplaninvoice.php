<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Subscriptionplaninvoice extends \Opencart\System\Engine\Controller {
		private $error = array();
		
		public function index() {
			$this->load->language('extension/purpletree_multivendor/multivendor/subscriptionplanInvoice');
			
			$this->document->setTitle('Offline Payment');
			$this->document->addStyle('../extension/purpletree_multivendor/admin/view/javascript/purpletreecss/commonstylesheet.css');
			$this->load->model('extension/purpletree_multivendor/multivendor/subscriptionplaninvoice');
		}
		public function view() {
			$this->document->addStyle('../extension/purpletree_multivendor/admin/view/javascript/purpletreecss/commonstylesheet.css');
			if (!isset($this->request->get['invoice_id']) || $this->request->get['invoice_id'] == '') {
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/managesubscriptionplan', 'user_token=' . $this->session->data['user_token'] , true));
			} 
			$this->load->language('sale/order');
			$this->load->language('extension/purpletree_multivendor/multivendor/subscriptionplanInvoice');
			$this->load->model('extension/purpletree_multivendor/multivendor/subscriptionplaninvoice');
			$this->document->setTitle('Invoice');
			
			
			$data['title'] = "Invoice";
			
			$data['base'] = HTTP_SERVER;
			
			$data['direction'] = $this->language->get('direction');
			$data['lang'] = $this->language->get('code');
			$data = array();
			$invoice_id = $this->request->get['invoice_id'];
			
			$data['invoice_id'] = $this->request->get['invoice_id'];
			$seller_id=$this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getsellerfromInvoice($invoice_id);
			if(!$seller_id) {
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/managesubscriptionplan', 'user_token=' . $this->session->data['user_token'] , true));
			}
			$seller_store=$this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getStoreDetail($seller_id);
			$this->load->model('extension/purpletree_multivendor/multivendor/stores');
			$cus_seller_email = $this->model_extension_purpletree_multivendor_multivendor_stores->getCustomerEmailId($seller_id);
			
		    if(!empty($seller_store)){
				$data['store_info']=array(
				'name' => $seller_store['store_name'],
				'address'=> $seller_store['store_address'],
				'email' => $cus_seller_email,
				'telephone' => $seller_store['store_phone'],
				'fax' => ''
				);
			}
			
			$data['admin_info']=array(
			'name' => $this->config->get('config_name'),
			'address' => $this->config->get('config_address'),
			'email' => $this->config->get('config_email'),
			'telephone' => $this->config->get('config_telephone'),
			'fax' => $this->config->get('config_fax'),
			'url' => $this->config->get('config_url')
			);
			$data['payment_history'] = array();
			$data['payment_history']=$this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getInvoiceHistory($invoice_id);
			$invoceddetail = $this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getinvoice($invoice_id);
			$data['created_date'] = '';
			$data['current_status'] ='';
			if($invoceddetail) {
				$data['created_date']= date('d-m-Y', strtotime($invoceddetail['created_date']));
				$data['current_status']=$this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getstausfromid($invoceddetail['status_id']);
			}
			$old_invoice_id=$this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getInvoiceId($seller_id);
			//$old_invoice_id=$this->request->get['old_invoice_id'];
			$data['invoice_id']=$invoice_id;
			
			if(isset($invoice_id)){
				$data['invoice_data']=$this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getPlanId($invoice_id,$old_invoice_id);
				
			}
			
			$curency = $this->config->get('config_currency');			 
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerpayment');
			$currency_detail = $this->model_extension_purpletree_multivendor_multivendor_sellerpayment->getCurrencySymbol($curency);
			$data['invoice']=array();
			foreach($data['invoice_data'] as $value){
				$data['invoice']['seller_id']= $value['seller_id'];
				$data['invoice']['plan_id']= $value['plan_id'];
				$data['invoice']['payment_mode']= $value['payment_mode'];
				$data['invoice']['status_id']= $value['status_id'];
				$data['invoice']['created_date']= $value['created_date'];
				foreach($data['invoice_data']['invoice']['item'] as $items){
					$data['invoice']['item'][]=array(
					'title'=>$items['title'],
					'code'=>$items['code'],
					'price'=>$this->currency->format($items['price'], $currency_detail['code'], $currency_detail['value'])
					);
				} 
			} 
			
			
			$fff1 = array();			 
			
			
			foreach($data['invoice_data']['invoice']['item'] as $key => $value){
				$fff1[$value['code']] = $value['price'];
			}
			
			
			$data['joining_fee']=0;			 
			if(!empty($fff1['joining_fee'])){
				$data['joining_fee']=$this->currency->format($fff1['joining_fee'], $currency_detail['code'], $currency_detail['value']);
			}
			$data['subscription_price']=$this->currency->format($fff1['subscription_price'], $currency_detail['code'], $currency_detail['value']);
			
			// echo"<pre>"; print_r($data['joining_fee']); die;
			if(array_key_exists('adjustment_Joining_fee',$fff1)){
				unset($fff1['joining_fee']);
			}
			
			if(array_key_exists('adjustment_subscription_price',$fff1)){
				unset($fff1['subscription_price']);
			}
			$keyyy1 ='';
			$keyyy2 ='';
			foreach($data['invoice_data']['invoice']['item'] as $key => $value){
				if($value['code'] == 'adjustment_Joining_fee') {
					$keyyy1 = $key;
				}
				if($value['code'] == 'adjustment_subscription_price') {
					$keyyy2 = $key;
				}
			}
			foreach($data['invoice']['item'] as $key => $value){
				if($keyyy1 != '') {
					if($value['code'] == 'joining_fee') {
						unset($data['invoice']['item'][$key]);
					}
				}
				if($keyyy2 != '') {
					if($value['code'] == 'subscription_price') {
						unset($data['invoice']['item'][$key]);
					}
				}
			}				  
			
			
			$data['invoiceitemss'] = $data['invoice']['item'];
			
			$data['grand_total']=$this->currency->format(array_sum(array_values($fff1)), $currency_detail['code'], $currency_detail['value']);
			
			$planId = $this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getsellerplanid($invoice_id);
			$data['newplan'] = array();
			if(isset($data['invoice_data']['invoice']['plan_id'])){
				$result=$this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getSubscribePlan($data['invoice_data']['invoice']['plan_id']);
			}
			
			if(!empty($result)){
				
				$pts_date= $this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getCurrentPlanByPlanId($invoice_id);
				
				$data['newplan'] = array(
				'plan_id'        => $result['plan_id'],
				'plan_name'        => $result['plan_name'],
				'plan_description'  => html_entity_decode($result['plan_description'], ENT_QUOTES, 'UTF-8'),
				'plan_short_description'  => strip_tags(html_entity_decode($result['plan_short_description'], ENT_QUOTES, 'UTF-8')),
				'no_of_product'  => $result['no_of_product'],
				'joining_fee'  => $this->currency->format($result['joining_fee'],$currency_detail['code'], $currency_detail['value']),
				'subscription_price'  => $this->currency->format($result['subscription_price'], $currency_detail['code'], $currency_detail['value']),
				'validity'  => $result['validity'],
				'start_date'  => date('d/m/Y',strtotime($pts_date['start_date'])),
				'end_date'        => date('d/m/Y', strtotime($pts_date['start_date']. ' + '.$result['validity'].' days'))
				);
				
			}
			
			if(!empty($data['payment_history'])) {
				foreach($data['payment_history'] as $key => $paymentss) {
					$data['payment_history'][$key]['status'] = $this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getstausfromid($paymentss['status_id']);
				}
			}
			$data['heading_title'] = $this->language->get('heading_title');
			$data['text_invoice'] = $this->language->get('text_invoice');
			$data['text_invoice_details'] = $this->language->get('text_invoice_details');
			$data['text_admin_store_name'] = $this->language->get('text_admin_store_name');
			$data['text_address'] = $this->language->get('text_address');
			$data['text_telephone'] = $this->language->get('text_telephone');
			$data['text_email'] = $this->language->get('text_email');
			$data['text_website'] = $this->language->get('text_website');
			$data['text_seller_store_name'] = $this->language->get('text_seller_store_name');
			$data['text_plan_details'] = $this->language->get('text_plan_details');
			$data['text_start_date'] = $this->language->get('text_start_date');
			$data['text_end_date'] = $this->language->get('text_end_date');
			$data['text_joining_fee'] = $this->language->get('text_joining_fee');
			$data['text_subscription_price'] = $this->language->get('text_subscription_price');
			$data['text_invoice_id'] = $this->language->get('text_invoice_id');
			$data['text_created_date'] = $this->language->get('text_created_date');
			$data['text_payment_mode'] = $this->language->get('text_payment_mode');
			$data['text_status'] = $this->language->get('text_status');
			$data['text_transaction_id'] = $this->language->get('text_transaction_id');
			$data['text_comment'] = $this->language->get('text_comment');
			$data['text_grand_total'] = $this->language->get('text_grand_total');
			$data['title']=$this->language->get('heading_title');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/subscription_invoice', $data));
		}
		
		public function add(){
			$this->load->language('extension/purpletree_multivendor/multivendor/subscriptionplanInvoice');
			$this->load->model('extension/purpletree_multivendor/multivendor/subscriptionplaninvoice');
			$this->document->setTitle('Offline Payment');
			if (!isset($this->request->get['invoice_id']) || $this->request->get['invoice_id'] == '') {
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/managesubscriptionplan', 'user_token=' . $this->session->data['user_token'], true));
			}
			$invoice_id = $this->request->get['invoice_id'];
			$currentStatus = $this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getinvoice($invoice_id);
			$data['currentstatus'] = '1';
			if($currentStatus) {
				$data['currentstatus'] = $currentStatus;
			}
			if ($this->request->server['REQUEST_METHOD'] == 'POST') {
				$this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->addOfflinePayment($this->request->post,$invoice_id);
				$this->session->data['success'] = "Payment History Added successully";
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/managesubscriptionplan', 'user_token=' . $this->session->data['user_token'], true));
			}
			$data['invoice_id'] = $this->request->get['invoice_id'];
			$data['statuslist'] = $this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->getstatuslist();
			$this->document->setTitle($this->language->get('heading_title'));
			
			$url = '';
			///Help code///	
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-subscription";
			$data['helplink'] = "https://cutt.ly/RCoVwdf";
			if (defined ('DISABLED_PTS_HELP')){if(DISABLED_PTS_HELP == 0){$data['helpcheck'] = 1;}else{$data['helpcheck'] = 0;}}else{$data['helpcheck'] = 1;}
			$data['helpimage'] = HTTP_CATALOG . '/extension/purpletree_multivendor/admin/view/image/help.png';
			/// End Help code///
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/managesubscriptionplan', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
				unset($this->session->data['error_warning']);
				} else {
				$data['error_warning'] = '';
			}
			if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];
				
				unset($this->session->data['success']);
				} else {
				$data['success'] = '';
			}
			$data['saveAndEnableSubscription']=$this->url->link('extension/purpletree_multivendor/multivendor/subscriptionplaninvoice|saveandenablesubscription', 'user_token=' . $this->session->data['user_token'].'&invoice_id='.$invoice_id, true);
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/offline_payment_form', $data));
		}
		public function saveAndEnableSubscription() {
			
			if (!isset($this->request->get['invoice_id']) || $this->request->get['invoice_id'] == '') {
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/managesubscriptionplan', 'user_token=' . $this->session->data['user_token'], true));
			}
			$this->load->language('extension/purpletree_multivendor/multivendor/subscriptionplanInvoice');
			$this->load->model('extension/purpletree_multivendor/multivendor/subscriptionplaninvoice');
			$invoice_id = $this->request->get['invoice_id'];
			if ($this->request->server['REQUEST_METHOD'] == 'POST') {
				$this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->addOfflinePayment($this->request->post,$invoice_id);
				
				$this->model_extension_purpletree_multivendor_multivendor_subscriptionplaninvoice->enableSubscription($invoice_id);
				$this->session->data['success'] = "Payment History Added successully";
				$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/managesubscriptionplan', 'user_token=' . $this->session->data['user_token'], true));
			}
		}
		
}
?>