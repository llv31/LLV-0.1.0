<?php
/**
 * PHP Class Language.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Referential_Helper_Language
{
    /**
     * @static
     *
     * @param array $dal
     *
     * @return Llv_Dto_Language
     */
    public static function convertFromDalToDto($dal)
    {
        $dto = new Llv_Dto_Language();
        $dto->id = $dal['id'];
        $dto->label = $dal['label'];
        $dto->locale = new Llv_Locale($dal['locale']);
        $dto->shortTag = $dal['short_tag'];
        return $dto;
    }

    /**
     * @static
     *
     * @param $dals
     *
     * @return array
     */
    public static function convertFromDalToDtoAll($dals)
    {
        $result = array();
        foreach ($dals as $dal) {
            $result[] = self::convertFromDalToDto($dal);
        }
        return $result;
    }
}