 <?php
 /**
 * Cart inquiry 
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */      
    class Ranosys_Inquiry_Model_Mysql4_Inquiry_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
    {
        public function _construct()
        {
            //parent::__construct();
            $this->_init('inquiry/inquiry');
        }
    }
