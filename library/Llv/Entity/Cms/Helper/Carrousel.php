<?php
/**
 * PHP Class Carrousel.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Cms_Helper_Carrousel
{
    /**
     * @static
     *
     * @param array $dal
     *
     * @return Llv_Dto_Cms_Page
     */
    public static function convertFromDalToDto(array $dal)
    {
        $dto = new Llv_Dto_Cms_Carrousel();
        $dto->id = $dal['id'];
        $dto->filename = $dal['filename'];
        $dto->originalFilename = $dal['original_filename'];
        $dto->mimeType = $dal['mime_type'];
        $dto->size = $dal['size'];
        $dto->online = (bool)$dal['online'];
        $dto->position = $dal['position'];
        $dto->link = $dal['link'];
        $dto->dateAdd = new DateTime($dal['date_add']);
        $dto->dateUpdate = new DateTime($dal['date_update']);
        $dto->dateDelete = isset($dal['date_delete']) ? new DateTime($dal['date_delete']) : null;
        return $dto;
    }

    /**
     * @param $dals
     *
     * @return array
     */
    public static function convertListFromDalToDto($dals)
    {
        $result = array();
        foreach ($dals as $ligne) {
            $result[] = Llv_Entity_Cms_Helper_Carrousel::convertFromDalToDto($ligne);
        }
        return $result;
    }
}