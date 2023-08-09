<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Startup;
class Seourl extends \Opencart\System\Engine\Controller {
	public function index() {
if ($this->config->get('config_seo_url')) {
		// Add rewrite to URL class
		if ($this->config->get('config_seo_url')) {
			//$this->url->addRewrite($this);
		}
		
		$this->load->model('design/seo_url');

		// Decode URL
		if (isset($this->request->get['_route_'])) {
			$parts = explode('/', $this->request->get['_route_']);

			// remove any empty arrays from trailing
			if (strlen(end($parts)) == 0) {
				array_pop($parts);
			}
			
			foreach ($parts as $part) {
				$seo_url_info = $this->model_design_seo_url->getSeoUrlByKeyword($part);

				if ($seo_url_info) {
					$url_string = "extension/purpletree_multivendor/multivendor";
					if($seo_url_info['value'] === $url_string){
						$index = array_search($part,$parts);
						$seo_url_info['value'] = $seo_url_info['value'].'/'.$parts[$index+1];
					}
					
					$this->request->get[$seo_url_info['key']] = html_entity_decode($seo_url_info['value'], ENT_QUOTES, 'UTF-8');
				}
			}
		}
	}
	}
}
?>