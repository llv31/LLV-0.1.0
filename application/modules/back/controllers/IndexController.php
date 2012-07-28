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

require_once APPLICATION_PATH . '/controllers/IndexController.php';
class IndexController
    extends Zend_Controller_Action
//    extends IndexController
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

    /**
     * Gestion du texte de bienvenue
     */
    public function indexAction()
    {
        $formPageCms = new App_Form_Back_Cms_Page();
        if ($this->getRequest()->isPost()) {
            if ($formPageCms->isValid($_POST)) {
                $title = $this->_getParam(App_Model_Constant_Cms_Page::FORM_PREFIX_TITLE);
                $content = $this->_getParam(App_Model_Constant_Cms_Page::FORM_PREFIX_CONTENT);
                foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
                    $request = new Llv_Services_Cms_Request_Page();
                    $request->id = Llv_Constant_Cms_Page::HOME_ID;
                    $request->idLangue = $language->id;
                    $request->title = $title[App_Model_Constant_Cms_Page::FORM_PREFIX_TITLE . $language->id];
                    $request->content = $content[App_Model_Constant_Cms_Page::FORM_PREFIX_CONTENT . $language->id];
                    $request->dateUpdate = new DateTime();
                    Llv_Context_Cms::getInstance()->pageUpdateRow($request);
                }
                $this->_redirect('/');
            }
        } else {
            foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
                $request = new Llv_Services_Cms_Request_Page();
                $request->id = Llv_Constant_Cms_Page::HOME_ID;
                $request->idLangue = $language->id;
                $page = Llv_Context_Cms::getInstance()->pageGetRow($request);
                $formPageCms->getElement(App_Model_Constant_Cms_Page::FORM_PREFIX_TITLE . $language->id)
                    ->setValue($page->title);
                $formPageCms->getElement(App_Model_Constant_Cms_Page::FORM_PREFIX_CONTENT . $language->id)
                    ->setValue($page->content);
            }
        }
        $this->view->assign('formPageCms', $formPageCms);
    }

    /**
     * Gestion de la page partenaires
     */
    public function partnersAction()
    {
        $formPageCms = new App_Form_Back_Cms_Page();
        $formPageCms->setAction('partners/');
        if ($this->getRequest()->isPost()) {
            if ($formPageCms->isValid($_POST)) {
                $title = $this->_getParam(App_Model_Constant_Cms_Page::FORM_PREFIX_TITLE);
                $content = $this->_getParam(App_Model_Constant_Cms_Page::FORM_PREFIX_CONTENT);
                foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
                    $request = new Llv_Services_Cms_Request_Page();
                    $request->id = Llv_Constant_Cms_Page::PARTNERS_ID;
                    $request->idLangue = $language->id;
                    $request->title = $title[App_Model_Constant_Cms_Page::FORM_PREFIX_TITLE . $language->id];
                    $request->content = $content[App_Model_Constant_Cms_Page::FORM_PREFIX_CONTENT . $language->id];
                    $request->dateUpdate = new DateTime();
                    Llv_Context_Cms::getInstance()->pageUpdateRow($request);
                }
                $this->_redirect('index/partners/');
            }
        } else {
            foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
                $request = new Llv_Services_Cms_Request_Page();
                $request->id = Llv_Constant_Cms_Page::PARTNERS_ID;
                $request->idLangue = $language->id;
                $page = Llv_Context_Cms::getInstance()->pageGetRow($request);
                $formPageCms->getElement(App_Model_Constant_Cms_Page::FORM_PREFIX_TITLE . $language->id)
                    ->setValue($page->title);
                $formPageCms->getElement(App_Model_Constant_Cms_Page::FORM_PREFIX_CONTENT . $language->id)
                    ->setValue($page->content);
            }
        }
        $this->view->assign('formPageCms', $formPageCms);
    }

    /**
     * Ajout de fichiers
     */
    public function carrouselAddAction()
    {
        $formPageCms = new App_Form_Back_Cms_Carrousel();
        if ($this->getRequest()->isPost()) {
            if ($formPageCms->isValid($_POST)) {
                foreach ($_FILES as $file) {
                    $request = new Llv_Services_Cms_Request_Carrousel();
                    $request->filename = $file['name'];
                    $request->mimeType = $file['type'];
                    $request->tmpName = $file['tmp_name'];
                    $request->error = $file['error'];
                    $request->size = $file['size'];
                    Llv_Context_Cms::getInstance()->carrouselAddRow($request);
                }
            }
        }
        $this->view->assign('formPageCms', $formPageCms);
    }

    /**
     * Liste et administration rapide
     */
    public function carrouselListAction()
    {

    }

    /**
     * Connecte un utilisateur
     */
    public function loginAction()
    {
        $formLogin = new App_Form_Back_Login();
        if ($this->getRequest()->isPost()) {
            if ($formLogin->isValid($_POST)) {
                $login = $this->_getParam('login');
                $password = $this->_getParam('password');
                $user = Llv_Context_User::getInstance()->getUserByCreditential(
                    $login,
                    $password
                );
                if (!is_null($user)) {
                    Llv_Context_User::getInstance()->loginUser($user->id);
                }
                $this->_redirect('/');
            }
        }
        $this->view->assign('formLogin', $formLogin);
    }

    /**
     * Déconnecte un utilisateur
     */
    public function logoutAction()
    {
        Llv_Context_User::getInstance()->logoutUser();
        $this->_redirect('/');
    }
}