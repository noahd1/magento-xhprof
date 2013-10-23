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
class Demac_Xhprof_Model_Resource_Record_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('xhprof/record');
    }
}