<?php
class ControllerExtensionModuleASSlideshow extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/androidstore_owl_carousel.js');
		
		// custom css
		if (file_exists(DIR_TEMPLATE . $this->config->get('android_store_template') . '/stylesheet/owl.theme.androidstore-slideshow.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('android_store_template') . '/stylesheet/owl.theme.androidstore-slideshow.css');
		} else {
			$this->document->addStyle('catalog/view/theme/android_store_default/stylesheet/owl.theme.androidstore-slideshow.css');
		}	

		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}

		$data['slide_time'] = $setting['slide_time'] * 1000;
		$data['transition_time'] = $setting['transition_time'] * 1000;
		
		$data['module'] = $module++;

		return $this->load->view('extension/module/as_slideshow', $data);
	}
}