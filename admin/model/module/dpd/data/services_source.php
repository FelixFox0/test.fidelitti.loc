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

require_once(DIR_APPLICATION . 'model' . DIRECTORY_SEPARATOR . 'module' . DIRECTORY_SEPARATOR . 'dpd' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'source' . '.php');

class ModelModuleDpdDataServicesSource extends ModelModuleDpdDataSource
{

    public static $_data = array(
        1     => '1 - DPD Classic',
        10    => '10 - DPD 10:00',
        9     => '9 - DPD 12:00',
        109   => '109 - DPD B2C',
        27    => '27 - DPD Same Day',
        40033 => '40033 - DPD Classic International',
        40107 => '40107 - DPD Classic Bulgaria',
        40171 => '40171 - DPD Ungaria',
    );


}