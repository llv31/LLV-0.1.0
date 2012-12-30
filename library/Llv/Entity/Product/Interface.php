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

interface Llv_Entity_Product_Interface
{
    /**
     * @abstract
     *
     * @param Llv_Entity_Product_Filter_Product $filter
     *
     * @return Llv_Dto_Product
     */
    public function getOne(Llv_Entity_Product_Filter_Product $filter);

    /**
     * @abstract
     *
     * @param Llv_Entity_Product_Filter_Product $filter
     *
     * @return array
     */
    public function getAll(Llv_Entity_Product_Filter_Product $filter);

    /**
     * @param Llv_Entity_Product_Request_Edit $request
     *
     * @return int
     */
    public function addRow(Llv_Entity_Product_Request_Edit $request);

    /**
     * @param Llv_Entity_Product_Request_Edit $request
     *
     * @return bool
     */
    public function updateRow(Llv_Entity_Product_Request_Edit $request);

    /**
     * @param Llv_Entity_Product_Filter_Product $filter
     *
     * @return null
     */
    public function deleteRow(Llv_Entity_Product_Filter_Product $filter);

    /**
     * @param Llv_Entity_Product_Request_EditContent $request
     *
     * @return int
     */
    public function addRowContent(Llv_Entity_Product_Request_EditContent $request);

    /**
     * @param Llv_Entity_Product_Request_EditContent $request
     *
     * @return bool
     */
    public function updateRowContent(Llv_Entity_Product_Request_EditContent $request);

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */
    /**
     * @param Llv_Entity_Product_Request_EditSeason $request
     *
     * @return mixed
     */
    public function updateRowTarifSeason(Llv_Entity_Product_Request_EditSeason $request);

    /**
     * @param Llv_Entity_Product_Request_EditNight $request
     *
     * @return int
     */
    public function updateRowTarifNight(Llv_Entity_Product_Request_EditNight $request);

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Product_Request_File $request
     *
     * @return bool|int
     */
    public function addRowFile(Llv_Entity_Product_Request_File $request);

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Product_Filter_Category $filter
     *
     * @return Llv_Dto_Product
     */
    public function categoryGetOne(Llv_Entity_Product_Filter_Category $filter);

    /**
     * @param Llv_Entity_Product_Filter_Category $filter
     *
     * @return array
     */
    public function categoryGetAll(Llv_Entity_Product_Filter_Category $filter);

    /**
     * @param Llv_Entity_Product_Request_EditCategory $request
     *
     * @return array
     */
    public function categoryUpdateRow(Llv_Entity_Product_Request_EditCategory $request);

    /**
     * @param Llv_Entity_Product_Request_EditCategoryContent $request
     *
     * @return mixed
     */
    public function categoryEditRowContent(Llv_Entity_Product_Request_EditCategoryContent $request);

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Product_Filter_Season $filter
     *
     * @return array
     */
    public function weeksGetOne(Llv_Entity_Product_Filter_Season $filter);

    /**
     * @param Llv_Entity_Product_Filter_Season $filter
     *
     * @return array
     */
    public function weeksGetAll(Llv_Entity_Product_Filter_Season $filter);

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Product_Filter_Season $filter
     *
     * @return array
     */
    public function seasonGetAll(Llv_Entity_Product_Filter_Season $filter);

    /**
     * @param Llv_Entity_Product_Request_Season $filter
     *
     * @return mixed
     */
    public function weekUpdateLot(Llv_Entity_Product_Request_Season $filter);
}