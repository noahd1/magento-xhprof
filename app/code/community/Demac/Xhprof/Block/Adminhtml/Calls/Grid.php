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
class Demac_Xhprof_Block_Adminhtml_Calls_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('xhprofGrid_calls');

        // This is the primary key of the database
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        // Get and set our collection for the grid
        if (!$this->getCollection()) {
            $collection = Mage::getModel('xhprof/call_collection');

            $id = Mage::app()->getRequest()->getParam('id');
            $parent = Mage::app()->getRequest()->getParam('parent');

            $recordCollection = Mage::getModel('xhprof/record')->getCollection();
            $recordCollection->addFieldToFilter('id', $id);

            $row = $recordCollection->getFirstItem();

            $data = json_decode($row->getData('raw_data'), true);

            $collection->setCalls($data);
            $collection->setCurrent($parent);

            $this->setCollection($collection);

            return parent::_prepareCollection();
        }
    }

    protected function _prepareColumns()
    {

       $this->addColumn('name',
           array(
              'header'=> $this->__('Name'),
              'index' => 'name',
              'sortable' => false,
           )
       );

       $this->addColumn('excl_time',
           array(
              'header'=> $this->__('Excl. Wall Time'),
              'index' => 'excl_time',
              'type' => 'number',
              'width' => 200,
              'renderer'  => 'Demac_Xhprof_Block_Adminhtml_Record_Renderer_Wt' // THIS IS WHAT THIS POST IS ALL ABOUT

           )
       );

       $this->addColumn('time',
           array(
              'header'=> $this->__('Wall Time'),
              'index' => 'time',
              'type' => 'number',
              'width' => 200,
              'renderer'  => 'Demac_Xhprof_Block_Adminhtml_Record_Renderer_Wt' // THIS IS WHAT THIS POST IS ALL ABOUT
           )
       );

       $this->addColumn('count',
           array(
              'header'=> $this->__('Count'),
              'index' => 'count',
              'type' => 'number',
              'width' => 200,
           )
       );

       return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        $id = Mage::app()->getRequest()->getParam('id');
        return $this->getUrl('*/*/calls', array('id' => $id, 'parent' => $row->getName()));
    }

    public function getGridUrl()
     {
        return $this->getUrl('*/*/calls', array('_current'=>true));
     }
}
