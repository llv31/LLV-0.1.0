<?php
/**
 * PHP Class ActivitiesController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 29/09/12
 * @author      : aroy <contact@aroy.fr>
 */

class ActivitiesController
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
        $filter = new Llv_Services_Activity_Filter_Activity();
        $filter->online = true;
        $filter->onlineIllustration = true;
        $activities = Llv_Context_Activity::getInstance()->getAll($filter);
        if (count($activities) > 0) {
            $spotlight = array_shift($activities);
            $this->view->assign('spotlight', $spotlight);
        }

        $this->view->assign('activities', $activities);
    }

    public function readAction()
    {
        $filter = new Llv_Services_Activity_Filter_Activity();
        $filter->id = $this->_getParam('id');
        $filter->onlineIllustration = true;
        $activity = Llv_Context_Activity::getInstance()->getOne($filter);
        $this->view->assign('activity', $activity);
    }
}