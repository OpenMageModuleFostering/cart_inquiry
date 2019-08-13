<?php
/**
 * Adminhtml cart inquiry page content block
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */
 class Ranosys_Inquiry_Block_Adminhtml_Inquiry extends Mage_Adminhtml_Block_Widget_Grid_Container
    {
        public function __construct()
        {
            $this->_controller = 'adminhtml_inquiry';
            $this->_blockGroup = 'inquiry';
            $this->_headerText = Mage::helper('inquiry')->__('Inquiry');
            $this->_addButtonLabel = Mage::helper('inquiry')->__('Add');
            parent::__construct();
            $this->_removeButton('add');
        }
    }