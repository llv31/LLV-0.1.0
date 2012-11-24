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

class Llv_Context_News
    extends Llv_Context_Abstract
{
    /** @var Llv_Context_News */
    protected static $_instance;
    /** @var  */
    private $_service;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Llv_Context_News
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
        $this->_service = new Llv_Services_News();
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_News_Filter_News $filter
     *
     * @return Llv_Dto_News|null
     */
        public function getOne(Llv_Services_News_Filter_News $filter)
    {
        $message = $this->_service->getOne($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->actualite;
        }
        return null;
    }

    /**
     * @param Llv_Services_News_Filter_News $filter
     *
     * @return null
     */
    public function getAll(Llv_Services_News_Filter_News $filter)
    {
        if (!isset($filter->idLangue)) {
            $filter->idLangue = Llv_Context_Application::getInstance()->getCurrentLocale()->getIdLangue();
        }
        $message = $this->_service->getAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->actualites;
        }
        return null;
    }

    /**
     * @param Llv_Services_News_Request_Edit $request
     *
     * @return null
     */
    public function addRow(Llv_Services_News_Request_Edit $request)
    {
        $message = $this->_service->editRow($this->getHeaderMessage(), $request);
        Zend_Debug::dump($request);
        if ($message->success) {
            return $message->idActualite;
        }
        return false;
    }

    /**
     * @param Llv_Services_News_Request_Edit $request
     *
     * @return null
     */
    public function updateRow(Llv_Services_News_Request_Edit $request)
    {
        $message = $this->_service->editRow($this->getHeaderMessage(), $request);
        return $message->success;
    }

    /**
     * @param Llv_Services_News_Filter_News $filter
     *
     * @return mixed
     */
    public function deleteRow(Llv_Services_News_Filter_News $filter)
    {
        $message = $this->_service->deleteRow($this->getHeaderMessage(), $filter);
        return $message->success;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_News_Request_EditContent $request
     *
     * @return bool
     */
    public function editRowContent(Llv_Services_News_Request_EditContent $request)
    {
        $message = $this->_service->editRowContent($this->getHeaderMessage(), $request);
        return $message->success;
    }


    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_News_Request_File $request
     *
     * @return bool
     */
    public function addRowFile(Llv_Services_News_Request_File $request)
    {
        $message = $this->_service->addRowFile($this->getHeaderMessage(), $request);
        return $message->success;
    }

    /**
     * @param Llv_Services_News_Filter_File $filter
     *
     * @return bool
     */
    public function getNewsFiles(Llv_Services_News_Filter_File $filter)
    {
        $message = $this->_service->getNewsFiles($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->files;
        }
        return false;
    }

    /**
     * @param Llv_Services_News_Request_File $request
     *
     * @return bool|Llv_Dto_News_File[]
     */
    public function updateRowFile(Llv_Services_News_Request_File $request)
    {
        $message = $this->_service->updateRowFile($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->file->idNews;
        }
        return false;
    }

    /**
     * @param Llv_Services_News_Request_File $request
     *
     * @return bool
     */
    public function deleteRowFile(Llv_Services_News_Request_File $request)
    {
        $message = $this->_service->deleteRowFile($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->idActualite;
        }
        return false;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_News_Filter_Category $filter
     *
     * @return Llv_Dto_News|null
     */
    public function categoryGetOneById(Llv_Services_News_Filter_Category $filter)
    {
        $message = $this->_service->categoryGetOne($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->categorie;
        }
        return null;
    }

    /**
     * @param Llv_Services_News_Filter_Category $filter
     *
     * @return array
     */
    public function categoryGetAll(Llv_Services_News_Filter_Category $filter)
    {
        $message = $this->_service->categoryGetAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->categories;
        }
        return null;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */
}