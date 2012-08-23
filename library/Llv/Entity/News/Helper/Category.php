<?php
/**
 * PHP Class Category.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_News_Helper_Category
{
    /**
     * @static
     *
     * @param $dal
     *
     * @return Llv_Dto_News
     */
    public static function convertFromDalToDto($dal)
    {
        $dto = new Llv_Dto_News_Category();
        $dto->id = $dal['id'];
        $dto->title = $dal['title'];
        $dto->online = $dal['online'];
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