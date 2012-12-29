<?php
/**
 * PHP Class ProductsController.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class ProductsController
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
        $filter = new Llv_Services_Product_Filter_Category();
        $categories = Llv_Context_Product::getInstance()->categoryGetAll($filter);
        $this->view->assign('categories', $categories);

        $filter = new Llv_Services_Product_Filter_Product();
        $products = Llv_Context_Product::getInstance()->getAll($filter);
        $this->view->assign('products', $products);
    }

    /**
     *
     */
    public function editCategoryAction()
    {
        $id = $this->_getParam('id');
        $filter = new Llv_Services_Product_Filter_Category();
        $filter->id = $id;
        $categorie = Llv_Context_Product::getInstance()->categoryGetOne($filter);
        $this->view->assign('categorie', $categorie);

        $formCategoryEdit = new App_Form_Back_Products_Category($id);
        $formFileUploader = new App_Form_Back_FileUploader(1);

        if ($this->getRequest()->isPost()) {
            if ($formCategoryEdit->isValid($_POST)) {
                $request = new Llv_Services_Product_Request_EditCategory();
                $request->id = $formCategoryEdit->getValue('id');
                $request->coordonnees = $formCategoryEdit->getValue('location');
                $request->pinColor = $formCategoryEdit->getValue('pin_color');
                $request->princingType = $formCategoryEdit->getValue('princing_type');
//                $request->route = $formCategoryEdit->getValue('route');
                Llv_Context_Product::getInstance()->categoryUpdateRow($request);

                $type = $this->_getParam(App_Model_Constant_Products_Category::FORM_PREFIX_TYPE);
                $title = $this->_getParam(App_Model_Constant_Products_Category::FORM_PREFIX_TITLE);
                $content = $this->_getParam(App_Model_Constant_Products_Category::FORM_PREFIX_CONTENT);
                foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
                    $request = new Llv_Services_Product_Request_EditCategoryContent();
                    $request->idCategory = $formCategoryEdit->getValue('id');
                    $request->idLangue = $language->id;
                    $request->type = $type[App_Model_Constant_Products_Category::FORM_PREFIX_TYPE . $language->id];
                    $request->title = $title[App_Model_Constant_Products_Category::FORM_PREFIX_TITLE . $language->id];
                    $request->content = $content[App_Model_Constant_Products_Category::FORM_PREFIX_CONTENT . $language->id];
                    Llv_Context_Product::getInstance()->categoryEditRowContent($request);
                }
                $this->_redirect('products/edit-category/id/' . $id);

            } elseif ($formFileUploader->isValid($_POST)) {
                foreach ($_FILES as $file) {
                    $request = new Llv_Services_Product_Request_File();
                    $request->id = $id;
                    $request->filename = $file['name'];
                    $request->mimeType = $file['type'];
                    $request->tmpName = $file['tmp_name'];
                    $request->error = $file['error'];
                    $request->size = $file['size'];
                    Llv_Context_Product::getInstance()->categoryUpdateFile($request);
                    $this->_redirect('products/edit-category/id/' . $id . '#jq-pictures');
                }
            }
        }

        $this->view->assign('formCategoryEdit', $formCategoryEdit);
        $this->view->assign('formFileUploader', $formFileUploader);
    }

    /**
     *
     */
    public function editProductAction()
    {
        $id = $this->_getParam('id');

        $filter = new Llv_Services_Product_Filter_Product();
        $filter->id = $id;
        $product = Llv_Context_Product::getInstance()->getOne($filter);
        $this->view->assign('product', $product);

        $formProductEdit = new App_Form_Back_Product($id);
        $formFileUploader = new App_Form_Back_FileUploader();

        if ($this->getRequest()->isPost()) {
            if ($formProductEdit->isValid($_POST)) {
                $title = $this->_getParam(App_Model_Constant_Product::FORM_PREFIX_TITLE);
                $intro = $this->_getParam(App_Model_Constant_Product::FORM_PREFIX_INTRO);
                $content = $this->_getParam(App_Model_Constant_Product::FORM_PREFIX_CONTENT);
                foreach (Llv_Context_Referential::getInstance()->getLanguages() as $language) {
                    $request = new Llv_Services_Product_Request_EditContent();
                    $request->idProduct = $formProductEdit->getValue('id');
                    $request->idLangue = $language->id;
                    $request->title = $title[App_Model_Constant_Product::FORM_PREFIX_TITLE . $language->id];
                    $request->introduction = $intro[App_Model_Constant_Product::FORM_PREFIX_INTRO . $language->id];
                    $request->content = $content[App_Model_Constant_Product::FORM_PREFIX_CONTENT . $language->id];
                    Llv_Context_Product::getInstance()->editRowContent($request);
                }
                $this->_redirect('products/edit-product/id/' . $id);
            } elseif ($formFileUploader->isValid($_POST)) {
                foreach ($_FILES as $file) {
                    $request = new Llv_Services_Product_Request_File();
                    $request->idProduct = $id;
                    $request->filename = $file['name'];
                    $request->mimeType = $file['type'];
                    $request->tmpName = $file['tmp_name'];
                    $request->error = $file['error'];
                    $request->size = $file['size'];
                    Llv_Context_Product::getInstance()->addRowFile($request);
                }
                $this->_redirect('products/edit-product/id/' . $id . '#jq-pictures');
            }
        }

        $this->view->assign('formProductEdit', $formProductEdit);
        $this->view->assign('formFileUploader', $formFileUploader);
    }

    /**
     *
     */
    public function fileUpdateAction()
    {
        $id = $this->_getParam('id');
        if (!is_null($id)) {
            $idProduct = false;
            $request = new Llv_Services_Product_Request_File();
            $request->id = $id;
            switch ($this->_getParam('make')) {
                case 'delete':
                    $idProduct = $this->_getParam('idProduct');
                    Llv_Context_Product::getInstance()->deleteRowFile($request);
                    break;
                case 'up':
                    $request->moveUp = true;
                    $idProduct = Llv_Context_Product::getInstance()->updateRowFile($request);
                    break;
                case 'down':
                    $request->moveUp = false;
                    $idProduct = Llv_Context_Product::getInstance()->updateRowFile($request);
                    break;
                case 'online':
                    $request->show = true;
                    $idProduct = Llv_Context_Product::getInstance()->updateRowFile($request);
                    break;
                case 'offline':
                    $request->show = false;
                    $idProduct = Llv_Context_Product::getInstance()->updateRowFile($request);
                    break;
            }
            if ($idProduct != false) {
                $this->_redirect('/products/edit-product/id/' . $idProduct . '#jq-pictures');
            }
        }
    }
}