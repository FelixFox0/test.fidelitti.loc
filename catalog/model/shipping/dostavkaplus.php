<?php
class ModelShippingDostavkaPlus extends Model {
    private $type = 'shipping';
    private $name = 'dostavkaplus';

    public function getQuote($address, $code = '') {
        $this->language->load($this->type . '/' . $this->name);

        $method_data = array();

        if ($this->config->get($this->name.'_status') == true) {
            $quote_data = array();

            $arr_lock = array();
            $arr_unlock = array();

            if (is_array($this->config->get($this->name.'_module')) and count($this->config->get($this->name.'_module')) > 0) {

                foreach($this->config->get($this->name.'_module') as $key => $module) {

                    $arr_error = array();

                    if ($module['status'] == 1) {

                        if (isset($module['group']) and is_array($module['group']) and in_array((int)$this->customer->getGroupId(), $module['group'])) {

                            if (isset($module['store']) and is_array($module['store']) and in_array((int)$this->config->get('config_store_id'), $module['store'])) {

                                $status = true;

                                $total_data = array();
                                $order_total = 0;
                                $taxes = $this->cart->getTaxes();


                                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "extension WHERE `type` = 'total'");
                                $order_totals = $query->rows;
                                $sort_order = array();
                                foreach ($order_totals as $k => $value) {
                                    $sort_order[$k] = $this->config->get($value['code'] . '_sort_order');
                                }
                                array_multisort($sort_order, SORT_ASC, $order_totals);

                                //print_r($order_totals);

                                foreach ($order_totals as $ot) {
                                    if ($ot['code'] != $this->type) {
                                        if ($this->config->get($ot['code'] . '_status')) {

                                            //echo $ot['code']."\n";

                                            $this->load->model('total/' . $ot['code']);
                                            $this->{'model_total_' . $ot['code']}->getTotal($total_data, $order_total, $taxes);
                                        }
                                    }

                                    if ($ot['code'] == $module['total_value']) {
                                        break;
                                    }
                                }

                                //echo $module['title'][$this->config->get('config_language_id')].'=='.$module['total_value'];
                                //echo ">>>>".$order_total."<<<<<br/>\n\n\n";

                                $total = $order_total;

                                $weight = $this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $module['weight_class_id']);

                                if (isset($module['geo_zone']) and is_array($module['geo_zone']) and count($module['geo_zone']) > 0 ) {

                                    $sql = "SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone
                                        WHERE geo_zone_id IN (" . implode(',', $module['geo_zone']) . ") AND country_id = " . (int)$address['country_id'] . "
                                        AND (zone_id = " . (int)$address['zone_id'] . " OR zone_id = 0)";

                                    $query = $this->db->query($sql);
                                    if ($query->num_rows) {
                                        $status = true;

                                        if ($module['city_rate'] != '' and isset($address['city']) and $address['city'] != '') {
                                            $rates = explode(',', $module['city_rate']);

                                            if (count($rates) > 0) {
                                                foreach ($rates as $rate) {
                                                    $data = trim($rate);

                                                    if (mb_strtolower($data, 'UTF-8') == mb_strtolower(trim($address['city']), 'UTF-8')) {
                                                        $arr_lock[] = $key;
                                                    }
                                                }
                                            }
                                        }


                                        if ($module['city_rate2'] != '' and isset($address['city']) and $address['city'] != '') {
                                            $rates = explode(',', $module['city_rate2']);
                                            //print_r($rates);
                                            if (count($rates) > 0) {
                                                foreach ($rates as $rate) {
                                                    $data = trim($rate);

                                                    if (mb_strtolower($data, 'UTF-8') == mb_strtolower(trim($address['city']), 'UTF-8')) {
                                                        $arr_unlock[] = $key;
                                                    }
                                                }
                                            }
                                        }


                                        if ( !in_array($key,$arr_lock)
                                            and (empty($module['city_rate2']) or (!empty($module['city_rate2']) and in_array($key,$arr_unlock)))
                                        ) {
                                            $status = true;
                                        }
                                        else {
                                            if (isset($module['bibb']) and in_array('zone',$module['bibb'])) {
                                                $arr_error[] = $this->language->get('error_description_zone');
                                            }
                                            $status = false;
                                        }
                                    }
                                    else {
                                        if (isset($module['bibb']) and in_array('zone',$module['bibb'])) {
                                            $arr_error[] = $this->language->get('error_description_zone');
                                        }
                                        $status = false;
                                    }
                                }


                                if ($status == true) {
                                    if (isset($module['filter_group_id']) and $module['filter_group_id'] > 0) {
                                        $in_group = true;

                                        $this->load->model('module/product_groups');

                                        $products = $this->cart->getProducts();
                                        foreach ($products as $product) {
                                            $locals_in_group = $this->model_module_product_groups->isProductInGroup($product['product_id'], $module['filter_group_id']);
                                            if ($locals_in_group == false) {
                                                $in_group = false;
                                                break;
                                            }
                                        }

                                        if ($in_group == false) {
                                            $status = false;
                                        }
                                    }
                                }


                                if ($status == true) {
                                    if (isset($module['bibb']) and in_array('quantity',$module['bibb'])) {
                                        $in_stock = true;

                                        $products = $this->cart->getProducts();
                                        foreach ($products as $product) {
                                            if (!$product['stock']) {
                                                $in_stock = false;
                                                break;
                                            }
                                        }

                                        if ($in_stock == false) {
                                            $arr_error[] = $this->language->get('error_description_quantity');
                                            $status = false;
                                        }
                                    }
                                }


                                if ($status == true) {
                                    if (!isset($module['min_total'])) {
                                        $module['min_total'] = 0;
                                    }

                                    if (!isset($module['max_total'])) {
                                        $module['max_total'] = 0;
                                    }

                                    $module['min_total'] = (int)$module['min_total'];
                                    $module['max_total'] = (int)$module['max_total'];

                                    if (($module['min_total'] > 0 and $module['max_total'] > 0 and $total >= $module['min_total'] and $total < $module['max_total']) or
                                        ($module['min_total'] > 0 and $module['max_total'] == 0 and $total >= $module['min_total']) or
                                        ($module['max_total'] > 0 and $module['min_total'] == 0 and $total < $module['max_total']) or
                                        ($module['max_total'] == 0 and $module['min_total'] == 0)) {

                                        $status = true;
                                    }
                                    else {
                                        if (isset($module['bibb']) and in_array('total',$module['bibb']) and $total < (float)$module['min_total']) {
                                            $arr_error[] = html_entity_decode(sprintf($this->language->get('error_description_total'), $this->currency->format($this->tax->calculate($module['min_total'],'', $this->config->get('config_tax'))), $this->currency->format($this->tax->calculate($module['min_total']-$total,'', $this->config->get('config_tax')))), ENT_QUOTES, 'UTF-8');
                                        }
                                        $status = false;
                                    }
                                }


                                if ($status == true) {
                                    if (!isset($module['min_weight'])) {
                                        $module['min_weight'] = 0;
                                    }

                                    if (!isset($module['max_weight'])) {
                                        $module['max_weight'] = 0;
                                    }

                                    $module['min_weight'] = (int)$module['min_weight'];
                                    $module['max_weight'] = (int)$module['max_weight'];

                                    if (($module['min_weight'] > 0 and $module['max_weight'] > 0 and $weight >= $module['min_weight'] and $weight < $module['max_weight']) or
                                        ($module['min_weight'] > 0 and $module['max_weight'] == 0 and $weight >= $module['min_weight']) or
                                        ($module['max_weight'] > 0 and $module['min_weight'] == 0 and $weight < $module['max_weight']) or
                                        ($module['max_weight'] == 0 and $module['min_weight'] == 0)) {

                                        $status = true;
                                    }
                                    else {
                                        $weight_unit = $this->weight->getUnit($module['weight_class_id']);

                                        if (isset($module['bibb']) and in_array('weight',$module['bibb']) and $weight > (float)$module['max_weight']) {
                                            $arr_error[] = sprintf($this->language->get('error_description_weight'), $module['max_weight'].' '.$weight_unit, ($weight - $module['max_weight']).' '.$weight_unit);
                                        }
                                        $status = false;
                                    }
                                }


                                if ($status == true or ($status == false and count($arr_error) > 0)) {
                                    //print_r($module);

                                    $price = $module['price'];

                                    if ($module['rate'] != '') {
                                        $rates = explode(',', $module['rate']);

                                        if (count($rates) > 0) {
                                            foreach ($rates as $rate) {
                                                $data = explode(':', $rate);

                                                $data[0] = trim($data[0]);

                                                if ($data[0] >= $weight) {
                                                    if (isset($data[1])) {
                                                        $price = trim($data[1]);
                                                    }

                                                    break;
                                                }
                                            }
                                        }
                                    }


                                    if (isset($module['cost']) and $module['cost'] != '') {
                                        $price = $price + (int)$module['cost'];
                                    }

                                    if (!isset($module['image'])) {
                                        $module['image'] = '';
                                    }

                                    $title = html_entity_decode($module['title'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');

                                    if (isset($module['info'][$this->config->get('config_language_id')])) {
                                        $description = html_entity_decode($module['info'][$this->config->get('config_language_id')]);
                                    }
                                    else {
                                        $description = '';
                                    }


                                    if ($price == 0) {
                                        if (isset($module['price_text']) and !empty($module['price_text'])) {
                                            $text = trim($module['price_text']);
                                        }
                                        else {
                                            $text = $this->language->get('text_free');
                                        }
                                    }
                                    else {
                                        $text = $this->currency->format($this->tax->calculate($price, $this->config->get($this->name.'_tax_class_id'), $this->config->get('config_tax')));
                                    }


                                    $quote_data['sh'.$key] = array(
                                        'code'            => $this->name.'.sh'.$key,
                                        'title'           => $title,
                                        'image'           => $module['image'],
                                        'cost'            => $price,
                                        'dummy'           => isset($arr_error[0]) ? $arr_error[0] : '',
                                        'description'     => isset($arr_error[0]) ? $arr_error[0] : $description,
                                        'tax_class_id'    => $this->config->get($this->name.'_tax_class_id'),
                                        'sort_order'      => isset($arr_error[0]) ? ($module['sort_order'] + 1000) : $module['sort_order'],
                                        'text'            => isset($arr_error[0]) ? '' : $text,
                                        'error'           => isset($arr_error[0]) ? true : false
                                    );

                                    if (isset($arr_error[0])) {
                                        $error = true;
                                    }
                                    //print_R($quote_data['sh'.$key]);
                                }
                            }
                        }
                    }
                }
            }

            if (isset($quote_data) and count($quote_data) > 0) {
                $sort_by = array();
                foreach ($quote_data as $key => $value) $sort_by[$key] = $value['sort_order'];
                array_multisort($sort_by, SORT_ASC, $quote_data);
            }

            if ((isset($quote_data) and count($quote_data) > 0) or isset($error)) {
                $title = $this->config->get($this->name.'_name');

                $method_data = array(
                    'code'       => $this->name,
                    'title'      => html_entity_decode($title[$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8'),
                    'quote'      => $quote_data,
                    'error'      => false,
                    'sort_order' => isset($error) ? ($this->config->get($this->name.'_sort_order') + 1000) : $this->config->get($this->name.'_sort_order')
                );
            }
        }
//print_r($method_data);
        return $method_data;
    }
}
?>