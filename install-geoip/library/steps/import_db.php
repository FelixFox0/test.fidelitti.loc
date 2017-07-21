<?php

class ImportDb extends Step {

    public function run() {

        $this->install->queryFromFile('main.sql');

        if (!$this->install->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'geoip' AND `key` = 'geoip_setting'")) {
            $this->install->setError('Не удалось очистить `' . DB_PREFIX . 'setting`');
            return false;
        }

        $settings = 'a:7:{s:8:"set_zone";s:1:"0";s:9:"from_ajax";s:1:"0";s:7:"license";s:0:"";s:12:"popup_active";s:1:"0";s:17:"popup_cookie_time";i:0;s:16:"disable_redirect";s:1:"0";s:6:"domain";s:0:"";}';

        if (!$this->install->query("INSERT INTO `" . DB_PREFIX . "setting` (`store_id`, `code`, `key`, `value`, `serialized`) VALUES (0, 'geoip', 'geoip_setting', '" . $settings . "', 1)")) {
            $this->install->setError('Не удалось записать данные в `' . DB_PREFIX . 'setting`');
            return false;
        }

        $row = $this->install->query("SELECT COUNT(*) total FROM `geoip_city`")->row;

        if (!$row['total']) {
            $this->install->query("INSERT INTO `geoip_city` (`geoip_city_id`, `fias_id`, `name`) VALUES
                            (1, 41, 'Москва'), (2, 3145, 'Воронеж'), (3, 4187, 'Ростов-на-Дону'),
                            (4, 3737, 'Саратов'), (5, 3187, 'Екатеринбург'), (6, 5033, 'Владивосток'),
                            (7, 2638, 'Хабаровск'), (8, 86, 'Санкт-Петербург'), (9, 5147, 'Новосибирск'),
                            (10, 2990, 'Нижний Новгород'), (11, 4006, 'Казань'), (12, 2782, 'Самара'),
                            (13, 3704, 'Омск'), (14, 4778, 'Челябинск'), (15, 6125, 'Уфа'),
                            (16, 3734, 'Волгоград'), (17, 3753, 'Красноярск'), (18, 4131, 'Пермь')");
        }

        return true;
    }
}
