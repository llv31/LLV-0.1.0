<?php
/**
 * PHP Class IndexController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class IndexController
    extends Zend_Controller_Action
{
    public function init()
    {
        $this->view->assign('urlToLike', "https://www.facebook.com/pages/Luchon-Location-Vacances/113336662034784");
        $this->geolocation();
    }

    public function indexAction()
    {
        $request = new Llv_Services_Cms_Request_Page();
        $request->id = Llv_Constant_Cms_Page::HOME_ID;
        $page = Llv_Context_Cms::getInstance()->pageGetRow($request);

        $filter = new Llv_Services_Cms_Filter_Carrousel();
        $filter->online = true;
        $carrousel = Llv_Context_Cms::getInstance()->carrouselGetList($filter);

        $filter = new Llv_Services_News_Filter_News();
        $filter->spotlight = true;
        $filter->onlineIllustration = true;
        $news = Llv_Context_News::getInstance()->getOne($filter);

        $filter = new Llv_Services_Activity_Filter_Activity();
        $filter->spotlight = true;
        $filter->onlineIllustration = true;
        $activity = Llv_Context_Activity::getInstance()->getOne($filter);

        $this->view->assign('page', $page);
        $this->view->assign('carrousel', $carrousel);
        $this->view->assign('news', $news);
        $this->view->assign('activity', $activity);
    }

    public function geolocation()
    {
        foreach ($_SERVER as $key=> $srvLine) {
            if (strstr($key, 'GEOIP_')) {
                $res[] = $srvLine;
            }
        }
        $filename = APPLICATION_PATH . '/../data/logs/visits.log';
        $document = file_get_contents($filename);
        $res = implode(', ', $res);
        if (!in_array($res, explode(PHP_EOL, $document))) {
            $document .= $res . PHP_EOL;
            file_put_contents($filename, $document);
        }
    }
}