<?php
/**
 * PHP Class SeasonController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class SeasonController
    extends Zend_Controller_Action
{
    /**
     * Initializer
     */
    public function init()
    {
        if (!Llv_Context_User::getInstance()->isUserLogged()) {
            $this->_forward('login', 'index');
        }
    }

    /** ••••••••••••••••••••••••••••••••••••••••••••••••••••••• */

    /**
     * Gestion du texte de bienvenue
     */
    public function indexAction()
    {
        $currentYear = !is_null($this->_getParam('year')) ? $this->_getParam('year') : date('Y');
        $this->view->assign('currentYear', $currentYear);

        $formSeason = new App_Form_Back_Season();
        $formSeason->setAction('/season/index/year/' . $currentYear);
        $this->view->assign('formSeason', $formSeason);
        if ($this->getRequest()->isPost()) {
            $formSeason->populate($_POST);
            $request = new Llv_Services_Product_Request_Season();
            $request->id = $formSeason->getValue('id');
            $request->idWeekList = $formSeason->getValue('semaines');
            Llv_Context_Product::getInstance()->weekUpdateLot($request);
        }

    }
}