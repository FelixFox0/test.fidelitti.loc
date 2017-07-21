<?php
class ControllerXCheckoutXFooter extends Controller {
	public $data=array();
	public function index() {
		$this->load->model('catalog/information');
		$this->data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$this->data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		for($i=1;$i<8;$i++){
			if (file_exists(DIR_APPLICATION .'/view/theme/xtensions/image/payment/p'.$i.'.png')) {
				$this->data['payment_images'][]= array('url'=>$server .'catalog/view/theme/xtensions/image/payment/p'.$i.'.png');
			} else {
				$this->data['payment_images'][] = array('url'=>'');
			}
		}
		$this->language->load('common/footer');
		$this->data['text_contact'] = $this->language->get('text_contact');
		$this->data['contact'] = $this->url->link('information/contact');
		$this->data['telephone'] = $this->config->get('config_telephone');
		$this->data['email'] = $this->config->get('config_email');

		$this->template = 'xtensions/template/checkout/xfooter.tpl';
		return $this->xtensions->renderView($this);
	}
}
?>