<?php
/**
 * Zitec_Dpd – shipping carrier extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Zitec
 * @package    Zitec_Dpd
 * @copyright  Copyright (c) 2014 Zitec COM
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 *
 * @category   Zitec
 * @package    Zitec_Dpd
 * @author     Zitec COM <magento@zitec.ro>
 */
class ModelModuleDpdDataSource
{

    public static $_data = null;

    public $_context;

    public function __construct($data)
    {
        $this->_context = $data;

    }

    /**
     * return all options of the source model
     *
     * @return array
     */
    public function getOptions()
    {
        return static::$_data;
    }

    /**
     * return the value of the element with id
     *
     * @param $id
     *
     * @return null
     */
    public function getById($id)
    {
        if (!empty(static::$_data[$id])) {
            $languageObject = $this->_context->get('language');
            if (!empty($languageObject) && method_exists($languageObject, 'get')) {
                return $languageObject->get(static::$_data[$id]);
            }

            return static::$_data[$id];
        }

        return null;
    }

    /**
     * return the html element of select - as string
     *
     * to be printed on frontend
     *
     * @param array $parameters
     * @param null  $values
     *
     * @return string
     */
    public function getSelectHtml($parameters = array(), $values = null)
    {
        $html = '<select class="form-control" name="' . (!empty($parameters['name']) ? $parameters['name'] : '') . '">';
        if (!empty($this->_context->get('session')->data['form_data'])) {
            if (!empty($this->_context->get('session')->data['form_data'][$parameters['name']])) {
                $values = $this->_context->get('session')->data['form_data'][$parameters['name']];
            }
        }
        if (!empty($values) && !is_array($values)) {
            $values = array($values);
        }
        $options = $this->getOptions();
        if (!empty($options)) {
            foreach ($options as $key => $option) {
                $html .= '<option value="' . $key . '" ' . ((!empty($values) && in_array($key, $values)) ? ' selected="selected" ' : '') . ' >' . $option . '</option>';
            }
        }

        $html .= '</select>';

        return $html;
    }

    /**
     * return the html element of select - as string
     *
     * to be printed on frontend
     *
     * @param array $parameters
     * @param null  $values
     *
     * @return string
     */
    public function getMultiSelectHtml($parameters = array(), $values = null)
    {
        $html = '<select multiple="multiple" class="form-control" name="' . (!empty($parameters['name']) ? $parameters['name'] : '') . '[]">';
        if (!empty($this->_context->get('session')->data['form_data'])) {
            if (!empty($this->_context->get('session')->data['form_data'][$parameters['name']])) {
                $values = $this->_context->get('session')->data['form_data'][$parameters['name']];
            }
        }
        if (!empty($values) && !is_array($values)) {
            $values = array($values);
        }
        $options = $this->getOptions();
        if (!empty($options)) {
            foreach ($options as $key => $option) {
                $html .= '<option value="' . $key . '" ' . ((!empty($values) && in_array($key, $values)) ? ' selected="selected" ' : '') . ' >' . $option . '</option>';
            }
        }

        $html .= '</select>';

        return $html;
    }

}