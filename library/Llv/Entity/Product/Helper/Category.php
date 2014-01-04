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
            if (isset($dal['type'])) {
                $dto->type = $dal['type'];
            }
            if (isset($dal['title'])) {
                $dto->title = $dal['title'];
            }
            if (isset($dal['content'])) {
                $dto->content = $dal['content'];
            }
            if (isset($dal['address'])) {
                $dto->adresse = nl2br($dal['address']);
            }
            if (isset($dal['location'])) {
                $dto->location = new Llv_Dto_Coordinate();
                $location = explode(',', $dal['location']);
                $dto->location->value = $dal['location'];
                $dto->location->latitude = $location[0];
                $dto->location->longitude = $location[1];
            }
            if (isset($dal['pricing_type'])) {
                $dto->pricingType = $dal['pricing_type'];
            }
            if (isset($dal['pin_color'])) {
                $dto->pinColor = $dal['pin_color'];
            }
            if (isset($dal['route'])) {
                $dto->route = $dal['route'];
            }
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