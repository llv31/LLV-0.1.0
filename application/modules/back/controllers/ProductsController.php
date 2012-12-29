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

            } elseif ($formFileUploader->isValid($_POST)) {

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
    }
}