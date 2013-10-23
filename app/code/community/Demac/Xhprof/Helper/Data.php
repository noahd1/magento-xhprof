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
class Demac_Xhprof_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function isEnabled()
    {
        if(extension_loaded('xhprof') && $this->getConfigData('active'))
        {
            return true;
        }

        return false;
    }

    public function getConfigData($field)
    {
        $path = 'dev/xhprof/'.$field;
        return Mage::getStoreConfig($path, Mage::app()->getStore());
    }

    public function getExcludePaths()
    {
        return $this->_explodePaths('exclude_paths');
    }

    public function getIncludePaths()
    {
        return $this->_explodePaths('include_paths');
    }

    protected function _explodePaths($field)
    {
        $paths = $this->getConfigData($field);
        return explode("\n",$paths);
    }
}