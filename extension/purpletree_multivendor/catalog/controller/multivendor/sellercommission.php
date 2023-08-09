<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Sellercommission extends \Opencart\System\Engine\Controller{
		private $ptsValidateSeller = false;
		public function index(){
			
			if (!$this->customer->isLogged()) {			
				$this->session->data['redirect'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellercommission','language=' . $this->config->get('config_language'), true);
				
				$this->response->redirect($this->url->link('account/login','language=' . $this->config->get('config_language'), true));
			}
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			$store_detail = $this->model_extension_purpletree_multivendor_multivendor_dashboard->isSeller($this->customer->getId());
			if(!isset($store_detail['store_status'])){
				$this->response->redirect($this->url->link('account/account','language=' . $this->config->get('config_language'), true));
				}else{
				$stores=array();
						if(isset($store_detail['multi_store_id'])){
							$stores=explode(',',$store_detail['multi_store_id']);
						}
				if(isset($store_detail['store_status']) && !in_array($this->config->get('config_store_id'),$stores)){		
					$this->response->redirect($this->url->link('account/account','language=' . $this->config->get('config_language'), true));
				}
			}
			$this->load->model('extension/purpletree_multivendor/multivendor/dashboard');
			
			$this->model_extension_purpletree_multivendor_multivendor_dashboard->checkSellerApproval();
			$this->ptsValidateSeller = $this->load->controller('extension/purpletree_multivendor/multivendor/config');
			if(!$this->ptsValidateSeller) {
				$this->load->language('extension/purpletree_multivendor/multivendor/ptsmultivendor');
				$this->session->data['error_warning'] = $this->language->get('error_license');
				$this->response->redirect($this->url->link('account/account','language=' . $this->config->get('config_language'), true));
			}
			$this->load->language('extension/purpletree_multivendor/multivendor/sellercommission');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/sellercommission');
			
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
			
			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
				} else {
				$page = 1;
			}
			
			$data['heading_title'] = $this->language->get('heading_title');
			
			$data['text_total_sale'] = $this->language->get('text_total_sale');
			$data['text_total_commission'] = $this->language->get('text_total_commission');
			$data['text_recvd_amt'] = $this->language->get('text_recvd_amt');
			$data['text_pending_amt'] = $this->language->get('text_pending_amt');
			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_product_id'] = $this->language->get('text_product_id');
			$data['text_status'] = $this->language->get('text_status');
			$data['text_created_at'] = $this->language->get('text_created_at');
			$data['text_commission'] = $this->language->get('text_commission');
			$data['text_product_price'] = $this->language->get('text_product_price');
			$data['text_empty'] = $this->language->get('text_empty');
			$data['entry_date_from'] = $this->language->get('entry_date_from');
			$data['entry_date_to'] = $this->language->get('entry_date_to');
			
			$data['button_filter'] = $this->language->get('button_filter');
			
			$url = '';
			
			if (isset($this->request->get['filter_date_from'])) {
				$url .= '&filter_date_from=' . $this->request->get['filter_date_from'];
			}
			
			if (isset($this->request->get['filter_date_to'])) {
				$url .= '&filter_date_to=' . $this->request->get['filter_date_to'];
			}
			///Help code///	
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-commission";
			$data['helplink'] = "https://cutt.ly/tCo2Iuf";
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
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/sellercommission','language=' . $this->config->get('config_language'), true)
			);
			
			$seller_id = $this->customer->getId();
			$filter_data = array(
			'filter_date_from'    => $filter_date_from,
			'filter_date_to' => $filter_date_to,
			'start'                => ($page - 1) * $this->config->get('config_pagination_admin'),
			'limit'                => $this->config->get('config_pagination_admin'),
			'order_status' => $this->config->get('module_purpletree_multivendor_commission_status'),
			'seller_id'				=> $seller_id
			);
			$data['seller_commissions'] = array();
			
			$total_sale = $this->model_extension_purpletree_multivendor_multivendor_sellercommission->getTotalsale($filter_data);
			
			$seller_commissions = $this->model_extension_purpletree_multivendor_multivendor_sellercommission->getCommissions($filter_data);
			
			$total_commissions = $this->model_extension_purpletree_multivendor_multivendor_sellercommission->getTotalCommissions($filter_data);
			
			$this->load->model('extension/purpletree_multivendor/multivendor/sellerpayment');
			$curency = $this->session->data['currency'];
			
			$currency_detail = $this->model_extension_purpletree_multivendor_multivendor_sellerpayment->getCurrencySymbol($curency);
			
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
			
			$data['pagination'] = $this->load->controller('common/pagination', [
			'total' => $total_commissions,
			'page'  => $page,
			'limit' => $this->config->get('config_pagination_admin'),
			'url'   => $this->url->link('extension/purpletree_multivendor/multivendor/sellercommission', $url . '&page={page}'.'&language=' . $this->config->get('config_language'), true)
		]);

		$data['results'] = sprintf($this->language->get('text_pagination'), ($total_commissions) ? (($page - 1) * $this->config->get('config_pagination_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_pagination_admin')) > ($total_commissions - $this->config->get('config_pagination_admin'))) ? $total_commissions : ((($page - 1) * $this->config->get('config_pagination_admin')) + $this->config->get('config_pagination_admin')), $total_commissions, ceil($total_commissions / $this->config->get('config_pagination_admin')));
			
			
			$data['filter_date_from'] = $filter_date_from;
			$data['filter_date_to'] = $filter_date_to;
			
			$data['column_left'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/column_left');
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/commission_list', $data));
		}
	}
?>