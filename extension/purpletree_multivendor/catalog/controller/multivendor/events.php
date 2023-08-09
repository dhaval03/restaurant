<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Events extends \Opencart\System\Engine\Controller {
	
		// model/catalog/product/getProducts/after
		public function getFilterProducts(&$route, &$args, &$output) {

		if($this->config->get('module_purpletree_multivendor_status')){	
		$this->load->model('extension/purpletree_multivendor/sellerproduct');
		$this->load->model('extension/purpletree_multivendor/vendor');
		if(!empty($output)){
			$products=array();
			foreach($output as $pkey => $pvalue){
			if(!empty($pvalue['product_id'])){
			    $seller_products = $this->model_extension_purpletree_multivendor_sellerproduct->is_seller_product($pvalue['product_id']);
				if(!empty($seller_products)){
					if($seller_products['is_approved'] == 1){
						$products[] = $pvalue;
					}
				} else {
						$products[] = $pvalue;
				}
			   }
			   }
				$output=  $products;
			 }
			 
		if($this->config->get('module_purpletree_multivendor_hyperlocal_status')){
		if((isset($this->session->data['seller_area'])&& ($this->session->data['seller_area'] > 0))){
		$current_area = '';	
		$assign_area = array();
		     $filter_products = array();
			$this->load->model('extension/purpletree_multivendor/sellerproduct');
			$this->load->model('extension/purpletree_multivendor/vendor');
			if(!empty($output)){
			foreach($output as $key => $value){
			    $seller_detail = $this->model_extension_purpletree_multivendor_sellerproduct->getSellername($value['product_id']);
				if($seller_detail){
				$seller_detailss = $this->model_extension_purpletree_multivendor_vendor->getStoreDetail($seller_detail['seller_id']);
				if($seller_detailss['store_area'] != ''){
				    $current_area = $this->session->data['seller_area'];	
					$assign_area = unserialize($seller_detailss['store_area']);
					if(!in_array($current_area,$assign_area)){
						 unset($output[$key]);
						}
				  }
				   }
			   }
			 }
		   }
		   }
			return $output;
			}
		}	
		
		 // model/catalog/product/getLatestProducts/after
		public function getFilterLatestProducts(&$route, &$args, &$output) {

		if($this->config->get('module_purpletree_multivendor_status')){	
		$this->load->model('extension/purpletree_multivendor/sellerproduct');
		$this->load->model('extension/purpletree_multivendor/vendor');
		if(!empty($output)){
			$products=array();
			foreach($output as $pkey => $pvalue){
			if(!empty($pvalue['product_id'])){
			    $seller_products = $this->model_extension_purpletree_multivendor_sellerproduct->is_seller_product($pvalue['product_id']);
				if(!empty($seller_products)){
					if($seller_products['is_approved'] == 1){
						$products[] = $pvalue;
					}
				} else {
						$products[] = $pvalue;
				}
			   }
				$output=  $products;
		}
			 }
			 
		if($this->config->get('module_purpletree_multivendor_hyperlocal_status')){
		if((isset($this->session->data['seller_area'])&& ($this->session->data['seller_area'] > 0))){
		$current_area = '';	
		$assign_area = array();
		     $filter_products = array();
			$this->load->model('extension/purpletree_multivendor/sellerproduct');
			$this->load->model('extension/purpletree_multivendor/vendor');
			if(!empty($output)){
			foreach($output as $key => $value){
			    $seller_detail = $this->model_extension_purpletree_multivendor_sellerproduct->getSellername($value['product_id']);
				if($seller_detail){
				$seller_detailss = $this->model_extension_purpletree_multivendor_vendor->getStoreDetail($seller_detail['seller_id']);
				if($seller_detailss['store_area'] != ''){
				    $current_area = $this->session->data['seller_area'];	
					$assign_area = unserialize($seller_detailss['store_area']);
					if(!in_array($current_area,$assign_area)){
						 unset($output[$key]);
						}
				  }
				   }
			   }
			 }
		   }
		   }
			return $output;
			}
		}	
		
		
		// model/catalog/product/getTotalProducts/after
		public function getFilterTotalProducts(&$route, &$args, &$output) {
		  if($this->config->get('module_purpletree_multivendor_status')){		
			if($this->config->get('module_purpletree_multivendor_hyperlocal_status')){
				if((isset($this->session->data['seller_area'])&& ($this->session->data['seller_area'] > 0))){
				 /// add code here 
				}
			}
		  }
		}
		
		// model/catalog/product/getProduct/after
		public function getFilterProduct(&$route, &$args, &$output) {		
		   if($this->config->get('module_purpletree_multivendor_status')){
		$this->load->model('extension/purpletree_multivendor/sellerproduct');
		$this->load->model('extension/purpletree_multivendor/vendor');
		if(!empty($output)){
			$products=array();
			    $seller_products = $this->model_extension_purpletree_multivendor_sellerproduct->is_seller_product($output['product_id']);
				if(!empty($seller_products)){
					if($seller_products['is_approved'] == 1){
						$products = $output;
					}
				} else {
						$products = $output;
				}

				$output=  $products;
			 }
		   
		   if($this->config->get('module_purpletree_multivendor_hyperlocal_status')){
		if((isset($this->session->data['seller_area'])&& ($this->session->data['seller_area'] > 0))){	
		$current_area = '';	
		$assign_area = array();
		     $filter_products = array();
			$this->load->model('extension/purpletree_multivendor/sellerproduct');
			$this->load->model('extension/purpletree_multivendor/vendor');
			if(!empty($output)){
			   $seller_detail = $this->model_extension_purpletree_multivendor_sellerproduct->getSellername($output['product_id']);
				if($seller_detail){
				$seller_detailss = $this->model_extension_purpletree_multivendor_vendor->getStoreDetail($seller_detail['seller_id']);
				    $current_area = $this->session->data['seller_area'];
					if($seller_detailss['store_area'] != ''){
					$assign_area = unserialize($seller_detailss['store_area']);
					if(!in_array($current_area,$assign_area)){
						 $output = '';
						}
					}
				   }
			}
		}
		}
	  }
	}
		
	public function beforeheader(&$route, &$data, &$output) {
		  if($this->config->get('module_purpletree_multivendor_status')){	
		$data= array();
		$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
		$this->load->language('extension/purpletree_multivendor/sellerregister');
		   //unset($this->session->data['seller_area']);
           
            if(!isset($this->session->data['seller_area'])) {		
						
               $this->session->data['seller_area']= '';			   
			   $data['check_seller_area'] = $this->session->data['seller_area'];
	         }else{
			  $data['check_seller_area'] = $this->session->data['seller_area'];
			 }
			 if($this->config->get('module_purpletree_multivendor_area_status')){
		            $data['seller_area_namea'] = "...";
				  }else{
					$data['seller_area_namea'] = $this->language->get('text_all_sellerarea');
				  }
			 $this->load->model('extension/purpletree_multivendor/vendor');
			 $data['seller_area'] = '';
			if((isset($this->session->data['seller_area'])) && ($this->session->data['seller_area'] != '')) {
			if($this->session->data['seller_area'] > 0){
		        $seller_area = $this->model_extension_purpletree_multivendor_vendor->getSellerAreasName($this->session->data['seller_area']); 
	            if(isset($seller_area)){
				   $data['seller_area_namea'] = $seller_area;
				}else{
				   unset($this->session->data['seller_area']);
				   $data['seller_area_namea'] = "...";
					}
			   }else{
			     if($this->session->data['seller_area'] == 0){
				    $data['seller_area_namea'] = $this->language->get('text_all_sellerarea');
				  }else{
					 $data['seller_area_namea'] = "...";
				  }
			   }
			    if(isset( $this->session->data['seller_area'])){
				$data['seller_area'] = $this->session->data['seller_area'];	
				}else{
				 $data['seller_area'] = '';
				}
	         }
             // start hyper local  section//
                $hyper_local=$this->config->get('module_purpletree_multivendor_hyperlocal_status');
                $data['hyper_status']= $hyper_local;               
		
		    // End  hyper local section//
                

       // start pop up heading 
	      if($this->config->get('module_purpletree_multivendor_hp_heading')){
            $popupheading=$this->config->get('module_purpletree_multivendor_hp_heading');			
            $data['hp_heading']=$popupheading;
		  }else{		    
			 $data['hp_heading']="";
		  }
		  if($this->config->get('module_purpletree_multivendor_area_status')){
		      $data['area_status_check'] = $this->config->get('module_purpletree_multivendor_area_status');
			  }
		  if($this->config->get('config_url')){
		   $data['hyperlocal_loder'] = $this->config->get('config_url')."image/catalog/spinner.gif"; 
		  }
		  if($this->config->get('config_url')){
		   $data['base_url'] = $this->config->get('config_url'); 
		  }
		  // end pop up heading       

            $data['sellerareas'] = array();			
			$data['sellerareas'] = array();
		    $all_seller_store = array();
		    $assign_area = array();
		    $all_seller_store = array();
			$results = $this->model_extension_purpletree_multivendor_vendor->getSellerAreas();
			$sellerareas = array();
			if(!empty($results)){
			foreach ($results as $result) {	
			/* $all_seller_store = $this->model_extension_purpletree_multivendor_vendor->getAllSellerInfo();
			if(!empty($all_seller_store)){
			     foreach ($all_seller_store as $seller_store) {
				       if($seller_store['store_area'] != ''){
					       $assign_area = unserialize($seller_store['store_area']);
					       if(in_array($result['area_id'],$assign_area)){ */
						       $sellerareas[] = array(
								'area_id'=> $result['area_id'],
								'area_name'=> $result['area_name']);
						        
							   /* }
						   }
					 }
				} */
				
			} 
			} 			
			$all_area[] = array(
			    'area_id' => 0,
                'area_name' => $this->language->get('text_all_sellerarea')
				);
		   $data['sellerareas'] = array_merge($all_area,$sellerareas);	

		   $data['hyperlocal_type'] = $this->config->get('module_purpletree_multivendor_hyperlocal_type');
		   $data['text_seller_area_ok'] = $this->language->get('text_seller_area_ok');
		   $data['text_search_area_placeholder'] = $this->language->get('text_search_area_placeholder');
		   $data['text_message'] = $this->language->get('text_message');
		   
		$newheader = $this->load->view('extension/module/beforeheader', $data);
		 $output = str_replace('</head>', '</head>'.$newheader, $output);

	}
	}
	public function afterHeaderView(&$route, &$data, &$output) {
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

		$find = '<li class="list-inline-item"><a href="'.$data['contact'].'"><i class="fas fa-phone"></i></a> <span class="d-none d-md-inline">'.$data['telephone'].'</span></li>';
		
		$replace = '';
		if($data['linkVisible']){
		if($data['module_purpletree_multivendor_status'] and $data['module_purpletree_multivendor_seller_login']){
		if($data['sellerlogged']){
			$replace .= '<li class="list-inline-item"><a href="'.$data['seller_panel_link'].'"><i class="fa fa-user fas fa user-o" aria-hidden="true"></i> <span class="d-none d-md-inline">'.$data['text_seller_panel'].'</span></a> </li>';
		} else {
			$replace .= '<li class="list-inline-item"><a href="'.$data['seller_register_link'].'"><i class="fa fa-user fas fa user-o" aria-hidden="true"></i> <span class="d-none d-md-inline">'.$data['text_seller_panel'].'</span></a></li>';
		}
		}
		if($data['module_purpletree_multivendor_status']){
		if($data['module_purpletree_multivendor_browse_sellers']){
		$replace .= '<li class="list-inline-item"><a href="'.$data['browse_seller_link'].'"><i class="fa fa-users" aria-hidden="true"></i> <span class="d-none d-md-inline">'.$data['text_browse_sellers'].'</span></a> </li>';
		}
		}
		}
		
		$replace .= '<li class="list-inline-item"><a href="'.$data['contact'].'"><i class="fas fa-phone"></i></a> <span class="d-none d-md-inline">'.$data['telephone'].'</span></li>';
		$output = str_replace($find,$replace,$output);
	}
}
?>