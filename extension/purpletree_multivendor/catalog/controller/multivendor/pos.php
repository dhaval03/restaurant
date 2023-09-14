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
			
			$this->load->model('catalog/product');
			$data['products'] = $this->model_catalog_product->getProducts();
			$data['image1'] = HTTP_SERVER.'extension/purpletree_multivendor/image/table_logo.jpg';
			$data['image2'] = HTTP_SERVER.'extension/purpletree_multivendor/image/profile.png';
			
			$data['column_left'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/column_left');
			$data['footer'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/footer');
			$data['header'] = $this->load->controller('extension/purpletree_multivendor/multivendor/common/header');
			
			$this->response->setOutput($this->load->view('extension/purpletree_multivendor/multivendor/pos', $data));
		}
		public function getCategorieProducts(){
			$json = [];
			if(isset($this->request->post['category_id']) && $this->request->post['category_id'] > 0){
				$this->load->model('extension/purpletree_multivendor/multivendor/pos');
				$results = $this->model_extension_purpletree_multivendor_multivendor_pos->getPos($this->request->post['category_id']);
				foreach ($results as $result) {
					if (!empty($result['image'])) {
						//$thumb = str_replace('\\', '/', realpath(DIR_IMAGE.$result['image']));
						$thumb = HTTP_SERVER.'image/'.$result['image'];
					} else {
						$thumb = DIR_IMAGE.'no_image.png';
					}
					$json['rt_products'][] = array(
						'product_id' => $result['product_id'],
						'name'       => strip_tags(html_entity_decode($result['model']." - ".$result['name'], ENT_QUOTES, 'UTF-8')),
						'thumb'=>$thumb	
					);
				}				
				$json['success'] = true;
			}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
		public function getProductDetails(){
			$json = [];
			if(isset($this->request->post['product_id']) && $this->request->post['product_id'] > 0){
			$this->load->model('extension/purpletree_multivendor/multivendor/pos');
			$product = $this->model_extension_purpletree_multivendor_multivendor_pos->getProducts($this->request->post['product_id']);
				if(!empty($product)){
					$json['product_data'] = $product;
					$json['success'] = true;
				}
			}
			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		}
	}
?>