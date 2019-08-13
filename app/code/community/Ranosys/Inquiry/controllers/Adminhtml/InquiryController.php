<?php  
/**
 * Cart inquiry adminhtml controller
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */
   class Ranosys_Inquiry_Adminhtml_InquiryController extends Mage_Adminhtml_Controller_Action
    {
        protected function _initAction()
        {
            $this->loadLayout()
                ->_setActiveMenu('inquiry/inquiry')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Detail'), Mage::helper('adminhtml')->__('Detail'));
            return $this;
        }   
        public function indexAction()
        {
            $this->_initAction();       
            $this->_addContent($this->getLayout()->createBlock('inquiry/adminhtml_inquiry'));
            $this->renderLayout();
        }
     
        public function editAction()
        {
            $inquiryId     = $this->getRequest()->getParam('id');
            $inquiryModel  = Mage::getModel('inquiry/inquiry')->load($inquiryId);
            if ($inquiryModel->getId() || $inquiryId == 0)
            {
                Mage::register('inquiry_data', $inquiryModel);
                $this->loadLayout();
                $this->_setActiveMenu('inquiry/inquiry');
                $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Detail'), Mage::helper('adminhtml')->__('Detail'));
                $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Cart Inquiry'), Mage::helper('adminhtml')->__('Cart Inquiry'));
                $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
                $this->_addContent($this->getLayout()->createBlock('inquiry/adminhtml_inquiry_edit'))
                     ->_addLeft($this->getLayout()->createBlock('inquiry/adminhtml_inquiry_edit_tabs'));   
                $this->renderLayout();
            } 
            else 
            {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('inquiry')->__('Information does not exist'));
                $this->_redirect('*/*/');
            }
        }
       
        public function newAction()
        {
            $inquiryId     = $this->getRequest()->getParam('id');
            $inquiryModel  = Mage::getModel('inquiry/inquiry')->load($inquiryId);
     
            if ($inquiryModel->getId() || $inquiryId == 0) {
                Mage::register('inquiry_data', $inquiryModel);
                $this->loadLayout();
                $this->_setActiveMenu('inquiry/inquiry');
                $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Detail'), Mage::helper('adminhtml')->__('Detail'));
                $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Cart Inquiry'), Mage::helper('adminhtml')->__('Cart Inquiry'));
                $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
                $this->_addContent($this->getLayout()->createBlock('inquiry/adminhtml_inquiry_edit'))
                     ->_addLeft($this->getLayout()->createBlock('inquiry/adminhtml_inquiry_edit_tabs'));   
                $this->renderLayout();
            } 
            else 
            {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('inquiry')->__('Information does not exist'));
                $this->_redirect('*/*/');
            }
        }
       
        public function saveAction()
        {
            if ( $this->getRequest()->getPost() ) {
                try {
                    $postData = $this->getRequest()->getPost();
                    $inquiryModel = Mage::getModel('inquiry/inquiry');
                    $inquiryModel->setId($this->getRequest()->getParam('id'))
                        ->setFirstname($postData['firstname'])
                        ->setLastname($postData['lastname'])
                        ->setEmail($postData['email'])
                        ->setPhone($postData['phone'])
                        ->setMessage($postData['message'])
                        ->setStatus($postData['status'])
                        ->save();
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Inquiry was successfully saved'));
                    Mage::getSingleton('adminhtml/session')->setInquiryData(false);
                    if ($this->getRequest()->getParam('back')) {
                        $this->_redirect(
                            '*/*/edit',
                            array(
                                'id' => $this->getRequest()->getParam('id'),
                            )
                        );
                        return;
                    }
                    $this->_redirect('*/*/');
                    return;
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    Mage::getSingleton('adminhtml/session')->setInquiryData($this->getRequest()->getPost());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    return;
                }
            }
            $this->_redirect('*/*/');
        }
       
        public function deleteAction()
        {
            if( $this->getRequest()->getParam('id') > 0 ) {
                try {
                    $inquiryModel = Mage::getModel('inquiry/inquiry');
                    $inquiryModel->setId($this->getRequest()->getParam('id'))
                        ->delete();  
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Inquiry was successfully deleted'));
                    $this->_redirect('*/*/');
                } catch (Exception $e) {
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                }
            }
            $this->_redirect('*/*/');
        }
        public function gridAction()
        {
            $this->loadLayout();
            $this->getResponse()->setBody(
                   $this->getLayout()->createBlock('inquiry/adminhtml_inquiry_grid')->toHtml()
            );
        }        
        public function massDeleteAction()
        {
        $Ids = $this->getRequest()->getParam('inquiryIds');
        if(is_array(Ids)) {
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('inquiry')->__('Please select any one id'));
        } else {
        try {
       foreach ($Ids as $Id) 
        {
         $inquiryModel = Mage::getModel('inquiry/inquiry');
                    $inquiryModel->setId($Id)
                        ->delete();
                    $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess(
        Mage::helper('inquiry')->__(
        'Total of %d inquiry(s) were successfully deleted to the inquiry list', count($Ids)
        )
        );
        } catch (Exception $e) {
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        }
        $this->_redirect('*/*/index');
        }
        public function massActiveAction()
        {
        $Ids = $this->getRequest()->getParam('inquiryIds');
        if (!is_array($Ids)) {
        Mage::getSingleton('adminhtml/session')->addError($this->__('Please select inquiry(s)'));
        } else {
        try 
        {
            foreach ($Ids as $Id){
            Mage::getSingleton('inquiry/inquiry')
                ->load($Id)
                ->setStatus(1)
                ->save();
            }
            $this->_getSession()->addSuccess(
            $this->__('Total of %d inquiry(s) were successfully updated', count($Ids))
            );
            } 
        catch (Exception $e)
        {
            $this->_getSession()->addError($e->getMessage());
            }
            }
            $this->_redirect('*/*/index');
        }
        public function massInactiveAction()
        {
        $Ids = $this->getRequest()->getParam('inquiryIds');
        if (!is_array($Ids)) {
        Mage::getSingleton('adminhtml/session')->addError($this->__('Please select inquiry(s)'));
        } else {
        try 
            {
            foreach ($Ids as $Id){
            Mage::getSingleton('inquiry/inquiry')
                ->load($Id)
                ->setStatus(0)
                ->save();
            }
            $this->_getSession()->addSuccess(
            $this->__('Total of %d inquiry(s) were successfully updated', count($Ids))
            );
        } 
        catch (Exception $e) 
            {
            $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
        }
       }