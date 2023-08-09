<?php
namespace Opencart\Admin\Controller\Extension\PurpletreeMultivendor\Events\Catalog;
class Product extends \Opencart\System\Engine\Controller {
	public function product_form(&$route, &$data, &$output): void {

		///Help code///	
			$data['module_purpletree_multivendor_status'] = $this->config->get('module_purpletree_multivendor_status');
			if($this->config->get('module_purpletree_multivendor_status')){			
			//$data['helplink'] = "https://www.purpletreesoftware.com/knowledgebase/tag/opencart-multivendor-seller-product";
			$data['helplink'] = "https://cutt.ly/oCpRHgG";
			if (defined ('DISABLED_PTS_HELP')){if(DISABLED_PTS_HELP == 0){$data['helpcheck'] = 1;}else{$data['helpcheck'] = 0;}} else {$data['helpcheck'] = 1;}
			$data['helpimage'] = HTTP_CATALOG . '/extension/purpletree_multivendor/admin/view/image/help.png';
			}
			
			/*** Get seller associated with this product ***/
				$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
				if(isset($this->request->get['product_id'])){
				$product_seller = $this->model_extension_purpletree_multivendor_multivendor_vendor->getProductSeller($this->request->get['product_id']);

				$product_assign_plan = $this->model_extension_purpletree_multivendor_multivendor_vendor->getSellerProductPlan($this->request->get['product_id']);
				$seller_pro1 = $this->model_extension_purpletree_multivendor_multivendor_vendor->getProductSeller($this->request->get['product_id']);
				////// quick order //////
				$quick_order_status = $this->model_extension_purpletree_multivendor_multivendor_vendor->getQucikOrderStatus($this->request->get['product_id']);	
				}
				////// end quick order //////
				
				$seller_id=0;
		if(isset($seller_pro1['seller_id'])){
		$seller_id = $seller_pro1['seller_id'];
		}
		
		$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
		if (isset($this->request->get['product_id'])){
			$data['hidetab'] = $this->model_extension_purpletree_multivendor_multivendor_vendor->getAdmintempProductId($this->request->get['product_id']);			
		}		
		$data['product_plan_info'] = $this->model_extension_purpletree_multivendor_multivendor_vendor->getSellerSubscriptionPlan($seller_id);
        $this->load->language('extension/purpletree_multivendor/customer/ptscustomer');
        $product_plan_name='';
		$featured_product_plan_name='';
		$category_featured_product_plan_name='';
		if(isset($this->request->get['product_id'])){
			$product_plan_name= $this->model_extension_purpletree_multivendor_multivendor_vendor->productPlanName($this->request->get['product_id']);
			$featured_product_plan_name= $this->model_extension_purpletree_multivendor_multivendor_vendor->featuredProductPlanName($this->request->get['product_id']);
			$category_featured_product_plan_name= $this->model_extension_purpletree_multivendor_multivendor_vendor->categoryFeaturedProductPlanName($this->request->get['product_id']);
		}
		if (isset($this->request->post['product_plan_id'])) {
			$data['product_plan_id'] = $this->request->post['product_plan_id'];
		} elseif ($product_plan_name) {
			$data['product_plan_id'] =$this->model_extension_purpletree_multivendor_multivendor_vendor->featuredProductPlanName($this->request->get['product_id']);
		} else {
			$data['product_plan_id'] = '';
		}
		if (isset($this->request->post['featured_product_plan_id'])) {
			$data['featured_product_plan_id'] = $this->request->post['featured_product_plan_id'];
		} elseif ($product_plan_name) {
			$data['featured_product_plan_id'] =$this->model_extension_purpletree_multivendor_multivendor_vendor->featuredProductPlanName($this->request->get['product_id']);
		} else {
			$data['featured_product_plan_id'] = '';
		}
		if (isset($this->request->post['category_featured_product_plan_id'])) {
			$data['category_featured_product_plan_id'] = $this->request->post['category_featured_product_plan_id'];
		} elseif ($product_plan_name) {
			$data['category_featured_product_plan_id'] =$this->model_extension_purpletree_multivendor_multivendor_vendor->categoryFeaturedProductPlanName($this->request->get['product_id']);
		} else {
			$data['category_featured_product_plan_id'] = '';
		}
			
			/// End Help code///
					/** get vendor name for this product if any **/
			///// quick order /////
			$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
			if (defined('QUICK_ORDER') && QUICK_ORDER == 1 ){
			     $data['quick_order_check'] = QUICK_ORDER;
				}
			$data['quick_order_tab_position'] = $this->config->get('module_purpletree_multivendor_quick_order_tab_position');
			    if (isset($this->request->post['quick_order'])) {
					$data['quick_order'] = $this->request->post['quick_order'];
				} elseif (!empty($quick_order_status)) {
					$data['quick_order'] = (int)$quick_order_status;
				} else {
					$data['quick_order'] = '';
				}
		   ////// End quick order ///////
				if (isset($this->request->post['vendor'])) {
					$data['vendor'] = $this->request->post['vendor'];
				} elseif (!empty($product_seller)) {
					$data['vendor'] = (int)$product_seller['seller_id'];
				} else {
					$data['vendor'] = '';
				}
			    if (isset($this->request->post['product_plan_id'])) {
					$data['product_plan_id'] = $this->request->post['product_plan_id'];
				} elseif (!empty($product_assign_plan)) {
					$data['product_plan_id'] = $product_assign_plan['product_plan_id'];
				} else {
					$data['product_plan_id'] = '';
				}
				
				if (isset($this->request->post['featured_product_plan_id'])) {
					$data['featured_product_plan_id'] = $this->request->post['featured_product_plan_id'];
				} elseif (!empty($product_assign_plan)) {
					$data['featured_product_plan_id'] = $product_assign_plan['featured_product_plan_id'];
				} else {
					$data['featured_product_plan_id'] = '';
				}
				
				if (isset($this->request->post['category_featured_product_plan_id'])) {
					$data['category_featured_product_plan_id'] = $this->request->post['category_featured_product_plan_id'];
				} elseif (!empty($product_assign_plan)) {
					$data['category_featured_product_plan_id'] = $product_assign_plan['category_featured_product_plan_id'];
				} else {
					$data['category_featured_product_plan_id'] = '';
				}
				/** get all vendors **/
				$data['vendors'] = $this->model_extension_purpletree_multivendor_multivendor_vendor->getVendors();
				
				$data['module_purpletree_multivendor_subscription_plans'] = $this->config->get('module_purpletree_multivendor_subscription_plans');
				$data['module_purpletree_multivendor_multiple_subscription_plan_active'] = $this->config->get('module_purpletree_multivendor_multiple_subscription_plan_active');
	
		$find = array();
		$replace = array();
		$data['tab_vendor']= 'Vendor';
		$find[] = '<a href="'.$data['back'].'" data-bs-toggle="tooltip" title="'.$data['button_back'].'" class="btn btn-light"><i class="fas fa-reply"></i></a>';
		
		$find[] = '<li class="nav-item"><a href="#tab-report" data-bs-toggle="tab" class="nav-link">'.$data['tab_report'].'</a></li>';
		
		$find[] = '<div id="tab-report" class="tab-pane">';
		 if($data['module_purpletree_multivendor_status']){ 
			if($data['helpcheck']){
			$replace[] = '<a href="'.$data['back'].'" data-bs-toggle="tooltip" title="'.$data['button_back'].'" class="btn btn-light"><i class="fas fa-reply"></i></a>
			<a href="'.$data['helplink'].'" target="_blank" id="button-pts-help" class="btn"><img src="'.$data['helpimage'].'" alt="Help" width="85" height="43"></a>';
			}
		} else {
			$replace[]='<a href="'.$data['back'].'" data-bs-toggle="tooltip" title="'.$data['button_back'].'" class="btn btn-light"><i class="fas fa-reply"></i></a>';
		}		
		
		$replace[] = '<li class="nav-item"><a href="#tab-report" data-bs-toggle="tab" class="nav-link">'.$data['tab_report'].'</a></li>
<li class="nav-item"><a href="#tab-vendor" data-bs-toggle="tab" class="nav-link">'.$data['tab_vendor'].'</a></li>';
		
		$replace[] = $this->load->view('extension/purpletree_multivendor/events/catalog/product_form', $data);

		$output = str_replace($find,$replace,$output);
	}
	
	public function addproduct(&$route, &$data, &$product_id): void {
					/** update product status according to mv config setting **/
		if (isset($data['vendor']) && !empty($data['vendor'])) {
					if($this->config->get('module_purpletree_multivendor_product_approval')){
						$is_approved = 0;
						$data['status'] = 0;
						$this->db->query("UPDATE " . DB_PREFIX . "product SET status = '0' WHERE product_id = '" . (int)$product_id . "'");
					} else{
						$is_approved = 1;
					}
		$is_featured = 0;
		if(isset($data['is_featured'])){
		  $is_featured = $data['is_featured'];
		} elseif(isset($data['featured_product_plan_id'])){
			if($data['featured_product_plan_id'] > 0) {
			$is_featured = 1;
			}
		}
		$is_category_featured = 0;
		if(isset($data['is_category_featured'])){
		  $is_category_featured = $data['is_category_featured'];
		}
		elseif(isset($data['category_featured_product_plan_id'])){
			if($data['category_featured_product_plan_id'] > 0) {
			$is_category_featured = 1;
			}
		}
		$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_products SET product_id = '" . (int)$product_id."', seller_id = '".(int)$data['vendor']."', is_approved ='".(int)$is_approved."',is_featured ='".(int)$is_featured."',is_category_featured ='".(int)$is_category_featured."', created_at =NOW(), updated_at =NOW()");
		         if(isset($data['product_plan_id'])){
						
					}else{
						$data['product_plan_id'] = 0;
					}
					if(isset($data['featured_product_plan_id'])){
						
					}else{
						$data['featured_product_plan_id'] = 0;
					}
					if(isset($data['category_featured_product_plan_id'])){
						
					}else{
						$data['category_featured_product_plan_id'] = 0;
					}
		$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_subscription_products SET product_id = '" . (int)$product_id . "',product_plan_id = '" . (int)$data['product_plan_id']. "',featured_product_plan_id = '" . (int)$data['featured_product_plan_id']. "',category_featured_product_plan_id = '" . (int)$data['category_featured_product_plan_id']. "'");
					
	}		
	}
	public function editproduct(&$route, &$product_data, &$output): void {

				$product_id = $product_data[0];
				$data = $product_data[1];
				/** update or insert into seller products **/
				if (isset($data['product_plan_id'])) {
				$query= $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_subscription_products WHERE product_id = '".(int)$product_id."'");
				if($query->num_rows>0){
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_subscription_products SET product_plan_id = '" . (int)$data['product_plan_id'] . "' WHERE product_id = '".(int)$product_id."'");
				}
			}
			
			$is_featured = 0;
			if (isset($data['featured_product_plan_id'])) {
			if($data['featured_product_plan_id'] > 0) {
			$is_featured = 1;
			}
				$query= $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_subscription_products WHERE product_id = '".(int)$product_id."'");
				if($query->num_rows>0){
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_subscription_products SET featured_product_plan_id = '" . (int)$data['featured_product_plan_id'] . "' WHERE product_id = '".(int)$product_id."'");
				}
			}
			
		$is_category_featured = 0;
		if (isset($data['category_featured_product_plan_id'])) {
		if($data['category_featured_product_plan_id'] > 0) {
			 $is_category_featured = 1;
			}
				$query= $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_subscription_products WHERE product_id = '".(int)$product_id."'");
				if($query->num_rows>0){
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_subscription_products SET category_featured_product_plan_id = '" . (int)$data['category_featured_product_plan_id'] . "' WHERE product_id = '".(int)$product_id."'");
				}
			}

				if (isset($data['vendor'])  && !empty($data['vendor'])) {
				if(isset($data['product_plan_id'])){
						
					}else{
						$data['product_plan_id'] = 0;
					}
					if(isset($data['featured_product_plan_id'])){
						
					}else{
						$data['featured_product_plan_id'] = 0;
					}
					if(isset($data['category_featured_product_plan_id'])){
						
					}else{
						$data['category_featured_product_plan_id'] = 0;
					}
					$query = $this->db->query("SELECT seller_id FROM " . DB_PREFIX . "purpletree_vendor_products WHERE product_id='".(int)$product_id."'");
					$query1 = $this->db->query("SELECT * FROM " . DB_PREFIX . "purpletree_vendor_subscription_products WHERE product_id='".(int)$product_id."'");
					
					if(!$query1->num_rows) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_subscription_products SET product_id = '" . (int)$product_id . "',product_plan_id = '" . (int)$data['product_plan_id']. "',featured_product_plan_id = '" . (int)$data['featured_product_plan_id']. "',category_featured_product_plan_id = '" . (int)$data['category_featured_product_plan_id']. "'");		
					}
					if($query->num_rows > 0) {
						$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_products SET seller_id = '" . (int)$data['vendor'] . "', updated_at =NOW(),is_category_featured ='".(int)$is_category_featured."',is_featured ='".(int)$is_featured."' WHERE product_id = '".(int)$product_id."'");
					} else {
						if($this->config->get('purpletree_multivendor_product_approval')){
							$is_approved = 0;
							$this->db->query("UPDATE " . DB_PREFIX . "product SET status = '0' WHERE product_id = '" . (int)$product_id . "'");
						} else{
							$is_approved = 1;
						}

						$this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_products SET product_id = '" . (int)$product_id . "', seller_id = '" . (int)$data['vendor'] . "',is_category_featured ='".(int)$is_category_featured."',is_featured ='".(int)$is_featured."', created_at =NOW(), updated_at =NOW(), is_approved = '".(int)$is_approved."'");
						
					}
				} else {
					$query = $this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_vendor_products WHERE product_id='".(int)$product_id."'");
					
						$query = $this->db->query("DELETE FROM " . DB_PREFIX . "purpletree_vendor_subscription_products WHERE product_id='".(int)$product_id."'");
				}
		//// quick order ////	
		if (isset($data['quick_order'])) {
		      $query = $this->db->query("SELECT status FROM " . DB_PREFIX . "purpletree_vendor_quick_order_product WHERE product_id='".(int)$product_id."'");
			
			if($query->num_rows){
				$this->db->query("UPDATE " . DB_PREFIX . "purpletree_vendor_quick_order_product SET status = '" . (int)$data['quick_order'] . "',seller_id = '".(int)$data['vendor']."' WHERE product_id='".(int)$product_id."'");
				} else {
		        $this->db->query("INSERT INTO " . DB_PREFIX . "purpletree_vendor_quick_order_product SET product_id = '" . (int)$product_id . "',seller_id = '".(int)$data['vendor']."',status = '" . (int)$data['quick_order'] . "'");
			}
		     
			}
	   ////  end quick order ////	
	}
	public function getSellerPlan() {
		$json = array();
		$this->load->language('catalog/product');
		if (isset($this->request->get['seller_id'])) {
			
			if (isset($this->request->get['seller_id'])) {
				$seller_id = $this->request->get['seller_id'];
			} else {
				$seller_id = '';
			}

		$this->load->model('extension/purpletree_multivendor/multivendor/subcriptionplan');

			$result = $this->model_extension_purpletree_multivendor_multivendor_subcriptionplan->getSellerSubscriptionPlan($seller_id);
			if(!empty($result)){
				foreach($result as $key=>$value){
						$json[]=array(
						'plan_id'=>$value['plan_id'],
						'plan_name'=>$value['plan_name']
						);			
				}
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
?>