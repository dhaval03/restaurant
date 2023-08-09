<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Module;
class PurpletreeFeaturedstore extends \Opencart\System\Engine\Controller {
		public function index() {
			$this->load->language('extension/purpletree_multivendor/module/purpletree_featuredstore');			
			
			$this->load->model('catalog/product');
			
			$this->load->model('tool/image');
			
			$data['products'] = array();
			
			$this->load->model('extension/purpletree_multivendor/module/storefeatured');
			$data = array();	
			$data['store']=array();	
			$purpletree_multivendor_subscription_plans = $this->config->get('module_purpletree_multivendor_subscription_plans');
			if($purpletree_multivendor_subscription_plans==1){
				$storess = $this->model_extension_purpletree_multivendor_module_storefeatured->getLatest();
			}			
			if(!empty($storess)){
			if ($this->config->get('module_purpletree_featuredstore_limit')) {
			$stores = array_slice($storess, 0, (int)$this->config->get('module_purpletree_featuredstore_limit'));
			}else{
			$stores = array_slice($storess, 0,5);
			}
			}
			$image_height = 200;
			$image_width = 200;
			if ($this->config->get('module_purpletree_featuredstore_height')) {
			  $image_height = $this->config->get('module_purpletree_featuredstore_height');
			}
			if ($this->config->get('module_purpletree_featuredstore_width')) {
			  $image_width = $this->config->get('module_purpletree_featuredstore_width');
			}
			if(!empty($stores)){
				$i=0;
				$storearray = array();				
				//$count= 0;
				foreach($stores as $store){
					//if($count < 8) {
					//	$count++;
						if(!in_array($store['id'],$storearray)) {
							$storearray[] = $store['id'];		
							if($stores[$i]['store_logo']) {
								$store_logo = $this->model_tool_image->resize($stores[$i]['store_logo'],$image_width , $image_height);
								} else {
								$store_logo = $this->model_tool_image->resize('placeholder.png',$image_width , $image_height);
								
							}
							$i++;
							$data['store'][]=array(
							'store_name'=>$store['store_name'],
							'store_logo'=>$store_logo,
							'href'    => $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|storeview','seller_store_id=' . $store['id'].'&language=' . $this->config->get('config_language'))
							);
						}
					//}
				}

			}
			$data['heading_title'] = $this->language->get('heading_title');	 	
			
			return $this->load->view('extension/purpletree_multivendor/module/purpletree_featuredstore', $data);
		}
	}
?>