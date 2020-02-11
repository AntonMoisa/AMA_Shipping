<?php

class AMA_Shipping_Model_Resource_Store extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('amashipping/store','store_id');
    }
}