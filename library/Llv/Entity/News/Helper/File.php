<?php
/**
 * PHP Class File.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 16/09/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_News_Helper_File
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
        if (count($dal) > 0) {
            $dto = new Llv_Dto_News_File();
            $dto->id = $dal['id'];
            $dto->idNews = $dal['news_id'];
            $dto->filename = $dal['filename'];
            $dto->position = $dal['position'];
            $dto->id = $dal['id'];
            $dto->online = $dal['online'];
            $dto->dateAdd = new DateTime($dal['date_add']);
            $dto->dateDelete = isset($dal['date_delete']) ? new DateTime($dal['date_delete']) : null;
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