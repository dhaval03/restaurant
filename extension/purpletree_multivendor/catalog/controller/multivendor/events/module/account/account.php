<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events\Module\Account;
class Account extends \Opencart\System\Engine\Controller {
public function afterCustomerContactController(&$route, &$data, &$output) {
$this->load->language('extension/purpletree_multivendor/multivendor/ptsregister');
		$data['sellercontact'] = $this->url->link('extension/purpletree_multivendor/multivendor/sellercontact|customerContactlist','language=' . $this->config->get('config_language'), true);
		$data['sellercontact_module'] =$this->config->get('module_purpletree_multivendor_seller_contact');	
		$data['purpletree_module_status'] =$this->config->get('module_purpletree_multivendor_status');	
		$data['text_seller_contact1'] = $this->language->get('text_seller_contact1');
		
		$find= '<a href="'.$data['address'].'" class="list-group-item">'.$data['text_address'].'</a>';
		$replace = '';
		if($data['sellercontact_module']==1 and $data['purpletree_module_status']==1){
		$replace .= '<a href="'.$data['address'].'" class="list-group-item">'.$data['text_address'].'</a>';	
		$replace .= '<a href="'.$data['sellercontact'].'" class="list-group-item">'.$data['text_seller_contact1'].'</a>';	
		$output = $this->load->controller('extension/purpletree_multivendor/multivendor/events/stringreplace',$find,$replace,$output);
		}

	}
}
?>