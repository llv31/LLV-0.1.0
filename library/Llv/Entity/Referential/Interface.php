<?php
/**
 * PHP Interface Interface.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

interface Llv_Entity_Referential_Interface
{
    /**
     * Retourne plusieurs modules
     * @abstract
     *
     * @param Llv_Entity_Referential_Filter_Modules $filter
     *
     * @return mixed
     */
    public function getModules(Llv_Entity_Referential_Filter_Modules $filter);

    /**
     * Retourne un module
     * @abstract
     *
     * @param Llv_Entity_Referential_Filter_Module $filter
     *
     * @return mixed
     */
    public function getModule(Llv_Entity_Referential_Filter_Module $filter);
}