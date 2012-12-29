<?php
/**
 * PHP Class Route.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Route
    implements Llv_Entity_Route_Interface
{

    /**
     * @param Llv_Entity_Route_Filter_Route $filter
     *
     * @return Llv_Dto_Route|null
     */
    public function getAll(Llv_Entity_Route_Filter_Route $filter)
    {
        return Llv_Entity_Route_Helper_Route::convertListFromDalToDto(
            Llv_Entity_Route_Dal_Route::getAll($filter)
        );
    }
}