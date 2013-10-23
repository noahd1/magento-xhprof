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
class Demac_Xhprof_Block_Adminhtml_Record_Renderer_Wt extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex()) / 1000;
        $result = '';

        switch($value)
        {
            case($value > 3000):
                $result = '<span style="color:red;">'.$value.'ms</span>';
                break;
            case($value > 2000):
                $result = '<span style="color:orange;">'.$value.'ms</span>';
                break;
            default:
                $result = '<span style="color:green;">'.$value.'ms</span>';
                break;
        }
        return $result;
    }
}
