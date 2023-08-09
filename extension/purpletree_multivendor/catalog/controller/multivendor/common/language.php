<?php
namespace Opencart\Catalog\Controller\Extension\PurpletreeMultivendor\Multivendor\Common;
class Language extends \Opencart\System\Engine\Controller {
	public function index() {
		$this->load->language('common/language');

		$url_data = $this->request->get;

		if (isset($url_data['route'])) {
			$route = $url_data['route'];
		} else {
			$route = $this->config->get('action_default');
		}

		unset($url_data['route']);
		unset($url_data['_route_']);
		unset($url_data['language']);

		$url = '';

		if ($url_data) {
			$url .= '&' . urldecode(http_build_query($url_data));
		}

		$data['languages'] = [];

		$this->load->model('localisation/language');

		$results = $this->model_localisation_language->getLanguages();

		foreach ($results as $result) {
			$data['languages'][] = [
				'name'  => $result['name'],
				'code'  => $result['code'],
				'image' => $result['image'],
				'href'  => $this->url->link($route, 'language=' . $result['code'] . $url, true)
			];
		}

		$data['code'] = $this->config->get('config_language');

		return $this->load->view('extension/purpletree_multivendor/multivendor/common/language', $data);
	}

	public function language() {
		if (isset($this->request->post['code'])) {
			$this->session->data['language'] = $this->request->post['code'];
		}

		if (isset($this->request->post['redirect'])) {
			$this->response->redirect($this->request->post['redirect']);
		} else {
			$this->response->redirect($this->url->link('extension/purpletree_multivendor/multivendor/dashboardicons', 'language=' . $this->config->get('config_language')));
		}
	}
}