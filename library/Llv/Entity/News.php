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

class Llv_Entity_News
    implements Llv_Entity_News_Interface
{
    /**
     * @param Llv_Entity_News_Filter_News $filter
     *
     * @return Llv_Dto_News
     */
    public function newsGetOne(Llv_Entity_News_Filter_News $filter)
    {
        return Llv_Entity_News_Helper_News::convertFromDalToDto(
            Llv_Entity_News_Dal_News::getOne($filter)
        );
    }

    /**
     * @param Llv_Entity_News_Filter_News $filter
     *
     * @return array
     */
    public function newsGetAll(Llv_Entity_News_Filter_News $filter)
    {
        return Llv_Entity_News_Helper_News::convertListFromDalToDto(
            Llv_Entity_News_Dal_News::getAll($filter)
        );
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_News_Filter_Category $filter
     *
     * @return Llv_Dto_News
     */
    public function categoryGetOne(Llv_Entity_News_Filter_Category $filter)
    {
        return Llv_Entity_News_Helper_Category::convertFromDalToDto(
            Llv_Entity_News_Dal_Category::getOne($filter)
        );
    }

    /**
     * @param Llv_Entity_News_Filter_Category $filter
     *
     * @return array
     */
    public function categoryGetAll(Llv_Entity_News_Filter_Category $filter)
    {
        return Llv_Entity_News_Helper_Category::convertListFromDalToDto(
            Llv_Entity_News_Dal_Category::getAll($filter)
        );
    }
}