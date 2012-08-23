<?php
/**
 * PHP Class News.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_News_Helper_News
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
        $dto = new Llv_Dto_News();
        $dto->id = $dal['id'];
        $dto->category = new Llv_Dto_News_Category();
        $dto->category->id = $dal['category_id'];
        $dto->idLangue = $dal['language_id'];
        $dto->title = $dal['title'];
        $dto->content = $dal['content'];
        $dto->link= $dal['link'];
        $dto->location = $dal['location'];
        $dto->filename = $dal['filepath'];
        $dto->online = $dal['online'];
        $dto->dateAdd = new DateTime($dal['date_add']);
        $dto->dateUpdate = new DateTime($dal['date_update']);
        $dto->dateDelete = new DateTime($dal['date_delete']);
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