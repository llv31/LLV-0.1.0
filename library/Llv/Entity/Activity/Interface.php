<?php
/**
 * PHP Class Interface.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

interface Llv_Entity_Activity_Interface
{
    /**
     * @abstract
     *
     * @param Llv_Entity_Activity_Filter_Activity $filter
     *
     * @return Llv_Dto_Activity
     */
    public function getOne(Llv_Entity_Activity_Filter_Activity $filter);

    /**
     * @abstract
     *
     * @param Llv_Entity_Activity_Filter_Activity $filter
     *
     * @return array
     */
    public function getAll(Llv_Entity_Activity_Filter_Activity $filter);

    /**
     * @param Llv_Entity_Activity_Request_Edit $request
     *
     * @return int
     */
    public function addRow(Llv_Entity_Activity_Request_Edit $request);

    /**
     * @param Llv_Entity_Activity_Request_Edit $request
     *
     * @return bool
     */
    public function updateRow(Llv_Entity_Activity_Request_Edit $request);

    /**
     * @param Llv_Entity_Activity_Filter_Activity $filter
     *
     * @return null
     */
    public function deleteRow(Llv_Entity_Activity_Filter_Activity $filter);

    /**
     * @param Llv_Entity_Activity_Request_EditContent $request
     *
     * @return int
     */
    public function addRowContent(Llv_Entity_Activity_Request_EditContent $request);

    /**
     * @param Llv_Entity_Activity_Request_EditContent $request
     *
     * @return bool
     */
    public function updateRowContent(Llv_Entity_Activity_Request_EditContent $request);

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Activity_Request_File $request
     *
     * @return bool|int
     */
    public function addRowFile(Llv_Entity_Activity_Request_File $request);

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Activity_Filter_Category $filter
     *
     * @return Llv_Dto_Activity
     */
    public function categoryGetOne(Llv_Entity_Activity_Filter_Category $filter);

    /**
     * @param Llv_Entity_Activity_Filter_Category $filter
     *
     * @return array
     */
    public function categoryGetAll(Llv_Entity_Activity_Filter_Category $filter);
}