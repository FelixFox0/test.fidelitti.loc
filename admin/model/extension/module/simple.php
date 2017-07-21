<?php
class ModelModuleSimple extends Model {
    public function alterTableOfSettings() {
        $query = $this->db->query('SHOW COLUMNS FROM `' . DB_PREFIX . 'setting`');

        $change = false;

        foreach ($query->rows as $column) {
            if ($column['Field'] == 'value' && $column['Type'] != 'mediumtext') {
                $change = true;
            }
        }

        if ($change) {
            $this->db->query("ALTER TABLE `" . DB_PREFIX . "setting` CHANGE `value` `value` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
        }
    }

    public function createTableForCustomerFields() {
        $this->db->query('CREATE TABLE IF NOT EXISTS `'.DB_PREFIX.'customer_simple_fields` (
                          `customer_id` int(11) NOT NULL,
                          `metadata` text NULL,
                          PRIMARY KEY (`customer_id`)
                          ) ENGINE=MyISAM DEFAULT CHARSET=utf8;');
    }

    public function createTableForAddressFields() {
        $this->db->query('CREATE TABLE IF NOT EXISTS `'.DB_PREFIX.'address_simple_fields` (
                          `address_id` int(11) NOT NULL,
                          `metadata` text NULL,
                          PRIMARY KEY (`address_id`)
                          ) ENGINE=MyISAM DEFAULT CHARSET=utf8;');
    }

    public function createTableForOrderFields() {
        $this->db->query('CREATE TABLE IF NOT EXISTS `'.DB_PREFIX.'order_simple_fields` (
                          `order_id` int(11) NOT NULL,
                          `metadata` text NULL,
                          PRIMARY KEY (`order_id`)
                          ) ENGINE=MyISAM DEFAULT CHARSET=utf8;');
    }

    public function createTableForAbandonedCarts() {
        return;
        $this->db->query('CREATE TABLE IF NOT EXISTS `'.DB_PREFIX.'simple_cart` (
                          `simple_cart_id` int(11) NOT NULL AUTO_INCREMENT,
                          `customer_id` int(11) NULL,
                          `email` varchar(96) NULL,
                          `firstname` varchar(32) NULL,
                          `lastname` varchar(32) NULL,
                          `telephone` varchar(32) NULL,
                          `cart` text NULL,
                          `date_added` datetime NOT NULL,
                          PRIMARY KEY (`simple_cart_id`)
                          ) ENGINE=MyISAM DEFAULT CHARSET=utf8;');
    }

    public function alterTableOfCustomer($fields) {
        $this->alterTable('customer_simple_fields', $fields);
    }

    public function alterTableOfAddress($fields) {
        $this->alterTable('address_simple_fields', $fields);
    }

    public function alterTableOfOrder($fields) {
        $this->alterTable('order_simple_fields', $fields);
    }

    public function createUrlAliases() {
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "url_alias'");

        if ($query->rows) {
            $checkQuery = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'checkout/simplecheckout'");

            if (!$checkQuery->num_rows) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET `query` = 'checkout/simplecheckout', `keyword` = 'simplecheckout'");
            }

            $checkQuery = $this->db->query("SELECT * FROM " . DB_PREFIX . "url_alias WHERE `query` = 'account/simpleregister'");

            if (!$checkQuery->num_rows) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET `query` = 'account/simpleregister', `keyword` = 'simpleregister'");
            }
        }
    }

    public function deleteUrlAliases() {
        $query = $this->db->query("SHOW TABLES LIKE '" . DB_PREFIX . "url_alias'");

        if ($query->rows) {
            $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE `query` = 'checkout/simplecheckout' AND `keyword` = 'simplecheckout'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE `query` = 'account/simpleregister' AND `keyword` = 'simpleregister'");
        }
    }

    private function alterTable($table, $fields) {
        $fields[] = 'metadata';

        $tmp = array();
        $existFields = $this->getColumnsFrom($table);

        foreach ($fields as $field) {
            if (!in_array(strtolower($field), $existFields)) {
                $tmp[] = 'ADD `' . $field . '` TEXT NULL';
            }
        }

        if (count($tmp) > 0) {
            $this->db->query('ALTER TABLE `' . DB_PREFIX . $table . '` ' . implode(',', $tmp));
        }
    }

    private function getColumnsFrom($table) {
        $query = $this->db->query('SHOW COLUMNS FROM ' . DB_PREFIX . $table);

        $result = array();

        foreach ($query->rows as $column) {
            if (empty($column['Key'])) {
                $result[] = strtolower($column['Field']);
            }
        }

        return $result;
    }

    public function addModifications() {
        $this->load->model('extension/modification');

        $mod = $this->model_extension_modification->getModificationByCode('simple url rewrite');

        if (empty($mod)) {
            $this->model_extension_modification->addModification(array(
                'code' => 'simple url rewrite',
                'name' => 'simple url rewrite',
                'author' => 'deeman',
                'version' => '1.0.0',
                'link' => 'http://simpleopencart.com',
                'xml' => '
                <modification>
                    <name>simple url rewrite</name>
                    <code>simple url rewrite</code>
                    <version>1.0.0</version>
                    <author>deeman</author>
                    <link>http://simpleopencart.com</link>

                    <file path="catalog/controller/startup/startup.php">
                        <operation>
                            <search><![CDATA[new Url]]></search>
                            <add position="after"><![CDATA[$this->url->addRewrite(new Simple\Rewrite($this->config));]]></add>
                        </operation>
                    </file>
                </modification>',
                'status' => 1
            ));
        }
    }

    public function deleteModifications() {
        $this->load->model('extension/modification');
        $modification = $this->model_extension_modification->getModificationByCode('simple url rewrite');
        $this->model_extension_modification->deleteModification($modification['modification_id']);
    }
}

class ModelExtensionModuleSimple extends ModelModuleSimple {
}