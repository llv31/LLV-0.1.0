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
        if(!Llv_Context_User::getInstance()->isUserLogged()){
            $this->_forward('login', 'index');
        }
    }

    public function indexAction()
    {
    }

    /**
     * Connecte un utilisateur
     */
    public function loginAction()
    {
        $formLogin = new App_Form_Login();
        if ($this->getRequest()->isPost()) {
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