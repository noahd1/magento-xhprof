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
class Demac_Xhprof_Block_Adminhtml_Calls extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_calls';
        $this->_blockGroup = 'xhprof';
        $this->_headerText = Mage::helper('xhprof')->__('Xhprof Profiler');
        parent::__construct();
        $this->_removeButton('add');

    }

}