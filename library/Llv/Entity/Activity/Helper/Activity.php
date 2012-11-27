<?php
/**
 * PHP Class Activity.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Activity_Helper_Activity
{
    /**
     * @static
     *
     * @param $dal
     *
     * @return Llv_Dto_Activity
     */
    public static function convertFromDalToDto($dal)
    {
        if (count($dal) > 0) {
            $dto = new Llv_Dto_Activity();
            $dto->id = $dal['id'];
            $dto->category = new Llv_Dto_Activity_Category();
            $dto->category->id = $dal['category_id'];
            $dto->idLangue = $dal['language_id'];
            $dto->title = stripcslashes($dal['title']);
            $dto->content = stripcslashes($dal['content']);
            $dto->link = $dal['link'];
            $dto->location = $dal['location'];
            $dto->online = $dal['online'];
            $dto->dateAdd = new DateTime($dal['date_add']);
            $dto->dateUpdate = isset($dal['date_update']) ? new DateTime($dal['date_update']) : null;
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