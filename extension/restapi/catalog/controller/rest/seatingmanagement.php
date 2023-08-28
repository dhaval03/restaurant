<?php

/**
 * tutor.php
 *
 * tutor management
 *
 * @author     Opencart-api.com
 * @copyright  2017
 * @license    License.txt
 * @version    2.0
 * @link       https://opencart-api.com/product/shopping-cart-rest-api/
 * @documentations https://opencart-api.com/opencart-rest-api-documentations/
 */
namespace Opencart\Catalog\Controller\Extension\RestApi\Rest;
require_once(DIR_EXTENSION . 'restapi/system/engine/restcontroller.php');

class Seatingmanagement extends \RestController
{

    private $error = array();

    public function seatingmanagement()
    {
		$this->checkPlugin();
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->listSeatingmanagement();
			
        }else {
            $this->statusCode = 405;
            $this->allowedHeaders = array("GET");
        }

        return $this->sendResponse();
    }
	
	public function listSeatingmanagement()
    {
		$this->load->model('extension/purpletree_multivendor/multivendor/seatingmanagement');
		$limit = 10
		if(isset($this->request->get['limit'])){
			$limit = $this->request->get['limit'];
		}
		$page = 1;
		if(isset($this->request->get['page'])){
			$page = $this->request->get['page'];
		}
		
		$filter_data = array(
			'start'=>($page-1)*$limit,
			'limit'=>$limit,
			'status'=>1,
		);
        $seatingmanagement = $this->model_extension_purpletree_multivendor_multivendor_seatingmanagement->getSeatingManagements($filter_data);
        $data['seatingmanagement'] = array_values($seatingmanagement);

        if (!empty($data['seatingmanagement'])) {
            $this->json["data"] = $data;
        }

        if($this->includeMeta) {

            $data = $this->json['data'];

            if(isset($this->json['data']['seatingmanagement'])) {
                $intercomsData = $this->json['data']['seatingmanagement'];
            } else {
                $intercomsData = array();
            }
            $this->response->addHeader('X-Total-Count: ' . count($intercomsData));
            $this->response->addHeader('X-Pagination-Limit: '.count($intercomsData));
            $this->response->addHeader('X-Pagination-Page: 1');        
        }
	}
}
