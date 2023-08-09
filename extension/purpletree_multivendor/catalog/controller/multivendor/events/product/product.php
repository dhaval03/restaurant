<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Product;
class Product extends \Opencart\System\Engine\Controller {
	public function afterProductView(&$route, &$data, &$output) {
		
			if (isset($data['product_id'])) {
			$product_id = (int)$data['product_id'];
		$this->load->model('extension/purpletree_multivendor/multivendor/sellerproduct');
		    $this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');	    
		    $data['button_deliver'] =$this->language->get('button_deliver');
			$pts_quick_status = '';
			$pts_quick_status = $this->model_extension_purpletree_multivendor_multivendor_sellerproduct->getQucikOrderStatus($product_id);
			$seller_detailss = array();			
            $data['quick_order'] =$this->url->link('extension/purpletree_multivendor/multivendor/quick_order', '&product_id='.$product_id.'&language=' . $this->config->get('config_language'), true);
            $data['pts_quick_status'] =$pts_quick_status;
			if(isset($this->session->data['seller_sto_page'])) {
				unset($this->session->data['seller_sto_page']);
			}
			/******* get seller details to show on product page *******/
			$data['seller_review_status'] = $this->config->get('module_purpletree_multivendor_seller_review');
			$data['module_purpletree_multivendor_hide_seller_detail'] = $this->config->get('module_purpletree_multivendor_hide_seller_detail');
			$data['seller_detail'] = array();
			$data['module_purpletree_multivendor_allow_live_chat'] = 0;
				if(NULL !== $this->config->get('module_purpletree_multivendor_allow_live_chat')) {
					$data['module_purpletree_multivendor_allow_live_chat'] = $this->config->get('module_purpletree_multivendor_allow_live_chat');
				}
				$data['store_live_chat_enable'] =0;
				$data['store_live_chat_code'] ='';
			if($this->config->get('module_purpletree_multivendor_status')){
				
				$currentpage = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
				$this->session->data['ptsmv_current_page'] = $currentpage;
				
				$this->load->model('extension/purpletree_multivendor/multivendor/sellerproduct');
				$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
				$this->load->model('extension/purpletree_multivendor/multivendor/sellertemplateproduct');
				$minprice = $this->model_extension_purpletree_multivendor_multivendor_sellertemplateproduct->getMinPrice($product_id);
				if($this->config->get('module_purpletree_multivendor_seller_product_template')){
				if(!empty($minprice)){
				  $data['template_product_status'] = $minprice['subtract_status'];
			    }else{
				  $data['template_product_status'] = 0;
			    }}else{
				   $data['template_product_status'] = 0;
				}
				$seller_detail = $this->model_extension_purpletree_multivendor_multivendor_sellerproduct->getSellername($product_id);
				if($seller_detail){
				$seller_detailss = $this->model_extension_purpletree_multivendor_multivendor_vendor->getStoreDetail($seller_detail['seller_id']);
				
				$data['store_live_chat_enable'] = isset($seller_detailss['store_live_chat_enable'])?$seller_detailss['store_live_chat_enable']:0;
				$data['store_live_chat_code'] ='';
				if(isset($seller_detailss['store_live_chat_code'])) {
					
				$data['store_live_chat_code'] = html_entity_decode($seller_detailss['store_live_chat_code'], ENT_QUOTES, "UTF-8");	
					if($data['store_live_chat_code'] != '') {
						$this->session->data['seller_sto_page'] = $seller_detailss['id'];
					}					
				}
					$seller_rating = $this->model_extension_purpletree_multivendor_multivendor_vendor->getStoreRating($seller_detail['seller_id']);
					$data['seller_detail'] = array(
						'seller_name' => $seller_detail['store_name'],
						'store_id' => $seller_detail['id'],
						'seller_rating' => (isset($seller_rating['rating'])?$seller_rating['rating']:'0'),
						'seller_count' => (isset($seller_rating['count'])?$seller_rating['count']:'0'),
						'seller_href' => $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|storeview', 'seller_store_id=' . $seller_detail['id'].'&language=' . $this->config->get('config_language')),
						'seller_review_link' => $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|sellerreview', 'seller_id=' . $seller_detail['seller_id'].'&language=' . $this->config->get('config_language')),
						'seller_contact_link' => $this->url->link('extension/purpletree_multivendor/multivendor/sellercontact|customerReply', 'seller_id=' . $seller_detail['seller_id'].'&language=' . $this->config->get('config_language'))
					);
				}
			$data['module_purpletree_multivendor_status']=$this->config->get('module_purpletree_multivendor_status');
			}
		} else {
			$product_id = 0;
		}
		$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
		$data['text_seller_label'] = $this->language->get('text_seller_label');
		$data['text_seller_review'] = $this->language->get('text_seller_review');
		$data['text_seller_rating'] = $this->language->get('text_seller_rating');
		$data['text_seller_contact'] = $this->language->get('text_seller_contact');
		// unknown
		//$this->session->data['ptsmv_current_page_name'] = $product_info['name'];
		// unknown
			//template product filter	
			/* $minPriceData = $this->getTemplateData($product_id);
			if(!empty($minPriceData)){
				$data['template_product_status'] = $minPriceData['status'];
				$product_info['price']=$minPriceData['price'];
				$product_info['quantity']=$minPriceData['quantity'];
				$product_info['stock_status_id']=$minPriceData['stock_status_id'];
				$product_info['subtract']=$minPriceData['subtract'];
				$product_info['status']=$minPriceData['status'];
			} */
			
			/* 
public function getTemplateData($product_id) {
		// Template Product Code
			$minPriceData=array();
			if($this->config->get('module_purpletree_multivendor_seller_product_template')){
			$minPriceData=array();
			$this->load->model('extension/module/purpletree_sellerprice');
			$TemplateData = $this->model_extension_module_purpletree_sellerprice->getTemplatePrice($product_id);
			$templateProductData= $this->load->controller('extension/module/purpletree_sellerprice/filterDataWithHyperlocal',$TemplateData);
			if(!empty($templateProductData)){
				foreach($templateProductData as $tempKey => $tempVal){
				  $sort_template[$tempKey]=$tempVal['price'];
				}
				array_multisort($sort_template, SORT_ASC, $templateProductData);
				
				$minPriceData=$templateProductData[0];
			}
	}
	return $minPriceData;
	// template product code
}
			public function getSellerPriceModel() {
				$data=array();
				if(isset($this->request->post['product_id'])){
					$data['prod_id']=$this->request->post['product_id'];
				}
				if(isset($this->request->post['name']) && $this->request->post['name']!=''){
					$temp_option= explode('[',$this->request->post['name']);
					$option_id= explode(']',$temp_option[1]);
					$data['product_option_id']=$option_id[0];
				} elseif(isset($this->request->post['name'])){
					$data['product_option_id'] = $this->request->post['name'];
				}
				if(isset($this->request->post['value']) && $this->request->post['value']!=''){
					$data['product_option_value_id']=$this->request->post['value'];
				} elseif(isset($this->request->post['value'])){
					$data['product_option_value_id']=$this->request->post['value'];	
				}
				if(isset($this->request->post['onload'])){
					$data['onload']=$this->request->post['onload'];
				}
				$this->response->addHeader('Content-Type: text/html');
				$this->response->setOutput($this->load->controller('extension/module/purpletree_sellerprice',$data));
			}
			*/
	//template product filter
		//template description
			if($this->config->get('module_purpletree_multivendor_template_description')){
				$this->load->model('extension/purpletree_multivendor/module/purpletree_sellerprice');
				if(isset($this->request->get['seller_id'])){
					$description = $this->model_extension_purpletree_multivendor_module_purpletree_sellerprice->getTemlateDescription($this->request->get['product_id'],$this->request->get['seller_id']);
					$data['description'] = html_entity_decode($description, ENT_QUOTES, 'UTF-8');
				}
			}
	// multi_prices
		$data['multi_prices'] = $this->load->controller('extension/purpletree_multivendor/module/purpletree_sellerprice');
		$data['has_multi_prices'] = !empty($data['multi_prices']) ? true : false;
		$data['seller_template_price_list'] = $this->config->get('module_purpletree_multivendor_temp_prod_price_list');

		$this->load->model('extension/purpletree_multivendor/module/purpletree_sellerprice');
		$templateCnts = $this->model_extension_purpletree_multivendor_module_purpletree_sellerprice->getSellerTemplateProductCounts($this->request->get['product_id']);
		$data['has_product_template'] = $templateCnts > 0 ? true : false;	
		// multi_prices
		
		
		
		
	// find replace part		
		$find = '<li>'. $data['text_model'] .' '. $data['model'] .'</li>';
		$replace = '';
		if($data['pts_quick_status']){
		} else {
			$replace .= '<li>'. $data['text_model'].' '. $data['model'] .'</li>';
		}	
	if($data['seller_detail']){	
		if($data['module_purpletree_multivendor_hide_seller_detail']!= 1){
		$replace .= '<li>'. $data['text_seller_label'].' &nbsp;<a href="'.$data['seller_detail']['seller_href'].'">'.$data['seller_detail']['seller_name'].'</a></li>';
			if($data['seller_review_status']){
				$replace .= '<li>';
				if($data['seller_detail']['seller_rating']){
					$replace .= '<div class="rating" style="display:inline !important; border:none !important;">'.
					$data['text_seller_rating'].' &nbsp;&nbsp;&nbsp;';
						for($i=0;$i<5 ;$i++){
							if($data['seller_detail']['seller_rating'] < $i ){
								$replace .= '<span class="fa fa-stack" style="min-width:0;"><i class="far fa-star fa-stack-1x"></i></span>';
							} else {
								$replace .= '<span class="fa fa-stack" style="min-width:0;"><i class="far fa-star fa-stack-1x"></i></span>';
							}
						}
					$replace .= '<a href="'.$data['seller_detail']['seller_review_link'].'" id = "pts_srating">'.$data['seller_detail']['seller_count'].' '.  $data['text_seller_review'].'</a>';
					$replace .= '</div>';
				} else {
					$replace .= '<div class="rating"  style="display:inline !important; border:none !important;">'.$data['text_seller_rating'].'&nbsp;&nbsp;&nbsp';
						for($i=0;$i<5 ;$i++){
							$replace .= '<span class="fa fa-stack" style="min-width:0;"><i class="far fa-star fa-stack-1x"></i></span>';
						}
						$replace .= '<a href="'.$data['seller_detail']['seller_review_link'].'" id = "pts_srating">'.$data['seller_detail']['seller_count'].' '. $data['text_seller_review'].'</a>';
						$replace .= '</div>';
				}
				$replace .= '</li>';
			}
			$replace .= '<li><a href="'.$data['seller_detail']['seller_contact_link'].'">'.$data['text_seller_contact'].'</a></li>';
		}
	}		
	if(!empty($seller_detail['seller_id'])){	
		$find1 = '<input type="hidden" name="product_id" value="'.$data['product_id'].'"/>';
		$replace1 = '<input type="hidden" name="product_id" value="'.$data['product_id'].'"/>
		<input type="hidden" name="seller_id" value="'.$seller_detail['seller_id'].'"/>
		';	

		$find2 = '<input type="hidden" name="product_id" value="'.$data['product_id'].'" id="input-product-id"/>';
		$replace2 = '<input type="hidden" name="product_id" value="'.$data['product_id'].'" id="input-product-id"/>
		<input type="hidden" name="seller_id" value="'.$seller_detail['seller_id'].'"/>
		';
	}
	$find3 = '<button type="submit" id="button-cart" class="btn btn-primary btn-lg btn-block">'.$data['button_cart'].'</button>';
	// echo "<pre>";
	// print_r($data);
	// die;
	$replace3 = '';
	if($data['template_product_status'] == 1){
		if($data['has_multi_prices'] and $data['seller_template_price_list']){
			$replace3 .='<div id="pts-seller-price">'.$data['multi_prices'].'</div>';	
		}
	} else {
		if($data['pts_quick_status'] ){
			$replace3 .='<button type="button" data-loading-text="'. $data['text_loading'] .'" class="btn btn-primary btn-lg btn-block"><a style="color:white"href="'. $data['quick_order'] .'"><i class="fa fa-shopping-cart"></i>&nbsp'. $data['button_deliver'].'</a></button>';
		} else {			  
			$replace3 .='<button type="submit" id="button-cart" class="btn btn-primary btn-lg btn-block">'.$data['button_cart'].'</button>';				  
		}
	}
	
	
$output = $this->load->controller('extension/purpletree_multivendor/multivendor/events/stringreplace',$find,$replace,$output);	
if(!empty($seller_detail['seller_id'])){		
$output = $this->load->controller('extension/purpletree_multivendor/multivendor/events/stringreplace',$find1,$replace1,$output);
		
$output = $this->load->controller('extension/purpletree_multivendor/multivendor/events/stringreplace',$find2,$replace2,$output);
}
$output = $this->load->controller('extension/purpletree_multivendor/multivendor/events/stringreplace',$find3,$replace3,$output);

	
	}
}
?>