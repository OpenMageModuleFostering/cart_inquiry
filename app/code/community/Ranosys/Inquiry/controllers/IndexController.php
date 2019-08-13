<?php
/**
 * Cart inquiry frontend controller
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */
  class Ranosys_Inquiry_IndexController extends Mage_Core_Controller_Front_Action
    {
        public function indexAction()
        {
                $this->loadLayout();
                $this->renderLayout();
        }
        public function saveAction()
        {  
            if ( $this->getRequest()->getPost() ) {
                try 
                {
                $postData = $this->getRequest()->getPost();
                $inquiryModel = Mage::getModel('inquiry/inquiry');
               
                $inquiryModel->setId($this->getRequest()->getParam('id'))
                    ->setFirstname($postData['firstname'])
                    ->setLastname($postData['lastname'])
                    ->setEmail($postData['email'])
                    ->setPhone($postData['phone'])
                    ->setMessage($postData['message'])
                    ->setPid($postData['productId'])
                    ->setPname($postData['productName'])
                    ->setPsku($postData['productSku'])    
                    ->save();
                $adminEmailOption = Mage::getStoreConfig('ranosys/ranosys_group/ranosys_ranosys_input',Mage::app()->getStore());
                if($adminEmailOption=='')
                {
                    $adminEmail= Mage::getStoreConfig('trans_email/ident_general/email');
                }
                else
                {
                    $adminEmail= $adminEmailOption;
                }
                $adminName = Mage::getStoreConfig('trans_email/ident_general/name');
                $emailTemplate = Mage::getModel('core/email_template')->loadDefault('inquiry_template');
                $senderName =$postData['firstname'];
                $senderEmail = $postData['email'];
                $emailTemplateVariables = array();
                $emailTemplateVariables['firstName'] = $postData['firstname'];
                $emailTemplateVariables['productId'] = $postData['productId'];
                $emailTemplateVariables['productName']=$postData['productName'];
                $emailTemplateVariables['productSku'] = $postData['productSku'];
                $emailTemplateVariables['message'] = $postData['message'];
                $emailTemplate->getProcessedTemplate($emailTemplateVariables);

                $emailTemplate
                    ->setSubject('Subject :Inquiry by '. $postData['firstname'])
                    ->setSenderEmail($senderEmail)
                    ->setSenderName($senderName)
                    ->setType('html');
//echo "<pre>";print_r($emailTemplate->getData());die;
                $emailTemplate->send($adminEmail, $adminName, $emailTemplateVariables);
                
                Mage::getSingleton('core/session')->addSuccess(Mage::helper('core')->__('Your message was sent successfully. We will reach you soon as we review.'));
                Mage::getSingleton('core/session')->setInquiryData(false);
                $this->_redirect('checkout/cart');
                return;
            } 
            catch (Exception $e) 
            {
                Mage::getSingleton('core/session')->addError($e->getMessage());
                Mage::getSingleton('core/session')->setInquiryData($this->getRequest()->getPost());
                $this->_redirect('checkout/cart', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
            
        }
    }
