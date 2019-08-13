<?php     
/**
 * cart inquiry tag add new 
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */
    class Ranosys_Inquiry_Block_Adminhtml_Inquiry_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
    {
     
        public function __construct()
        {
            parent::__construct();
            $this->setId('inquiry_tabs');
            $this->setDestElementId('edit_form');
            $this->setTitle(Mage::helper('inquiry')->__('Cart Inquiry'));
        }
     
        protected function _beforeToHtml()
        {
            $this->addTab('form_section', array(
                'label'     => Mage::helper('inquiry')->__('Detail'),
                'title'     => Mage::helper('inquiry')->__('Detail'),
                'content'   => $this->getLayout()->createBlock('inquiry/adminhtml_inquiry_edit_tab_form')->toHtml(),
            ));
           
            return parent::_beforeToHtml();
        }
    }