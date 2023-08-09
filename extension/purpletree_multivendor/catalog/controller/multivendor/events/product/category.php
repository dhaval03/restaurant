<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Product;
class Category extends \Opencart\System\Engine\Controller {
	public function beforeCategoryView(&$route, &$data) {
		$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
		$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
		$data[' text_seller_contact'] = $this->language->get('text_seller_contact');
		if (isset($this->request->get['path'])) {
			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$category_id = (int)array_pop($parts);
/* 
			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$category_info = $this->model_catalog_category->getCategory($path_id);

				if ($category_info) {
					$data['breadcrumbs'][] = array(
						'text' => $category_info['name'],
						'href' => $this->url->link('product/category', 'path=' . $path . $url)
					);
				}
			} */
		} else {
			$category_id = 0;
		}
		if($this->config->get('module_purpletree_multivendor_allow_selleron_category') === 'service_mode'){
			$product_total = $this->model_extension_purpletree_multivendor_multivendor_vendor->getTotalStores($category_id);
			}
			if ($this->config->get('module_purpletree_multivendor_allow_selleron_category')){
			$data['products'] = array();
			}
		
		// $filter_data = array(
				// 'filter_category_id' => $category_id,
				// 'filter_filter'      => $filter,
				// 'sort'               => $sort,
				// 'order'              => $order,
				// 'start'              => ($page - 1) * $limit,
				// 'limit'              => $limit
			// );
			$data['selleron_category'] = $this->config->get('module_purpletree_multivendor_allow_selleron_category');
			$array23 = $this->model_extension_purpletree_multivendor_multivendor_vendor->checkAssignCategory($category_id);
			// echo "<pre>";
			// print_r($array23);
			// die;
			$results = array();
            $seller_id = array();
            $stordgory = array();
			$data['store_categories'] =array();
			$this->load->model('extension/purpletree_multivendor/multivendor/sellers');	
			$array1 = array();
			$array2 = array();
			if($this->config->get('module_purpletree_multivendor_allow_selleron_category') === 'service_mode'){	
				$data['text_empty'] = '';
				$array1 = $this->model_extension_purpletree_multivendor_multivendor_vendor->getAssinCategoriesSeller($category_id);
			}else{
				$array1 = $this->model_extension_purpletree_multivendor_multivendor_vendor->getCategoriesBySellerStore($category_id);
				$array2 = $this->model_extension_purpletree_multivendor_multivendor_vendor->getCategoriesBySellerStoreFromTemplatePro($category_id);
			}	
			$stordgory = array_merge($array1,$array2);		
			if($this->config->get('module_purpletree_multivendor_allow_selleron_category') === 'service_mode'){
				$seller_idd = array();
				if(!empty($stordgory) and $array23){
					foreach($array23 as $value){
						 $seller_idd[] = $value['seller_id'];
					}
					foreach($stordgory as $key=>$value){
						if(in_array($value['seller_id'], $seller_idd)){
							$seller_id[] = $value['seller_id'];
							$results[$key] = $value;
						}
				
					}
				}
			}else{
				if(!empty($stordgory)){
					foreach($stordgory as $key=>$value){
						if(!in_array($value['seller_id'], $seller_id)){
							$seller_id[] = $value['seller_id'];
							$results[$key] = $value;
						}
				
					}
				}
			}
			foreach ($results as $result) {
				// if ($result['store_logo']) {
					// $store_logo = $this->model_tool_image->resize($result['store_logo'], $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
				// } else {
					// $store_logo = $this->model_tool_image->resize('placeholder.png', $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_width'), $this->config->get('theme_' . $this->config->get('config_theme') . '_image_product_height'));
				// }
				
				if ($result['store_logo']) {
					$store_logo = $this->model_tool_image->resize(html_entity_decode($result['store_logo'], ENT_QUOTES, 'UTF-8'), $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$store_logo = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

				$subscription_status=1;
				if($this->config->get('module_purpletree_multivendor_subscription_plans')){
							
				$getSsellerplanStatus = $this->model_extension_purpletree_multivendor_multivendor_sellers->getSsellerplanStatus($result['seller_id']);
				$invoiceStatus = $this->model_extension_purpletree_multivendor_multivendor_sellers->getInvoiceStatus($result['seller_id']);
					if(!$getSsellerplanStatus && ($invoiceStatus==NULL || $invoiceStatus!=2)) {
						$subscription_status=0;			
					}	else {
						//$seller_totals++;			
					}	
					
				}else {
					//$seller_totals++;			
				}	
				$string = html_entity_decode($result['store_description'], ENT_QUOTES, 'UTF-8');
				$len = strlen($string);
				if($len>=70){
					$descriptions = substr($string, 0, 70).'....';
				}else{	
					$descriptions = $string;
				}
				$lend = strlen($result['store_address']);

				$addres = $result['store_address'] . ', ' . $result['country_name'];

				if($this->config->get('module_purpletree_multivendor_allow_selleron_category')==='service_mode'){	
					$result['product_id'] = '' ;
				}
				$data['store_categories'][] = array(
					'product_id'  => $result['product_id'],
					'category_id' => $result['category_id'],
					'store_id'    => $result['id'],
					'store_name'  => $result['store_name'],
					'store_address'  => $addres,
					'thumb'       => $store_logo,
					'description' => $descriptions,
					'subscription_status'=>$subscription_status,
					'href'        => $this->url->link('extension/purpletree_multivendor/multivendor/sellerstore|storeview', '&seller_store_id=' . $result['id'].'&language=' . $this->config->get('config_language')),
					'seller_id'        => $this->url->link('extension/purpletree_multivendor/multivendor/sellercontact|customerreply', '&seller_id=' . $result['seller_id'].'&language=' . $this->config->get('config_language'))
				);
			}

}
public function afterCategoryView(&$route, &$data, &$output) {
	if($this->config->get('module_purpletree_multivendor_status')){
if($this->config->get('module_purpletree_multivendor_allow_selleron_category')==1 || $this->config->get('module_purpletree_multivendor_allow_selleron_category')=='service_mode'){

$replace = '';
$replace = '<div id="product-list" class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4">';
$replace .= '<div class="pts-row row">';

foreach ($data['store_categories'] as $product){
if($product['subscription_status']){
$replace .= '<div class="product-layout product-list col-xs-12">';
$replace .= '<div class="product-thumb">';
$replace .= '<div class="image"><a href="'.$product['href'].'"><img src="'.$product['thumb'].'" alt="'.$product['store_name'].'" title="'.$product['store_name'].'" class="img-responsive" /></a></div>';	
$replace .= '<div>';
$replace .= '<div class="caption">';
$replace .= '<h4><a href="'.$product['href'].'">'.$product['store_name'].'</a></h4>';
$replace .= '<p>"'.$product['store_address'].'"</p>';
$replace .= '<p>"'.$product['description'].'"</p>';
$replace .= '<p class="price">'; 
$replace .= '<a href="'.$product['seller_id'].'">"'.$data[' text_seller_contact'].'"</a>';
$replace .= '</p>';
$replace .= '</div>';
$replace .= '</div>';
$replace .= '</div>';
$replace .= '</div>';
	}
	}
$replace .= '</div>';

$data['categories_store'] = $replace;
	
	$output = $this->load->view('extension/purpletree_multivendor/multivendor/events/product/category', $data);
	}
	} 
	return $output;
}
}

?>