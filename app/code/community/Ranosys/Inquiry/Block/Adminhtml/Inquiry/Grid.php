<?php
/**
 * Adminhtml cart inquiry page grid
 *
 * @category   Ranosys
 * @package    Ranosys_Inquiry
 * @author     Ranosys Technologies Pvt. Ltd. 
 */
 class Ranosys_Inquiry_Block_Adminhtml_Inquiry_Grid extends Mage_Adminhtml_Block_Widget_Grid
    {
        public function __construct()
        {
            parent::__construct();
            $this->setId('inquiryGrid');
            // This is the primary key of the database
            $this->setDefaultSort('id');
            $this->setDefaultDir('ASC');
            $this->setSaveParametersInSession(true);
            
        }
     
        protected function _prepareCollection()
        {
            $collection = Mage::getModel('inquiry/inquiry')->getCollection();
            $this->setCollection($collection);
            return parent::_prepareCollection();
        }
     
        protected function _prepareColumns()
        {
            $this->addColumn('id', array(
                'header'    => Mage::helper('inquiry')->__('ID'),
                'align'     =>'right',
                'width'     => '50px',
                'index'     => 'id',
            ));
     
            $this->addColumn('firstname', array(
                'header'    => Mage::helper('inquiry')->__('First Name'),
                'align'     =>'left',
                'index'     => 'firstname',
            ));
            $this->addColumn('lastname', array(
                'header'    => Mage::helper('inquiry')->__('Last Name'),
                'align'     =>'left',
                'index'     => 'lastname',
            ));
            $this->addColumn('email', array(
                'header'    => Mage::helper('inquiry')->__('Email'),
                'align'     =>'left',
                'index'     => 'email',
            ));
            $this->addColumn('phone', array(
                'header'    => Mage::helper('inquiry')->__('Phone'),
                'align'     =>'left',
                'index'     => 'phone',
            )); 
            $this->addColumn('message', array(
                'header'    => Mage::helper('inquiry')->__('Message'),
                'align'     =>'left',
                'index'     => 'message',
            ));
             $this->addColumn('created_time', array(
                'header'    => Mage::helper('inquiry')->__('Created Time'),
                'align'     =>'left',
                'index'     => 'created_time',
            )); 
     
            $this->addColumn('status', array(
     
                'header'    => Mage::helper('inquiry')->__('Status'),
                'align'     => 'left',
                'width'     => '80px',
                'index'     => 'status',
                'type'      => 'options',
                'options'   => array(
                    1 => 'Active',
                    0 => 'Inactive',
                ),
            ));
             $this->addColumn('pid', array(
                'header'    => Mage::helper('inquiry')->__('Product Id'),
                'align'     =>'right',
                'width'     => '50px',
                'index'     => 'pid',
            ));
            $this->addColumn('pname', array(
                'header'    => Mage::helper('inquiry')->__('Product Name'),
                'align'     =>'right',
                'width'     => '50px',
                'index'     => 'pname',
            ));
            $this->addColumn('psku', array(
                'header'    => Mage::helper('inquiry')->__('Product SKU'),
                'align'     =>'right',
                'width'     => '50px',
                'index'     => 'psku',
                
            ));
     
            return parent::_prepareColumns();
        }
     
        public function getRowUrl($row)
        {
            return $this->getUrl('*/*/edit', array('id' => $row->getId()));
        }
   
        protected function _prepareMassaction()
         {
         $this->setMassactionIdField('inquiry_id');
         $this->getMassactionBlock()->setFormFieldName('inquiryIds');

         $this->getMassactionBlock()->addItem('delete', array(
                         'label'    => Mage::helper('inquiry')->__('Delete'),
                         'url'      => $this->getUrl('*/*/massDelete'),
                         'confirm'  => Mage::helper('inquiry')->__('Are you sure?')
                    ));
         $this->getMassactionBlock()->addItem('active', array(
                         'label'    => Mage::helper('inquiry')->__('Active'),
                         'url'      => $this->getUrl('*/*/massActive'),
                         'confirm'  => Mage::helper('inquiry')->__('Are you sure?')
                    ));
         $this->getMassactionBlock()->addItem('inactive', array(
                         'label'    => Mage::helper('inquiry')->__('Inactive'),
                         'url'      => $this->getUrl('*/*/massInactive'),
                         'confirm'  => Mage::helper('inquiry')->__('Are you sure?')
                    ));
                    return $this;
            }
    }