<?php
/**
 * PHP Class Interface.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

interface Llv_Entity_Route_Interface
{
    /**
     * @abstract
     *
     * @param Llv_Entity_Route_Filter_Route $filter
     *
     * @return mixed
     */
    public function getAll(Llv_Entity_Route_Filter_Route $filter);
}