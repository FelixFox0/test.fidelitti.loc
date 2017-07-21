<?php
/**
* Extended common classes 12
* @author qooaen@gmail.com
* @version 1.2
*/

require_once(DIR_SYSTEM.'library/ECSimpleSQLStorage.php');

abstract class ECController12 extends Controller {

	protected $s;
	protected $children = array();
	protected $data = array();
	protected $template;

	public function __construct($registry) {

		parent::__construct($registry);
		$this->s = ECSimpleSQLStorage::instance($registry->get('db'));
		$this->data['z'] = $this;
	}

	public function __invoke($key) {

		echo $this->language->get($key);
	}

	protected function redirect($url, $status = 302) {
		header('Status: ' . $status);
		header('Location: ' . str_replace('&amp;', '&', $url));
		die();
	}

	protected function render() {

		if (is_callable('Controller::render')) {
			return parent::render();
		} elseif(is_callable(array($this->load, 'controller')) && is_callable(array($this->load, 'view'))) {
			foreach ($this->children as $child) {
				$this->data[basename($child)] = $this->load->controller($child);
			}
			return $this->load->view($this->template, $this->data);
		}
		throw new Exception("Error Processing Request");
	}

	public function l($key) {

		return $this->language->get($key);
	}

	public function c($name, $field = null) {

		$value = $this->config->get($name);
		if (null === $value && isset($this->_config[$name]['defaultValue'])) {
			$value = $this->_config[$name]['defaultValue'];
		}
		if ($field) {
			if (null !== $value && is_array($value) && isset($value[$field])) {
				return $value[$field];
			} else {
				return null;
			}
		}
		return $value;
	}

	public function m($name) {

		$canonicalName = explode('/', $name);
		$canonicalName = 'model_' . $canonicalName[0] . '_' . $canonicalName[1];
		if (!($this->$canonicalName)) {
			$this->load->model($name);
		}
		return $this->$canonicalName;
	}

}

abstract class ECModel12 extends Model {

	protected $s;

	public function __construct($registry) {

		parent::__construct($registry);
		$this->s = ECSimpleSQLStorage::instance($registry->get('db'));
	}

	public function l($key) {

		return $this->language->get($key);
	}

	public function c($name, $field = null) {

		$value = $this->config->get($name);
		if (null === $value && isset($this->_config[$name]['defaultValue'])) {
			$value = $this->_config[$name]['defaultValue'];
		}
		if ($field) {
			if (null !== $value && is_array($value) && isset($value[$field])) {
				return $value[$field];
			} else {
				return null;
			}
		}
		return $value;
	}

	protected function m($name) {

		$canonicalName = explode('/', $name);
		$canonicalName = 'model_' . $canonicalName[0] . '_' . $canonicalName[1];
		if (!($this->$canonicalName)) {
			$this->load->model($name);
		}
		return $this->$canonicalName;
	}

}

?>