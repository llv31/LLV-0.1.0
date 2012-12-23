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

class Llv_Entity_Product_Helper_Category
{
    /**
     * @static
     *
     * @param $dal
     *
     * @return Llv_Dto_Product
     */
    public static function convertFromDalToDto($dal)
    {
        if (count($dal) > 0) {
            $dto = new Llv_Dto_Product_Category();
            $dto->id = $dal['id'];
            $dto->title = $dal['title'];
            $dto->content = $dal['content'];
            $dto->adresse = $dal['address'];
            $dto->location = $dal['location'];
            $dto->pricingType = $dal['pricing_type'];
            $dto->route = $dal['route'];
            return $dto;
        }
        return null;
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