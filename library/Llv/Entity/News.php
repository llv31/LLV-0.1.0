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
    public function getOne(Llv_Entity_News_Filter_News $filter)
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
    public function getAll(Llv_Entity_News_Filter_News $filter)
    {
        return Llv_Entity_News_Helper_News::convertListFromDalToDto(
            Llv_Entity_News_Dal_News::getAll($filter)
        );
    }

    /**
     * @param Llv_Entity_News_Request_Edit $request
     *
     * @return int
     */
    public function addRow(Llv_Entity_News_Request_Edit $request)
    {
        return Llv_Entity_News_Dal_News::addRow($request);
    }

    /**
     * @param Llv_Entity_News_Request_Edit $request
     *
     * @return bool
     */
    public function updateRow(Llv_Entity_News_Request_Edit $request)
    {
        return Llv_Entity_News_Dal_News::updateRow($request);
    }

    /**
     * @param Llv_Entity_News_Filter_News $filter
     *
     * @return null
     */
    public function deleteRow(Llv_Entity_News_Filter_News $filter)
    {
        return Llv_Entity_News_Dal_News::deleteRow($filter);
    }

    /**
     * @param Llv_Entity_News_Request_EditContent $request
     *
     * @return int
     */
    public function addRowContent(Llv_Entity_News_Request_EditContent $request)
    {
        return Llv_Entity_News_Dal_News::addRowContent($request);
    }

    /**
     * @param Llv_Entity_News_Request_EditContent $request
     *
     * @return bool
     */
    public function updateRowContent(Llv_Entity_News_Request_EditContent $request)
    {
        return Llv_Entity_News_Dal_News::updateRowContent($request);
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_News_Request_File $request
     *
     * @return bool|int
     */
    public function addRowFile(Llv_Entity_News_Request_File $request)
    {
        return Llv_Entity_News_Dal_News::addRowFile($request);
    }

    /**
     * @param Llv_Entity_News_Filter_File $filter
     *
     * @return array
     */
    public function getNewsFiles(Llv_Entity_News_Filter_File $filter)
    {
        return Llv_Entity_News_Helper_File::convertListFromDalToDto(
            Llv_Entity_News_Dal_News::getNewsFiles($filter)
        );
    }

    /**
     * @param Llv_Entity_News_Request_File $request
     *
     * @return Llv_Dto_News
     */
    public function updateRowFile(Llv_Entity_News_Request_File $request)
    {
        return Llv_Entity_News_Helper_File::convertFromDalToDto(
            Llv_Entity_News_Dal_News::updateRowFile($request)
        );
    }

    /**
     * @param Llv_Entity_News_Filter_File $filter
     *
     * @return mixed
     */
    public function deleteRowFile(Llv_Entity_News_Filter_File $filter)
    {
        return Llv_Entity_News_Dal_News::deleteRowFile($filter);
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