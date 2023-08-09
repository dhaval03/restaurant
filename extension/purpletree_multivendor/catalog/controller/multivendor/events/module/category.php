<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Module;
class Category extends \Opencart\System\Engine\Controller {
public function beforeCategoryController(&$route, &$data) {

	if($this->config->get('module_purpletree_multivendor_allow_selleron_category') === 'service_mode'){
	$this->load->model('extension/purpletree_multivendor/multivendor/vendor');
	 $categories = $this->model_catalog_category->getCategories(0);
	 
			foreach ($categories as $category) {
			$children_data = array();

			if ($category['category_id'] == $data['category_id']) {
				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach($children as $child) {
					$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

					$categoriess = $this->model_extension_purpletree_multivendor_multivendor_vendor->getTotalStores($child['category_id']);
	
					 $children_data[] = array(
						'category_id' => $child['category_id'],
						'name' => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $categoriess . ')' : ''),
						'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'].'&language=' . $this->config->get('config_language'))
					);
	
				}
			}

			$filter_data = array(
				'filter_category_id'  => $category['category_id'],
				'filter_sub_category' => true
			);
			
			$categoriess = $this->model_extension_purpletree_multivendor_multivendor_vendor->getTotalStores($category['category_id']);
		
			$cat_data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $categoriess . ')' : ''),
				'children'    => $children_data,
				'href'        => $this->url->link('product/category', 'path=' . $category['category_id'],'&language=' . $this->config->get('config_language'))
			);	
			$data['categories'] = $cat_data['categories'];
		}
//	return $data;
		}

	}
}
?>