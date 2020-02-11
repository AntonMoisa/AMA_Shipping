<?php

class AMA_Shipping_Model_Carrier extends Mage_Shipping_Model_Carrier_Abstract
{
    protected $_code = 'amashipping';

    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        /** @var Mage_Shipping_Model_Rate_Result $result */
        $result = Mage::getModel('shipping/rate_result');

        /** @var Mage_Shipping_Model_Rate_Result_Method $method */
        $method = Mage::getModel('shipping/rate_result_method');
        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod('pickup store');
        $method->setMethodTitle('pickup store');
        $method->setPrice(Mage::getStoreConfig('carriers/amashipping/price'));
        $result->append($method);

        if ($config = Mage::getStoreConfig('carriers/amashipping/storeshow')) {
            $allowedStoreConfig = array_map(function (array $data) {
                return (integer) $data;
            }, explode(',', $config));

            $allowedStore = Mage::getModel('amashipping/store')->getCollection();

            $allowedStore->addFieldToFilter('block_id', [
                'in' => [
                    $allowedStoreConfig,
                ],
            ]);
        }

        return $result;
    }
}