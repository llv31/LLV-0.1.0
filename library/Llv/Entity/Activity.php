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

class Llv_Entity_Activity
    implements Llv_Entity_Activity_Interface
{
    /**
     * @param Llv_Entity_Activity_Filter_Activity $filter
     *
     * @return Llv_Dto_Activity
     */
    public function getOne(Llv_Entity_Activity_Filter_Activity $filter)
    {
        return Llv_Entity_Activity_Helper_Activity::convertFromDalToDto(
            Llv_Entity_Activity_Dal_Activity::getOne($filter)
        );
    }

    /**
     * @param Llv_Entity_Activity_Filter_Activity $filter
     *
     * @return array
     */
    public function getAll(Llv_Entity_Activity_Filter_Activity $filter)
    {
        return Llv_Entity_Activity_Helper_Activity::convertListFromDalToDto(
            Llv_Entity_Activity_Dal_Activity::getAll($filter)
        );
    }

    /**
     * @param Llv_Entity_Activity_Request_Edit $request
     *
     * @return int
     */
    public function addRow(Llv_Entity_Activity_Request_Edit $request)
    {
        return Llv_Entity_Activity_Dal_Activity::addRow($request);
    }

    /**
     * @param Llv_Entity_Activity_Request_Edit $request
     *
     * @return bool
     */
    public function updateRow(Llv_Entity_Activity_Request_Edit $request)
    {
        return Llv_Entity_Activity_Dal_Activity::updateRow($request);
    }

    /**
     * @param Llv_Entity_Activity_Filter_Activity $filter
     *
     * @return null
     */
    public function deleteRow(Llv_Entity_Activity_Filter_Activity $filter)
    {
        return Llv_Entity_Activity_Dal_Activity::deleteRow($filter);
    }

    /**
     * @param Llv_Entity_Activity_Request_EditContent $request
     *
     * @return int
     */
    public function addRowContent(Llv_Entity_Activity_Request_EditContent $request)
    {
        return Llv_Entity_Activity_Dal_Activity::addRowContent($request);
    }

    /**
     * @param Llv_Entity_Activity_Request_EditContent $request
     *
     * @return bool
     */
    public function updateRowContent(Llv_Entity_Activity_Request_EditContent $request)
    {
        return Llv_Entity_Activity_Dal_Activity::updateRowContent($request);
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Activity_Request_File $request
     *
     * @return bool|int
     */
    public function addRowFile(Llv_Entity_Activity_Request_File $request)
    {
        return Llv_Entity_Activity_Dal_Activity::addRowFile($request);
    }

    /**
     * @param Llv_Entity_Activity_Filter_File $filter
     *
     * @return array
     */
    public function getActivityFiles(Llv_Entity_Activity_Filter_File $filter)
    {
        return Llv_Entity_Activity_Helper_File::convertListFromDalToDto(
            Llv_Entity_Activity_Dal_Activity::getActivityFiles($filter)
        );
    }

    /**
     * @param Llv_Entity_Activity_Request_File $request
     *
     * @return Llv_Dto_Activity
     */
    public function updateRowFile(Llv_Entity_Activity_Request_File $request)
    {
        return Llv_Entity_Activity_Helper_File::convertFromDalToDto(
            Llv_Entity_Activity_Dal_Activity::updateRowFile($request)
        );
    }

    /**
     * @param Llv_Entity_Activity_Filter_File $filter
     *
     * @return mixed
     */
    public function deleteRowFile(Llv_Entity_Activity_Filter_File $filter)
    {
        return Llv_Entity_Activity_Dal_Activity::deleteRowFile($filter);
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Activity_Filter_Category $filter
     *
     * @return Llv_Dto_Activity
     */
    public function categoryGetOne(Llv_Entity_Activity_Filter_Category $filter)
    {
        return Llv_Entity_Activity_Helper_Category::convertFromDalToDto(
            Llv_Entity_Activity_Dal_Category::getOne($filter)
        );
    }

    /**
     * @param Llv_Entity_Activity_Filter_Category $filter
     *
     * @return array
     */
    public function categoryGetAll(Llv_Entity_Activity_Filter_Category $filter)
    {
        return Llv_Entity_Activity_Helper_Category::convertListFromDalToDto(
            Llv_Entity_Activity_Dal_Category::getAll($filter)
        );
    }
}