<?php

class AMA_Shipping_Model_Observer
{
    /**
     * @throws Exception
     */
    public function changedCarrirersAmashippingStoreadd()
    {
        $newStoreName = Mage::getStoreConfig('carriers/amashipping/storeadd');
        $hasNewStoreName = (bool) $newStoreName;

        if ($hasNewStoreName) {
            $newStore = Mage::getModel('amashipping/store');
            $newStore->addData([
                'name' => $newStoreName,
                'created_at' => now()
            ]);
            $newStore->save();
        }
        Mage::app()->getConfig()->saveConfig('carriers/amashipping/storeadd', '');

        $allowedStore = array_map(function (array $data) {
            return (integer) $data;
        }, explode(',',  Mage::getStoreConfig('carriers/amashipping/storeshow')));

        $stores = Mage::getModel('amashipping/store')->getCollection();

        /** @var AMA_Shipping_Model_Store $store */
        foreach ($stores as $store)
        {
            if (in_array($store->getId(), $allowedStore)) {
                $store->setData([
                    'allowed' => 1
                ]);
                $store->save();
            }
        }
    }
}