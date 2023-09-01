<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Pos extends \Opencart\System\Engine\Controller {
		private $error = array();
		public function index() {
			
			$this->load->language('extension/purpletree_multivendor/multivendor/pos');
			
			$this->document->setTitle($this->language->get('heading_title'));
			
			$this->load->model('extension/purpletree_multivendor/multivendor/pos');
			
			$data['breadcrumbs'] = array();
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home','language=' . $this->config->get('config_language'),true)
			);
			
			$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/purpletree_multivendor/multivendor/pos','&language=' . $this->config->get('config_language'), true)
			);
			
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			$data['vendor_categories'] = $this->model_extension_purpletree_multivendor_multivendor_vendor->getAssingedCategories();
			
			$data['column_left'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/column_left');
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/pos', $data));
		}
	}
?>