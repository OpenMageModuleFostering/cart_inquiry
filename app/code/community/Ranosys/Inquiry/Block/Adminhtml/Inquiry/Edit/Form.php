<?php
/**
 * Base block for rendering cart inquiry forms
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */
  class Ranosys_Inquiry_Block_Adminhtml_Inquiry_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
    {
        protected function _prepareForm()
        {
            $form = new Varien_Data_Form(array(
                                            'id' => 'edit_form',
                                            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                                            'method' => 'post',
                                         )
            );
     
            $form->setUseContainer(true);
            $this->setForm($form);
            return parent::_prepareForm();
        }
    }