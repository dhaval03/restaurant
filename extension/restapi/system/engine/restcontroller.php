<?php
error_reporting(E_ALL & ~E_NOTICE);
/**
 * @author     Opencart-api.com
 * @copyright  2017
 * @license    License.txt
 * @version    2.0
 * @link       https://opencart-api.com/product/shopping-cart-rest-api/
 * @documentations https://opencart-api.com/opencart-rest-api-documentations/
 */
abstract class RestController extends \Opencart\System\Engine\Controller
{
	public $statusCode = 200;
    public $post = array();
    public $allowedHeaders = array("GET", "POST", "PUT", "DELETE");
    public $accessControlAllowHeaders = array("Content-Type", "Authorization", "X-Requested-With", "X-Oc-Merchant-Id",
        "X-Oc-Merchant-Language", "X-Oc-Currency", "X-Oc-Image-Dimension", "X-Oc-Store-Id", "X-Oc-Session", "X-Oc-Include-Meta");
    public $json = array("success" => 1, "error" => array(), "data" => array());

    public $multilang = 0;
    public $opencartVersion = "";
    public $urlPrefix = "";
    public $includeMeta = true;

    public $apiRequest = null;

    private $httpVersion = "HTTP/1.1";

    private $enableLogging = 0;

    public function checkPlugin()
    {

        /*check rest api is enabled*/
        $rest_api_licensed_on = $this->config->get('module_shoppingcartrestapi_licensed_on');
        if (!$this->config->get('module_shoppingcartrestapi_status') || empty($rest_api_licensed_on)) {
            $this->json["error"][] = 'Shopping Cart Rest API is disabled. Enable it!';
            $this->statusCode = 403;
            $this->sendResponse();
        }


        if (!$this->ipValidation()) {
            $this->statusCode = 403;
            $this->sendResponse();
        }

        $this->opencartVersion = str_replace(".", "", VERSION);
        $this->urlPrefix = $this->request->server['HTTPS'] ? HTTPS_SERVER : HTTP_SERVER;

        $this->validateToken();

        $token = $this->getTokenValue();

        $this->setSystemParameters();

        $this->update_session($token['access_token'], json_decode($token['data'], true));

    }

    public function sendResponse()
    {

        $statusMessage = $this->getHttpStatusMessage($this->statusCode);

        //fix missing allowed OPTIONS header
        $this->allowedHeaders[] = "OPTIONS";

        if ($this->statusCode != 200) {
            if (!isset($this->json["error"])) {
                $this->json["error"][] = $statusMessage;
            }

            if ($this->statusCode == 405 && $_SERVER['REQUEST_METHOD'] !== 'OPTIONS') {
                $this->response->addHeader('Allow: ' . implode(",", $this->allowedHeaders));
            }

            $this->json["success"] = 0;

            //enable OPTIONS header
            if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
                $this->statusCode = 200;
                $this->json["success"] = 1;
                $this->json["error"] = array();
            }
        } else {

            if (!empty($this->json["error"])) {
                $this->statusCode = 400;
                $this->json["success"] = 0;
            }
            //add cart errors to the response
            if (isset($this->json["cart_error"]) && !empty($this->json["cart_error"])) {
                $this->json["error"] = $this->json["cart_error"];
                unset($this->json["cart_error"]);
            }
        }

        $this->json["error"] = array_values($this->json["error"]);

        if (isset($this->request->server['HTTP_ORIGIN'])) {
            $this->response->addHeader('Access-Control-Allow-Origin: ' . $this->request->server['HTTP_ORIGIN']);
            $this->response->addHeader('Access-Control-Allow-Methods: '. implode(", ", $this->allowedHeaders));
            $this->response->addHeader('Access-Control-Allow-Headers: '. implode(", ", $this->accessControlAllowHeaders));
            $this->response->addHeader('Access-Control-Allow-Credentials: true');
        }

        $this->load->model('account/customer');

        if (isset($this->session->data['token_id']) || isset($_SESSION['token_id'])) {
            $token = $this->session->data['token_id'];
            $this->session->data['rest_session_id'] = $this->session->getId();
            $this->model_account_customer->updateSession($this->session->data, $token);
        }

        if (isset($this->session->data['customer_id']) && !empty($this->session->data['customer_id'])) {
            $this->model_account_customer->updateCustomerData($this->session, $this->session->data['customer_id']);
        }

        $this->response->addHeader($this->httpVersion . " " . $this->statusCode . " " . $statusMessage);
        $this->response->addHeader('Content-Type: application/json; charset=utf-8');

        /*check logging is enabled or not*/
        if ($this->config->get('module_shoppingcartrestapi_enable_logging')) {
            $this->enableLogging = (int)$this->config->get('module_shoppingcartrestapi_enable_logging');
        }

        if ($this->enableLogging) {
            //Log request info
            $now = new DateTime('now');
            $now->format('Y-m-d H:i:s');

            $clientIp = self::getClientIp();
            if(filter_var($clientIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                $clientIp = $this->convertIp($clientIp);
            }
            $headers = $this->getRequestHeaders();
            $this->APILogger(
                array(
                    'request_created' => $now,
                    'request_method' => $_SERVER['REQUEST_METHOD'],
                    'api_endpoint' => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",
                    'ip' => $clientIp,
                    'request_params' => $this->post,
                    'request_headers' => $headers,
                    'response_code' => $this->statusCode,
                    'response' => $this->json,
                )
            );
        }

        if (defined('JSON_UNESCAPED_UNICODE')) {
            $this->response->setOutput(json_encode($this->json, JSON_UNESCAPED_UNICODE));
        } else {
            $this->response->setOutput($this->rawJsonEncode($this->json));
        }

        $this->response->output();

        die;
    }

    public function getHttpStatusMessage($statusCode)
    {
        $httpStatus = array(
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed'
        );

        return ($httpStatus[$statusCode]) ? $httpStatus[$statusCode] : $httpStatus[500];
    }

    private function rawJsonEncode($input, $flags = 0)
    {
        $fails = implode('|', array_filter(array(
            '\\\\',
            $flags & JSON_HEX_TAG ? 'u003[CE]' : '',
            $flags & JSON_HEX_AMP ? 'u0026' : '',
            $flags & JSON_HEX_APOS ? 'u0027' : '',
            $flags & JSON_HEX_QUOT ? 'u0022' : '',
        )));
        $pattern = "/\\\\(?:(?:$fails)(*SKIP)(*FAIL)|u([0-9a-fA-F]{4}))/";
        $callback = function ($m) {
            return html_entity_decode("&#x$m[1];", ENT_QUOTES, 'UTF-8');
        };
        return preg_replace_callback($pattern, $callback, json_encode($input, $flags));
    }

    public function validateToken()
    {
        // Handle a request to a resource and authenticate the access token
        $server = $this->getOauthServer();

        $this->apiRequest = OAuth2\Request::createFromGlobals();

        if (!$server->verifyResourceRequest($this->apiRequest)) {
            $serverResp = $server->getResponse();


            $error_description = $serverResp->getParameter('error_description');

            $this->json['error'] = array(
                'error_description' => !empty($error_description)
                && $error_description != "NULL" ? $error_description : $serverResp->getStatusText()
            );

            $this->statusCode = $serverResp->getStatusCode();

            $this->sendResponse();
        }
    }

    public function getOauthServer()
    {
        //$dsn      = DB_DRIVER.':dbname='.DB_DATABASE.';host='.DB_HOSTNAME;
        $dsn = 'mysql:dbname=' . DB_DATABASE . ';host=' . DB_HOSTNAME;
        $username = DB_USERNAME;
        $password = DB_PASSWORD;

        // Autoloading (composer is preferred, but for this example let's just do this)
        require_once(DIR_EXTENSION . 'restapi/system/oauth2-server-php/src/OAuth2/Autoloader.php');
        \OAuth2\Autoloader::register();

        $config = array(
            'id_lifetime' => $this->config->get('module_shoppingcartrestapi_token_ttl'),
            'access_lifetime' => $this->config->get('module_shoppingcartrestapi_token_ttl')
        );

        // $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
        $storage = new \OAuth2\Storage\Pdo(array('dsn' => $dsn, 'username' => $username, 'password' => $password));

        // Pass a storage object or array of storage objects to the OAuth2 server class
        $oauthServer = new OAuth2\Server($storage, $config);

        // Add the "Client Credentials" grant type (it is the simplest of the grant types)
        $oauthServer->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

        return $oauthServer;
    }

    private function getTokenValue()
    {
        $server = $this->getOauthServer();
        return $server->getAccessTokenData($this->apiRequest);
    }

    private function update_session($token, $data)
    {

        if (isset($data['rest_session_id'])) {
            $oldSession = $this->session->getId();
            $this->session->start($data['rest_session_id']);
            $data['old_session_id'] = $oldSession;
        }

        if (!empty($data)) {
            $this->session->data = $data;
        }

        $this->session->data['token_id'] = $token;

        if (isset($data['customer_id']) && !empty($data['customer_id'])) {
            $this->load->model('account/customer');
            $customer_info = $this->model_account_customer->loginCustomerById($data['customer_id']);

            if ($customer_info) {
                $this->customer->login($customer_info['email'], "", true);
            }

            if ($this->customer->isLogged()) {
                // Logged in customers
                $this->config->set('config_customer_group_id', $this->customer->getGroupId());
            } elseif (isset($this->session->data['guest']) && isset($this->session->data['guest']['customer_group_id'])) {
                $this->config->set('config_customer_group_id', $this->session->data['guest']['customer_group_id']);
            }
        }

        $this->tax->clear();

        if (isset($this->session->data['shipping_address']['country_id'])) {
            $this->tax->setShippingAddress($this->session->data['shipping_address']['country_id'], $this->session->data['shipping_address']['zone_id']);
        } elseif ($this->config->get('config_tax_default') == 'shipping') {
            $this->tax->setShippingAddress($this->config->get('config_country_id'), $this->config->get('config_zone_id'));
        }

        if (isset($this->session->data['payment_address']['country_id'])) {
            $this->tax->setPaymentAddress($this->session->data['payment_address']['country_id'], $this->session->data['payment_address']['zone_id']);
        } elseif ($this->config->get('config_tax_default') == 'payment') {
            $this->tax->setPaymentAddress($this->config->get('config_country_id'), $this->config->get('config_zone_id'));
        }

        $this->tax->setStoreAddress($this->config->get('config_country_id'), $this->config->get('config_zone_id'));

        $this->registry->set('cart', new \Opencart\System\Library\Cart\Cart($this->registry));
    }

    private function setSystemParameters()
    {


        $headers = $this->getRequestHeaders();

        //set currency
        /*if (isset($headers['x-oc-currency'])) {
            $currency = $headers['x-oc-currency'];
            if (!empty($currency)) {
                $this->currency->setRestCurrencyCode($currency);
                $this->session->data['currency'] = $currency;
            } else {
                $this->currency->setRestCurrencyCode($this->session->data['currency']);
            }
        } else {
            $this->currency->setRestCurrencyCode($this->session->data['currency']);
        }*/

        //set store ID
        if (isset($headers['x-oc-store-id'])) {

            $this->config->set('config_store_id', $headers['x-oc-store-id']);

            //overrride current store settings
            $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "setting` WHERE store_id = '0' OR store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY store_id ASC");

            foreach ($query->rows as $result) {
                if (!$result['serialized']) {
                    $this->config->set($result['key'], $result['value']);
                } else {
                    $this->config->set($result['key'], json_decode($result['value'], true));
                }
            }
            // Url
            $this->registry->set('url', new Url($this->config->get('config_url'), $this->config->get('config_ssl')));

        }

        $this->load->model('localisation/language');
        $allLanguages = $this->model_localisation_language->getLanguages();

        if (count($allLanguages) > 1) {
            $this->multilang = 1;
        }

        //set language
        if (isset($headers['x-oc-merchant-language'])) {
            $this->setLanguage($headers['x-oc-merchant-language']);
        } else {
            $this->setLanguage($this->config->get('config_language'));
        }

        if (isset($headers['x-oc-image-dimension'])) {
            $d = $headers['x-oc-image-dimension'];
            $d = explode('x', $d);
            $this->config->set('config_shoppingcartrestapi_image_width', $d[0]);
            $this->config->set('config_shoppingcartrestapi_image_height', $d[1]);
        } else {
            $this->config->set('config_shoppingcartrestapi_image_width', 500);
            $this->config->set('config_shoppingcartrestapi_image_height', 500);
        }
    }

    private function setLanguage($language) {
        $languages = array();
        $this->load->model('localisation/language');
        $all = $this->model_localisation_language->getLanguages();

        foreach ($all as $result) {
            $languages[$result['code']] = $result;
        }
		
        if (isset($languages[$language])) {
            $this->session->data['language'] = $language;
            $this->config->set('config_language', $language);
            $this->config->set('config_language_id', $languages[$language]['language_id']);

            if (isset($languages[$language]['directory']) && !empty($languages[$language]['directory'])) {
                $directory = $languages[$language]['directory'];
            } else {
                $directory = $languages[$language]['code'];
            }

            
			$language_obj = new \Opencart\System\Library\Language($languages[$language]['code']);
			$language_obj->addPath(DIR_LANGUAGE);
			$language_obj->load($languages[$language]['code']);
			$this->registry->set('language', $language_obj);
        }
    }

    private function getRequestHeaders()
    {
        $arh = array();
        $rx_http = '/\AHTTP_/';

        foreach ($_SERVER as $key => $val) {
            if (preg_match($rx_http, $key)) {
                $arh_key = preg_replace($rx_http, '', $key);

                $rx_matches = explode('_', $arh_key);

                if (count($rx_matches) > 0 and strlen($arh_key) > 2) {
                    foreach ($rx_matches as $ak_key => $ak_val) {
                        $rx_matches[$ak_key] = ucfirst($ak_val);
                    }

                    $arh_key = implode('-', $rx_matches);
                }

                $arh[strtolower($arh_key)] = $val;
            }
        }

        return ($arh);

    }

    public function getPost()
    {
        $request = $this->apiRequest;
        $post = $request->request;

        if (!is_array($post) || empty($post)) {
            $this->statusCode = 400;
            $this->json['error'][] = 'Invalid request body, please validate the json object';
            $this->sendResponse();
        }

        $req = new \Opencart\System\Library\Request();
        $post = $req->clean($post);

        $this->post = $post;

        return $post;
    }

    public function returnDeprecated()
    {
        $this->statusCode = 400;
        $this->json['error'] = "This service has been removed for security reasons.Please contact us for more information.";

        return $this->sendResponse();
    }

    public function clearTokensTable($token = null, $sessionid = null)
    {
        //delete all previous token to this session and delete all expired session
        $this->load->model('account/customer');
        $this->model_account_customer->clearTokens($token, $sessionid);
    }


    private function ipValidation()
    {
        $allowedIPs = $this->config->get('module_shoppingcartrestapi_allowed_ip');

        if (!empty($allowedIPs)) {
            $ips = explode(",", $allowedIPs);

            $ips = array_map(
                function ($ip) {
                    return trim($ip);
                },
                $ips
            );

            if (!in_array($_SERVER['REMOTE_ADDR'], $ips)
                || (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && !in_array($_SERVER["HTTP_X_FORWARDED_FOR"], $ips))
            ) {
                return false;
            } else {
                return true;
            }
        }
        return true;
    }


    private function rmkdir($path, $mode = 0777)
    {

        if (!file_exists($path)) {
            $path = rtrim(preg_replace(array("/\\\\/", "/\/{2,}/"), "/", $path), "/");
            $e = explode("/", ltrim($path, "/"));
            if (substr($path, 0, 1) == "/") {
                $e[0] = "/" . $e[0];
            }
            $c = count($e);
            $cp = $e[0];
            for ($i = 1; $i < $c; $i++) {
                if (!is_dir($cp) && !@mkdir($cp, $mode)) {
                    return false;
                }
                $cp .= "/" . $e[$i];
            }
            return @mkdir($path, $mode);
        }

        if (is_writable($path)) {
            return true;
        } else {
            return false;
        }
    }

    private function APILogger($data){

        $year = date("Y");
        $month = date("m");
        $day = date("d");

        //The folder path for our file should be YYYY/MM/DD
        $directory = DIR_LOGS."shopping-cart-api-log/".$year."/".$month."/".$day."/";

        $file = $year.$month.$day.".log";

        $dirOk = $this->rmkdir($directory);

        if($dirOk && file_exists($directory)) {
            file_put_contents($directory.$file, PHP_EOL .json_encode($data), FILE_APPEND);
        }
    }

    public static function getClientIp()
    {

        if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            return $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (
            strtolower($_SERVER['HTTP_HOST']) == 'localhost' ||
            strtolower($_SERVER['SERVER_NAME']) == 'localhost' ||
            $_SERVER['REMOTE_ADDR'] == '::1'
        ) {
            return sprintf(
                '%s.%s.%s.%s',
                rand(1, 255), rand(1, 255), rand(1, 255), rand(1, 255)
            );
        }

        return $_SERVER['REMOTE_ADDR'];
    }

    public function convertIp($ip = null)
    {
        $ip6 = self::parseIp6($ip);
        $ip4 = ($ip6[6] >> 8) . '.' . ($ip6[6] & 0xff) . '.' . ($ip6[7] >> 8) . '.' . ($ip6[7] & 0xff);
        if (!filter_var($ip4, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) || $ip4 === "0.0.0.0")
        {
            return sprintf(
                '%s.%s.%s.%s', rand(1, 255), rand(1, 255), rand(1, 255), rand(1, 255)
            );
        }
        return $ip4;
    }

    public static function parseIp6($str)
    {
        for ($i = 0; $i < 8; $i++)
        {
            $ar[$i] = 0;
        }

        if ($str == "::")
        {
            return $ar;
        }

        $sar = explode(':', $str);
        $slen = count($sar);
        if ($slen > 8)
        {
            $slen = 8;
        }

        $j = 0;
        for ($i = 0; $i < $slen; $i++)
        {
            if ($i && $sar[$i] == "")
            {
                $j = 9 - $slen + $i;
                continue;
            }
            $ar[$j] = hexdec('0x' . $sar[$i]);
            $j++;
        }
        return $ar;
    }
}