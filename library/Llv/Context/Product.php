<?php
/**
 * PHP Class Product.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Context_Product
    extends Llv_Context_Abstract
{
    /** @var Llv_Context_Product */
    protected static $_instance;
    /** @var  */
    private $_service;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Llv_Context_Product
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
        $this->_service = new Llv_Services_Product();
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Product_Filter_Product $filter
     *
     * @return Llv_Dto_Product|null
     */
    public function getOne(Llv_Services_Product_Filter_Product $filter)
    {
        if (!isset($filter->idLangue)) {
            $filter->idLangue = Llv_Context_Application::getInstance()->getCurrentLocale()->getIdLangue();
        }
        $message = $this->_service->getOne($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->product;
        }
        return null;
    }

    /**
     * @param Llv_Services_Product_Filter_Product $filter
     *
     * @return null
     */
    public function getAll(Llv_Services_Product_Filter_Product $filter)
    {
        if (!isset($filter->idLangue)) {
            $filter->idLangue = Llv_Context_Application::getInstance()->getCurrentLocale()->getIdLangue();
        }
        $message = $this->_service->getAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->products;
        }
        return null;
    }

    /**
     * @param Llv_Services_Product_Request_Edit $request
     *
     * @return null
     */
    public function addRow(Llv_Services_Product_Request_Edit $request)
    {
        $message = $this->_service->editRow($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->idActivite;
        }
        return false;
    }

    /**
     * @param Llv_Services_Product_Request_Edit $request
     *
     * @return null
     */
    public function updateRow(Llv_Services_Product_Request_Edit $request)
    {
        $message = $this->_service->editRow($this->getHeaderMessage(), $request);
        return $message->success;
    }

    /**
     * @param Llv_Services_Product_Filter_Product $filter
     *
     * @return mixed
     */
    public function deleteRow(Llv_Services_Product_Filter_Product $filter)
    {
        $message = $this->_service->deleteRow($this->getHeaderMessage(), $filter);
        return $message->success;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Product_Request_EditContent $request
     *
     * @return bool
     */
    public function editRowContent(Llv_Services_Product_Request_EditContent $request)
    {
        $message = $this->_service->editRowContent($this->getHeaderMessage(), $request);
        return $message->success;
    }


    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Product_Request_File $request
     *
     * @return bool
     */
    public function addRowFile(Llv_Services_Product_Request_File $request)
    {
        $message = $this->_service->addRowFile($this->getHeaderMessage(), $request);
        return $message->success;
    }

    /**
     * @param Llv_Services_Product_Filter_File $filter
     *
     * @return bool
     */
    public function getProductFiles(Llv_Services_Product_Filter_File $filter)
    {
        $message = $this->_service->getProductFiles($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->files;
        }
        return false;
    }

    /**
     * @param Llv_Services_Product_Request_File $request
     *
     * @return bool|Llv_Dto_Product_File[]
     */
    public function updateRowFile(Llv_Services_Product_Request_File $request)
    {
        $message = $this->_service->updateRowFile($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->file->idProduct;
        }
        return false;
    }

    /**
     * @param Llv_Services_Product_Request_File $request
     *
     * @return bool
     */
    public function deleteRowFile(Llv_Services_Product_Request_File $request)
    {
        $message = $this->_service->deleteRowFile($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->idProduct;
        }
        return false;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * @param Llv_Services_Product_Filter_Category $filter
     *
     * @return Llv_Dto_Product_Category|null
     */
    public function categoryGetOne(Llv_Services_Product_Filter_Category $filter)
    {
        $message = $this->_service->categoryGetOne($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->categorie;
        }
        return null;
    }

    /**
     * @param Llv_Services_Product_Filter_Category $filter
     *
     * @return array
     */
    public function categoryGetAll(Llv_Services_Product_Filter_Category $filter)
    {
        $message = $this->_service->categoryGetAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->categories;
        }
        return null;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */
    /**
     * @param Llv_Services_Product_Filter_Season $filter
     *
     * @return Llv_Dto_Week[]|null
     */
    public function weeksGetOne(Llv_Services_Product_Filter_Season $filter)
    {
        if (is_null($filter->dateDebut)) {
            $filter->dateDebut = new DateTime();
        }
        if ($filter->dateFin = true) {
            $filter->dateFin = new DateTime(
                date(
                    Llv_Constant_Date::FORMAT_DB,
                    strtotime('+1 week', $filter->dateDebut->getTimestamp())
                )
            );
        }
        $message = $this->_service->weeksGetOne($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->week;
        }
        return null;
    }

    /**
     * @param Llv_Services_Product_Filter_Season $filter
     *
     * @return Llv_Dto_Week[]|null
     */
    public function weeksGetAll(Llv_Services_Product_Filter_Season $filter)
    {
        if (is_null($filter->dateDebut)) {
            $filter->dateDebut = new DateTime();
        }
        if (is_null($filter->dateFin)) {
            $filter->dateFin = new DateTime(
                date(
                    Llv_Constant_Date::FORMAT_DB,
                    strtotime('+2 years', $filter->dateDebut->getTimestamp())
                )
            );
        }
        $message = $this->_service->weeksGetAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->weeks;
        }
        return null;
    }
    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */
}