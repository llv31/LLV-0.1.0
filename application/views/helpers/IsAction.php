<?php
/**
 * PHP Class IsAction.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_IsAction
    extends Zend_View_Helper_Abstract
{
    /**
     * Retourne vrai si la chaine en paramètre est l'action courante
     * @param $actionName
     *
     * @return bool
     */
    public function isAction($actionName)
    {
        return Zend_Controller_Front::getInstance()->getRequest()->getParam('action') == $actionName;
    }
}