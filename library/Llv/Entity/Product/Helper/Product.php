<?php
/**
 * PHP Class Product.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Product_Helper_Product
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
        if (count($dal) > 0 && strlen($dal['title']) > 0) {
            $dto = new Llv_Dto_Product();
            $dto->id = $dal['id'];
            $dto->category = new Llv_Dto_Product_Category();
            $dto->category->id = $dal['product_category_id'];
            $dto->idLangue = $dal['language_id'];
            $dto->title = stripcslashes($dal['title']);
            $dto->introduction = stripcslashes($dal['introduction']);
            $dto->content = stripcslashes($dal['content']);
            $dto->url = $dal['url'];
            $dto->availability = $dal['availability'];
            $dto->position = $dal['position'];
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

    /**
     * @static
     *
     * @param $dal
     *
     * @return Llv_Dto_Product
     */
    public static function convertNightPriceFromDalToDto($dal)
    {
        $dal = array_shift($dal);
        if (count($dal) > 0) {
            $dto = new Llv_Dto_Product_Night_Price();
            $dto->one = $dal['one'];
            $dto->two = $dal['two'];
            $dto->three = $dal['three'];
            $dto->four = $dal['four'];
            return $dto;
        }
        return null;
    }

    /**
     * @static
     *
     * @param $dal
     *
     * @return Llv_Dto_Product
     */
    public static function convertSeasonPriceFromDalToDto($dal)
    {
        if (count($dal) > 0) {
//            Zend_Debug::dump($dal);die;
            $dto = new Llv_Dto_Product_Season_Price();
            $dto->season = new Llv_Dto_Season();
            $dto->season->id = $dal['type_id'];
            $dto->season->label = $dal['label'];
            $dto->season->idLangue = $dal['language_id'];
            $dto->week = $dal['week'];
            $dto->midweek = $dal['midweek'];
            $dto->weekend = $dal['weekend'];
            return $dto;
        }
        return null;
    }

    public static function convertListSeasonPriceFromDalToDto($dals)
    {
        $result = array();
        foreach ($dals as $dal) {
            $result[] = self::convertSeasonPriceFromDalToDto($dal);
        }
        return $result;
    }
}