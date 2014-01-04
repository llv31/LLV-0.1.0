<?php
/**
 * PHP Class GetAction.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_GetLocations
    extends Zend_View_Helper_Abstract
{
    /**
     * Retourne l'action courante
     *
     * @return bool
     */
    public function getLocations()
    {
        $filter = new Llv_Services_Product_Filter_Product();
        return Llv_Context_Product::getInstance()->getAll($filter);
    }
}