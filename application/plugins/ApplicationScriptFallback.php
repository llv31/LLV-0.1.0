<?php
/**
 * PHP Class ApplicationScriptFallback.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Plugin_ApplicationScriptFallback extends Zend_Controller_Plugin_Abstract
{
    /**
     * Initialise les vues et les helpers
     * @param Zend_Controller_Request_Abstract $request
     */
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $layout = Zend_Layout::getMvcInstance();
        $layout->getView()->addScriptPath(APPLICATION_PATH . '/views/scripts/');
        $layout->getView()->addHelperPath(APPLICATION_PATH . '/views/helpers/', 'App_View_Helper_');
    }
}