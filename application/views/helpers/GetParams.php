<?php
/**
 * PHP Class GetParams.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_GetParams
    extends Zend_View_Helper_Abstract
{
    /**
     * Retourne l'action courante
     *
     * @return bool
     */
    public function getParams()
    {
        return Zend_Controller_Front::getInstance()->getRequest()->getParams();
    }
}