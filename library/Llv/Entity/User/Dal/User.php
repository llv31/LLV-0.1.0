<?php
/**
 * PHP Class User.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_User_Dal_User extends Zend_Db_Table_Abstract
{
    protected $_name = "user";
    protected $_rowClass = "Llv_Entity_Dal_Row_Abstract";

    /**
     * Retourne un utilsateur en fonction de son id
     *
     * @static
     *
     * @param $id
     *
     * @return array
     */
    public static function getOne($id)
    {
        $tbl = new self();
        return $tbl->find($id)->current();
    }

    /**
     * Retourne un utilisateur en fonction de son login mot de passe
     * @static
     *
     * @param $login
     * @param $password
     *
     * @return mixed
     */
    public static function getOneByCreditentials($login, $password)
    {
        $sql = Llv_Db::getInstance()->select()
            ->from('user')
            ->where('login = ?', $login)
            ->where('password = ?', $password);
        return Llv_Db::getInstance()->fetchRow($sql);
    }
}