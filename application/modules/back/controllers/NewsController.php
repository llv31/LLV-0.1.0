<?php
/**
 * PHP Class NewsController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class NewsController
    extends Zend_Controller_Action
{
    public function init()
    {

    }

    /**
     *
     */
    public function indexAction()
    {
        $this->_forward('list');
    }

    /**
     *
     */
    public function listAction()
    {
        $filter = new Llv_Services_News_Filter_News();
        $filter->idLangue = Llv_Context_Application::getInstance()->getCurrentLocale()->getIdLangue();

        $this->view->assign('list', Llv_Context_News::getInstance()->newsGetAll($filter));
    }

    /**
     *
     */
    public function addAction()
    {
    }
}