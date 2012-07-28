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

class App_View_Helper_GetAction
    extends Zend_View_Helper_Abstract
{
    /**
     * Retourne l'action courante
     *
     * @return bool
     */
    public function getAction()
    {
        return Zend_Controller_Front::getInstance()->getRequest()->getParam('action');
    }
}