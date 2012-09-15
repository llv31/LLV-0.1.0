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

interface Llv_Entity_News_Interface
{
    /**
     * @abstract
     *
     * @param Llv_Entity_News_Filter_News $filter
     *
     * @return Llv_Dto_News
     */
    public function newsGetOne(Llv_Entity_News_Filter_News $filter);

    /**
     * @abstract
     *
     * @param Llv_Entity_News_Filter_News $filter
     *
     * @return array
     */
    public function newsGetAll(Llv_Entity_News_Filter_News $filter);

    /**
     * @param Llv_Entity_News_Request_Edit $request
     *
     * @return int
     */
    public function addRow(Llv_Entity_News_Request_Edit $request);

    /**
     * @param Llv_Entity_News_Request_Edit $request
     *
     * @return bool
     */
    public function updateRow(Llv_Entity_News_Request_Edit $request);

    /**
     * @param Llv_Entity_News_Request_EditContent $request
     *
     * @return int
     */
    public function addRowContent(Llv_Entity_News_Request_EditContent $request);

    /**
     * @param Llv_Entity_News_Request_EditContent $request
     *
     * @return bool
     */
    public function updateRowContent(Llv_Entity_News_Request_EditContent $request);

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_News_Filter_Category $filter
     *
     * @return Llv_Dto_News
     */
    public function categoryGetOne(Llv_Entity_News_Filter_Category $filter);

    /**
     * @param Llv_Entity_News_Filter_Category $filter
     *
     * @return array
     */
    public function categoryGetAll(Llv_Entity_News_Filter_Category $filter);
}