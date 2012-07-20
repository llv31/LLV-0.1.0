<?php
/**
 * PHP Class Abstract.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

abstract class Llv_Context_Abstract
{
    /**
     * Retourne une instance de la classe
     *
     * @static
     * @abstract
     * @return mixed
     */
    abstract public static function getInstance();

    /**
     * Retourne les en-têtes attendues par les services
     * @return Llv_Services_Message_Header
     */
    public function getHeaderMessage()
    {
        $header = new Llv_Services_Message_Header();
        $header->_locale = Llv_Context_Application::getInstance()->getCurrentLocale();
        $header->_idSite = Llv_Context_Application::getInstance()->getCurrentSite();
        return $header;
    }
}