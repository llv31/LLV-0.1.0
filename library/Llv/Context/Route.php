<?php
/**
 * PHP Class Route.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Context_Route
    extends Llv_Context_Abstract
{
    /** @var Llv_Context_Route */
    protected static $_instance;
    /** @var Llv_Services_Route */
    private $_service;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Llv_Context_Route
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Instancie le service
     */
    public function __construct()
    {
        $this->_service = new Llv_Services_Route();
    }

    public function getAll(Llv_Services_Route_Filter_Route $filter)
    {
        if (!isset($filter->idLangue)) {
            $filter->idLangue = Llv_Context_Application::getInstance()->getCurrentLocale()->getIdLangue();
        }
        $message = $this->_service->getAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->routes;
        }
        return null;
    }
}