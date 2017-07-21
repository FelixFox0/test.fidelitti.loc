<?php
require_once DIR_SYSTEM . 'library/sqllib.php';

/**
 * Brainy Filter SEO Plugin 1.0.2 OC2.3, September 22, 2016 / brainyfilter.com 
 * Copyright 2015-2016 Giant Leap Lab / www.giantleaplab.com 
 * License: Commercial. Reselling of this software or its derivatives is not allowed. You may use this software for one website ONLY including all its subdomains if the top level domain belongs to you and all subdomains are parts of the same OpenCart store. 
 * Support: http://support.giantleaplab.com
 */
class ModelExtensionModuleBrainyFilterSeo extends Model 
{
    const TBL_SEF_TERM = 'bf_sef_term';
    
    protected $settigns;
    
    protected static $cache = array();
    
    public function __construct($registry) 
    {
        parent::__construct($registry);
        
        SqlStatement::$DB_PREFIX = DB_PREFIX;
        SqlStatement::$DB_CONNECTOR = $this->db;
        
        $this->settigns = $this->config->get('brainyfilter_seo');
    }
    
    public function rewriteFilterGetParam()
    {
        $paramName = $this->getSetting('param_name');
        
        if (!empty($this->request->get['bfilter']) && $paramName !== 'bfilter') {
            return;
        }
                
        if (!isset($this->request->get[$paramName])) {
            return false;
        }
        
        if ($this->isBFParamSef($this->request->get[$paramName])) {
            return false;
        }
        
        $param = $this->request->get[$paramName];
        
        if (!isset(self::$cache[$param])) 
        {
            $data = $this->parseSefParam($param);

            $data = $this->convertToIds($data);

            $convertedStr = $this->toString($data);
            self::$cache[$param] = $convertedStr;
        } else {
            $convertedStr = self::$cache[$param];
        }
        
        if (!empty($convertedStr)) {
            $this->request->get['bfilter'] = $convertedStr;
        }
    }
    
    public function parseSefParam($str)
    {
        $data = array();
        
        $nextFilterSep = $this->getSetting('separator.next_filter');
        $openingSep    = $this->getSetting('separator.values_start');
        $len = utf8_strlen($str);
        $offset = 0;
        $eof = null;
        
        while (is_null($eof) || $eof < $len)
        {
            $eof = utf8_strpos($str, $nextFilterSep, $offset);
            if ($nextFilterSep === $openingSep && $eof !== false) {
                $eof = utf8_strpos($str, $nextFilterSep, $eof + 1);
            }
            $eof = $eof === false ? $len : $eof;
            
            $parsed = $this->parseFilter(utf8_substr($str, $offset, $eof - $offset));
            
            if ($parsed) {
                $parsed['isRange'] = isset($parsed['values']['min']) ? true : false;
                $data[] = $parsed;
            }
            
            $offset = $eof + utf8_strlen($nextFilterSep);
            $offset = $offset > $len ? $len : $offset;
        }
        
        return $data;
    }
    
    protected function toString($data)
    {
        if (!count($data)) {
            return;
        }
        $filters = array();
        foreach ($data as $fid => $values) {
            if (isset($values['min'])) {
                $filters[] = $fid . ':' . (isset($values['min']) ? $values['min'] : 'na') . '-' . (isset($values['max']) ? $values['max'] : 'na');
            } else {
                $filters[] = $fid . ':' . implode(',', $values);
            }
        }
        
        return implode(';', $filters);
    }
    
    protected function parseFilter($str)
    {
        $startSeparator = $this->getSetting('separator.values_start');
        $endSeparator   = $this->getSetting('separator.values_end');
        
        $s = utf8_strpos($str, $startSeparator);
        if ($s === false) {
            return false;
        }
        
        $filter = utf8_substr($str, 0, $s);
        $values = utf8_substr($str, $s + utf8_strlen($startSeparator));
        
        if (!empty($endSeparator)) {
            $values = utf8_substr($values, 0, utf8_strrpos($values, $endSeparator));
        }
        
        $values = $this->parseFilterValues($values);
        
        return array(
            'filter' => $filter,
            'values' => $values,
        );
    }

    protected function parseFilterValues($str)
    {
        if ($this->containsRangeOfValues($str)) 
        {
            $p = explode($this->getSetting('separator.range_separator'), $str);
            return array(
                'min' => $p[0],
                'max' => $p[1],
            );
        } 
        elseif ($this->containsListOfValues($str)) 
        {
            return explode($this->getSetting('separator.list_separator'), $str);
        }
        
        return array($str);
    }

    protected function containsListOfValues($str)
    {
        return utf8_strpos($str, $this->getSetting('separator.list_separator')) !== false;
    }
    
    protected function containsRangeOfValues($str) 
    {
        return utf8_strpos($str, $this->getSetting('separator.range_separator')) !== false;
    }
    
    protected function getSetting($setting, $default = null)
    {
        $nm = explode('.', $setting);
        if (count($nm)) {
            $isset = true;
            $var = $this->settigns;
            foreach ($nm as $p) {
                if (isset($var[$p])) {
                    $var = $var[$p];
                } else {
                    $isset = false;
                    break;
                }
            }
            
        }
        if ($isset) {
            return $var;
        }
        return $default;
    }
    
    protected function dbQuote($param)
    {
        return '"' . $this->db->escape($param) . '"';
    }

    protected function convertToSortOrder($id, $min = null, $max = null)
    {
        $type = substr($id, 0, 1);
        $sql1 = new SqlStatement();
        $sql2 = new SqlStatement();
        
        $tables = array(
            'a' => array('table' => 'bf_attribute_value', 'idField' => 'attribute_value_id'),
            'f' => array('table' => 'filter',             'idField' => 'filter_id'),
            'o' => array('table' => 'option_value',       'idField' => 'option_value_id'),
        );
        
        $table = $tables[$type]['table'];
        $idField = $tables[$type]['idField'];
        
        if ($min) {
            $sql1->select(array('sort_order', 'type' => '"min"'))->from($table)->where("$idField = ?", $min);
        }
        if ($max) {
            $sql2->select(array('sort_order', 'type' => '"max"'))->from($table)->where("$idField = ?", $max);
        }
        
        $res = $this->db->query(implode(' UNION ', array($sql1, $sql2)));
        
        $output = array();
        foreach ($res->rows as $row) {
            $output[$row['type']] = $row['sort_order'];
        }
        
        return $output;
    }
    
    public function convertToIds($data) 
    {
        if (empty($data)) {
            return array();
        }
        $filterNameToIsRange  = array();
        $filterNameToValues   = array();
        $filterIdToFilterName = array();
        foreach ($data as $item) {
            $filterNameToIsRange[$item['filter']] = isset($item['isRange']) ? $item['isRange'] : false;
            $filterNameToValues[$item['filter']] = $item['values'];
        }
        
        $sql = new SqlStatement;
        
        $sql->select(array('filter_group', 'name'))
            ->from(self::TBL_SEF_TERM)
            ->where('filter_id = 0')
            ->where('(name IN (' . implode(',', array_map(array($this, 'dbQuote'), array_keys($filterNameToIsRange))) . '))');
        
        $res = $this->db->query($sql);
        
        if ($res && !$res->num_rows) {
            return array();
        }
        
        foreach ($res->rows as $row) {
            if ($row['filter_group'] === 'p0') {
                $row['filter_group'] = 'price';
            }
            if ($row['filter_group'] === 'k0') {
                $row['filter_group'] = 'search';
            }
            $filterIdToFilterName[$row['filter_group']] = $row['name'];
        }

        $result = array();
        
        // check for price filter
        if (isset($filterIdToFilterName['price'])) {
            $result['price'] = $filterNameToValues[ $filterIdToFilterName[ 'price' ] ];
        }
        // check for keywords filter
        if (isset($filterIdToFilterName['search'])) {
            $result['search'] = $filterNameToValues[ $filterIdToFilterName[ 'search' ] ];
        }
        
        $orConditions = array();
        foreach ($filterIdToFilterName as $fid => $filterName) {
            if ($fid !== 'price' && $fid !== 'search') {
                $values = $filterNameToValues[$filterName];
                $orConditions[] = array('(filter_group = ? AND name IN (' . implode(',', array_map(array($this, 'dbQuote'), $values)) . '))', $fid);
            }
        }
        
        if (empty($orConditions)) {
            return $result;
        }
        
        $sql->clean()
            ->select(array('filter_group', 'filter_id', 'name'))
            ->from(self::TBL_SEF_TERM)
            ->where('filter_id != 0')
            ->multipleWhere($orConditions);

        $res = $this->db->query($sql);
        
        // match filter values
        foreach ($res->rows as $row) {
            if (!isset($result[$row['filter_group']])) {
                $result[$row['filter_group']] = array();
            }
            $isRange = $filterNameToIsRange[ $filterIdToFilterName[ $row[ 'filter_group' ] ] ];
            if (!$isRange) {
                $result[$row['filter_group']][] = $row['filter_id'];
            } else {
                $realValues = $filterNameToValues[ $filterIdToFilterName[ $row[ 'filter_group' ] ] ];
                $pos = array_search($row['name'], $realValues);
                if ($pos === 'min') {
                    $result[$row['filter_group']]['min'] = $row['filter_id'];
                } elseif ($pos === 'max') {
                    $result[$row['filter_group']]['max'] = $row['filter_id'];
                }
            }
        }
        
        // convert range values to a plain list of values
        foreach ($result as $fid => &$values) {
            $isRange = $filterNameToIsRange[$filterIdToFilterName[$fid]];
            if ($isRange && $fid !== 'price') {
                $values = $this->convertToSortOrder($fid, $values['min'], $values['max']);
            }
        }
        
        return $result;
    }
    
    public function getSefUrl($bfConditions)
    {
        $this->legacyBFCondition($bfConditions);
        
        $sefParts = array();
        $conditions = array();
        if (isset($bfConditions->price)) {
            $sefParts['p0'] = array('min' => $bfConditions->price->min, 'max' => $bfConditions->price->max);
            $conditions[] = 'filter_group = "p0" AND filter_id = "0"';
        }
        if ($bfConditions->search) {
            $sefParts['k0'] = array('values' => array($bfConditions->search));
            $conditions[] = 'filter_group = "k0" AND filter_id = "0"';
        }
        if (count($bfConditions->filters)) {
            foreach ($bfConditions->filters as $fid => $values) {
                $qValues = $values;
                if (isset($values['min']) || isset($values['max'])) {
                    $qValues = array();
                    $sefParts[$fid] = array('min' => 'na', 'max' => 'na');
                    if (isset($values['min']) && $values['min'] !== 'na') {
                        $min = $this->getFilterValueWithSortOrder($fid, $values['min']);
                        $sefParts[$fid]['min'] = $min;
                        $qValues[] = $min;
                    }
                    if (isset($values['max']) && $values['max'] !== 'na') {
                        $max = $this->getFilterValueWithSortOrder($fid, $values['max']);
                        $sefParts[$fid]['max'] = $max;
                        $qValues[] = $max;
                    }
                }
                $qValues[] = 0;
                $conditions[] = array('filter_group = ? AND filter_id IN (' . implode(',', array_map(array($this, 'dbQuote'), $qValues)) . ')', $fid);
            }
        }
        
        if (count($conditions)) {
            $sql = new SqlStatement();
            $sql->select(array('fid' => 'filter_group', 'filter_id', 'name'))
                ->from(self::TBL_SEF_TERM)
                ->multipleWhere($conditions);
            $res = $this->db->query($sql);
            if ($res->num_rows) {
                foreach ($res->rows as $row) {
                    if (!isset($sefParts[$row['fid']])) {
                        $sefParts[$row['fid']] = array();
                    }
                    if ($row['filter_id'] == 0) {
                        $sefParts[$row['fid']]['filter'] = $row['name'];
                    } elseif (isset($sefParts[$row['fid']]['min']) && $sefParts[$row['fid']]['min'] == $row['filter_id']) {
                        $sefParts[$row['fid']]['min'] = $row['name'];
                    } elseif (isset($sefParts[$row['fid']]['max']) && $sefParts[$row['fid']]['max'] == $row['filter_id']) {
                        $sefParts[$row['fid']]['max'] = $row['name'];
                    } else {
                        $sefParts[$row['fid']]['values'][] = $row['name'];
                    }
                }
            }
        }
        
        // put filtering by keywords to the end of the resulting SEF URL string
        if (isset($sefParts['k0'])) {
            $k0 = $sefParts['k0'];
            unset($sefParts['k0']);
            $sefParts['k0'] = $k0;
        }
        
        $strs = array();
        foreach ($sefParts as $part) {
            $rangeMin = isset($part['min']) ? $part['min'] : 'na';
            $rangeMax = isset($part['max']) ? $part['max'] : 'na';
            
            if ($rangeMax !== 'na' || $rangeMin !== 'na') {
                $strs[] = $part['filter'] . $this->getSetting('separator.values_start') . $rangeMin . $this->getSetting('separator.range_separator') . $rangeMax . $this->getSetting('separator.values_end');
            } elseif (isset($part['values']) && isset($part['filter'])) {
                $strs[] = $part['filter'] . $this->getSetting('separator.values_start') . implode($this->getSetting('separator.list_separator'), $part['values']) . $this->getSetting('separator.values_end');
            }
        }
        return implode($this->getSetting('separator.next_filter'), $strs);
    }
    
    /**
     * Resolves compatibility issue for BF 4.7.2 and lower
     * @param stdClass $bfConditions
     */
    protected function legacyBFCondition ($bfConditions)
    {
        if (!isset($bfConditions->filters)) {
            $attributes = array();
            if (is_array($bfConditions->attribute)) {
                foreach ($bfConditions->attribute as $id => $values) {
                    $attributes['a' . $id] = $values;
                }
            }
            $options = array();
            if (is_array($bfConditions->option)) {
                foreach ($bfConditions->option as $id => $values) {
                    $options['o' . $id] = $values;
                }
            }
            $filters = array();
            if (is_array($bfConditions->filter)) {
                foreach ($bfConditions->filter as $id => $values) {
                    $filters['f' . $id] = $values;
                }
            }
            $bfConditions->filters = array_merge(
                    $attributes, 
                    $options, 
                    $filters, 
                    (!empty($bfConditions->category)) ? array('c0' => $bfConditions->category[0]) : array(),
                    (!empty($bfConditions->manufacturer)) ? array('m0' => $bfConditions->manufacturer[0]) : array(),
                    (!empty($bfConditions->stock_status)) ? array('s0' => $bfConditions->stock_status[0]) : array(),
                    (!empty($bfConditions->rating)) ? array('r0' => $bfConditions->rating[0]) : array()
                );
        }
    }
    
    public function getFilterValueWithSortOrder($filterId, $sortOrder)
    {
        $type = substr($filterId, 0, 1);
        $numb = substr($filterId, 1);
        
        $tables = array(
            'a' => array('table' => 'bf_attribute_value', 'idField' => 'attribute_value_id', 'groupField' => 'attribute_id'),
            'f' => array('table' => 'filter',             'idField' => 'filter_id'         , 'groupField' => 'filter_group_id'),
            'o' => array('table' => 'option_value',       'idField' => 'option_value_id'   , 'groupField' => 'option_id'),
        );
        
        $sql = new SqlStatement();
        $sql->select(array('id' => $tables[$type]['idField']))
            ->from($tables[$type]['table'])
            ->where("sort_order = ?", $sortOrder)
            ->where("{$tables[$type]['groupField']} = ?", $numb);
        $res = $this->db->query($sql);
        return $res->row ? $res->row['id'] : null;
    }
    
    public function isBFParamSef($param) 
    {
        return (bool)preg_match('/^(((price|((a|f|o|r|s|c|m)\d+)):([\d,]+|(\d+|na)-(\d+|na))|search:[^;]+);)+$/', $param);
    }
}