<?php

class AMA_Shipping_Model_Source_StoreDelete
{
    const DEFAULT_VALUE = 0;
    const DEFAULT_TEXT = '--Please Select--';

    /**
     * @throws Exception
     * @return array
     */
    public function toOptionArray()
    {
        $deleteStoreConfig = Mage::getStoreConfig('carriers/amashipping/storedelete');
        $hasSelectStore = (bool) $deleteStoreConfig;

        if ($hasSelectStore) {
            $deleteStore = Mage::getModel('amashipping/store')->load($deleteStoreConfig);
            $deleteStore->delete();
        }

        Mage::app()->getConfig()->saveConfig('carriers/amashipping/storedelete', (string) self::DEFAULT_VALUE);

        $stores = Mage::getResourceModel('amashipping/store_collection');

        $data = [
            0 => [
                'value' => self::DEFAULT_VALUE,
                'label' => Mage::helper('amashipping')->__(self::DEFAULT_TEXT)
            ]
        ];

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
