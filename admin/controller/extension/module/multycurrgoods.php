<?php
class ControllerExtensionModuleMultycurrgoods extends Controller {
	private $error = array();

	public function index() {
    $data['token'] = $this->session->data['token'];
		$this->load->language('extension/module/multycurrgoods');

		$this->document->setTitle('Мультивалютные товары v. 2.0');
		
		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		  }

		$data['heading_title'] = $this->language->get('heading_title');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$data['action_cron'] = $this->url->link('extension/module/multycurrgoods/save_cron_tab', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

    $data['round_mode'] = 2;
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `code` = 'multycurrgoods' AND `key` = 'round_mode'");
    if ($query->row) $data['round_mode'] = $query->row['value'];
    if (($data['round_mode']<-2)||($data['round_mode']>3)) $data['round_mode'] = 2;

    $data['save_mode'] = 0;
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `code` = 'multycurrgoods' AND `key` = 'save_mode'");
    if ($query->row) $data['save_mode'] = $query->row['value'];
    if ($data['save_mode']!=0) $data['save_mode'] = 1;

// - Закрузка списка валют --
		$data['currencies'] = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "currency" . " ORDER BY title" . " ASC");

		foreach ($query->rows as $result) {
      $r     = $this->db->query("SELECT COUNT(`product_id`) AS total FROM " . DB_PREFIX . "product_multycurr WHERE currency_id = '" . $result['currency_id'] . "'");
      $key  = "currency_id" . $result['currency_id'] . "LastValue";
  		$last = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `code` = 'multycurrgoods' AND `key` = '" . $key . "'");
      $lastvalue =  $result['value']?1/$result['value']:0;
      if ($last->num_rows) $lastvalue = $last->row['value'];
			$data['currencies'][$result['currency_id']] = array(
				'currency_id'   => $result['currency_id'],
				'title'         => $result['title'] . (($result['code'] == $this->config->get('config_currency')) ? $this->language->get('text_default') : null),
				'code'          => $result['code'],
				'value'         => round ( $result['value']?1/$result['value']:0, 4),
				'last'          => $lastvalue,
 				'total'         => $r->row['total']
         );
		}	
// - Закрузка истории --
    $data['log'] = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_multycurr_history" . " ORDER BY dateof DESC");
		foreach ($query->rows as $result1) {
			$data['log'][] = array(
				'id'            => $result1['id'],
				'date'          => $result1['dateof'],
				'user'          => $result1['user'],
				'code'          => $result1['currency_id'],
				'kurs'          => $result1['kurs'],
 				'total'         => $result1['total']
         );
        }
// - Загрузка списка поставщиков  --
		$data['suppliers'] = array();
    $query  = $this->db->query("SELECT DISTINCT supplier FROM " . DB_PREFIX . "product_to_supplier" . " ORDER BY supplier");
		foreach ($query->rows as $result) {
      $totals = $this->db->query("SELECT COUNT(`product_id`) AS total FROM " . DB_PREFIX . "product_to_supplier WHERE supplier = '" . $this->db->escape($result['supplier']) . "'");
			$data['suppliers'][] = array(
				'name'   => $result['supplier'],
        'total'  => $totals->row?$totals->row['total']:0
        );
      }
// Загружаем список производителей
    $data['manufacturer'] = array();
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "manufacturer ORDER by name");
    foreach ($query->rows as $result) {
      $totals = array();
      foreach ($data['currencies'] as $curr) {   
        $currency_id = $curr['currency_id'];
        $c_query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_multycurr pm LEFT JOIN " . DB_PREFIX . "product p ON (pm.product_id = p.product_id) WHERE pm.currency_id = '" . $currency_id . "' AND p.manufacturer_id = '" . $result['manufacturer_id'] . "'");
        $totals [$curr['currency_id']] = array( 'total' => $c_query->row['total'] );
        }
			$data['manufacturer'][] = array(
				'manufacturer_id'    => $result['manufacturer_id'],
        'totals'             => $totals,
 				'name'               => $result['name']
         );
      }

    $data['mccron'] = array ();
		$data['mccron'] = $this->getSetting('mccron');		

		$this->response->setOutput($this->load->view('extension/module/multycurrgoods.tpl', $data));
	}

public function start () {
	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
   // Обрабатываем запрос  из модуля на пересчет по новому курсу для ЗАДАЧИ
    $total              = 0;
    $currency_id        = $this->request->post['currency_id'];
    $manufacturer_id    = $this->request->post['manufacturer_id'];
    $name               = $this->request->post['supplier'];
    $add_before         = $this->request->post['add_before'];
    $mul_after          = $this->request->post['mul_after'];
    $add_after          = $this->request->post['add_after'];
    $round_mode         = $this->request->post['round_mode'];
    $kurs               = round($this->request->post['kurs'],$this->request->post['curr_round_mode']);
    
    $sql = "SELECT pm.product_id,pm.price FROM "  . DB_PREFIX . "product_multycurr pm";
    if ($manufacturer_id>0) $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (pm.product_id = p.product_id)"; 
    if ($name!='0')         $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_supplier p2s ON (pm.product_id = p2s.product_id)"; 
                            $sql .= " WHERE pm.currency_id = '" . $currency_id . "'";
    if ($manufacturer_id>0) $sql .= " AND p.manufacturer_id = '" . $manufacturer_id . "'"; 
    if ($name!='0')         $sql .= " AND p2s.supplier = '" . $this->db->escape($name) . "'"; 
                            $sql .= " GROUP BY pm.product_id";
    $query = $this->db->query($sql);
    foreach ($query->rows as $product) {
      $product_id = $product['product_id'];
      $price = round (($product['price'] + $add_before) * $kurs * $mul_after + $add_after, $round_mode);
		  $this->db->query("UPDATE " . DB_PREFIX . "product SET price = '" . (float)$price . "', date_modified = NOW() WHERE product_id = '" . (int)$product_id . "'");
      $total ++;
      // Таблица "Акции"
     $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_multycurr_special WHERE product_id = '" . (int)$product_id . "' AND currency_id = '" . $currency_id . "'");
	   foreach ($query->rows as $result) {
          $price = round (($result['mc_price'] + $add_before) * $kurs * $mul_after + $add_after, $round_mode);
		      $this->db->query("UPDATE " . DB_PREFIX . "product_special SET price = '" . (float)$price . "' WHERE product_special_id = '" . (int)$result['product_special_id'] . "'");
          }
    // Таблица "Скидки"
     $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_multycurr_discount WHERE product_id = '" . (int)$product_id . "' AND currency_id = '" . $currency_id . "'");
	   foreach ($query->rows as $result) {
          $price = round (($result['mc_price'] + $add_before) * $kurs * $mul_after + $add_after, $round_mode);
		      $this->db->query("UPDATE " . DB_PREFIX . "product_discount SET price = '" . (float)$price . "' WHERE product_discount_id = '" . (int)$result['product_discount_id'] . "'");
          }
    // Таблица "Опции"
     $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_multycurr_option WHERE product_id = '" . (int)$product_id . "' AND currency_id = '" . $currency_id . "'");
	   foreach ($query->rows as $result) {
          $price = round (($result['mc_price'] + $add_before) * $kurs * $mul_after + $add_after, $round_mode);
		      $this->db->query("UPDATE " . DB_PREFIX . "product_option_value SET price = '" . (float)$price . "' WHERE product_option_value_id = '" . (int)$result['product_option_value_id'] . "'");
          }
        }
    // Записываем в ЛОГ
    $this->db->query("INSERT INTO " . DB_PREFIX . "product_multycurr_history SET kurs = '" . $kurs . "', total = '" . $total . "', currency_id = '" . $currency_id . "', user = '" . $this->user->getUserName() . "', dateof = NOW()");

    $data['save_mode'] = 0;
    $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `code` = 'multycurrgoods' AND `key` = 'save_mode'");
    if ($query->row) $data['save_mode'] = $query->row['value'];
    if ($data['save_mode']!=0) {
  		$this->db->query("UPDATE " . DB_PREFIX . "currency SET date_modified = NOW(), value = '" . (float)(1/$kurs) . "' WHERE currency_id = '" . $currency_id . "'");
      }
    }
	$this->response->redirect($this->url->link('extension/module/multycurrgoods', 'token=' . $this->session->data['token'] . '&type=module', true));
  }
  
public function save_cron_tab () {
	if (($this->request->server['REQUEST_METHOD'] == 'POST')&&$this->validate()&&(isset($this->request->post['mccron']))) {
    $this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = 'mccron'");
    foreach ($this->request->post['mccron'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET `code` = 'mccron', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape(json_encode($value)) . "', serialized = '1'");
      }
		$this->session->data['mc_success'] = 'Настройки планировщика сохранены!';
		$this->response->redirect($this->url->link('extension/module/multycurrgoods', 'token=' . $this->session->data['token'] . '&type=module', true));
    }
  }	

public function settings  () {
	if (($this->request->server['REQUEST_METHOD'] == 'POST')&&$this->validate()) {
    if (isset($this->request->post['round_mode'])) {
      $this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = 'multycurrgoods' AND `key` = 'round_mode'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET `code` = 'multycurrgoods', `key` = 'round_mode', `value` = '" . $this->db->escape($this->request->post['round_mode']) . "'");
      }
    if (isset($this->request->post['save_mode'])) {
      $this->db->query("DELETE FROM " . DB_PREFIX . "setting WHERE `code` = 'multycurrgoods' AND `key` = 'save_mode'");
			$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET `code` = 'multycurrgoods', `key` = 'save_mode', `value` = '" . $this->db->escape($this->request->post['save_mode']) . "'");
      }
		$this->session->data['mc_success'] = 'Настройки сохранены!';
		$this->response->redirect($this->url->link('extension/module/multycurrgoods', 'token=' . $this->session->data['token'] . '&type=module', true));
    }
  }	

public function del_history_row () {
	if (($this->request->server['REQUEST_METHOD'] == 'POST')&&$this->validate()&&(isset($this->request->post['id']))) {
    $this->db->query("DELETE FROM " . DB_PREFIX . "product_multycurr_history WHERE `id` = '" . $this->request->post['id'] . "'");
		$this->session->data['mc_success'] = 'Запись удалена!';
		$this->response->redirect($this->url->link('extension/module/multycurrgoods', 'token=' . $this->session->data['token'] . '&type=module', true));
    }
  }	

public function del_history () {
	if (($this->request->server['REQUEST_METHOD'] == 'POST')&&$this->validate()) {
    $this->db->query("TRUNCATE TABLE " . DB_PREFIX . "product_multycurr_history");
		$this->session->data['mc_success'] = 'Лог очищен!';
		$this->response->redirect($this->url->link('extension/module/multycurrgoods', 'token=' . $this->session->data['token'] . '&type=module', true));
    }
  }	

  protected function getSetting($group) {
		$mydata = array(); 
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `code` = '" . $this->db->escape($group) . "' ORDER BY `key`");
		foreach ($query->rows as $result) $mydata[$result['key']] = json_decode($result['value'], true);
    return $mydata; 
  }

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/multycurrgoods')) $this->error['warning'] = $this->language->get('error_permission');
		return !$this->error;
	}

  public function install() {
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_multycurr (product_id INT(11), price decimal(15,4), currency_id INT(11), PRIMARY KEY (product_id))");
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_multycurr_history (id INT(11) AUTO_INCREMENT, dateof DATETIME NOT NULL, user VARCHAR(32), currency_id INT(11), kurs decimal(15,4), vendor INT(11), total INT(11), PRIMARY KEY (id))");
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_multycurr_special (product_special_id INT(11), product_id INT(11), mc_price decimal(15,4), currency_id INT(11), PRIMARY KEY (product_special_id))");
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_multycurr_discount (product_discount_id INT(11), product_id INT(11), mc_price decimal(15,4), currency_id INT(11), PRIMARY KEY (product_discount_id))");
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_multycurr_option (id INT(11) AUTO_INCREMENT, product_option_value_id INT(11), product_id INT(11), mc_price decimal(15,4), currency_id INT(11), PRIMARY KEY (id))");
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_input_price (product_id INT(11), iprice decimal(15,4), currency_id INT(11), PRIMARY KEY (product_id))");
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_to_ym (product_id INT(11), ym INT(11), PRIMARY KEY (product_id))");
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_to_supplier (product_id INT(11), supplier VARCHAR(32), PRIMARY KEY (product_id))");
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_sliv (product_id INT(11), sliv INT(2), PRIMARY KEY (product_id))");
  	$this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_country_of_origin (product_id INT(11), country VARCHAR(32), PRIMARY KEY (product_id))");
    // -- Регистрация модуля в системе --
		$this->load->model('setting/setting');
    $data = "module=Мультивалютные товары 2.0";
    $data.= "&mail=";
    $data.= $this->config->get('config_email');
    $data.= "&store=";
    $data.= $this->config->get('config_name');
    $data.= "&www=";
    $data.= $_SERVER['SERVER_NAME'];
    $data.= "&ip=";
    $data.= $_SERVER['SERVER_ADDR'];
    $ch = curl_init(); curl_setopt($ch, CURLOPT_URL, ""); curl_setopt($ch, CURLOPT_POST, 1); curl_setopt($ch, CURLOPT_POSTFIELDS, $data ); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); $server_output = curl_exec ($ch); curl_close ($ch);    
		$settings = array();
    $settings[] = array(
			'round_mode'        => 0,
      'reg_mail'          => $this->config->get('config_email'),
      'reg_store'         => $this->config->get('config_name'),
      'reg_www'           => $_SERVER['SERVER_NAME'],
      'reg_ip'            => $_SERVER['SERVER_ADDR'],
			'reg_name'          => "Мультивалютные товары 2.0" 
       );
    $this->model_setting_setting->editSetting('multycurrgoods', $settings );
		$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET `code` = 'multycurrgoods', `key` = 'round_mode', `value` = '2'");
		$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET `code` = 'multycurrgoods', `key` = 'save_mode', `value` = '0'");
    }

}