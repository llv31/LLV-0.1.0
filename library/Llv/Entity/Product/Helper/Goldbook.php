<?php
/**
 * PHP Class Goldbook.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Product_Helper_Goldbook
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
        if (is_array($dal) && count($dal) > 0) {
            $dto = new Llv_Dto_Product_Goldbook();
            $dto->id = $dal['id'];
            $dto->idCategorie = $dal['product_category_id'];
            $dto->content = $dal['content'];
            $dto->validated = $dal['validated'];
            $dto->dateBegin = new DateTime($dal['date_begining']);
            $dto->dateEnd = new DateTime($dal['date_ending']);
            $dto->dateAdd = new DateTime($dal['date_add']);
            $dto->dateUpdate = new DateTime($dal['date_update']);
            $dto->dateDelete = new DateTime($dal['date_delete']);
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