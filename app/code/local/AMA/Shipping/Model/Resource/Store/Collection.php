<?php

class AMA_Shipping_Model_Resource_Store_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('amashipping/store');
    }
}