<?php

/**
 * login.php
 *
 * Login management
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

class Updatesession  extends \RestController
{

    const FACEBOOK_USER_INFORMATION_URL = 'https://graph.facebook.com/me?fields=email,name';
    const GOOGLE_USER_INFORMATION_URL = 'https://www.googleapis.com/userinfo/v2/me';

    public function updatesession()
    {
		echo "yess";exit;
		
        $this->checkPlugin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $post = $this->getPost();

            $this->language->load('checkout/checkout');
			$this->language->load('account/login');
            if ($this->customer->isLogged()) {
                $this->json['error'][] = "User is logged.";
                $this->statusCode = 400;
            } else {
                if (!$this->customer->login($post['email'], $post['password'])) {
                    $this->json['error'][] = $this->language->get('error_login');
                    $this->statusCode = 403;
                } else {
                    $this->load->model('account/customer');

                    $email = $post['email'];

                    $customer_info = $this->model_account_customer->getCustomerByEmail($email);

                    if ($customer_info && !$customer_info['status']) {
                        $this->json['error'][] = $this->language->get('error_approved');
                        $this->statusCode = 403;
                    }
                }
            }

            if (empty($this->json['error'])) {

                unset($this->session->data['guest']);

                // Default Addresses
                $this->load->model('account/address');

                if ($this->config->get('config_tax_customer') == 'payment') {
					$payment_address = $this->model_account_address->getAddress($this->customer->getId(),$this->customer->getAddressId());
					if(count($payment_address)>0){
						$this->session->data['payment_address'] = $payment_address;
					}
                }

                if ($this->config->get('config_tax_customer') == 'shipping') {
					$shipping_address = $this->model_account_address->getAddress($this->customer->getId(),$this->customer->getAddressId());
					if(count($shipping_address)>0){
						$this->session->data['shipping_address'] = $shipping_address;
					}
                }

                unset($customer_info['password']);
                unset($customer_info['token']);
                unset($customer_info['salt']);

                $customer_info['address_id'] = $this->customer->getAddressId();


                $this->load->model('account/custom_field');

                $customer_info['custom_fields'] = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));

                if ($this->opencartVersion < 2100) {
                    $customer_info['account_custom_field'] = unserialize($customer_info['custom_field']);
                } else {
                    $customer_info['account_custom_field'] = json_decode($customer_info['custom_field'], true);
                }

                unset($customer_info['custom_field']);
                unset($customer_info['cart']);

                unset($customer_info['custom_field']);
                unset($customer_info['cart']);

                $this->registry->set('cart', new \Opencart\System\Library\Cart\Cart($this->registry));

                $wishlist = array();

                //get wishlist data
                $this->load->model('account/wishlist');
                $list = $this->model_account_wishlist->getWishlist();

                if(!empty($list)) {
                    foreach ($list as $item) {
                        $wishlist[$item['product_id']] = $item['product_id'];
                    }
                }

                $customer_info['wishlist'] = array_values($wishlist);
                $customer_info['wishlist_total'] = $this->model_account_wishlist->getTotalWishlist();

                $customer_info['cart_count_products'] = $this->cart->countProducts();
                //$customer_info['cart_total'] = $this->currency->format($this->cart->getTotal(), $this->currency->getRestCurrencyCode());

                $this->json['data'] = $customer_info;
            }

        } else {
            $this->statusCode = 405;
            $this->allowedHeaders = array("POST");
        }

        $this->sendResponse();
    }


    }