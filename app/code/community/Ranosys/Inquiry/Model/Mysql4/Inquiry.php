<?php
    /**
 * Cart inquiry 
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */    
    class Ranosys_Inquiry_Model_Mysql4_Inquiry extends Mage_Core_Model_Mysql4_Abstract
    {
        public function _construct()
        {   
            $this->_init('inquiry/inquiry', 'id');
        }
    }
