<?php
/**
 * PHP Class Interface.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/07/12
 * @author      : aroy <contact@aroy.fr>
 */

interface Llv_Entity_Cms_Interface
{
    /**
     * @abstract
     *
     * @param Llv_Entity_Cms_Request_Page $request
     *
     * @return Llv_Dto_Cms_Page
     */
    public function pageGetRow(Llv_Entity_Cms_Request_Page $request);

    /**
     * @abstract
     *
     * @param Llv_Entity_Cms_Request_Page $request
     *
     * @return mixed
     */
    public function pageUpdateRow(Llv_Entity_Cms_Request_Page $request);

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Entity_Cms_Request_Carrousel $request
     *
     * @return bool
     */
    public function carrouselAddRow(Llv_Entity_Cms_Request_Carrousel $request);

    /**
     * @param Llv_Entity_Cms_Request_Carrousel $request
     *
     * @return mixed
     */
    public function carrouselDeleteRow(Llv_Entity_Cms_Request_Carrousel $request);

    /**
     * @param Llv_Entity_Cms_Filter_Carrousel $filter
     *
     * @return array|mixed
     */
    public function carrouselGetList(Llv_Entity_Cms_Filter_Carrousel $filter);
}