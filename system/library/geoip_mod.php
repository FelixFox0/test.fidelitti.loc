<?php

    class GeoIP_Mod extends GeoIP {

        /** @var Registry; */
        private $registry;

        /** @var Session */
        private $session;

        /** @var Config */
        private $config;

        /** @var ModelModuleGeoip */
        private $model_module_geoip;

        private $cookie_domain;

        public function __construct($registry) {
            $this->registry = $registry;
            $this->config = $registry->get('config');
            $this->session = $this->registry->get('session');
            $registry->get('load')->model('module/geoip');
            $this->model_module_geoip = $this->registry->get('model_module_geoip');

            $this->setSettings();

            parent::__construct($registry);
            $registry->set('geoip', $this);
        }

        public function setCurrency($force = false) {

            $request = $this->registry->get('request');

            if ($force || !isset($request->cookie['geoip_currency'])) {

                $currency_code = isset($this->session->data['currency']) ? $this->session->data['currency'] : '';
                $code = $this->model_module_geoip->getCurrencyForCountry($this->getCountryId());

                if ($code && $currency_code != $code) {
                    $this->session->data['currency'] = $code;
                    unset($this->session->data['shipping_method']);
                    unset($this->session->data['shipping_methods']);
                    @setcookie('geoip_currency', $code, time() + 60 * 60 * 24 * 30, '/', $this->cookie_domain);
                }
            }
        }

        private function setSettings() {
            $query = $this->registry->get('db')->query(
                "SELECT * FROM `" . DB_PREFIX . "setting`\n"
                . "WHERE (store_id = '0' OR store_id = '" . (int)$this->config->get('config_store_id') . "')\n"
                . " AND code = 'geoip' AND `key` = 'geoip_setting'\n"
                . "ORDER BY store_id ASC");

            foreach ($query->rows as $result) {
                if (!$result['serialized']) {
                    $this->config->set($result['key'], $result['value']);
                }
                else {
                    $this->config->set($result['key'], json_decode($result['value'], true));
                }
            }
        }
    }