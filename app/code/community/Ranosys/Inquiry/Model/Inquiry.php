<?php
/**
 * Cart inquiry 
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */  
    class Ranosys_Inquiry_Model_Inquiry extends Mage_Core_Model_Abstract
    {
        public function _construct()
        {
            parent::_construct();
            $this->_init('inquiry/inquiry');
        }
    }
