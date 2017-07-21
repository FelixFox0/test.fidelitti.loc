<?php
class ControllerAndroidStoreCurrency extends Controller {
	public function index() {
		$data['action'] = $this->url->link('android_store/currency/currency', '', $this->request->server['HTTPS']);

		$data['code'] = $this->session->data['currency'];

		$this->load->model('localisation/currency');

		$data['currencies'] = array();

		$results = $this->model_localisation_currency->getCurrencies();

		foreach ($results as $result) {
			if ($result['status']) {
				$data['currencies'][] = array(
					'title'        => $result['title'],
					'code'         => $result['code'],
					'symbol_left'  => $result['symbol_left'],
					'symbol_right' => $result['symbol_right']
				);
			}
		}

		if (!isset($this->request->get['route'])) {
			$data['redirect'] = $this->url->link('android_store/home');
		} else {
			$url_data = $this->request->get;

			unset($url_data['_route_']);

			$route = $url_data['route'];

			unset($url_data['route']);

			$url = '';

			if ($url_data) {
				$url = '&' . urldecode(http_build_query($url_data, '', '&'));
			}

			$data['redirect'] = $this->url->link($route, $url, $this->request->server['HTTPS']);
		}

		return $this->load->view('android_store/currency', $data);
	}

	public function currency() {
		$json = array();
		
		if (isset($this->request->post['code'])) {
			$this->session->data['currency'] = $this->request->post['code'];

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
		}

		if (isset($this->request->post['redirect'])) {
			$json['redirect'] = $this->request->post['redirect'];
		} else {
			$json['redirect'] = $this->url->link('android_store/home');
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}