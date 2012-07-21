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
class Back_IndexController extends IndexController
{

    public function init()
    {
    }

    public function indexAction()
    {
        Zend_Debug::dump($this);
    }


}

