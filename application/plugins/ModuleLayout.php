<?php
/**
 * PHP Class ModuleLayout.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Plugin_ModuleLayout extends Zend_Controller_Plugin_Abstract
{
    /**
     * Initialise le répertoire de layout
     *
     * @param Zend_Controller_Request_Abstract $request
     */
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $moduleName = $request->getModuleName();
        if ($moduleName) {
            $moduleLayoutPath = APPLICATION_PATH . '/modules/' . $moduleName . '/layouts/scripts/';
            if (is_dir($moduleLayoutPath)) {
                $layout = Zend_Layout::getMvcInstance();
                $layout->setLayoutPath($moduleLayoutPath);
            }
        }
    }
}