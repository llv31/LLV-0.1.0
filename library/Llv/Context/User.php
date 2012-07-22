<?php
/**
 * PHP Class Llv_Context_User.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Context_User
    extends Llv_Context_Abstract
{
    /** @var Llv_Context_User */
    protected static $_instance;
    /** @var Llv_Services_User */
    private $_service;
    /** @var Zend_Session_Namespace */
    private $_session;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Llv_Context_User
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Instancie le service
     */
    public function __construct()
    {
        $this->_service = new Llv_Services_User();
        $this->_session = new Zend_Session_Namespace(Llv_Constant_User::SESSION_NAMESPACE);
    }

    /**
     * Retourne un utilisateur en fonction de son id
     *
     * @param $id
     *
     * @return Llv_Entity_Dal_Row_Abstract|null
     */
    public function getOneById($id)
    {
        $request = new Llv_Services_User_Request_User();
        $request->id = $id;
        $message = $this->_service->getOneById($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->user;
        }
        return null;
    }

    /**
     * Retourne un utilisateur en fonction des ses login mot de passe
     *
     * @param $login
     * @param $password
     *
     * @return Llv_Dto_User|null
     */
    public function getUserByCreditential($login, $password)
    {
        $request = new Llv_Services_User_Request_User();
        $request->login = $login;
        $request->password = $password;
        $message = $this->_service->getUserByCreditential($this->getHeaderMessage(), $request);
        if ($message->success) {
            return $message->user;
        }
        return null;
    }

    /**
     * Log un utilisateur
     *
     * @param $id
     */
    public function loginUser($id)
    {
        $this->_session->userId = $id;
    }

    /**
     * Déconnecte un utilisateur
     */
    public function logoutUser()
    {
        $this->_session->userId = null;
    }

    /**
     * Retourne l'utilisateur courant
     *
     * @return Llv_Entity_Dal_Row_Abstract|null
     */
    public function getCurrentUser()
    {
        if (isset($this->_session->userId)) {
            return $this->getOneById($this->_session->userId);
        }
        return null;
    }

    /**
     * Retourne vrai si l'utilisateur est connecté
     * @return bool
     */
    public function isUserLogged()
    {
        return !is_null($this->getCurrentUser());
    }
}