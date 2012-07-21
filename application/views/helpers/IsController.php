<?php
/**
 * PHP Class IsController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_IsController
    extends Zend_View_Helper_Abstract
{
    /**
     * Retourne vrai si la chaine en paramètre est le controlleur courant
     * @param $controllerName
     *
     * @return bool
     */
    public function isController($controllerName)
    {
        return Zend_Controller_Front::getInstance()->getRequest()->getParam('controller') == $controllerName;
    }
}