<?php
class Arunendra_Disablepayment_Model_Observer {
 public function filterpaymentmethod(Varien_Event_Observer $observer) {
            /* call get payment method */
        $method = $observer->getEvent()->getMethodInstance();
        if($method->getCode()=='paypal_express'){
        	$productWeight  = array();	
			$CartSession = Mage::getSingleton('checkout/session');
			foreach($CartSession->getQuote()->getAllItems() as $item)
			{
				$product_id = $item->getProductId();
				$obj = Mage::getModel('catalog/product')->load($product_id);
				$productWeight[] = $obj->getDisablepaypal();
			}
        if(!in_array(1,$productWeight)){
            $result = $observer->getEvent()->getResult();   
            $result->isAvailable = true;
            return;
            }
            else{
            $result = $observer->getEvent()->getResult();   
            $result->isAvailable = false;
            }

        }
        return;
    }
}
?>