<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor;
class Config extends \Opencart\System\Engine\Controller{
	public function index($skipcondition = null) {
		$this->load->model('extension/purpletree_multivendor/multivendor/config');
		return $this->model_extension_purpletree_multivendor_multivendor_config->validateSeller($skipcondition);

	}		
}
?>
