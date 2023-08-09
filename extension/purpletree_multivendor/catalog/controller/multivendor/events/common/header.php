<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\common;
class Header extends \Opencart\System\Engine\Controller {
	public function afterHeaderView(&$route, &$data, &$output) {
		if($this->config->get('module_purpletree_multivendor_status')){
		/***** Show browse seller link in header ******/
			 $this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
			 $data['sellerlogged']='';
			 $data['direction'] = $this->language->get('direction');
			 $data['module_purpletree_multivendor_browse_sellers'] = $this->config->get('module_purpletree_multivendor_browse_sellers');
			 $data['module_purpletree_multivendor_include_jquery'] = $this->config->get('module_purpletree_multivendor_include_jquery');
			 $data['module_purpletree_multivendor_seller_login'] = $this->config->get('module_purpletree_multivendor_seller_login');
             $data['module_purpletree_multivendor_status'] = $this->config->get('module_purpletree_multivendor_status');
			 $data['text_browse_sellers'] = $this->language->get('text_browse_sellers');
			 $data['text_seller_register'] = $this->language->get('text_seller_register');
			 $data['seller_panel_link'] = '';
			 $data['text_seller_panel'] = $this->language->get('text_seller_panel');
			 $data['browse_seller_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellers','language=' . $this->config->get('config_language'));
			 $data['seller_register_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerlogin','language=' . $this->config->get('config_language'));
			///// seller panel/////
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');

			   $store_detail = $this->model_extension_purpletree_multivendor_multivendor_vendor->isSeller($this->customer->getId());	
				if($store_detail){
						if($store_detail['is_removed']==1){
							$data['seller_panel_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore/becomeseller','language=' . $this->config->get('config_language'), true);
						} else {
						$stores=array();
						if(isset($store_detail['multi_store_id'])){
							$stores=explode(',',$store_detail['multi_store_id']);
						}
						if($store_detail['store_status']==1 && in_array($this->config->get('config_store_id'),$stores)){
							$data['seller_panel_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/dashboardicons','language=' . $this->config->get('config_language'), true);
						} elseif(!in_array($this->config->get('config_store_id'),$stores)){
						  $data['seller_panel_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerlogin','language=' . $this->config->get('config_language'));
						   $data['text_seller_panel'] = $this->language->get('text_seller_register');
						} else {
							$data['seller_panel_link'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|becomeseller','language=' . $this->config->get('config_language'), true);
						}
						}
				}
				
				$storesData = $this->model_extension_purpletree_multivendor_multivendor_vendor->getAllStoreData();
			   $data['linkVisible']=false;
			   $storesLinks[]=0;
			   if(!empty($storesData)){
				   foreach($storesData as $storeKey => $storeVal){
					$stores_temp= explode(',',$storeVal['multi_store_id']);
					if(!empty($stores_temp)){
						foreach($stores_temp as $storeKey1 => $storeVal1){
							$storesLinks[$storeVal1]=$storeVal1;
						}
					}
				   }
			   }
			    $pts_store_id= $this->config->get('config_store_id');
			   if(in_array($pts_store_id,$storesLinks)){
				   $data['linkVisible']=true;
			   }
			//////End seller panel///
			
			if ($this->customer->isLogged()) {
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			   $store_detail = $this->model_extension_purpletree_multivendor_multivendor_vendor->isSeller($this->customer->getId());	
				if($store_detail){
					$data['sellerlogged'] = 'seller';
				}
		    }	
	if(version_compare(VERSION, '4.0.0.0', '>')){
		$find = '<li class="list-inline-item"><a href="'.$data['contact'].'"><i class="fa-solid fa-phone"></i></a> <span class="d-none d-md-inline">'.$data['telephone'].'</span></li>';
	} else {
		$find = '<li class="list-inline-item"><a href="'.$data['contact'].'"><i class="fas fa-phone"></i></a> <span class="d-none d-md-inline">'.$data['telephone'].'</span></li>';
	}
		
		$replace = '';
		if($data['linkVisible']){
		if($data['module_purpletree_multivendor_status'] and $data['module_purpletree_multivendor_seller_login']){
		if($data['sellerlogged']){
			$replace .= '<li class="list-inline-item"><a href="'.$data['seller_panel_link'].'"><i class="fa fa-user fas fa user-o" aria-hidden="true"></i> <span class="d-none d-md-inline">'.$data['text_seller_panel'].'</span></a> </li>';
		} else {
			$replace .= '<li class="list-inline-item"><a href="'.$data['seller_register_link'].'"><i class="fa fa-user fas fa user-o" aria-hidden="true"></i> <span class="d-none d-md-inline">'.$data['text_seller_register'].'</span></a></li>';
		}
		}
		if($data['module_purpletree_multivendor_status']){
		if($data['module_purpletree_multivendor_browse_sellers']){
		$replace .= '<li class="list-inline-item"><a href="'.$data['browse_seller_link'].'"><i class="fa fa-users" aria-hidden="true"></i> <span class="d-none d-md-inline">'.$data['text_browse_sellers'].'</span></a> </li>';
		}
		}
		}
		if(version_compare(VERSION, '4.0.0.0', '>')){
		$replace .= '<li class="list-inline-item"><a href="'.$data['contact'].'"><i class="fa-solid fa-phone"></i></a> <span class="d-none d-md-inline">'.$data['telephone'].'</span></li>';
		} else {
		$replace .= '<li class="list-inline-item"><a href="'.$data['contact'].'"><i class="fas fa-phone"></i></a> <span class="d-none d-md-inline">'.$data['telephone'].'</span></li>';
		}
		$output = $this->load->controller('extension/purpletree_multivendor/multivendor/events/stringreplace',$find,$replace,$output);
	}
	return $output;
	}
}
?>