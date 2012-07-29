<?php
/**
 * PHP Class Cms.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Cms
    implements Llv_Entity_Cms_Interface
{
    /**
     * @param Llv_Entity_Cms_Request_Page $request
     *
     * @return Llv_Dto_Cms_Page
     */
    public function pageGetRow(Llv_Entity_Cms_Request_Page $request)
    {
        return Llv_Entity_Cms_Helper_Page::convertFromDalToDto(
            Llv_Entity_Cms_Dal_Page::getRow($request)
        );
    }

    /**
     *
     * @param Llv_Entity_Cms_Request_Page $request
     *
     * @return mixed
     */
    public function pageUpdateRow(Llv_Entity_Cms_Request_Page $request)
    {
        return Llv_Entity_Cms_Dal_Page::updateRow($request);
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Cms_Request_Carrousel $request
     *
     * @return mixed
     */
    public function carrouselAddRow(Llv_Entity_Cms_Request_Carrousel $request)
    {
        return Llv_Entity_Cms_Dal_Carrousel::addRow($request);
    }

    /**
     * @param Llv_Entity_Cms_Filter_Carrousel $filter
     *
     * @return array|mixed
     */
    public function carrouselGetRow(Llv_Entity_Cms_Filter_Carrousel $filter)
    {
        return Llv_Entity_Cms_Helper_Carrousel::convertFromDalToDto(
            Llv_Entity_Cms_Dal_Carrousel::getOne($filter)
        );
    }

    /**
     * @param Llv_Entity_Cms_Filter_Carrousel $filter
     *
     * @return array|mixed
     */
    public function carrouselGetList(Llv_Entity_Cms_Filter_Carrousel $filter)
    {
        return Llv_Entity_Cms_Helper_Carrousel::convertListFromDalToDto(
            Llv_Entity_Cms_Dal_Carrousel::getList($filter)
        );
    }

    /**
     * @param Llv_Entity_Cms_Request_Carrousel $request
     *
     * @return bool|int
     */
    public function carrouselUpdateRow(Llv_Entity_Cms_Request_Carrousel $request)
    {
        return Llv_Entity_Cms_Dal_Carrousel::updateRow($request);
    }

    /**
     * @param Llv_Entity_Cms_Request_Carrousel $request
     *
     * @return mixed
     */
    public function carrouselDeleteRow(Llv_Entity_Cms_Request_Carrousel $request)
    {
        return Llv_Entity_Cms_Dal_Carrousel::deleteRow($request);
    }
}