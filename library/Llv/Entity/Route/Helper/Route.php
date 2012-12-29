<?php
/**
 * PHP Class Llv_Entity_Route_Helper_Route.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Route_Helper_Route
{
    /**
     * @static
     *
     * @param array $dal
     *
     * @return Llv_Dto_Route
     */
    public static function convertFromDalToDto($dal)
    {
        $dto = new Llv_Dto_Route();
        $dto->id = $dal['id'];
        $dto->name = $dal['name'];
        $dto->regle = $dal['rule'];
        $dto->controller = $dal['controller'];
        $dto->action = $dal['action'];
        $dto->traduction = $dal['value'];
        $dto->parametres = array();
        return $dto;
    }

    /**
     * @static
     *
     * @param $dals
     *
     * @return array
     */
    public static function convertListFromDalToDto($dals)
    {
        $result = array();
        foreach ($dals as $dal) {
            $result[] = self::convertFromDalToDto($dal);
        }
        return $result;
    }
}