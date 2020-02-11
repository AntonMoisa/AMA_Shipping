<?php

class AMA_Shipping_Block_Checkout_Onepage_Shipping_Method_Available extends Mage_Checkout_Block_Onepage_Shipping_Method_Available
{
    public function _construct()
    {
        $this->setTemplate('amashipping/available.phtml');

        parent::_construct();
    }
}
