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
    public function newsGetOneById(Llv_Services_News_Filter_News $filter)
    {
        $message = $this->_service->newsGetOne($this->getHeaderMessage(), $filter);
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
    public function newsGetAll(Llv_Services_News_Filter_News $filter)
    {
        $message = $this->_service->newsGetAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->actualites;
        }
        return null;
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
            return $message->actualite;
        }
        return null;
    }

    /**
     * @param Llv_Services_News_Filter_Category $filter
     *
     * @return null
     */
    public function categoryGetAll(Llv_Services_News_Filter_Category $filter)
    {
        $message = $this->_service->categoryGetAll($this->getHeaderMessage(), $filter);
        if ($message->success) {
            return $message->actualites;
        }
        return null;
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */
}