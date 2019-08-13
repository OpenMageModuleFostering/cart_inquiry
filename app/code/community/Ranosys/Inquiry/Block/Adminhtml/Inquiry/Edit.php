<?php
/**
 * cart inquiry tag edit block
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */
  class Ranosys_Inquiry_Block_Adminhtml_Inquiry_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
    {
        public function __construct()
        {
            parent::__construct();
            $this->_objectId = 'id';
            $this->_blockGroup = 'inquiry';
            $this->_controller = 'adminhtml_inquiry';
            $this->_updateButton('save', 'label', Mage::helper('inquiry')->__('Save'));
            $this->_updateButton('delete', 'label', Mage::helper('inquiry')->__('Delete'));
            
            $this->_addButton('save_and_continue', array(
                  'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
                  'onclick' => 'saveAndContinueEdit()',
                  'class' => 'save',
            ), -100);
            
            $this->_formScripts[] = "
                function saveAndContinueEdit(){
                    editForm.submit($('edit_form').action+'back/edit/');
                }
            ";
        }    
        public function getHeaderText()
        {
            if( Mage::registry('inquiry_data') && Mage::registry('inquiry_data')->getId() ) {
                return Mage::helper('inquiry')->__("Edit '%s'", $this->htmlEscape(Mage::registry('inquiry_data')->getFirstname()));
                
            } else {
                return Mage::helper('inquiry')->__('Add');
            }
        }
    }