<?php

class ImportDb extends Step {

    public function run() {
        $this->install->queryFromFile('main.sql');

        if (!$this->install->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'geoip' AND `key` = 'geoip_setting'")) {
            $this->install->setError('Не удалось очистить `' . DB_PREFIX . 'setting`');
            return false;
        }

        if (!$this->install->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'progroman_cm'")) {
            $this->install->setError('Не удалось очистить `' . DB_PREFIX . 'setting`');
            return false;
        }

        $settings = '{"use_geoip":"1","popup_cookie_time":2592000,"enable_switch_messages":"1","enable_switch_redirects":"1","enable_switch_currency":"1","enable_switch_customer_group":"1"}';
        if (!$this->install->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES (0, 'progroman_cm', 'progroman_cm_setting', '" . $settings . "', 1)")) {
            $this->install->setError('Не удалось записать данные в `' . DB_PREFIX . 'setting`');
            return false;
        }

        $this->exportFromOldVersion();
        $this->fillCities();

        return true;
    }

    private function exportFromOldVersion() {
        $this->exportCities();
        $this->exportRedirects();
        $this->exportCurrencies();
        $this->exportMessages();
    }

    private function exportCities() {
        $total = $this->install->query("SELECT COUNT(*) total FROM `prmn_cm_city`")->row;
        if (!$total['total']) {
            $row = $this->install->query("SHOW TABLES LIKE 'geoip_city'")->row;
            if ($row) {
                $this->install->query("INSERT INTO `prmn_cm_city` (SELECT * FROM `geoip_city`)");
            }
        }
    }

    private function exportRedirects() {
        $total = $this->install->query("SELECT COUNT(*) total FROM `prmn_cm_redirect`")->row;
        if (!$total['total']) {
            $row = $this->install->query("SHOW TABLES LIKE 'geoip_redirect'")->row;
            if ($row) {
                $this->install->query("INSERT INTO `prmn_cm_redirect` (SELECT * FROM `geoip_redirect`)");
            }
        }
    }

    private function exportCurrencies() {
        $total = $this->install->query("SELECT COUNT(*) total FROM `prmn_cm_currency`")->row;
        if (!$total['total']) {
            $row = $this->install->query("SHOW TABLES LIKE 'geoip_currency'")->row;
            if ($row) {
                $this->install->query("INSERT INTO `prmn_cm_currency` (SELECT * FROM `geoip_currency`)");
            }
        }
    }

    private function exportMessages() {
        $total = $this->install->query("SELECT COUNT(*) total FROM `prmn_cm_message`")->row;
        if (!$total['total']) {
            $row = $this->install->query("SHOW TABLES LIKE 'geoip_rule'")->row;
            if ($row) {
                $this->install->query("INSERT INTO `prmn_cm_message` (SELECT * FROM `geoip_rule`)");
            }
        }
    }

    private function fillCities() {
        $row = $this->install->query("SELECT COUNT(*) total FROM `prmn_cm_city`")->row;
        if (!$row['total']) {
            $this->install->query(
                "INSERT INTO `prmn_cm_city` (`id`, `fias_id`, `name`) VALUES
                    (1, 41, 'Москва'), (2, 3145, 'Воронеж'), (3, 4187, 'Ростов-на-Дону'), (4, 3737, 'Саратов'), 
                    (5, 3187, 'Екатеринбург'), (6, 5033, 'Владивосток'), (7, 2638, 'Хабаровск'), 
                    (8, 86, 'Санкт-Петербург'), (9, 5147, 'Новосибирск'), (10, 2990, 'Нижний Новгород'), 
                    (11, 4006, 'Казань'), (12, 2782, 'Самара'), (13, 3704, 'Омск'), (14, 4778, 'Челябинск'), 
                    (15, 6125, 'Уфа'), (16, 3734, 'Волгоград'), (17, 3753, 'Красноярск'), (18, 4131, 'Пермь')"
            );
        }
    }
}
