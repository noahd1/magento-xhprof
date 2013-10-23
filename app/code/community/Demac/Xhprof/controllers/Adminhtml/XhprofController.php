<?php
/**
 * Company: Demac Media Inc.
 * Date: 10/15/13
 * Time: 8:57 AM
 */

/**
 * @category Demac
 * @package Demac_Xhprof
 * @author Allan MacGregor - Magento Head Developer <allan@demacmedia.com>
 */
class Demac_Xhprof_Adminhtml_XhprofController extends Demac_Xhprof_Controller_Abstract
{
    public function _initAction()
    {
        parent::_initAction();
        $this->loadLayout()
            ->_setActiveMenu('sales')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Xhprof Dashboard'), Mage::helper('adminhtml')->__('Dashboard'));
        return $this;
    }

    public function indexAction()
    {
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('xhprof/adminhtml_record'));
        $this->renderLayout();
    }

    public function callsAction()
    {
        $this->_title(Mage::helper('adminhtml')->__('Reports'))->_title(Mage::helper('adminhtml')->__('Xhprof'));

        $this->_initAction()
            ->_setActiveMenu('report/xhprof/index')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Xhprof'), Mage::helper('adminhtml')->__('Xhprof'));
        $this->_addContent($this->getLayout()->createBlock('xhprof/adminhtml_calls'));

        $this->renderLayout();
    }

    public function callsGridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}