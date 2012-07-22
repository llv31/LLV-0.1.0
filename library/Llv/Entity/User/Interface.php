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

interface Llv_Entity_User_Interface
{
    /**
     * @abstract
     *
     * @param Llv_Entity_User_Filter_User $filter
     *
     * @return mixed
     */
    public function getUser(Llv_Entity_User_Filter_User $filter);
}