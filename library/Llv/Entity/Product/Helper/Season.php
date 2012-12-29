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

class Llv_Entity_Product_Helper_Season
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
            $dto = new Llv_Dto_Season();
            $dto->id = $dal['type_id'];
            $dto->label = $dal['label'];
            $dto->idLangue = $dal['language_id'];
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
     * @return Llv_Dto_Week|null
     */
    public static function convertWeekFromDalToDto($dal)
    {
        if (count($dal) > 0) {
            $dto = new Llv_Dto_Week();
            $dto->season = new Llv_Dto_Season();
            $dto->id = $dal['id'];
            $dto->number = $dal['number'];
            $dto->season->id = $dal['type_id'];
            $dto->dateBegining = $dal['date_begining'];
            $dto->dateEnding = $dal['date_ending'];
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
    public static function convertWeekListFromDalToDto($dals)
    {
        $result = array();
        foreach ($dals as $dal) {
            $result[] = self::convertWeekFromDalToDto($dal);
        }
        return $result;
    }
}