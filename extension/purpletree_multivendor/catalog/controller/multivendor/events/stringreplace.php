<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Events;
class Stringreplace extends \Opencart\System\Engine\Controller {
	public function index($find,$replace,$output) {
		return str_replace($find,$replace,$output);	
	}
}
?>