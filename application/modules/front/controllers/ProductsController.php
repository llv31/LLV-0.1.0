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
     *
     */
    public function roomAction()
    {
        $action = $this->_getParam('type');

        $categoryFilter = new Llv_Services_Product_Filter_Category();
        $categoryFilter->route = $action;
        $category = Llv_Context_Product::getInstance()->categoryGetOne($categoryFilter);
        $this->view->assign('category', $category);

        $productFilter = new Llv_Services_Product_Filter_Product();
        $productFilter->idCategory = $category->id;
        $products = Llv_Context_Product::getInstance()->getAll($productFilter);
        $this->view->assign('products', $products);
    }

    /**
     *
     */
    public function locationAction()
    {
        $url = $this->_getParam('set');
        $type = $this->_getParam('type');

        $productFilter = new Llv_Services_Product_Filter_Product();
        $productFilter->url = $url;
        $productFilter->onlineIllustration = true;
        $product = Llv_Context_Product::getInstance()->getOne($productFilter);
        $this->view->assign('product', $product);

        $productFilter = new Llv_Services_Product_Filter_Product();
        $productFilter->idCategory = $product->category->id;
        $productFilter->exceptThisId = $product->id;
        $products = Llv_Context_Product::getInstance()->getAll($productFilter);
        $this->view->assign('products', $products);

        $contactForm = new App_Form_Front_Contact();
        $contactForm->setLocation($product->title);
        $this->view->assign('contactForm', $contactForm);

        $urlRetour = '/products/room/type/' . $type;
        $this->view->assign('urlRetour', $urlRetour);

    }
}