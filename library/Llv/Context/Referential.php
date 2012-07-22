<?php
/**
 * PHP Class Referential.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Context_Referential
    extends Llv_Context_Abstract
{
    /** @var Llv_Context_Referential */
    protected static $_instance;
    /** @var Llv_Services_Referential */
    private $_service;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Llv_Context_Referential
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
        $this->_service = new Llv_Services_Referential();
    }

    /**
     * Retourne un module en fonction d'un id de site
     * @param $idSite
     *
     * @return null|string
     */
    public function getModuleByIdSite($idSite)
    {
        $filter = new Llv_Services_Referential_Filter_Modules();
        $filter->idSite = $idSite;

        $message = $this->_service->getModuleByIdSite($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->module;
        }
        return null;
    }
}