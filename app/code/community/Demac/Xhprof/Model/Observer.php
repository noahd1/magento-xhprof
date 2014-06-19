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
class Demac_Xhprof_Model_Observer
{
    protected $is_running = false;

    /**
     * @param $observer
     */
    public function start($observer)
    {
        $helper = Mage::helper('xhprof');
        if($helper->isEnabled())
        {
            $interval       = $helper->getConfigData('interval');
            $isSample       = (mt_rand(1, $interval) == 1);

            if ($isSample) {
                $excludePaths = $helper->getExcludePaths();
                $includePaths = $helper->getIncludePaths();

                $requestPath = Mage::app()->getRequest()->getPathInfo();
                $isPathValid = $this->_isPathValid($requestPath, $includePaths, $excludePaths);

                if($isPathValid){
                    // Start Refactor : Make both values configurable
                    xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);
                    // End Refactor
                    $this->is_running = true;
                }
            }
        }
    }

    /**
     * @param $observer
     */
    public function stop($observer)
    {
        $helper = Mage::helper('xhprof');

        if($this->is_running)
        {
            $data   = xhprof_disable();
            $record = Mage::getModel('xhprof/record');

            $recordData = array(
                'path_info'         => Mage::app()->getRequest()->getPathInfo(),
                'request_method'    => $_SERVER['REQUEST_METHOD'],
                'controller'        => Mage::app()->getRequest()->getControllerName(),
                'action'            => Mage::app()->getRequest()->getActionName(),
                'route'             => Mage::app()->getRequest()->getRouteName(),
                'module'            => Mage::app()->getRequest()->getModuleName(),
                'parameters'        => json_encode(Mage::app()->getRequest()->getParams()),
                'pmu'               => isset($data['main()']['pmu']) ? $data['main()']['pmu'] : 0,
                'wt'                => isset($data['main()']['wt'])  ? $data['main()']['wt']  : 0,
                'cpu'               => isset($data['main()']['cpu']) ? $data['main()']['cpu'] : 0,
                'created_at'        => date('c'),
            );

            if ($helper->getConfigData('full_mode')) {
                $recordData['raw_data'] = json_encode($data);
            } else {
                $recordData['raw_data'] = '';
            }

            $record->addData($recordData);
            $record->save();

        }

    }

    /**
     *
     * TODO: UnitTest with different paths
     *
     * @param $requestPath
     * @param $includePaths
     * @param $excludePaths
     * @return bool
     */
    protected function _isPathValid($requestPath, $includePaths,$excludePaths)
    {
        $isPathValid = false;

        foreach($excludePaths as $path)
        {
            if (strpos($requestPath, $path) === 0) {
                $isPathValid = false;
                return $isPathValid;
            }
        }

        foreach($includePaths as $path)
        {
            if (strpos($requestPath, $path) === 0) {
                $isPathValid = true;
            }
        }
        return $isPathValid;

    }
}