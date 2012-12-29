<?php
/**
 * PHP Class Llv_Router.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Router extends Zend_Controller_Router_Rewrite
{
    /** @var int */
    protected $_idLangue;
    /** @var string */
    protected $_module;

    /**
     * Charge les routes
     */
    public function loadRoutes()
    {
        $filter = new Llv_Services_Route_Filter_Route();
        $routes = Llv_Context_Route::getInstance()->getAll($filter);
        $result = array();

        /** @var $route Llv_Dto_Route */
        foreach ($routes as $route) {
            $parametres = array(
                'controller' => $route->controller,
                'action'     => $route->action,
                'module'     => $this->_module
            );
            $routeA = new Llv_Router_Route(
                '/' . $route->regle . '/',
                $parametres
            );
            $routeA->setLocale(Llv_Context_Application::getInstance()->getCurrentLocale());
            $result[$route->name] = $routeA;
        }

        foreach ($result as $name => $row) {
            $this->addRoute($name, $row);
        }

        try {
            Zend_Controller_Router_Route::setDefaultTranslator(Llv_Translator::get());
        } catch (Exception $e) {
            Zend_Debug::dump($e);
        }

        if (isset($this->_routes['default']) && php_sapi_name() == 'cli') {
            $this->removeRoute('default');
            $this->addDefaultRoutes();
        } else if (!isset($this->_routes['default'])) {
            $this->addDefaultRoutes();
        }
    }

    /**
     * @param int $idLangue
     */
    public function setIdLangue($idLangue)
    {
        $this->_idLangue = $idLangue;
    }

    /**
     * @return int
     */
    public function getIdLangue()
    {
        return $this->_idLangue;
    }

    /**
     * @param string $module
     */
    public function setModule($module)
    {
        $this->_module = $module;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->_module;
    }
}