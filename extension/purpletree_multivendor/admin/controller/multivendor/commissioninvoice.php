<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Commissioninvoice extends \Opencart\System\Engine\Controller {
		private $error = array();
		public function index(){
			$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if (!$validateSeller) {
				$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
				$this->session->data['error_warning'] = $this->language->get('error_license');	
			}
			$this->load->language('extension/purpletree_multivendor/multivendor/commissioninvoice');
			$this->document->addStyle('../extension/purpletree_multivendor/admin/view/javascript/purpletreecss/commonstylesheet.css');
			$this->load->model('extension/purpletree_multivendor/multivendor/commissioninvoice');
			
			if (isset($this->request->get['filter_date_from'])) {
				$filter_date_from = $this->request->get['filter_date_from'];
				} else {
				$end_date = date('Y-m-d', strtotime("-30 days"));
				$filter_date_from = $end_date;
			}
			
			if (isset($this->request->get['filter_date_to'])) {
				$filter_date_to = $this->request->get['filter_date_to'];
				} else {
				$end_date = date('Y-m-d');
				$filter_date_to = $end_date;
			}
			
			if (isset($this->request->get['seller_id'])) {
				$seller_id = $this->request->get['seller_id'];
				} else {
			$seller_id = 0;
			}
			$data['seller_id'] = $seller_id;
			
			if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
			} else {
			$page = 1;
			}
			$url = '';
			
			if (isset($this->request->get['filter_date_from'])) {
			$url .= '&filter_date_from=' . $this->request->get['filter_date_from'];
			}
			
			if (isset($this->request->get['filter_date_to'])) {
			$url .= '&filter_date_to=' . $this->request->get['filter_date_to'];
			}
			
			if (isset($this->request->get['seller_id'])) {
			$url .= '&seller_id=' . $this->request->get['seller_id'];
			}
			
			///Help code///
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-commission";
			$data['helplink'] = "https://cutt.ly/tCo2Iuf";
			if (defined ('DISABLED_PTS_HELP')){if(DISABLED_PTS_HELP == 0){$data['helpcheck'] = 1;}else{$data['helpcheck'] = 0;}}else{$data['helpcheck'] = 1;}
			$data['helpimage'] = HTTP_CATALOG . '/extension/purpletree_multivendor/admin/view/image/help.png';
			/// End Help code///ata['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			$this->document->setTitle($this->language->get('heading_title'));
			
			$data['heading_title'] = $this->language->get('heading_title');
			$data['text_action'] = $this->language->get('text_action');
			$data['text_list'] = $this->language->get('text_list');
			$data['text_pending_amt'] = $this->language->get('text_pending_amt');
			$data['text_invoice_id'] = $this->language->get('text_invoice_id');
			$data['text_created_at'] = $this->language->get('text_created_at');
			$data['text_commission'] = $this->language->get('text_commission');
			$data['text_no_results'] = $this->language->get('text_empty');
			$data['button_view'] = $this->language->get('button_view');
			$data['button_filter'] = $this->language->get('button_filter');
			$data['entry_date_from'] = $this->language->get('entry_date_from');
			$data['entry_date_to'] = $this->language->get('entry_date_to');
			$data['entry_store'] = $this->language->get('entry_store');
			$data['entry_select_store'] = $this->language->get('entry_select_store');
			$data['column_store'] = $this->language->get('column_store'); 
			$data['button_filter'] = $this->language->get('button_filter');
			
			$url = '';
			
			if (isset($this->request->get['seller_id'])) {
			$url .= '&seller_id=' . $this->request->get['seller_id'];
			}
			
			
			$data['seller_commissions'] = array();
			$filter_data = array(
		    'seller_id'				=> $seller_id,
			'filter_date_from'    => $filter_date_from,
			'filter_date_to'	 => $filter_date_to,
			'start'                => ($page - 1) * $this->config->get('config_pagination_admin'),
			'limit'                => $this->config->get('config_pagination_admin')
			);
			
			$seller_commissions = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissions($filter_data);
			$total_commissions = 0;
			$data['seller_commissions'] = array();
			if(!empty($seller_commissions)) {
			foreach($seller_commissions as $invocee) {
			$data['seller_commissions'][] = array(
			'id' 			=> $invocee['id'],
			'created_at' 	=> $invocee['created_at'],
			'store_name' 	=> $invocee['store_name'],
			'view' 			=> $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|commissionInvoice', 'user_token=' . $this->session->data['user_token'].'&commision_view_id='.$invocee['id'], true)
			);
			}
			$total_commissions = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getTotalCommissionsinvoices($filter_data);
			}
			$data['user_token'] = $this->session->data['user_token'];
			
			if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
			}elseif (isset($this->session->data['error_warning'])) {
			$data['error_warning'] = $this->session->data['error_warning'];
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
			
			$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $total_commissions,
			'page'  => $page,
			'limit' => $this->config->get('config_pagination_admin'),
			'url'   => $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true)
		]);
			$data['results'] = sprintf($this->language->get('text_pagination'), ($total_commissions) ? (($page - 1) * $this->config->get('config_pagination_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_pagination_admin')) > ($total_commissions - $this->config->get('config_pagination_admin'))) ? $total_commissions : ((($page - 1) * $this->config->get('config_pagination_admin')) + $this->config->get('config_pagination_admin')), $total_commissions, ceil($total_commissions / $this->config->get('config_pagination_admin')));
			
			$data['seller_stores'] = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getSellerstore();
			
			$data['filter_date_from'] = $filter_date_from;
			$data['filter_date_to'] = $filter_date_to;
			$data['ver']=VERSION;
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/commissioninvoice_list', $data));
			}
			
			public function paymentOfflineSave(){
				$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if (!$validateSeller) {
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
			$this->session->data['error_warning'] = $this->language->get('error_license');
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			
			$this->load->language('extension/purpletree_multivendor/multivendor/commissioninvoice');
			
			$this->load->model('extension/purpletree_multivendor/multivendor/commissioninvoice');
			if ( ($this->request->server['REQUEST_METHOD'] == 'POST')  && $this->validateForm() ) {
			
			$this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->addCommissionHistory($this->request->post);
			$seller_id='';
			if(isset($this->request->post['seller_id'])){
			$seller_id=$this->request->post['seller_id'];
			}
			$this->session->data['success'] = $this->language->get('payment_successfully_captured');	
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|payoffline', 'user_token=' . $this->session->data['user_token'].'&commision_view_id='.$this->request->post['invoice_id'].'&seller_id='.$seller_id, true));
			}else{
			$this->session->data['error'] = $this->error;
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|payofflinesave', 'user_token=' . $this->session->data['user_token'].'&commision_view_id='.$this->request->post['invoice_id'].'&seller_id='.$this->request->post['seller_id'], true));
			}
			
			}		
			public function paymentOfflineEdit(){
				$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if (!$validateSeller) {
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
			$this->session->data['error_warning'] = $this->language->get('error_license');
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			
			$this->load->language('extension/purpletree_multivendor/multivendor/commissioninvoice');
			
			$this->load->model('extension/purpletree_multivendor/multivendor/commissioninvoice');
			
			if ( ($this->request->server['REQUEST_METHOD'] == 'POST')  && $this->validateForm() ) {
			
			$this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->editCommissionHistory($this->request->post);	
			$seller_id='';
			if($this->request->post['seller_id']){
			$seller_id=$this->request->post['seller_id'];
			}
			$this->session->data['success'] = $this->language->get('payment_successfully_captured');
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|payoffline', 'user_token=' . $this->session->data['user_token'].'&commision_view_id='.$this->request->post['invoice_id'].'&seller_id='.$seller_id , true));
			}else{
			$this->session->data['error'] = $this->error;
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|payofflineedit', 'user_token=' . $this->session->data['user_token'].'&id='.$this->request->post['id'].'&seller_id='.$this->request->post['seller_id'], true));
			}
			}
			public function payofflineedit(){
			$this->document->addStyle('../extension/purpletree_multivendor/admin/view/javascript/purpletreecss/commonstylesheet.css');
			$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if (!$validateSeller) {
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
			$this->session->data['error_warning'] = $this->language->get('error_license');
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			
			$this->load->language('sale/order');
			$this->load->language('extension/purpletree_multivendor/multivendor/commissioninvoice');
			//$data['title'] = $this->language->get('text_commision_invoice');
			$data['title'] = "Commission Invoice";
			$this->load->model('sale/order');
			$this->load->model('extension/purpletree_multivendor/multivendor/commissioninvoice');
			$this->load->model('catalog/product');
			$this->load->model('extension/purpletree_multivendor/multivendor/sellercommission');
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerpayment');
			
			$this->load->model('setting/setting');
			
			$url='';
			///Help code///	
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-commission";
			$data['helplink'] = "https://cutt.ly/tCo2Iuf";
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
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
			} else {
			$data['success'] = '';
			}
			if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
			} elseif(isset($this->session->data['error']['warning'])){
			$data['warning'] = $this->session->data['error']['warning'];
			unset($this->session->data['error']['warning']);
			}else {
			$data['error_warning'] = '';
			}
			
			if (isset($this->error['txn_id'])) {
			$data['error_txn_id'] = $this->error['txn_id'];
			} elseif(isset($this->session->data['error']['txn_id'])){
			$data['error_txn_id'] = $this->session->data['error']['txn_id'];
			unset($this->session->data['error']['txn_id']);
			} else {
			$data['error_txn_id'] = '';
			}
			if (isset($this->request->get['id']) && isset($this->request->get['seller_id'])) {
			
			
			$id=$this->request->get['id'];
			$invoice_id =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getInvoiceId($id);
			$data['invoice_number']=$invoice_id;
			$commission_paymentss=array();
			//$commission_paymentss =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionPaymentDetail($invoice_id);
			$commission_paymentss =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionPaymentHistoryDetail($id);
			
			$status=array();
			$data['status'] =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionInvoiceStatus();
			
			$data['id']='';
			if(isset($commission_paymentss['id'])){
			if($commission_paymentss['id']){
			$data['id']=$commission_paymentss['id'];
			}
			}
			
			$data['transaction_id']='';
			if(isset($commission_paymentss['transaction_id'])){
			if($commission_paymentss['transaction_id']){
			$data['transaction_id']=$commission_paymentss['transaction_id'];
			}
			}
			
			$data['comment']='';
			if(isset($commission_paymentss['comment'])){
			if($commission_paymentss['comment']){
			$data['comment']=$commission_paymentss['comment'];
			}
			}
			
			
			$data['status_id']='';
			if(isset($commission_paymentss['status_id'])){
			if($commission_paymentss['status_id']){
			$data['status_id']=$this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionStatus($commission_paymentss['status_id']);
			}
			}
			
			$commission_history=array();
			$commission_history =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionHistory($invoice_id);
			if(!empty($commission_history )){
			foreach($commission_history as $key=>$result){
			$data['commission_history'][]=array(
			'id'=>$result['id'],
			'transaction_id'=>$result['transaction_id'],
			'payment_mode'=>$result['payment_mode'],
			'created_date'=>$result['created_date'],
			'comment'=>$result['comment'],
			'status_id'=>$this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionStatus($result['status_id'])
			);	
			}
			}
			
			$invoiceData=array();
			$curency = $this->config->get('config_currency');
			$currency_detail = $this->model_extension_purpletree_multivendor_multivendor_sellerpayment->getCurrencySymbol($curency);
			$invoiceData =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getGenerateInvoiceData($invoice_id);
			$seller_coupon_amount=0;
			if(!empty($invoiceData['seller_coupon_amount'])){
				$seller_coupon_amount = $invoiceData['seller_coupon_amount'];
			}
			$totalPayAmount=$invoiceData['total_pay_amount']+$seller_coupon_amount;
			
			$data['total_amount']=$this->currency->format($invoiceData['total_amount'], $currency_detail['code'], $currency_detail['value']);
			$data['total_commission']=$this->currency->format($invoiceData['total_commission'], $currency_detail['code'], $currency_detail['value']);
			$data['total_pay']=$this->currency->format($totalPayAmount, $currency_detail['code'], $currency_detail['value']);
			$data['total_pay_amount']=sprintf('%0.2f', $totalPayAmount);
			
			if(isset($this->request->get['seller_id'])){
			$data['seller_id']=$this->request->get['seller_id'];	
			}
			
			$data['paymentoffline']=$this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|paymentOfflineEdit', 'user_token=' . $this->session->data['user_token'], true);
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/commission_pay_offline', $data));
			} else {
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'], true));
			}
			
			}
			public function payOfflineSave(){
			$this->document->addStyle('../extension/purpletree_multivendor/admin/view/javascript/purpletreecss/commonstylesheet.css');
			$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if (!$validateSeller) {
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
			$this->session->data['error_warning'] = $this->language->get('error_license');
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			$this->load->language('sale/order');
			$this->load->language('extension/purpletree_multivendor/multivendor/commissioninvoice');
			//$data['title'] = $this->language->get('text_commision_invoice');
			$data['title'] = "Commission Invoice";
			$this->load->model('sale/order');
			$this->load->model('extension/purpletree_multivendor/multivendor/commissioninvoice');
			$this->load->model('catalog/product');
			$this->load->model('extension/purpletree_multivendor/multivendor/sellercommission');
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerpayment');
			
			$this->load->model('setting/setting');
			
			$url='';
			///Help code///	
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-commission";
			$data['helplink'] = "https://cutt.ly/tCo2Iuf";
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
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			$this->document->setTitle($this->language->get('heading_title'));
			if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
			} else {
			$data['success'] = '';
			}
			if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
			} elseif(isset($this->session->data['error']['warning'])){
			$data['warning'] = $this->session->data['error']['warning'];
			unset($this->session->data['error']['warning']);
			}else {
			$data['error_warning'] = '';
			}
			
			if (isset($this->error['txn_id'])) {
			$data['error_txn_id'] = $this->error['txn_id'];
			} elseif(isset($this->session->data['error']['txn_id'])){
			$data['error_txn_id'] = $this->session->data['error']['txn_id'];
			unset($this->session->data['error']['txn_id']);
			} else {
			$data['error_txn_id'] = '';
			}
			if (isset($this->request->get['commision_view_id'])) {
			
			
			$invoice_id=$this->request->get['commision_view_id'];
			//$invoice_id =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getInvoiceId($id);
			$data['invoice_number']=$invoice_id;
			$commission_paymentss=array();
			
			
			
			$status=array();
			$data['status'] =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionInvoiceStatus();
			
			$data['id']='';
			$data['transaction_id']='';
			$data['comment']='';
			$data['status_id']='';
			$commission_history=array();
			$commission_history =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionHistory($invoice_id);
			if(!empty($commission_history )){
			foreach($commission_history as $key=>$result){
			$data['commission_history'][]=array(
			'id'=>$result['id'],
			'transaction_id'=>$result['transaction_id'],
			'payment_mode'=>$result['payment_mode'],
			'created_date'=>$result['created_date'],
			'comment'=>$result['comment'],
			'status_id'=>$this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionStatus($result['status_id'])
			);	
			}
			}
			
			$invoiceData=array();
			$curency = $this->config->get('config_currency');
			$currency_detail = $this->model_extension_purpletree_multivendor_multivendor_sellerpayment->getCurrencySymbol($curency);
			$invoiceData =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getGenerateInvoiceData($invoice_id);
			
			$seller_coupon_amount=0;
			if(!empty($invoiceData['seller_coupon_amount'])){
				$seller_coupon_amount = $invoiceData['seller_coupon_amount'];
			}
			$totalPayAmount=$invoiceData['total_pay_amount']+$seller_coupon_amount;
			
			
			
			$data['total_amount']=$this->currency->format($invoiceData['total_amount'], $currency_detail['code'], $currency_detail['value']);
			$data['total_commission']=$this->currency->format($invoiceData['total_commission'], $currency_detail['code'], $currency_detail['value']);
			$data['total_pay']=$this->currency->format($totalPayAmount, $currency_detail['code'], $currency_detail['value']);
			$data['total_pay_amount']=sprintf('%0.2f', $totalPayAmount);
			$data['seller_id']=$this->request->get['seller_id'];
			$data['paymentoffline']=$this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|paymentOfflineSave', 'user_token=' . $this->session->data['user_token'], true);
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/commission_pay_offline', $data));
			}else {
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'], true));
			}
			
			}
			
			public function payOffline(){
				$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if (!$validateSeller) {
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
			$this->session->data['error_warning'] = $this->language->get('error_license');
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			$this->load->language('sale/order');
			$this->load->language('extension/purpletree_multivendor/multivendor/commissioninvoice');
			//$data['title'] = $this->language->get('text_commision_invoice');
			$data['title'] = "Commission Invoice";
			$this->load->model('sale/order');
			$this->load->model('extension/purpletree_multivendor/multivendor/commissioninvoice');
			$this->load->model('catalog/product');
			$this->load->model('extension/purpletree_multivendor/multivendor/sellercommission');
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerpayment');
			
			$this->load->model('setting/setting');
			
			$url='';
			///Help code///
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-commission";
			$data['helplink'] = "https://cutt.ly/tCo2Iuf";
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
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			$this->document->setTitle($this->language->get('heading_title'));
			if (isset($this->request->get['paymentfrom'])) {
			if($this->request->get['paymentfrom']=='paypal'){
			$data['success'] = $this->language->get('payment_return_url');
			unset($this->session->data['success']);
			}else {
			$data['success'] = '';	
			}
			} else {
			$data['success'] = '';
			}
			if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
			} else {
			$data['error_warning'] = '';
			}
			
			if (isset($this->error['txn_id'])) {
			$data['error_txn_id'] = $this->error['txn_id'];
			} else {
			$data['error_txn_id'] = '';
			}
			if (isset($this->request->get['commision_view_id'])) {
			
			
			$invoice_id=$this->request->get['commision_view_id'];
			$data['invoice_number']=$invoice_id;
			$commission_paymentss=array();
			$commission_paymentss =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionPaymentDetail($invoice_id);
			$status=array();
			$data['status'] =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionInvoiceStatus();
			
			$data['transaction_id']='';
			if(isset($commission_paymentss['transaction_id'])){
			if($commission_paymentss['transaction_id']){
			$data['transaction_id']=$commission_paymentss['transaction_id'];
			}
			}
			
			$data['status_id']='';
			if(isset($commission_paymentss['status'])){
			if($commission_paymentss['status']){
			$data['status_id']=$commission_paymentss['status'];
			}
			}
			$commission_history=array();
			$commission_history =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionHistory($invoice_id);
			$seller_id='';
			if(isset($this->request->get['seller_id'])){
			$seller_id=$this->request->get['seller_id'];
			}
			if(!empty($commission_history )){
			foreach($commission_history as $key=>$result){
			$link_show=false;
			if($result['payment_mode']=='Offline'){
			$link_show=true;
			}
			
			$data['commission_history'][]=array(
			'id'=>$result['id'],
			'transaction_id'=>$result['transaction_id'],
			'payment_mode'=>$result['payment_mode'],
			'created_date'=>$result['created_date'],
			'comment'=>$result['comment'],
			'status_id'=>$this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionStatus($result['status_id']),
			'link'=>$this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|payofflineedit', 'user_token=' . $this->session->data['user_token'].'&id='.$result['id'].'&seller_id='.$seller_id, true),
			'link_show'=>$link_show
			);	
			}
			}
			
			$invoiceData=array();
			$curency = $this->config->get('config_currency');
			$currency_detail = $this->model_extension_purpletree_multivendor_multivendor_sellerpayment->getCurrencySymbol($curency);
			$invoiceData =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getGenerateInvoiceData($invoice_id);

				$seller_coupon_amount=0;
			if(!empty($invoiceData['seller_coupon_amount'])){
				$seller_coupon_amount = $invoiceData['seller_coupon_amount'];
			}
			$totalPayAmount=$invoiceData['total_pay_amount']+$seller_coupon_amount;
			$data['total_amount']=$this->currency->format($invoiceData['total_amount'], $currency_detail['code'], $currency_detail['value']);
			$data['total_commission']=$this->currency->format($invoiceData['total_commission'], $currency_detail['code'], $currency_detail['value']);
			$data['total_pay']=$this->currency->format($totalPayAmount, $currency_detail['code'], $currency_detail['value']);
			$data['total_pay_amount']=sprintf('%0.2f', $totalPayAmount);
			
			
			$data['paymentoffline']=$this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|paymentOfflineSave', 'user_token=' . $this->session->data['user_token'], true);
			if(isset($this->request->get['commision_view_id'])){
			$data['save']=$this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|payofflinesave', 'user_token=' . $this->session->data['user_token'].'&commision_view_id='.$this->request->get['commision_view_id'].'&seller_id='.$seller_id, true);
			}
			
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/commission_pay_offline_list', $data));
			}else {
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'], true));
			}
			
			}
			
			
			public function commissionInvoice(){
			$this->document->addStyle('../extension/purpletree_multivendor/admin/view/javascript/purpletreecss/commonstylesheet.css');
			$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');	
			if (!$validateSeller) {
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
			$this->session->data['error_warning'] = $this->language->get('error_license');
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			$this->load->language('sale/order');
			$this->load->language('extension/purpletree_multivendor/multivendor/commissioninvoice');
			//$data['title'] = $this->language->get('text_commision_invoice');
			$data['title'] = "Commission Invoice";
			$this->load->model('sale/order');
			$this->load->model('extension/purpletree_multivendor/multivendor/commissioninvoice');
			$this->load->model('catalog/product');
			$this->load->model('extension/purpletree_multivendor/multivendor/sellercommission');
			
			$this->load->model('setting/setting');
			$store_address = "";
			$store_email = "";
			$store_telephone = "";
			$url='';
			///Help code///
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-commission";
				$data['helplink'] = "https://cutt.ly/tCo2Iuf";
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
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true)
			);
			$this->document->setTitle($this->language->get('heading_title'));
			if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
			} else {
			$data['error_warning'] = '';
			}
			
			$data['orders'] = array();
			
			$orders = array();
			$commisionss = array();
			//$data['text_seller_details'] = 'Seller</br> tel:0101010101010 </br> email:demosd@sdsd.com';
			$data['created_date'] = '';
			if (isset($this->request->get['commision_view_id'])) {
			$commisions_invoice_id = $this->request->get['commision_view_id'];
			$seller_vatname = $this->language->get('seller_vatname');
			$vat_field_id =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCustomFieldIdFromName($seller_vatname);
			$commisionss =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getiinvoiceitems($commisions_invoice_id);

			$data['invoice_number'] = $this->request->get['commision_view_id'];
			$commioncreated_date = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getinvoicedate($commisions_invoice_id);
			
			//////////////////////
			$commissions_invoice = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionsInvoice($commisions_invoice_id);
			
			//////////////////////
			
			if(!empty($commioncreated_date)) {
			$data['created_date'] = $commioncreated_date['created_at'];
			}
			else {
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'], true));
			}
			} else {
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'], true));
			}
			$total_product_price =0;
			$total_commission = 0;
			$total_ccommission_percent = 0;
			$total_fixed_commission = 0;
			$total_shipping_commission = 0;
			$total_percent_commission = 0;
			$total_quantity = 0;
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerpayment');
			$curency = $this->config->get('config_currency');
			$data['taxname'] = '';
			if(null !== $this->config->get('module_purpletree_multivendor_tax_name')) {
			$data['taxname'] = $this->config->get('module_purpletree_multivendor_tax_name');
			}
			$data['taxvalue'] = '';
			if(null !== $this->config->get('module_purpletree_multivendor_tax_value')) {
			$data['taxvalue'] = $this->config->get('module_purpletree_multivendor_tax_value');
			}
			$currency_detail = $this->model_extension_purpletree_multivendor_multivendor_sellerpayment->getCurrencySymbol($curency);
			if(!empty($commisionss)) {
			$data['seller_vatnumber'] = '';
			$data['seller_vatname'] = $seller_vatname;
			foreach ($commisionss as $commisionid) {
			$data['sellerdetails'] = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getStoreDetail($commisionid['seller_id']);
			$data['seller_country'] = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCountryName($data['sellerdetails']['store_country']);
			$this->load->model('extension/purpletree_multivendor/multivendor/stores');
			$data['sellerdetails']['store_email'] = $this->model_extension_purpletree_multivendor_multivendor_stores->getCustomerEmailId($commisionid['seller_id']);
			if($vat_field_id) {
			$vatnumberserialzed =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getvatfromid($commisionid['seller_id']);
			if($vatnumberserialzed) {
			$customfields = json_decode($vatnumberserialzed);
			if(!empty($customfields)) {
			foreach($customfields as $key => $customfield) {
			if($key == $vat_field_id) {
			$data['seller_vatnumber'] =  $customfield;
			}
			}
			}
			}			
			}
			$order_id = $commisionid['order_id'];
			$order_info = $this->model_sale_order->getOrder($order_id);
			// Make sure there is a shipping method
			if ($order_info) {
			$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);
			if ($store_info) {
			$store_address = $store_info['config_address'];
			$store_email = $store_info['config_email'];
			$store_telephone = $store_info['config_telephone'];
			} else {
			$store_address = $this->config->get('config_address');
			$store_email = $this->config->get('config_email');
			$store_telephone = $this->config->get('config_telephone');
			}
			$ccommission_percent =0;
			$this->load->model('tool/upload');
			$product_data = array();
			$product_info = $this->model_catalog_product->getProduct($commisionid['product_id']);
			$product_data['product_price'] = 0;
			$product['quantity'] = 0;
			if ($product_info) {
			$option_data = array();
			if($commisionid['commission_id'] !=0){
			  $product = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getOrderProducts($commisionid['commission_id'],$commisionid['order_id'],$commisionid['product_id'],$commisionid['seller_id']);
			if($product) {
			  $product['total'] = $product['total_price'];
			  $product['price'] = $product['unit_price'];
			  $options = $this->model_sale_order->getOptions($order_id, $product['order_product_id']);
			  
					foreach ($options as $option) {
					if ($option['type'] != 'file') {
					$value = $option['value'];
					} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);
					
					if ($upload_info) {
					$value = $upload_info['name'];
					} else {
					$value = '';
					}
					}
					
					$option_data[] = array(
					'name'  => $option['name'],
					'value' => $value
					);
					}
			}
			}else{ 
					$products = $this->model_sale_order->getProducts($order_id);
					  foreach ($products as $product) {
					if($product['product_id'] == $commisionid['product_id']) {
					$product = $product;
					$options = $this->model_sale_order->getOptions($order_id, $product['order_product_id']);
					foreach ($options as $option) {
					if ($option['type'] != 'file') {
					$value = $option['value'];
					} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);
					
					if ($upload_info) {
					$value = $upload_info['name'];
					} else {
					$value = '';
					}
					}
					
					$option_data[] = array(
					'name'  => $option['name'],
					'value' => $value
					);
					}
					break;
					}
					}
				}
			
			
			  /* echo "<pre>";
			  print_r($product); die; */
			$product_data = array(
			'name'     => $product_info['name'],
			'option'   => $option_data,
			'quantity' => $product['quantity'],
			'price_total' =>  $this->currency->format($product['total'], $currency_detail['code'], $currency_detail['value']),
			//'price_total'    		   => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $currency_detail['code'], $currency_detail['value']),
			'product_price' =>  $product['price']
			
			);
			$ccommission_percent = ($commisionid['commission_percent']/100)*$product['total'];
			}
			
			$total_seller_commission=$ccommission_percent+$commisionid['commission_fixed'];
			$data['orders'][] = array(
			'order_id'	       => $order_id,
			//'invoice_no'       => $invoice_no,
			'date_added'       => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
			'store_name'       => $order_info['store_name'],
			'store_url'        => rtrim($order_info['store_url'], '/'),
			'store_address'    => nl2br($store_address),
			'store_email'      => $store_email,
			'store_telephone'  => $store_telephone,
			'email'            => $order_info['email'],
			'telephone'        => $order_info['telephone'],
			'product'          => $product_data,
			'commission_percent'  =>$this->currency->format($ccommission_percent,$currency_detail['code'], $currency_detail['value']),
			'commission_fixed'    => $this->currency->format($commisionid['commission_fixed'], $currency_detail['code'], $currency_detail['value']),
			'commission_shipping' => $this->currency->format($commisionid['commission_shipping'], $currency_detail['code'], $currency_detail['value']),
			'total_commission'    => $this->currency->format($total_seller_commission, $currency_detail['code'], $currency_detail['value']),
			'comment'          	  => nl2br($order_info['comment'])
			);
			$total_product_price+=$product_data['product_price'];
			$total_ccommission_percent += $ccommission_percent;
			$total_commission += $commisionid['total_commission'];
			$total_fixed_commission += $commisionid['commission_fixed'];
			$total_shipping_commission += $commisionid['commission_shipping'];
			$total_percent_commission += $commisionid['commission_percent'];
			$total_quantity += $product['quantity'];
			}
			}
			} else {
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'], true));
			}

			/////////////////////////////////////////////////
			
			$invoice_status = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getInvoiceStatus($commisions_invoice_id);
			if($invoice_status) {
			$data['invoice_status'] = $invoice_status;
			} else {
			$invoice_status = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getDefaultstatus();
			$data['invoice_status'] = $invoice_status;
			}
			
			if(!empty($commissions_invoice)) {
			foreach($commissions_invoice as $commissions_invoicess) {
			$seller_coupon_amt=0;
			if(!empty($commissions_invoicess['seller_coupon_amount'])){
			$seller_coupon_amt=$commissions_invoicess['seller_coupon_amount'];
			}
			
			$total_pay_amount=$commissions_invoicess['total_pay_amount']+$seller_coupon_amt;
			$commissions_invoicesss = array(
			'id' 			=> $commissions_invoicess['id'],
			'total_commission' 	=> $this->currency->format($commissions_invoicess['total_commission'], $currency_detail['code'], $currency_detail['value']),
			
			'total_pay_amount' 	=> $this->currency->format($total_pay_amount, $currency_detail['code'], $currency_detail['value']),				
			'seller_coupon_amount_c_f' 	=> $this->currency->format($commissions_invoicess['seller_coupon_amount'], $currency_detail['code'], $currency_detail['value']),				
			'seller_coupon_amount' 	=> $commissions_invoicess['seller_coupon_amount'],				
			'total_pay_amt' 	=> $total_pay_amount,
			'created_at' 	=>date('d/m/Y', strtotime($commissions_invoicess['created_at'])),
			
			);
			}
			}
			
			$data['created_at'] = $commissions_invoicesss['created_at'];     
			$data['total_commissionn'] = $commissions_invoicesss['total_commission'];
			$data['total_pay_amountt'] = $commissions_invoicesss['total_pay_amount'];
			$data['total_pay_amt'] = $commissions_invoicesss['total_pay_amt'];
			$data['seller_coupon_amount'] = $commissions_invoicesss['seller_coupon_amount'];
			$data['seller_coupon_amount_c_f'] = $commissions_invoicesss['seller_coupon_amount_c_f'];
			
			/////////////////////////////////////////////////////
			$invoice_status_id = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getInvoiceStatusID($commisions_invoice_id);
			
			$data['invoice_status_id'] = $invoice_status_id;
			
			$data['module_purpletree_multivendor_footer_text'] = $this->config->get('module_purpletree_multivendor_footer_text');		
			
			$data['total_fixed_commission']       = $this->currency->format($total_fixed_commission, $currency_detail['code'], $currency_detail['value']);
			$data['total_shipping_commission']       = $this->currency->format($total_shipping_commission, $currency_detail['code'], $currency_detail['value']);
			$data['total_percent_commission']       = $total_percent_commission;
			$data['total_ccommission_percent']       = $this->currency->format($total_ccommission_percent, $currency_detail['code'], $currency_detail['value']);
			$data['total_commission']       = $this->currency->format($total_commission, $currency_detail['code'], $currency_detail['value']);
			
			$data['total_product_pricee']       = $this->currency->format($total_product_price, $currency_detail['code'], $currency_detail['value']);
			$data['total_product_price']       = $total_product_price;
			$data['total_quantity']       = $total_quantity;
			$data['store_name']       = $order_info['store_name'];
			$data['store_url']        = rtrim($order_info['store_url'], '/');
			$data['store_address']    = nl2br($store_address);
			$data['store_email']      = $store_email;
			$data['store_telephone']  = $store_telephone;
			$data['text1'] = $this->language->get('text1');
			$data['column_product_price'] = $this->language->get('column_product_price');
			$data['text2'] = $this->language->get('text2');
			$data['total_text'] = $this->language->get('total_text');
			$data['text3'] = $this->language->get('text3');
			$data['invoice_number_text'] = $this->language->get('invoice_number_text');
			$data['commision_product'] = $this->language->get('commision_product');
			$data['fixed_text'] = $this->language->get('fixed_text');
			$data['column_commission_percent'] = $this->language->get('column_commission_percent');
			$data['fixed_text'] = $this->language->get('fixed_text');
			$data['shipping_text'] = $this->language->get('shipping_text');
			$data['order_id_text'] = $this->language->get('order_id_text');
			$data['text_created_at'] = $this->language->get('text_created_at');
			$data['vat_number'] = $this->language->get('vat_number');
			/* ------------------------Start Code Paypal ---------------------------------------- */
			$country='';
			if($this->config->get('config_country_id')){
			$country = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCountry($this->config->get('config_country_id'));
			}
			
			$zone='';
			if($this->config->get('config_zone_id')){
			$zone = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getZone($this->config->get('config_zone_id'),$this->config->get('config_country_id'));
			}
			
			$currency='';
			if($this->config->get('config_currency')){
			$currency=$this->config->get('config_currency');
			}
			
			$hosted_button_id='';
			if($data['sellerdetails']['seller_paypal_id']){
			$hosted_button_id=$data['sellerdetails']['seller_paypal_id'];	
			}
			
			$invoice_number='';
			$item_name='';
			if($data['invoice_number']){
			$invoice_number=$data['invoice_number'];
			$item_name='Seller Payment for invoice # '.$data['invoice_number'];
			}
			$store_email='';
			if($data['sellerdetails']['store_email']){
			$store_email=$data['sellerdetails']['store_email'];
			}
			
			$amount=0;
			if($data['total_pay_amt']){
			$amount=$data['total_pay_amt'];
			}
			$buttonShow=true;
			if($amount <=0) {
			$buttonShow=false;			
			}
			
			$first_name='';
			if($this->config->get('config_owner')){
			$first_name=$this->config->get('config_owner');
			}
			
			$address='';
			if($this->config->get('config_address')){
			$address=$this->config->get('config_address');
			}
			$mobile_no='';
			if($this->config->get('config_telephone')){
			$mobile_no=$this->config->get('config_telephone');	
			}
			////start client code
			$this->load->language('extension/purpletree_multivendor/payment/pp_adaptive');
			$data['paypal']['text_testmode'] = $this->language->get('text_testmode');
			$data['paypal']['testmode'] = $this->config->get('payment_pp_adaptive_test');

			if (!$this->config->get('payment_pp_adaptive_test')) {
			    $data['paypal']['action'] = 'https://www.paypal.com/cgi-bin/webscr';
			} else {
			    $data['paypal']['action'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
			}
			////end client code
			$data['paypal']['return_url'] = $this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|payoffline', 'user_token=' . $this->session->data['user_token'].'&commision_view_id='.$invoice_number.'&paymentfrom=paypal', true);
			//$root=str_replace("/admin","",HTTP_SERVER);
			$x= HTTP_SERVER;
            $y= HTTP_CATALOG;			
			$admin_folder_name= str_replace(substr($x, 0, strlen($y)), '', $x);

			  $root=str_replace($admin_folder_name,"",HTTP_SERVER);
			$data['paypal']['notify_url'] =$root. 'index.php?route=extension/account/purpletree_multivendor/commissioninvoicenotify';
			//$this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|notify','user_token=' . $this->session->data['user_token'], true);
			
			$data['paypal']['curency'] = $currency;
			$data['paypal']['admin_email'] = (NULL != $this->config->get('config_email') && $this->config->get('config_email') != '')?$this->config->get('config_email'):'';
			$data['paypal']['hosted_button_id']=$hosted_button_id;
			$data['paypal']['item_name']=$item_name;
			$data['paypal']['store_email']=$store_email;
			$data['paypal']['amount']=$amount;
			$data['paypal']['first_name']=$first_name;
			$data['paypal']['last_name']='';
			$data['paypal']['address']=$address;
			$data['paypal']['invoice_id']=$invoice_number;
			$data['paypal']['city']='';
			$data['paypal']['state']=$zone;
			$data['paypal']['zip']='';
			$data['paypal']['country']=$country;
			$data['paypal']['mobile']=$mobile_no;
			$data['paypal']['buttonshow']=$buttonShow;
			$data['paypal']['paypalbutton']=$root.'extension/purpletree_multivendor/admin/view/image/paypalbutton.png';
			
			/* ------------------------End Code Paypal -------------------------- */
			
			if(isset($this->request->get['commision_view_id'])){
			$data['print_commission_invoice']=$this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|view', 'user_token=' . $this->session->data['user_token'].'&commision_view_id='.$this->request->get['commision_view_id'], true);
			//pay offline
			$data['pay_offline']=$this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice|payoffline', 'user_token=' . $this->session->data['user_token'].'&commision_view_id='.$this->request->get['commision_view_id'].'&seller_id='.$data['sellerdetails']['seller_id'], true);
			}

			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/commission_invoice', $data));	
			}
			
			
			public function view(){
			$this->document->addStyle('../extension/purpletree_multivendor/admin/view/javascript/purpletreecss/commonstylesheet.css');
			$validateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if (!$validateSeller) {
			$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
			$this->session->data['error_warning'] = $this->language->get('error_license');
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'] . $url, true));
			}
			$this->load->language('sale/order');
			$this->load->language('extension/purpletree_multivendor/multivendor/commissioninvoice');
			//$data['title'] = $this->language->get('text_commision_invoice');
			$data['title'] = "Commission Invoice";
			$this->load->model('sale/order');
			$this->load->model('extension/purpletree_multivendor/multivendor/commissioninvoice');
			$this->load->model('catalog/product');
			$this->load->model('extension/purpletree_multivendor/multivendor/sellercommission');
			
			$this->load->model('setting/setting');
			
			$data['orders'] = array();
			$store_address = "";
			$store_email = "";
			$store_telephone = "";
			$orders = array();
			$commisionss = array();
			//$data['text_seller_details'] = 'Seller</br> tel:0101010101010 </br> email:demosd@sdsd.com';
			$data['created_date'] = '';
			if (isset($this->request->get['commision_view_id'])) {
			$commisions_invoice_id = $this->request->get['commision_view_id'];
			$seller_vatname = $this->language->get('seller_vatname');
			$vat_field_id =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCustomFieldIdFromName($seller_vatname);
			$commisionss =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getiinvoiceitems($commisions_invoice_id);
			$data['invoice_number'] = $this->request->get['commision_view_id'];
			$commioncreated_date = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getinvoicedate($commisions_invoice_id);
			
			//////////////////////
			$commissions_invoice = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionsInvoice($commisions_invoice_id);
			//////////////////////
			
			if(!empty($commioncreated_date)) {
			$data['created_date'] = $commioncreated_date['created_at'];
			}
			else {
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'], true));
			}
			} else {
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'], true));
			}
			$total_product_price =0;
			$total_commission = 0;
			$total_ccommission_percent = 0;
			$total_fixed_commission = 0;
			$total_shipping_commission = 0;
			$total_percent_commission = 0;
			$total_quantity = 0;
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerpayment');
			$curency = $this->config->get('config_currency');
			$data['taxname'] = '';
			if(null !== $this->config->get('module_purpletree_multivendor_tax_name')) {
			$data['taxname'] = $this->config->get('module_purpletree_multivendor_tax_name');
			}
			$data['taxvalue'] = '';
			if(null !== $this->config->get('module_purpletree_multivendor_tax_value')) {
			$data['taxvalue'] = $this->config->get('module_purpletree_multivendor_tax_value');
			}
			$currency_detail = $this->model_extension_purpletree_multivendor_multivendor_sellerpayment->getCurrencySymbol($curency);
			if(!empty($commisionss)) {
			$data['seller_vatnumber'] = '';
			$data['seller_vatname'] = $seller_vatname;
				foreach ($commisionss as $commisionid) {
			$data['sellerdetails'] = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getStoreDetail($commisionid['seller_id']);
			$data['seller_country'] = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCountryName($data['sellerdetails']['store_country']);
			$this->load->model('extension/purpletree_multivendor/multivendor/stores');
			$data['sellerdetails']['store_email'] = $this->model_extension_purpletree_multivendor_multivendor_stores->getCustomerEmailId($commisionid['seller_id']);
			if($vat_field_id) {
			$vatnumberserialzed =  $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getvatfromid($commisionid['seller_id']);
			if($vatnumberserialzed) {
			$customfields = json_decode($vatnumberserialzed);
			if(!empty($customfields)) {
			foreach($customfields as $key => $customfield) {
			if($key == $vat_field_id) {
			$data['seller_vatnumber'] =  $customfield;
			}
			}
			}
			}			
			}
			$order_id = $commisionid['order_id'];
			$order_info = $this->model_sale_order->getOrder($order_id);
			// Make sure there is a shipping method
			if ($order_info) {
			$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);
			if ($store_info) {
			$store_address = $store_info['config_address'];
			$store_email = $store_info['config_email'];
			$store_telephone = $store_info['config_telephone'];
			} else {
			$store_address = $this->config->get('config_address');
			$store_email = $this->config->get('config_email');
			$store_telephone = $this->config->get('config_telephone');
			}
			$ccommission_percent =0;
			$this->load->model('tool/upload');
			$product_data = array();
			$product_info = $this->model_catalog_product->getProduct($commisionid['product_id']);
			$product_data['product_price'] = 0;
			$product['quantity'] = 0;
			if ($product_info) {
			$option_data = array();
			 
			if($commisionid['commission_id'] !=0){
			  $product = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getOrderProducts($commisionid['commission_id']);
			if($product) {
			  $product['total'] = $product['total_price'];
			  $product['price'] = $product['unit_price'];
			  $options = $this->model_sale_order->getOptions($order_id, $product['order_product_id']);
			  
					foreach ($options as $option) {
					if ($option['type'] != 'file') {
					$value = $option['value'];
					} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);
					
					if ($upload_info) {
					$value = $upload_info['name'];
					} else {
					$value = '';
					}
					}
					
					$option_data[] = array(
					'name'  => $option['name'],
					'value' => $value
					);
					}
			}
			}else{ 
					$products = $this->model_sale_order->getProducts($order_id);
					  foreach ($products as $product) {
					if($product['product_id'] == $commisionid['product_id']) {
					$product = $product;
					$options = $this->model_sale_order->getOptions($order_id, $product['order_product_id']);
					foreach ($options as $option) {
					if ($option['type'] != 'file') {
					$value = $option['value'];
					} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);
					
					if ($upload_info) {
					$value = $upload_info['name'];
					} else {
					$value = '';
					}
					}
					
					$option_data[] = array(
					'name'  => $option['name'],
					'value' => $value
					);
					}
					break;
					}
					}
				}
			
			
			  /* echo "<pre>";
			  print_r($product); die; */
			$product_data = array(
			'name'     => $product_info['name'],
			'option'   => $option_data,
			'quantity' => $product['quantity'],
			'price_total' =>  $this->currency->format($product['total'], $currency_detail['code'], $currency_detail['value']),
			//'price_total'    		   => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $currency_detail['code'], $currency_detail['value']),
			'product_price' =>  $product['price']
			
			);
			$ccommission_percent = ($commisionid['commission_percent']/100)*$product['total'];
			}
			
			
			$data['orders'][] = array(
			'order_id'	       => $order_id,
			//'invoice_no'       => $invoice_no,
			'date_added'       => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
			'store_name'       => $order_info['store_name'],
			'store_url'        => rtrim($order_info['store_url'], '/'),
			'store_address'    => nl2br($store_address),
			'store_email'      => $store_email,
			'store_telephone'  => $store_telephone,
			'email'            => $order_info['email'],
			'telephone'        => $order_info['telephone'],
			'product'          => $product_data,
			'commission_percent'  =>$this->currency->format($ccommission_percent,$currency_detail['code'], $currency_detail['value']),
			'commission_fixed'    => $this->currency->format($commisionid['commission_fixed'], $currency_detail['code'], $currency_detail['value']),
			'commission_shipping' => $this->currency->format($commisionid['commission_shipping'], $currency_detail['code'], $currency_detail['value']),
			'total_commission'    => $this->currency->format($commisionid['total_commission'], $currency_detail['code'], $currency_detail['value']),
			'comment'          	  => nl2br($order_info['comment'])
			);
			$total_product_price+=$product_data['product_price'];
			$total_ccommission_percent += $ccommission_percent;
			$total_commission += $commisionid['total_commission'];
			$total_fixed_commission += $commisionid['commission_fixed'];
			$total_shipping_commission += $commisionid['commission_shipping'];
			$total_percent_commission += $commisionid['commission_percent'];
			$total_quantity += $product['quantity'];
			}
			}
			} else {
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/commissioninvoice', 'user_token=' . $this->session->data['user_token'], true));
			}
			
			/////////////////////////////////////////////////
			
			$invoice_status = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getInvoiceStatus($commisions_invoice_id);
			if($invoice_status) {
			$data['invoice_status'] = $invoice_status;
			} else {
			$invoice_status = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getDefaultstatus();
			$data['invoice_status'] = $invoice_status;
			}
			
			if(!empty($commissions_invoice)) {
			foreach($commissions_invoice as $commissions_invoicess) {
			$commissions_invoicesss = array(
			'id' 			=> $commissions_invoicess['id'],
			'total_commission' 	=> $this->currency->format($commissions_invoicess['total_commission'], $currency_detail['code'], $currency_detail['value']),
			
			'total_pay_amount' 	=> $this->currency->format($commissions_invoicess['total_pay_amount'], $currency_detail['code'], $currency_detail['value']),				
			'created_at' 	=>date('d/m/Y', strtotime($commissions_invoicess['created_at'])),
			);
			}
			}
			$data['created_at'] = $commissions_invoicesss['created_at'];
			$data['total_commissionn'] = $commissions_invoicesss['total_commission'];
			$data['total_pay_amountt'] = $commissions_invoicesss['total_pay_amount'];
			$commissions_history = $this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionHistory($commisions_invoice_id);
			if(!empty($commissions_history)){
			foreach($commissions_history as $commission_historyy){			
			$data['commissionn_history'][]=array(
			'id'=>$commission_historyy['id'],
			'transaction_id'=>$commission_historyy['transaction_id'],
			'payment_mode'=>$commission_historyy['payment_mode'],
			'created_date'=>$commission_historyy['created_date'],
			'comment'=>$commission_historyy['comment'],
			'status_id'=>$this->model_extension_purpletree_multivendor_multivendor_commissioninvoice->getCommissionStatus($commission_historyy['status_id'])					
			);	
			}
			}
			/////////////////////////////////////////////////////	
			$data['module_purpletree_multivendor_footer_text'] = $this->config->get('module_purpletree_multivendor_footer_text');
			$data['total_fixed_commission']       = $this->currency->format($total_fixed_commission, $currency_detail['code'], $currency_detail['value']);
			$data['total_shipping_commission']       = $this->currency->format($total_shipping_commission, $currency_detail['code'], $currency_detail['value']);
			$data['total_percent_commission']       = $total_percent_commission;
			$data['total_ccommission_percent']       = $this->currency->format($total_ccommission_percent, $currency_detail['code'], $currency_detail['value']);
			$data['total_commission']       = $this->currency->format($total_commission, $currency_detail['code'], $currency_detail['value']);
			$data['total_quantity']       = $total_quantity;
			$data['store_name']       = $order_info['store_name'];
			$data['store_url']        = rtrim($order_info['store_url'], '/');
			$data['store_address']    = nl2br($store_address);
			$data['store_email']      = $store_email;
			$data['store_telephone']  = $store_telephone;
			$data['text1'] = $this->language->get('text1');
			$data['column_product_price'] = $this->language->get('column_product_price');
			$data['text2'] = $this->language->get('text2');
			$data['total_text'] = $this->language->get('total_text');
			$data['text3'] = $this->language->get('text3');
			$data['invoice_number_text'] = $this->language->get('invoice_number_text');
			$data['commision_product'] = $this->language->get('commision_product');
			$data['fixed_text'] = $this->language->get('fixed_text');
			$data['text_created_at'] = $this->language->get('text_created_at');
			$data['column_commission_percent'] = $this->language->get('column_commission_percent');
			$data['fixed_text'] = $this->language->get('fixed_text');
			$data['shipping_text'] = $this->language->get('shipping_text');
			$data['order_id_text'] = $this->language->get('order_id_text');
			$data['vat_number'] = $this->language->get('vat_number');
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/commison_invoicee', $data));	
			}
			
			protected function validateForm() {
			
			if ((strlen($this->request->post['txn_id']) < 1) || (strlen($this->request->post['txn_id']) > 50)) {
			$this->error['txn_id']= $this->language->get('error_txn_id');
			}
			
			if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
			} 
			
			return !$this->error;
			}
			
}
?>