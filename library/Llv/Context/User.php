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
     * @return Llv_Entity_Dal_Row_Abstract|null
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
}