<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Dashboard extends \Opencart\System\Engine\Controller {
	private $error = array();
	public $validateSeller = false;	
		public function index(){
			if (!$this->customer->isLogged()) {
				$this->session->data['redirect'] = $this->url->link('extension/purpletree_multivendor/multivendor/dashboard','language=' . $this->config->get('config_language'), true);
				$this->response->redirect($this->url->link('account/login', 'language=' . $this->config->get('config_language'), true));
			}
			$this->load->language('extension/purpletree_multivendor/multivendor/dashboard');
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
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
			$this->validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if(!$this->validateSeller) {
				$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
				$this->session->data['error_warning'] = $this->language->get('error_license');
				$this->response->redirect($this->url->link('account/account', 'language=' . $this->config->get('config_language'), true));
			}
			
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			$data['seller_orders'] = array();
			
			
			if (isset($this->session->data['error_warning'])) {
				$data['error_warning'] = $this->session->data['error_warning'];
				
				unset($this->session->data['error_warning']);
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
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/dashboard', $url.'&language=' . $this->config->get('config_language'), true)
			);
			$data['my_orders']=$this->url->link('extension/purpletree_multivendor/multivendor/sellerorder', $url.'&language=' . $this->config->get('config_language'), true);
			
			$data['my_commission']=$this->url->link('extension/purpletree_multivendor/multivendor/sellercommission', $url.'&language=' . $this->config->get('config_language'), true);
			
			$data['my_payments']=$this->url->link('extension/purpletree_multivendor/multivendor/sellerpayment', $url.'&language=' . $this->config->get('config_language'), true);
			$data['my_sales']=$this->url->link('extension/purpletree_multivendor/multivendor/sellerorder', $url.'&language=' . $this->config->get('config_language'), true);
			
			$filter_data = array(
			'limit'                => $this->config->get('config_pagination_admin'),
			'seller_id'            => $this->customer->getId()
			);
			$orderstatus = 0;
			if(null !== $this->config->get('module_purpletree_multivendor_commission_status')) {
				$orderstatus = $this->config->get('module_purpletree_multivendor_commission_status');
				} else {
				$data['error_warning'] = $this->language->get('module_purpletree_multivendor_commission_status_warning');
			}
			$filter_data1 = array(
			'seller_id'            => $this->customer->getId(),
			'order_status_id'            =>  $orderstatus
			);
			$seller_id = $this->customer->getId();
			
			$data['total_sale'] = 0;
			$data['total_pay'] = 0;
			$data['total_commission'] = 0;
			
			$total_commission = 0;
			
			$total_sale = 0;
			$orderstatus = 0;
			if(null !== $this->config->get('module_purpletree_multivendor_commission_status')) {
				$orderstatus = $this->config->get('module_purpletree_multivendor_commission_status');
				} else {
				$data['error_warning'] = $this->language->get('module_purpletree_multivendor_commission_status_warning');
			}
			$total_commission1 = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getTotalSellerOrderscommission($this->customer->getId(),$orderstatus);
			if(!empty($total_commission1)) {
				foreach($total_commission1 as $tot) {
					$total_commission+= $tot['commission'];
				}	
			}
			
			$sellerstore = $this->model_extension_purpletree_multivendor_multivendor_dashboard->isSeller($this->customer->getId());
			
			$data['order_total'] = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getTotalSellerOrders($filter_data);
			
			$results = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getSellerOrders($filter_data);
			$seller_commissions = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getCommissions($filter_data);
			$curency = $this->session->data['currency'];
			$currency_detail = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getCurrencySymbol($curency);
			
			$seller_payments = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getPayments($filter_data);
			$stotal_payments = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getTotalPayments($filter_data);
			//$data['total_payments'] = $this->currency->format($stotal_payments, $currency_detail['code'], $currency_detail['value']);
			$pending_payments = $this->model_extension_purpletree_multivendor_multivendor_dashboard->pendingPayments($filter_data1);
			$totalpaymentss = 0;
			$orderstatus = 0;
			if(null !== $this->config->get('module_purpletree_multivendor_commission_status')) {
				$orderstatus = $this->config->get('module_purpletree_multivendor_commission_status');
				} else {
				$data['error_warning'] = $this->language->get('module_purpletree_multivendor_commission_status_warning');
			}
			if(!empty($pending_payments)) {
				foreach($pending_payments as $paymentsss) {
					if($paymentsss['seller_order_status'] == $paymentsss['admin_order_status'] && $paymentsss['seller_order_status'] == $orderstatus && $paymentsss['admin_order_status'] == $orderstatus) {
						$totalpaymentss += $paymentsss['total_price'];
					}
				}
			}
			$data['total_sale'] =$this->currency->format((float)$this->model_extension_purpletree_multivendor_multivendor_dashboard->getTotalsale($filter_data), $currency_detail['code'], $currency_detail['value']);
			
			if($seller_payments){
				foreach($seller_payments as $seller_payment){
					$data['seller_payments'][] = array(
					'transaction_id' => $seller_payment['transaction_id'],
					'amount' => $this->currency->format($seller_payment['amount'], $currency_detail['code'], $currency_detail['value']),
					'payment_mode' => $seller_payment['payment_mode'],
					'status' => $seller_payment['status'],
					'created_at' => date($this->language->get('date_format_short'), strtotime($seller_payment['created_at']))
					);
				}
			}
			if($seller_commissions){
				foreach($seller_commissions as $seller_commission){
					$data['seller_commissions'][] = array(
					'order_id' => $seller_commission['order_id'],
					'product_name' => $seller_commission['name'],
					'price' => $this->currency->format($seller_commission['total_price'], $currency_detail['code'], $currency_detail['value']),
					'commission' => $this->currency->format($seller_commission['commission'], $currency_detail['code'], $currency_detail['value']),
					'created_at' => date($this->language->get('date_format_short'), strtotime($seller_commission['created_at']))
					);
				}
			}
			
			foreach ($results as $result) {
				
				$total ='';
				$product_totals  = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getSellerOrdersTotal($seller_id,$result['order_id']);
				
				if(isset($product_totals['total'])){
					$total = $product_totals['total'];
					} else {
					$total = 0;
				}
				
				$product_commission  = $this->model_extension_purpletree_multivendor_multivendor_dashboard->getSellerOrdersCommissionTotal($result['order_id'],$seller_id);
				
				$total_sale+= $total;
				
				//$total_commission+= $product_commission['total_commission'];
				
				$data['seller_orders'][] = array(
				'order_id'      => $result['order_id'],
				'customer'      => $result['customer'],
				'admin_order_status'      => $result['admin_order_status'],
				'order_status'  => $result['order_status'] ? $result['order_status'] : $this->language->get('text_missing'),
				'total'         => $this->currency->format($total, $result['currency_code'], $result['currency_value']),
				'commission'         => $this->currency->format((float)$product_commission['total_commission'], $result['currency_code'], $result['currency_value']),
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'view'          => $this->url->link('extension/purpletree_multivendor/multivendor/sellerorder|seller_order_info', 'order_id=' . $result['order_id']. $url.'&language=' . $this->config->get('config_language'), true)
				);
			}
			$penpayems = $totalpaymentss - $stotal_payments - $total_commission;
			$data['pending_payments'] = $this->currency->format($penpayems, $currency_detail['code'], $currency_detail['value']);
			
			
			
			$data['total_order_commission'] = $this->currency->format($total_commission, $currency_detail['code'], $currency_detail['value']);
			
			$this->document->setTitle($this->language->get('heading_title'));
			$data['text_pending_payments'] = $this->language->get('text_pending_payments');
			$data['heading_title'] = $this->language->get('heading_title');
			$data['text_no_results'] = $this->language->get('text_no_results');
			$data['text_order'] = $this->language->get('text_order');
			$data['text_payments'] = $this->language->get('text_payments');
			$data['text_total'] =$this->language->get('text_total');
			$data['text_total_commission'] = $this->language->get('text_total_commission');
			$data['text_view_more'] = $this->language->get('text_view_more');
			$data['text_latest_order'] = $this->language->get('text_latest_order');
			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_customer'] = $this->language->get('text_customer');
			$data['text_status'] = $this->language->get('text_status');
			$data['text_admin_status'] = $this->language->get('text_admin_status');
			$data['text_commission'] = $this->language->get('text_commission');
			$data['text_date_added'] = $this->language->get('text_date_added');
			$data['text_date_modified'] = $this->language->get('text_date_modified');
			$data['text_latest_setlements'] = $this->language->get('text_latest_setlements');
			$data['text_last_five_records'] = $this->language->get('text_last_five_records');
			$data['text_transaction_id'] = $this->language->get('text_transaction_id');
			$data['text_amount'] = $this->language->get('text_amount');
			$data['text_payment_mode'] = $this->language->get('text_payment_mode');
			$data['text_created_date'] = $this->language->get('text_created_date');
			$data['text_latest_commission'] = $this->language->get('text_latest_commission');
			$data['text_product_name'] = $this->language->get('text_product_name');
			$data['text_product_price'] = $this->language->get('text_product_price');
			$data['text_action'] = $this->language->get('text_action');
			$data['button_view'] = $this->language->get('button_view');
			$data['hide_customer_details']= $this->config->get('module_purpletree_multivendor_hide_customer_details');
			
			$this->load->model('extension/purpletree_multivendor/multivendor/ptsorder_status');
			
			$data['order_statuses'] = $this->model_extension_purpletree_multivendor_multivendor_ptsorder_status->getOrderStatuses();
			$data['column_left'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/column_left');
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/dashboard', $data));
		}
}?>