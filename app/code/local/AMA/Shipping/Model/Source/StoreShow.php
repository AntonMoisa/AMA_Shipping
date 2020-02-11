<?php

class AMA_Shipping_Model_Source_StoreShow
{
    /**
     * @throws Exception
     * @return array
     */
    public function toOptionArray()
    {
        $stores = Mage::getResourceModel('amashipping/store_collection');

        $data = [];

        /** @var AMA_Shipping_Model_Store $store */
        foreach ($stores as $store)
        {
            $data[] = [
                'value' => $store->getId(),
                'label' => Mage::helper('amashipping')->__($store->getData('name'))
            ];
        }

        return $data;
    }
}