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

class Llv_Context_Cms
    extends Llv_Context_Abstract
{
    /** @var Llv_Context_Cms */
    protected static $_instance;
    /** @var Llv_Services_Cms */
    private $_service;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Llv_Context_Cms
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Instancie le service
     */
    public function __construct()
    {
        $this->_service = new Llv_Services_Cms();
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Cms_Request_Page $request
     *
     * @return Llv_Dto_Cms_Page|null
     */
    public function pageGetRow(Llv_Services_Cms_Request_Page $request)
    {
        if (!isset($request->idLangue)) {
            $request->idLangue = Llv_Context_Application::getInstance()->getCurrentLocale()->getIdLangue();
        }
        $message = $this->_service->pageGetRow($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->page;
        }
        return null;
    }

    /**
     * @param Llv_Services_Cms_Request_Page $request
     *
     * @return mixed
     */
    public function pageUpdateRow(Llv_Services_Cms_Request_Page $request)
    {
        $message = $this->_service->pageUpdateRow($this->getHeaderMessage(), $request);
        return $message->success;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */


    /**
     * @param Llv_Services_Cms_Request_Carrousel $request
     *
     * @return mixed
     */
    public function carrouselAddRow(Llv_Services_Cms_Request_Carrousel $request)
    {
        $message = $this->_service->carrouselAddRow($this->getHeaderMessage(), $request);
        return $message->success;
    }

    /**
     * @param Llv_Services_Cms_Filter_Carrousel $filter
     *
     * @return mixed
     */
    public function carrouselGetRow(Llv_Services_Cms_Filter_Carrousel $filter)
    {
        $message = $this->_service->carrouselGetRow($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->carrousel;
        }
        return null;
    }

    /**
     * @param Llv_Services_Cms_Filter_Carrousel $filter
     *
     * @return array|Llv_Dto_Cms_Carrousel[]
     */
    public function carrouselGetList(Llv_Services_Cms_Filter_Carrousel $filter)
    {
        $message = $this->_service->carrouselGetList($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->carrousels;
        }
        return array();
    }

    /**
     * @param Llv_Services_Cms_Request_Carrousel $request
     *
     * @return mixed
     */
    public function carrouselDeleteRow(Llv_Services_Cms_Request_Carrousel $request)
    {
        $message = $this->_service->carrouselDeleteRow($this->getHeaderMessage(), $request);
        return $message->success;
    }

    /**
     * @param Llv_Services_Cms_Request_Carrousel $request
     *
     * @return bool
     */
    public function carrouselUpdateRow(Llv_Services_Cms_Request_Carrousel $request)
    {
        $message = $this->_service->carrouselUpdateRow($this->getHeaderMessage(), $request);
        return $message->success;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Cms_Filter_Traduction $filter
     *
     * @return array|Llv_Dto_Cms_Traduction[]
     */
    public function traductionGetAll(Llv_Services_Cms_Filter_Traduction $filter)
    {
        $message = $this->_service->traductionGetAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->traductions;
        }
        return array();
    }

    /**
     * @param Llv_Services_Cms_Request_Traduction $request
     *
     * @return bool
     */
    public function traductionUpdateAll(Llv_Services_Cms_Request_Traduction $request)
    {
        $message = $this->_service->traductionUpdateAll($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->success;
        }
        return false;
    }

}