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
            $filter = new Llv_Services_News_Filter_File();
            $filter->idNews = $id;
            $illustrations = Llv_Context_News::getInstance()->getNewsFiles($filter);
            $this->view->assign('illustrations', $illustrations);
        }
        if ($this->getRequest()->isPost()) {
            if ($formNewsEdit->isValid($_POST)) {
                $callback = $this->_getParam('submit');
                $request = new Llv_Services_News_Request_Edit();
                $request->id = $formNewsEdit->getValue('id');
                $request->idCategorie = $formNewsEdit->getValue('category');
                $request->coordonnees = $formNewsEdit->getValue('location');
                $request->dateUpdate = new DateTime();
                $issetId = isset($request->id) && !is_null($request->id) && !empty($request->id) ;
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
                    $this->_redirect('news/edit/id/' . $idNews);
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
                    $this->_redirect('news/edit/id/' . $id . '#jq-pictures');
                }

            }
        }
        $this->view->assign('formNewsEdit', $formNewsEdit);
    }

    public function updateAction()
    {
        $id = $this->_getParam('id');
        if (!is_null($id)) {
            $idNews = false;
            $request = new Llv_Services_News_Request_Edit();
            $request->id = $id;
            $filter = new Llv_Services_News_Filter_News();
            $filter->id = $id;
            switch ($this->_getParam('make')) {
                case 'delete':
                    $idNews = Llv_Context_News::getInstance()->deleteRow($filter);
                    break;
                case 'up':
                    $request->moveUp = true;
                    $idNews = Llv_Context_News::getInstance()->updateRow($request);
                    break;
                case 'down':
                    $request->moveUp = false;
                    $idNews = Llv_Context_News::getInstance()->updateRow($request);
                    break;
                case 'online':
                    $request->show = true;
                    $idNews = Llv_Context_News::getInstance()->updateRow($request);
                    break;
                case 'offline':
                    $request->show = false;
                    $idNews = Llv_Context_News::getInstance()->updateRow($request);
                    break;
            }
            if ($idNews != false) {
                $this->_redirect('news/');
            }
        }
    }

    public function fileUpdateAction()
    {
        $id = $this->_getParam('id');
        if (!is_null($id)) {
            $idNews = false;
            $request = new Llv_Services_News_Request_File();
            $request->id = $id;
            switch ($this->_getParam('make')) {
                case 'delete':
                    $idNews = Llv_Context_News::getInstance()->deleteRowFile($request);
                    break;
                case 'up':
                    $request->moveUp = true;
                    $idNews = Llv_Context_News::getInstance()->updateRowFile($request);
                    break;
                case 'down':
                    $request->moveUp = false;
                    $idNews = Llv_Context_News::getInstance()->updateRowFile($request);
                    break;
                case 'online':
                    $request->show = true;
                    $idNews = Llv_Context_News::getInstance()->updateRowFile($request);
                    break;
                case 'offline':
                    $request->show = false;
                    $idNews = Llv_Context_News::getInstance()->updateRowFile($request);
                    break;
            }
            if ($idNews != false) {
                $this->_redirect('news/edit/id/' . $idNews . '#jq-pictures');
            }
        }
    }
}