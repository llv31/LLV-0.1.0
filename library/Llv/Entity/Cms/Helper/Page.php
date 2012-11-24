<?php
/**
 * PHP Class Page.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Cms_Helper_Page
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
        $dto = new Llv_Dto_Cms_Page();
        $dto->id = $dal['page_id'];
        $dto->idLangue = $dal['language_id'];
        $dto->title = stripslashes($dal['title']);
        $dto->content = stripslashes($dal['content']);
        $dto->url = stripslashes($dal['url']);
        $dto->dateAdd = $dal['date_add'];
        $dto->dateUpdate = $dal['date_update'];
        $dto->dateDelete = isset($dal['date_delete']) ? new DateTime($dal['date_delete']) : null;
        return $dto;
    }
}