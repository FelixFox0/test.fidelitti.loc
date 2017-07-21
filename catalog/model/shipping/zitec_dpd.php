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
class ModelShippingZitecDpd extends Model
{

    const FIXED_PRICE = 0;
    const PRICE_ADD_PERCENTAGE = 1;
    const PRICE_ADD_FIXED_AMOUNT = 2;

    protected static $apiInstance = null;
    protected static $postcodeSearchInstance = null;


    /**
     * compute and return to frontend the dpd shipping method amount and availability
     *
     * @param $address - array
     *
     * @return array
     */
    public function getQuote($address)
    {
        try {
            $this->load->language('shipping/zitec_dpd');
            $this->load->model('module/dpd/helper');
            $this->load->model('module/dpd/postcode');
            $this->load->model('module/dpd/tablerate');


            $request          = $address;
            $request['store'] = $this->config->get('config_store_id');;
            $request['region']  = $address['zone'];
            $request['country'] = $address['iso_code_2'];
            $request['price']   = $this->getCartTotal();
            $request['address'] = $address['address_1'] . ' ' . $address['address_2'];
            $request['weight']  = $this->getCartWeight();

            // look after a valid post code in database
            $relevance      = new stdClass();
            $postcodeResult = $this->model_module_dpd_postcode->findAndCachePostCode($request, $relevance);

            if (!empty($postcodeResult)) {
                $request['postcode'] = $postcodeResult;
                $address['postcode'] = $postcodeResult;
            }

            $quote_data = array();

            //require dpd api file
            $this->requireApiFile();
            if ($this->model_module_dpd_tablerate->isUsingTableRates()) {
                $this->model_module_dpd_tablerate->updateUsingTableRatesFlag();
                $rates = $this->model_module_dpd_tablerate->getRatesByRequest($request);
            } else {
                $rates = $this->model_module_dpd_tablerate->getDefaultRates();
            }

            if (empty($rates)) {
                return false;
            }
            foreach ($rates as $rate) {
                $serviceName = $this->model_module_dpd_helper->getShippingMethodCode() . $rate['dpd_service'];
                if (empty($rate['shipping_method_enabled'])) {
                    continue;
                }

                $price = $this->getShippingPriceForRate($rate, $address);

                // this is used because in total the amount is converted to the session currency
                //in this case we have to convert to the "default" currency
                $currencyCoefficient = $this->currency->getValue($this->session->data['currency']);

                if (is_numeric($price)) {
                    //the currency rate for text is 1 because, we already checked if we have the same currency with the
                    //currency displayed in site
                    $quote_data[$serviceName] = array(
                        'code'         => $this->model_module_dpd_helper->getShippingMethodCode() . '.' . $serviceName,
                        'title'        => $this->_getSettingsModel()->getShippingServiceLabel($rate['dpd_service']),
                        'cost'         => ($currencyCoefficient > 0) ? ($price / $currencyCoefficient) : $price,
                        'tax_class_id' => 1,
                        'text'         => $this->currency->format($price, $this->session->data['currency'], 1),
                        'dpd_rate'     => $rate
                    );
                }

            }

            $method_data = array(
                'code'       => 'zitec_dpd',
                'title'      => $this->language->get('text_title'),
                'quote'      => $quote_data,
                'sort_order' => 1,
                'error'      => false
            );
        } catch (Exception $e) {
            global $log;
            $logString = '___________________';
            $log->write($logString);
            $logString = 'DPD shipping carrier - calculate price exception';
            $log->write($logString);
            $log->write('Error code:' . $e->getCode());
            $log->write($e->getMessage());

            return false;
        }

        return $method_data;

    }

    /**
     * for a given rate entry in table rate will be computed the price
     * and returned as float
     *
     * @param $rate
     * @param $address
     *
     * @return bool|float
     */
    protected function getShippingPriceForRate($rate, $address)
    {

        if ($rate['shipping_price_calculation'] == self::FIXED_PRICE) {
            return $rate['shipping_price_value'];

        }
        //call the api and receive DPD delivery price
        $response = $this->getDpdWsShippingPrice($rate, $address);

        if (empty($response) || $response->hasError()) {
            return false;
        }

        $storeCurrency = $this->session->data['currency'];
        if ($storeCurrency == $response->getCurrency()) {
            $dpdPrice = $response->getTotalAmount();
        } else if ($storeCurrency == $response->getCurrencyLocal()) {
            $dpdPrice = $response->getTotalAmountLocal();
        } else {
            return false;
        }

        if ($rate['shipping_price_calculation'] == self::PRICE_ADD_PERCENTAGE) {
            return round($dpdPrice * (1 + ($rate['shipping_price_value'] / 100)), 2);
        } elseif ($rate['shipping_price_calculation'] == self::PRICE_ADD_FIXED_AMOUNT) {
            return round($dpdPrice + floatval($rate['shipping_price_value']), 2);
        }


    }

    /**
     * call calculate price on DPD api and return the values
     *
     * @param $rate
     * @param $address
     *
     * @return bool
     */
    public function getDpdWsShippingPrice($rate, $address)
    {

        $this->load->model('module/dpd/helper');
        $this->model_module_dpd_helper->requireApiFile();

        $storeId             = $this->config->get('config_store_id');
        $apiParams           = $this->model_module_dpd_helper->getShipmentParams($storeId);
        $apiParams['method'] = Zitec_Dpd_Api_Configs::METHOD_SHIPMENT_CALCULATE_PRICE;

        try {
            $dpdApi         = new Zitec_Dpd_Api($apiParams);
            $calculatePrice = $dpdApi->getApiMethodObject();
            $street = substr($address['address_1'] . ' ' . $address['address_2'], 0, 69);
            $calculatePrice->setReceiverAddress($street, $address['city'], $address['postcode'], $address['iso_code_2'])
                ->addParcel($this->getCartWeight())
                ->setShipmentServiceCode($rate['dpd_service']);

            $products             = $this->cart->getProducts();
            $insuranceDescription = '';
            foreach ($products as $product) {
                $insuranceDescription .= '|' . $product['name'];
            }

            $totalAmount  = $this->cart->getTotal();
            $currencyCode = $this->session->data['currency'];

            $calculatePrice->setAdditionalHighInsurance($totalAmount, $currencyCode, $insuranceDescription);

            $calculatePrice->execute();
        } catch (Exception $e) {
            return false;
        }

        return $dpdApi()->getResponse();

    }

    /**
     * return weight for products added to cart
     *
     * @return int
     */
    private function  getCartWeight()
    {
        $cart = $this->cart;
        if (empty($cart)) {
            return 0;
        }

        $cartProducts = $cart->getProducts();
        if (empty($cartProducts)) {
            return 0;
        }
        $weight = 0;
        foreach ($cartProducts as $product) {
            if (!empty($product['weight'])) {
                $weight += $product['weight'];
            }
        }

        return $weight;

    }

    /**
     * return the cart total price
     *
     * @return mixed
     */
    protected function getCartTotal()
    {
        return $this->cart->getTotal();
    }


    public static function  requireApiFile()
    {
        $apiClassFile = DIR_SYSTEM . 'library' . DIRECTORY_SEPARATOR . 'Zitec' . DIRECTORY_SEPARATOR . 'Dpd' . DIRECTORY_SEPARATOR . 'Api.php';
        if (empty(self::$apiInstance) && file_exists($apiClassFile)) {
            require_once($apiClassFile);
        }
    }


    /**
     *
     * @return Zitec_Dpd_Helper_Data
     */
    protected function _getSettingsModel()
    {
        if (empty($this->model_module_dpd_settings)) {
            $this->load->model('module/dpd/settings');
        }

        return $this->model_module_dpd_settings;
    }


}
