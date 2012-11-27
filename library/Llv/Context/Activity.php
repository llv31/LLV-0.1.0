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

class Llv_Context_Activity
    extends Llv_Context_Abstract
{
    /** @var Llv_Context_Activity */
    protected static $_instance;
    /** @var  */
    private $_service;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Llv_Context_Activity
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
        $this->_service = new Llv_Services_Activity();
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Activity_Filter_Activity $filter
     *
     * @return Llv_Dto_Activity|null
     */
    public function getOne(Llv_Services_Activity_Filter_Activity $filter)
    {
        $message = $this->_service->getOne($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->activite;
        }
        return null;
    }

    /**
     * @param Llv_Services_Activity_Filter_Activity $filter
     *
     * @return null
     */
    public function getAll(Llv_Services_Activity_Filter_Activity $filter)
    {
        if (!isset($filter->idLangue)) {
            $filter->idLangue = Llv_Context_Application::getInstance()->getCurrentLocale()->getIdLangue();
        }
        $message = $this->_service->getAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->activites;
        }
        return null;
    }

    /**
     * @param Llv_Services_Activity_Request_Edit $request
     *
     * @return null
     */
    public function addRow(Llv_Services_Activity_Request_Edit $request)
    {
        $message = $this->_service->editRow($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->idActivite;
        }
        return false;
    }

    /**
     * @param Llv_Services_Activity_Request_Edit $request
     *
     * @return null
     */
    public function updateRow(Llv_Services_Activity_Request_Edit $request)
    {
        $message = $this->_service->editRow($this->getHeaderMessage(), $request);
        return $message->success;
    }

    /**
     * @param Llv_Services_Activity_Filter_Activity $filter
     *
     * @return mixed
     */
    public function deleteRow(Llv_Services_Activity_Filter_Activity $filter)
    {
        $message = $this->_service->deleteRow($this->getHeaderMessage(), $filter);
        return $message->success;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Activity_Request_EditContent $request
     *
     * @return bool
     */
    public function editRowContent(Llv_Services_Activity_Request_EditContent $request)
    {
        $message = $this->_service->editRowContent($this->getHeaderMessage(), $request);
        return $message->success;
    }


    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Activity_Request_File $request
     *
     * @return bool
     */
    public function addRowFile(Llv_Services_Activity_Request_File $request)
    {
        $message = $this->_service->addRowFile($this->getHeaderMessage(), $request);
        return $message->success;
    }

    /**
     * @param Llv_Services_Activity_Filter_File $filter
     *
     * @return bool
     */
    public function getActivityFiles(Llv_Services_Activity_Filter_File $filter)
    {
        $message = $this->_service->getActivityFiles($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->files;
        }
        return false;
    }

    /**
     * @param Llv_Services_Activity_Request_File $request
     *
     * @return bool|Llv_Dto_Activity_File[]
     */
    public function updateRowFile(Llv_Services_Activity_Request_File $request)
    {
        $message = $this->_service->updateRowFile($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->file->idActivity;
        }
        return false;
    }

    /**
     * @param Llv_Services_Activity_Request_File $request
     *
     * @return bool
     */
    public function deleteRowFile(Llv_Services_Activity_Request_File $request)
    {
        $message = $this->_service->deleteRowFile($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->idActivity;
        }
        return false;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Activity_Filter_Category $filter
     *
     * @return Llv_Dto_Activity|null
     */
    public function categoryGetOneById(Llv_Services_Activity_Filter_Category $filter)
    {
        $message = $this->_service->categoryGetOne($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->categorie;
        }
        return null;
    }

    /**
     * @param Llv_Services_Activity_Filter_Category $filter
     *
     * @return array
     */
    public function categoryGetAll(Llv_Services_Activity_Filter_Category $filter)
    {
        $message = $this->_service->categoryGetAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->categories;
        }
        return null;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */
}