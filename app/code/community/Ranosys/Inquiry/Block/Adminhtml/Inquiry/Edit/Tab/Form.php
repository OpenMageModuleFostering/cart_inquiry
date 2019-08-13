<?php 
/**
 * Cart inquiry tag edit form
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */
    class Ranosys_Inquiry_Block_Adminhtml_Inquiry_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
    {
        protected function _prepareForm()
        {
            $form = new Varien_Data_Form();
            $this->setForm($form);
            $fieldset = $form->addFieldset('inquiry_form', array('legend'=>Mage::helper('inquiry')->__('Inquiry')));
           
            $fieldset->addField('pid', 'label', array(
            'label'     => Mage::helper('inquiry')->__('Product ID'),   
            'value'     => Mage::helper('inquiry')->__('pid'),
            ));
            $fieldset->addField('pname', 'label', array(
            'label'     => Mage::helper('inquiry')->__('Product Name'),   
            'value'     => Mage::helper('inquiry')->__('pname'),
            ));
            $fieldset->addField('psku', 'label', array(
            'label'     => Mage::helper('inquiry')->__('Product SKU'),   
            'value'     => Mage::helper('inquiry')->__('psku'),
            ));           
            $fieldset->addField('firstname', 'text', array(
                'label'     => Mage::helper('inquiry')->__('First Name'),
                'class'     => 'required-entry validate-alpha',
                'required'  => true,
                'name'      => 'firstname',
            ));
            $fieldset->addField('lastname', 'text', array(
                'label'     => Mage::helper('inquiry')->__('Last Name'),
                'class'     => 'required-entry validate-alpha',
                'required'  => true,
                'name'      => 'lastname',
            ));
            $fieldset->addField('email', 'text', array(
                'label'     => Mage::helper('inquiry')->__('Email'),
                'class'     => 'required-entry validate-email',
                'required'  => true,
                'name'      => 'email',
            ));
            $fieldset->addField('phone', 'text', array(
                'label'     => Mage::helper('inquiry')->__('Phone'),
                'class'     => 'validate-number',
                'name'      => 'phone',
            ));
            $fieldset->addField('message', 'textarea', array(
                'label'     => Mage::helper('inquiry')->__('Message'),
                'class'     => 'required-entry',
                'required'  => true,
                'name'      => 'message',
            ));
     
            $fieldset->addField('status', 'select', array(
                'label'     => Mage::helper('inquiry')->__('Status'),
                'name'      => 'status',
                'values'    => array(
                    array(
                        'value'     => 1,
                        'label'     => Mage::helper('inquiry')->__('Active'),
                    ),
     
                    array(
                        'value'     => 0,
                        'label'     => Mage::helper('inquiry')->__('Inactive'),
                    ),
                ),
            ));     
            if ( Mage::getSingleton('adminhtml/session')->getInquiryData() )
            {
                $form->setValues(Mage::getSingleton('adminhtml/session')->getInquiryData());
                Mage::getSingleton('adminhtml/session')->setInquiryData(null);
            } 
            elseif ( Mage::registry('inquiry_data') ) 
            {
                $form->setValues(Mage::registry('inquiry_data')->getData());
            }
            return parent::_prepareForm();
        }
    }