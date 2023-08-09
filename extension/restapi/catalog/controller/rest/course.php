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
require_once(DIR_SYSTEM . 'engine/restcontroller.php');

class Course extends \RestController
{

    private $error = array();

    public function course()
    {
		//echo"ddvf";exit;
		$this->checkPlugin();
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			if (isset($this->request->get['id']) && ctype_digit($this->request->get['id'])) {
			    $this->getCourse($this->request->get['id']);
			} else {
				$this->listcourse();
			}
        }else {
            $this->statusCode = 405;
            $this->allowedHeaders = array("GET");
        }

        return $this->sendResponse();
    }
	
	
	public function getCourse($product_id)
	{
		$json = array('success' => true);

		$this->load->model('catalog/product');
			
        $course = $this->model_catalog_product->getProduct($product_id);
        if(!empty($course)) {
            $this->json["data"] = $course;
        } else {
            $this->json['success'] = false;
        }

        $this->sendResponse($json);
	}
	
    public function listcourse()
    {
		if (empty($this->json['error'])) {

			$this->load->model('catalog/product');
			$this->load->model('tool/image');

            $start  = 0;
            $limit  = 20;
            $page   = 1;
			$search = "";

            /*check search parameter*/
			//print_r($this->request->get);exit;
            if (isset($this->request->get['search'])) {
                $search = $this->request->get['search'];
            }
			
			if (isset($this->request->get['tag'])) {
			$tag = $this->request->get['tag'];
			} elseif (isset($this->request->get['search'])) {
			$tag = $this->request->get['search'];
			} else {
			$tag = '';
			}
			
			if (isset($this->request->get['name'])) {
                $name = $this->request->get['name'];
            }else {
				$name = '';
			}
			
			if (isset($this->request->get['description'])) {
			$description = $this->request->get['description'];
			} else {
				$description = '';
			}

			if (isset($this->request->get['category_id'])) {
				$category_id = (int)$this->request->get['category_id'];
			} else {
				$category_id = 0;
			}

			if (isset($this->request->get['sub_category'])) {
				$sub_category = $this->request->get['sub_category'];
			} else {
				$sub_category = 0;
			}
			
			if (isset($this->request->get['order'])) {
				$order = $this->request->get['order'];
			} else {
				$order = 'ASC';
			}
		
			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = 'p.sort_order';
			}
			
			if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
			}

             /*check limit parameter*/
            if (isset($this->request->get['limit']) && ctype_digit($this->request->get['limit'])) {
                $limit = $this->request->get['limit'];
            }

            /*check page parameter*/
            if (isset($this->request->get['page']) && ctype_digit($this->request->get['page'])) {
                $start = ($this->request->get['page']-1)*$limit;
                $page   = $this->request->get['page'];
            }

            $start = ($page - 1) * $limit;
			
			
			$filter_data = [
				'filter_name'         => $name,
				'filter_tag'          => $tag,
				'filter_description'  => $description,
				'filter_category_id'  => $category_id,
				'filter_sub_category' => $sub_category,
				'sort'                => $sort,
				'order'               => $order,
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit
			];
			
			$product_total = $this->model_catalog_product->getTotalProducts($filter_data);
			
			$results = $this->model_catalog_product->getProducts($filter_data);
			foreach ($results as $result) {
				if (is_file(DIR_IMAGE . html_entity_decode($result['image'], ENT_QUOTES, 'UTF-8'))) {
					$image = $this->model_tool_image->resize(html_entity_decode($result['image'], ENT_QUOTES, 'UTF-8'), $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}

				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$price = false;
				}

				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				$product_data = [
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('config_product_description_length') . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
					'rating'      => $result['rating']
					//'href'        => $this->url->link('product/product', 'language=' . $this->config->get('config_language') . '&product_id=' . $result['product_id'])
				];
				//$data['products'][] = $this->load->controller('product/thumb', $product_data);
				$data['products'][] = $product_data;
			}
			if (!empty($data['products'])) {
				$this->json["data"] = $data;
			}else {
				$this->json['error'][] = 'Product not found';
				$this->statusCode = 404;
			}
		}
    }
	
}

