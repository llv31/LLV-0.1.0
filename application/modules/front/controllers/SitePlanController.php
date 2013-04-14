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

class SitePlanController
    extends Zend_Controller_Action
{
    public function init()
    {
    }

    public function indexAction()
    {

        $productFilter = new Llv_Services_Product_Filter_Product();
        $productFilter->idCategory = 1;
        $guesthouse = Llv_Context_Product::getInstance()->getAll($productFilter);
        $productFilter->idCategory = 2;
        $chalet = Llv_Context_Product::getInstance()->getAll($productFilter);
        $this->view->assign('guesthouse', $guesthouse);
        $this->view->assign('chalet', $chalet);
    }
}