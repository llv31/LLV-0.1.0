<?php
/**
 * PHP Class ModuleActivation.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_Plugin_ModuleActivation extends Zend_Controller_Plugin_Abstract
{
    /**
     * Initialise les modules Zend
     * @param Zend_Controller_Request_Abstract $request
     */
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        $activeModule = Llv_Context_Application::getInstance()->getActiveModule();
        $loader = new Zend_Loader_Autoloader_Resource(
            array(
                 'basePath' => APPLICATION_PATH . '/module/' . $activeModule,
                 'namespace'=> Zend_Filter::filterStatic(
                     strtr($activeModule, '-', '_'),
                     'Word_UnderscoreToCamelCase'
                 )
            )
        );
        $loader->addResourceType('form', 'forms', 'Form');
        if ($request->getModuleName() != $activeModule) {
            $request->setModuleName($activeModule)
                ->setControllerName('disabled')
                ->setActionName('index')
                ->setDispatched(false);
        }
    }
}