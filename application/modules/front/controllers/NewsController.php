<?php
/**
 * PHP Class NewsController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 29/09/12
 * @author      : aroy <contact@aroy.fr>
 */

class NewsController
    extends Zend_Controller_Action
{
    public function init()
    {

    }

    public function indexAction()
    {
        $this->_forward('list');
    }

    public function listAction()
    {
        $filter = new Llv_Services_News_Filter_News();
        $filter->online = true;
        $news = Llv_Context_News::getInstance()->getAll($filter);
        if (count($news) > 0) {
            $spotlight = array_shift($news);
            $this->view->assign('spotlight', $spotlight);
        }

        $this->view->assign('news', $news);
    }

    public function readAction()
    {
        foreach ($this->getFrontController()->getParams() as $test) {
            Zend_Debug::dump($test);
        }
    }
}