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

        $this->view->assign('list', Llv_Context_News::getInstance()->getAll($filter));
    }

    /**
     *
     */
    public function editAction()
    {
        $formNewsEdit = new App_Form_Back_News_Edit();
        $id = $this->_getParam('id');
        if (!is_null($id) && !empty($id)) {
            $formNewsEdit->fillForm($id);
            $formFileUploader = new App_Form_Back_FileUploader();
            $this->view->assign('formFileUploader', $formFileUploader);
        }
        if ($this->getRequest()->isPost()) {
            if ($formNewsEdit->isValid($_POST)) {
                $callback = $this->_getParam('submit');
                $request = new Llv_Services_News_Request_Edit();
                $request->id = $formNewsEdit->getValue('id');
                $request->idCategorie = $formNewsEdit->getValue('category');
                $request->coordonnees = $formNewsEdit->getValue('location');
                $request->dateUpdate = new DateTime();
                $issetId = isset($request->id) || !is_null($request->id) || !empty($request->id);
                if (!$issetId) {
                    $request->dateAdd = $request->dateUpdate;
                    $request->online = true;
                    $idNews = Llv_Context_News::getInstance()->addRow($request);
                } else {
                    $idNews = $request->id;
                    Llv_Context_News::getInstance()->updateRow($request);
                }

                $title = $this->_getParam(App_Model_Constant_News::FORM_PREFIX_TITLE);
                $content = $this->_getParam(App_Model_Constant_News::FORM_PREFIX_CONTENT);
                foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
                    $request = new Llv_Services_News_Request_EditContent();
                    $request->idNews = $idNews;
                    $request->idLangue = $language->id;
                    $request->title = $title[App_Model_Constant_News::FORM_PREFIX_TITLE . $language->id];
                    $request->content = $content[App_Model_Constant_News::FORM_PREFIX_CONTENT . $language->id];
                    Llv_Context_News::getInstance()->editRowContent($request);
                }
                if (is_null($callback)) {
                    $this->_redirect('news/list');
                } else {
                    $this->_redirect('news/edit/id/' . $id);
                }
            } elseif ($formFileUploader->isValid($_POST)) {
                foreach ($_FILES as $file) {
                    $request = new Llv_Services_News_Request_File();
                    $request->idNews = $id;
                    $request->filename = $file['name'];
                    $request->mimeType = $file['type'];
                    $request->tmpName = $file['tmp_name'];
                    $request->error = $file['error'];
                    $request->size = $file['size'];
                    Llv_Context_News::getInstance()->addRowFile($request);
                }

            }
        }
        $this->view->assign('formNewsEdit', $formNewsEdit);
    }
}