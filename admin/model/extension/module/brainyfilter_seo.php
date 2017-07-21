<?php
require_once DIR_SYSTEM . 'library/sqllib.php';
/**
 * Brainy Filter SEO model class for back-end.
 * 
 * Brainy Filter SEO Plugin 1.0.2 OC2.3, September 22, 2016 / brainyfilter.com 
 * Copyright 2015-2016 Giant Leap Lab / www.giantleaplab.com 
 * License: Commercial. Reselling of this software or its derivatives is not allowed. You may use this software for one website ONLY including all its subdomains if the top level domain belongs to you and all subdomains are parts of the same OpenCart store. 
 * Support: http://support.giantleaplab.com
 */
class ModelExtensionModuleBrainyFilterSeo extends Model 
{
    const TBL_SEF_TERM = 'bf_sef_term';
    
    public $settings = array();
    
    protected $_cache = null;
    
    public function __construct($registry) 
    {
        parent::__construct($registry);
        
        SqlStatement::$DB_PREFIX = DB_PREFIX;
        SqlStatement::$DB_CONNECTOR = $this->db;
        
        setlocale(LC_ALL, 'en_US.UTF8');
        
        $this->settings = $this->config->get('brainyfilter_seo');
    }
    

    /**
     * @todo: develop the table structure
     **/
    public function createSefTermsTable()
    {
        
        $this->db->query('CREATE TABLE IF NOT EXISTS `' . DB_PREFIX . self::TBL_SEF_TERM . '` (
           `filter_group` varchar(10) NOT NULL,
            `filter_id` int(11) NOT NULL,
            `name` varchar(20) NOT NULL,
            `replaced` varchar(20) NOT NULL,
            PRIMARY KEY (`filter_group`,`filter_id`),
            KEY `name` (`name`)
          ) ENGINE=MyISAM DEFAULT CHARSET=utf8;');
    }
    
    public function dropSefTermsTable() 
    {
        $this->db->query('DROP TABLE IF EXISTS ' . DB_PREFIX . self::TBL_SEF_TERM);
    }
    
    public function truncateSefTermTable()
    {
        $this->db->query('TRUNCATE TABLE ' . DB_PREFIX . self::TBL_SEF_TERM);
    }

    protected function _getAllFetchSqlQueries($requested = array())
    {
        $defLanguage = $this->getDefaultLanguageId();
        
        $sqls = array();
        $s = new SqlStatement();
        $s->select(array('filter_group' => '"c0"', 'filter_id' => 'category_id', 'name'))->from('category_description')->where('language_id = ?', array($defLanguage));
        $sqls['category'] = $s;
        
        $s = new SqlStatement();
        $s->select(array('filter_group' => '"m0"', 'filter_id' => 'manufacturer_id', 'name'))->from('manufacturer');
        $sqls['manufacturer'] = $s;
        
        $s = new SqlStatement();
        $s->select(array('filter_group' => 'CONCAT("a", attribute_id)', 'filter_id' => '"0"', 'name'))->from('attribute_description')->where('language_id = ?', array($defLanguage));
        $sqls['attribute'] = $s;
        
        $s = new SqlStatement();
        $s->select(array('filter_group' => 'CONCAT("a", attribute_id)', 'filter_id' => 'attribute_value_id', 'name' => 'value'))->from('bf_attribute_value')->where('language_id = ?', array($defLanguage));
        $sqls['attribute_value'] = $s;
        
        $s = new SqlStatement();
        $s->select(array('filter_group' => 'CONCAT("o", option_id)', 'filter_id' => '"0"', 'name'))->from('option_description')->where('language_id = ?', array($defLanguage));
        $sqls['option'] = $s;
        
        $s = new SqlStatement();
        $s->select(array('filter_group' => 'CONCAT("o", option_id)', 'filter_id' => 'option_value_id', 'name'))->from('option_value_description')->where('language_id = ?', array($defLanguage));
        $sqls['option_value'] = $s;
        
        $s = new SqlStatement();
        $s->select(array('filter_group' => 'CONCAT("f", filter_group_id)', 'filter_id' => '"0"', 'name'))->from('filter_group_description')->where('language_id = ?', array($defLanguage));
        $sqls['filter'] = $s;
        
        $s = new SqlStatement();
        $s->select(array('filter_group' => 'CONCAT("f", filter_group_id)', 'filter_id' => 'filter_id', 'name'))->from('filter_description')->where('language_id = ?', array($defLanguage));
        $sqls['filter_value'] = $s;
        
        $s = new SqlStatement();
        $s->select(array('filter_group' => '"s0"', 'filter_id' => 'stock_status_id', 'name'))->from('stock_status')->where('language_id = ?', array($defLanguage));
        $sqls['stock_status'] = $s;
        
        if (!empty($requested)) {
            $reqSqls = array();
            foreach ($requested as $type) {
                $reqSqls[$type] = $sqls[$type];
            }
        } else {
            $reqSqls = $sqls;
        }
        
        return $reqSqls;
    }
    
    public function generateSefTerms()
    {
        $this->truncateSefTermTable();
        
        $sqls = $this->_getAllFetchSqlQueries();
        
        $step = 10000;
        
        foreach ($sqls as $sql) {
            $i = 0;
            do {
                $sql->limit($step, $i * $step);
                $res = $this->db->query($sql);

                if (!$res->num_rows) {
                    break;
                }

                foreach ($res->rows as &$row) {
                    $row['name'] = $this->transformTerm($row['name'], $this->settings['transliteration'], $this->settings['lowercase']);
                }

                $saveSql = new SqlStatement();
                $saveSql->insertInto(self::TBL_SEF_TERM, $res->rows);
                $this->db->query($saveSql);

                $i ++;
            } while ($res->num_rows === $step);
        }
        
        $commonWords = array(
            array('filter_group' => 'm0', 'filter_id' => 0, 'name' => 'brand'),
            array('filter_group' => 'k0', 'filter_id' => 0, 'name' => 'keywords'),
            array('filter_group' => 's0', 'filter_id' => 0, 'name' => 'stock-status'),
            array('filter_group' => 'p0', 'filter_id' => 0, 'name' => 'price'),
            array('filter_group' => 'c0', 'filter_id' => 0, 'name' => 'category'),
            array('filter_group' => 'r0', 'filter_id' => 0, 'name' => 'rating'),
            array('filter_group' => 'r0', 'filter_id' => 1, 'name' => 'awful'),
            array('filter_group' => 'r0', 'filter_id' => 2, 'name' => 'poor'),
            array('filter_group' => 'r0', 'filter_id' => 3, 'name' => 'fair'),
            array('filter_group' => 'r0', 'filter_id' => 4, 'name' => 'good'),
            array('filter_group' => 'r0', 'filter_id' => 5, 'name' => 'excelent'),
        );
        $saveSql = new SqlStatement();
        $saveSql->insertInto(self::TBL_SEF_TERM, $commonWords);
        $this->db->query($saveSql);
    }
    
    public function updateTerm($filterGroupId, $filterId, $name)
    {
        if (!empty($name)) {
            $name = $this->transformTerm($name, $this->settings['transliteration'], $this->settings['lowercase']);
            $name = $this->db->escape($name);
            $sql = new SqlStatement();
            $sql->insertInto(self::TBL_SEF_TERM, array(array('filter_group' => $filterGroupId, 'filter_id' => $filterId, 'name' => $name)))->ignore();
            $this->db->query($sql);
            if (!$this->db->countAffected()) {
                $sql = "UPDATE " . DB_PREFIX . self::TBL_SEF_TERM . "
                        SET name = IF(replaced = '', '{$name}', name),
                            replaced = IF(replaced = '', '', '{$name}')
                        WHERE filter_group = '" . $this->db->escape($filterGroupId) . "'
                        AND  filter_id = '" . $this->db->escape($filterId) . "'";
                $this->db->query($sql);
            }
        } else {
            $sql = new SqlStatement();
            $sql->delete()
                ->from(self::TBL_SEF_TERM)
                ->where('filter_group = ?', $filterGroupId)
                ->where('filter_id = ?', $filterId);
            
            $this->db->query($sql);
        }
    }
    
    public function updateTermsRelativeToProduct($productId) 
    {
        $this->load->model('catalog/product');
        $this->load->model('catalog/attribute');
        $this->load->model('catalog/filter');
        $this->load->model('catalog/option');
        $this->load->model('catalog/category');
        $attributes = $this->model_catalog_product->getProductAttributes($productId);
        if (count($attributes)) {
            foreach ($attributes as $attr) {
                $fid = 'a' . $attr['attribute_id'];
                $val = $attr['product_attribute_description'][$this->getDefaultLanguageId()]['text'];
                $sql = new SqlStatement();
                $sql->select(array('attribute_value_id'))
                    ->from('bf_attribute_value')
                    ->where('attribute_id = ?', $attr['attribute_id'])
                    ->where('value = ?', $val)
                    ->where('language_id = ?', $this->getDefaultLanguageId());
                
                $res = $this->db->query($sql);
                if (!empty($res->row)) {
                    $this->updateTerm($fid, $res->row['attribute_value_id'], $val);
                }
                $attribute = $this->model_catalog_attribute->getAttribute($attr['attribute_id']);
                $this->updateTerm($fid, 0, $attribute['name']);
            }
        }
        $options = $this->model_catalog_product->getProductOptions($productId);
        if (count($options)) {
            foreach ($options as $opt) {
                $fid = 'o' . $opt['option_id'];
                $updated = array();
                if (!isset($updated[$fid])) {
                    $this->updateTerm($fid, 0, $opt['name']);
                    $updated[$fid] = true;
                }
                if (!empty($opt['product_option_value'])) {
                    foreach ($opt['product_option_value'] as $optValData) {
                        $optValId = $optValData['option_value_id'];
                        $optVal = $this->model_catalog_option->getOptionValue($optValId);
                        $this->updateTerm($fid, $optValId, $optVal['name']);
                    }
                }
            }
        }
        $filters = $this->model_catalog_product->getProductFilters($productId);
        if (count($filters)) {
            $updated = array();
            foreach ($filters as $filterId) {
                $filter = $this->model_catalog_filter->getFilter($filterId);
                $fid = 'f' . $filter['filter_group_id'];
                $this->updateTerm($fid, $filterId, $filter['name']);
                if (!isset($updated[$fid])) {
                    $this->updateTerm($fid, 0, $filter['group']);
                    $updated[$fid] = true;
                }
            }
        }
        
        $categories = $this->model_catalog_product->getProductCategories($productId);
        if (count($categories)) {
            foreach ($categories as $catId) {
                $category = $this->model_catalog_category->getCategory($catId);
                $this->updateTerm('c0', $catId, $category['name']);
            }
        }
        
        $sql = new SqlStatement();
        $sql->select(array('p.manufacturer_id', 'm.name'))
            ->from(array('p' => 'product'))
            ->innerJoin(array('m' => 'manufacturer'), 'p.manufacturer_id = m.manufacturer_id')
            ->where('product_id = ?', $productId);
        $res = $this->db->query($sql);
        if ($res->num_rows) {
            $this->updateTerm('m0', $res->row['manufacturer_id'], $res->row['name']);
        }
    }
    
    public function transformTerm($term, $transliteration = false, $lowercase = false)
    {
        $term = $this->applyReplacementRules($term);
        $term = trim($term);
        if ($transliteration) {
            $term = $this->transliterate($term);
        } else {
            $term = $this->removeUrlSpecialChars($term);
        }
        $term = $this->removeSeparatorSpecialChars($term);
        
        if ($lowercase) {
            if (function_exists('mb_strtolower')) {
                $term = mb_strtolower($term, 'UTF8');
            }
        }
        
        return $term;
    }
    
    
    public function transliterate($term, $delimiter = '-')
    {
        $cyrilic = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
            
            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        $term = strtr($term, $cyrilic);

       
        $term = iconv('UTF-8', 'ASCII//TRANSLIT', $term);
        $term = preg_replace("/[^a-zA-Z0-9\/_\+\-\s]/", '', $term);
        $term = preg_replace("/[\/\+\-\s]+/", $delimiter, $term);

        return $term;
    }
    
    public function removeUrlSpecialChars($term)
    {
        $specialChars = array(
            '=' => '', '?' => '', '&' => '',
        );
        $term = strtr($term, $specialChars);
        
        return $term;
    }
    
    public function applyReplacementRules($term)
    {
        if (!isset($this->_cache['rules'])) {
            $this->_cache['rules'] = array();
            if (!empty($this->settings['rules'])) {
                foreach ($this->settings['rules'] as $rule) {
                    if ($rule['enabled']) {
                        $this->_cache['rules'][$rule['target']] = $rule['replacement'];
                    }
                }
            }
        }
        if (!empty($this->_cache['rules'])) {
            $term = strtr($term, $this->_cache['rules']);
        }
        return $term;
    }
    
    public function removeSeparatorSpecialChars($term)
    {
        $separators = array(
            $this->settings['separator']['next_filter']    => '',
            $this->settings['separator']['values_start']   => '',
            $this->settings['separator']['list_separator'] => '',
            $this->settings['separator']['range_separator'] => '',
        );
        
        $term = strtr($term, $separators);
        
        return $term;
    }
    
    public function getDefaultLanguageId()
    {
        if (!isset($this->_cache['default_lang'])) {
            $sql = new SqlStatement();
            $sql->select(array('language_id'))->from('language')->where('code = ?', array($this->config->get('config_language')));
            $res = $this->db->query($sql);
            if ($res->row) {
                $this->_cache['default_lang'] = $res->row['language_id'];
            } else {
                $this->_cache['default_lang'] = false;
            }
        }
        return $this->_cache['default_lang'];
    }
    
    public function findFilters($type, $query)
    {
        $limit = 10;
        
        
        if ($type === 'a') {
            $sqls = $this->_getAllFetchSqlQueries(array('attribute', 'attribute_value'));
        } elseif ($type === 'o') {
            $sqls = $this->_getAllFetchSqlQueries(array('option', 'option_value'));
        } elseif ($type === 'f') {
            $sqls = $this->_getAllFetchSqlQueries(array('filter', 'filter_value'));
        } elseif ($type === 's') {
            $sqls = $this->_getAllFetchSqlQueries(array('stock_status'));
        } elseif ($type === 'm') {
            $sqls = $this->_getAllFetchSqlQueries(array('manufacturer'));
        } elseif ($type === 'c') {
            $sqls = $this->_getAllFetchSqlQueries(array('category'));
        } elseif ($type === 'x') {
            $sqls = array();
        } else {
            $sqls = $this->_getAllFetchSqlQueries();
        }
        
        $rows = array();
        
        foreach ($sqls as $k => $sql) {
            if (!$limit) {
                break;
            }
            if ($k === 'attribute_value') {
                $sql->where('value LIKE "' . $this->db->escape($query) . '%"');
            } else {
                $sql->where('name LIKE "' . $this->db->escape($query) . '%"');
            }
            $sql->limit($limit);
            
            $res = $this->db->query($sql);
            $limit -= $res->num_rows;
            $rows = array_merge($rows, $res->rows);
        }
        
        if (count($rows)) {
            foreach ($rows as &$row) {
                $row['name'] = html_entity_decode($row['name']);
                $row['gen_name'] = $this->transformTerm($row['name'], $this->settings['transliteration'], $this->settings['lowercase']);
            }
        } elseif ($type === 'x') {
            $this->load->language('module/brainyfilter_seo');
            $rows = array(
                array('filter_group' => 'm0', 'filter_id' => 0, 'name' => $this->language->get('seo_select_manufacturer'), 'gen_name' => 'brand'),
                array('filter_group' => 'c0', 'filter_id' => 0, 'name' => $this->language->get('seo_select_category'), 'gen_name' => 'category'),
                array('filter_group' => 'k0', 'filter_id' => 0, 'name' => $this->language->get('seo_select_keywords'), 'gen_name' => 'keywords'),
                array('filter_group' => 'p0', 'filter_id' => 0, 'name' => $this->language->get('seo_select_price'), 'gen_name' => 'price'),
                array('filter_group' => 'r0', 'filter_id' => 0, 'name' => $this->language->get('seo_select_rating'), 'gen_name' => 'rating'),
                array('filter_group' => 'r0', 'filter_id' => 1, 'name' => $this->language->get('seo_select_rating_1'), 'gen_name' => 'awful'),
                array('filter_group' => 'r0', 'filter_id' => 2, 'name' => $this->language->get('seo_select_rating_2'), 'gen_name' => 'poor'),
                array('filter_group' => 'r0', 'filter_id' => 3, 'name' => $this->language->get('seo_select_rating_3'), 'gen_name' => 'fair'),
                array('filter_group' => 'r0', 'filter_id' => 4, 'name' => $this->language->get('seo_select_rating_4'), 'gen_name' => 'good'),
                array('filter_group' => 'r0', 'filter_id' => 5, 'name' => $this->language->get('seo_select_rating_5'), 'gen_name' => 'excelent'),
                array('filter_group' => 's0', 'filter_id' => 0, 'name' => $this->language->get('seo_select_stock_status'), 'gen_name' => 'stock-status'),
            );
        }
        
        return $rows;
    }

    public function getCustomReplacements()
    {
        $types = array('a' => 'attribute', 'o' => 'option', 'f' => 'filter', 'm' => 'manufacturer', 's' => 'stock_status', 'c' => 'category');
        $commonTermOrigNames = array(
            'm' => $this->language->get('seo_select_manufacturer'),
            'k' => $this->language->get('seo_select_keywords'),
            's' => $this->language->get('seo_select_stock_status'),
            'p' => $this->language->get('seo_select_price'),
            'r' => $this->language->get('seo_select_rating'),
            'c' => $this->language->get('seo_select_category'),
        );
        
        $sql = new SqlStatement();
        $sql->select(array('filter_group', 'filter_id', 'name' => 'replaced', 'custom_name' => 'name'))
            ->from(self::TBL_SEF_TERM)
            ->where('replaced != ""');
        
        $res = $this->db->query($sql);
        
        $filters = array();
        $result  = array();
        if ($res->num_rows) {
            foreach ($res->rows as $row) {
                $t = $row['filter_group'][0];
                if (isset($types[$t])) {
                    $type = $types[$t];
                    if (in_array($t, array('a','o','f','r')) && $row['filter_id'] > 0) {
                        $type .= '_value';
                    }
                    if (!isset($filters[$type])) {
                        $filters[$type] = array();
                    }
                    if ($row['filter_id'] > 0) {
                        $filters[$type][] = $row['filter_id'];
                    } else {
                        $filters[$type][] = substr($row['filter_group'], 1);
                    }
                }
                if (!$row['filter_id'] && isset($commonTermOrigNames[$t])) {
                    $row['orig_name'] = $commonTermOrigNames[$t];
                } elseif($t === 'r' && $row['filter_id']) {
                    $row['orig_name'] = $row['filter_id'];
                }
                $result[$row['filter_group'] . ':' . $row['filter_id']] = $row;
            }
        }
        
        if (!empty($filters)) {
            $sqls = $this->_getAllFetchSqlQueries();
            foreach ($filters as $type => $arr) {
                $sql = $sqls[$type];
                if ($type === 'filter') {
                    $idColumn = 'filter_group_id';
                } elseif ($type === 'filter_value') {
                    $idColumn = 'filter_id';
                } else {
                    $idColumn = $type . '_id';
                }
                $sql->where($idColumn . ' IN (' . implode(',', $arr) . ')');
                $res = $this->db->query($sql);
                if ($res->num_rows) {
                    foreach ($res->rows as $row) {
                        $uid = $row['filter_group'] .':' . $row['filter_id'];
                        if (isset($result[$uid])) {
                            $result[$uid]['orig_name'] = $row['name'];
                        }
                    }
                }
            }
        }
        usort($result, array(__CLASS__, '_sortCustomReplacements'));
        
        return array_values($result);
    }
    
    private function _sortCustomReplacements($a, $b)
    {
        if (function_exists('mb_strtolower')) {
            $a['orig_name'] = mb_strtolower($a['orig_name'], 'UTF8');
            $b['orig_name'] = mb_strtolower($b['orig_name'], 'UTF8');
            $a['custom_name'] = mb_strtolower($a['custom_name'], 'UTF8');
            $b['custom_name'] = mb_strtolower($b['custom_name'], 'UTF8');
        }
        if ($a['orig_name'] == $b['orig_name']) {
            if ($a['custom_name'] == $b['custom_name']) {
                return 0;
            }
            return $a['custom_name'] > $b['custom_name'] ? 1 : -1;
        }
        return $a['orig_name'] > $b['orig_name'] ? 1 : -1;
    }


    public function saveCustomReplacements($data)
    {
        $this->db->query("UPDATE " . DB_PREFIX . self::TBL_SEF_TERM . " SET replaced = '' WHERE replaced != ''");
        
        if (!empty($data)) {
            foreach ($data as $row) {
                $customName = $this->transformTerm($row['custom_name']);
                $sql = "UPDATE " . DB_PREFIX . self::TBL_SEF_TERM . " "
                     . "SET replaced = name, name = '" . $this->db->escape($customName) . "' "
                     . "WHERE filter_group = '" . $this->db->escape($row['filter_group']) . "' "
                     . "AND filter_id = '" . $this->db->escape($row['filter_id']) . "'";
                
                $this->db->query($sql);
            }
        }
    }
    
    public function checkForDuplicates($term = null, $filterGroup = null)
    {
        $sql = new SqlStatement();
        $sql->select(array('fgroup' => 'IF (filter_id = 0, 0, filter_group)', 'name', 'c' => 'COUNT(*)'))
             ->from(array('t' => self::TBL_SEF_TERM))
             ->group(array('fgroup', 'name'))
             ->having('c > 1');
        
        if ($filterGroup && $term) {
            $sql->where('(name = ?', $term);
            $sql->where('(filter_group = ?', $filterGroup);
        }
        
        $duplicates = $this->db->query($sql);
        $result = array();
        if ($duplicates->num_rows) {
            $types = array('a' => 'attribute', 'o' => 'option', 'f' => 'filter', 'm' => 'manufacturer', 's' => 'stock_status', 'c' => 'category');
            foreach ($duplicates->rows as $row) {
                if ($row['fgroup']) {
                    $t = substr($row['fgroup'], 0, 1);
                    if (isset($types[$t])) {
                        $type = $types[$t];
                        $sqls = $this->_getAllFetchSqlQueries();
                        $gid = substr($row['fgroup'], 1);
                        if ($gid) {
                            $sqls[$type]->where($type . ($t === 'f' ? '_group' : '') . '_id = ?', $gid);
                            $res = $this->db->query($sqls[$type]);
                            if ($res->num_rows) {
                                $result[] = array(
                                    'filter_group_name' => $res->row['name'],
                                    'filter_group_type' => $type,
                                    'duplicate' => $row['name'],
                                );
                            }
                        } else {
                            $result[] = array(
                                'filter_group_type' => $type,
                                'duplicate' => $row['name'],
                            );
                        }
                    }
                } else {
                    $result[] = array(
                        'duplicate' => $row['name'],
                    );
                }
            }
        }
        
        return $result;
    }
}