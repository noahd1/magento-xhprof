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
class Demac_Xhprof_Block_Adminhtml_Record_Renderer_Pmu extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        $value = round($value/1048576,2);
        $result = '';

        switch($value)
        {
            case($value > 3000):
                $result = '<span style="color:red;">'.$value.'MB</span>';
                break;
            case($value > 2000):
                $result = '<span style="color:orange;">'.$value.'MB</span>';
                break;
            default:
                $result = '<span style="color:green;">'.$value.'MB</span>';
                break;
        }
        return $result;
    }
}
