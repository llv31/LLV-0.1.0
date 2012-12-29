<?php
/**
 * PHP Class PartnersController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class PartnersController
    extends Zend_Controller_Action
{
    public function init()
    {
    }

    public function indexAction()
    {
        $request = new Llv_Services_Cms_Request_Page();
        $request->id = Llv_Constant_Cms_Page::PARTNERS_ID;
        $page = Llv_Context_Cms::getInstance()->pageGetRow($request);

        $this->view->assign('page', $page);
    }
}