<?php
/**
 * PHP Class ActivityController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 04/08/12
 * @author      : aroy <contact@aroy.fr>
 */

class ActivitiesController
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
        $filter = new Llv_Services_Activity_Filter_Activity();
        $filter->idLangue = Llv_Context_Application::getInstance()->getCurrentLocale()->getIdLangue();

        $this->view->assign('list', Llv_Context_Activity::getInstance()->getAll($filter));
    }

    /**
     *
     */
    public function editAction()
    {
        $formActivityEdit = new App_Form_Back_Activity_Edit();
        $id = $this->_getParam('id');
        if (!is_null($id) && !empty($id)) {
            $formActivityEdit->fillForm($id);
            $formFileUploader = new App_Form_Back_FileUploader();
            $this->view->assign('formFileUploader', $formFileUploader);
            $filter = new Llv_Services_Activity_Filter_File();
            $filter->idActivity = $id;
            $illustrations = Llv_Context_Activity::getInstance()->getActivityFiles($filter);
            $this->view->assign('illustrations', $illustrations);
            $this->view->assign('idActivite', $id);
        }
        if ($this->getRequest()->isPost()) {
            if ($formActivityEdit->isValid($_POST)) {
                $callback = $this->_getParam('submit');
                $request = new Llv_Services_Activity_Request_Edit();
                $request->id = $formActivityEdit->getValue('id');
                $request->idCategorie = $formActivityEdit->getValue('category');
                $request->coordonnees = $formActivityEdit->getValue('location');
                $request->dateUpdate = new DateTime();
                $issetId = isset($request->id) && !is_null($request->id) && !empty($request->id);
                if (!$issetId) {
                    $request->dateAdd = $request->dateUpdate;
                    $request->online = true;
                    $idActivity = Llv_Context_Activity::getInstance()->addRow($request);
                } else {
                    $idActivity = $request->id;
                    Llv_Context_Activity::getInstance()->updateRow($request);
                }
                $title = $this->_getParam(App_Model_Constant_Activity::FORM_PREFIX_TITLE);
                $content = $this->_getParam(App_Model_Constant_Activity::FORM_PREFIX_CONTENT);
                foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
                    $request = new Llv_Services_Activity_Request_EditContent();
                    $request->idActivity = $idActivity;
                    $request->idLangue = $language->id;
                    $request->title = $title[App_Model_Constant_Activity::FORM_PREFIX_TITLE . $language->id];
                    $request->content = $content[App_Model_Constant_Activity::FORM_PREFIX_CONTENT . $language->id];
                    Llv_Context_Activity::getInstance()->editRowContent($request);
                }
                if (is_null($callback)) {
                    $this->_redirect('activities/list');
                } else {
                    $this->_redirect('activities/edit/id/' . $idActivity);
                }
            } elseif ($formFileUploader->isValid($_POST)) {
                foreach ($_FILES as $file) {
                    $request = new Llv_Services_Activity_Request_File();
                    $request->idActivity = $id;
                    $request->filename = $file['name'];
                    $request->mimeType = $file['type'];
                    $request->tmpName = $file['tmp_name'];
                    $request->error = $file['error'];
                    $request->size = $file['size'];
                    Llv_Context_Activity::getInstance()->addRowFile($request);
                    $this->_redirect('activities/edit/id/' . $id . '#jq-pictures');
                }
            }
        }
        $this->view->assign('formActivityEdit', $formActivityEdit);
    }

    public function updateAction()
    {
        $id = $this->_getParam('id');
        if (!is_null($id)) {
            $idActivity = false;
            $request = new Llv_Services_Activity_Request_Edit();
            $request->id = $id;
            $filter = new Llv_Services_Activity_Filter_Activity();
            $filter->id = $id;
            switch ($this->_getParam('make')) {
                case 'delete':
                    $idActivity = Llv_Context_Activity::getInstance()->deleteRow($filter);
                    break;
                case 'up':
                    $request->moveUp = true;
                    $idActivity = Llv_Context_Activity::getInstance()->updateRow($request);
                    break;
                case 'down':
                    $request->moveUp = false;
                    $idActivity = Llv_Context_Activity::getInstance()->updateRow($request);
                    break;
                case 'online':
                    $request->show = true;
                    $idActivity = Llv_Context_Activity::getInstance()->updateRow($request);
                    break;
                case 'offline':
                    $request->show = false;
                    $idActivity = Llv_Context_Activity::getInstance()->updateRow($request);
                    break;
            }
            if ($idActivity != false) {
                $this->_redirect('activities/');
            }
        }
    }

    public function fileUpdateAction()
    {
        $id = $this->_getParam('id');
        if (!is_null($id)) {
            $idActivity = false;
            $request = new Llv_Services_Activity_Request_File();
            $request->id = $id;
            switch ($this->_getParam('make')) {
                case 'delete':
                    $idActivity = $this->_getParam('idActivite');
                    Llv_Context_Activity::getInstance()->deleteRowFile($request);
                    break;
                case 'up':
                    $request->moveUp = true;
                    $idActivity = Llv_Context_Activity::getInstance()->updateRowFile($request);
                    break;
                case 'down':
                    $request->moveUp = false;
                    $idActivity = Llv_Context_Activity::getInstance()->updateRowFile($request);
                    break;
                case 'online':
                    $request->show = true;
                    $idActivity = Llv_Context_Activity::getInstance()->updateRowFile($request);
                    break;
                case 'offline':
                    $request->show = false;
                    $idActivity = Llv_Context_Activity::getInstance()->updateRowFile($request);
                    break;
            }
            if ($idActivity != false) {
                $this->_redirect('activities/edit/id/' . $idActivity . '#jq-pictures');
            }
        }
    }
}