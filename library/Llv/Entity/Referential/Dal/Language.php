<?php
/**
 * PHP Class Language.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 22/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Entity_Referential_Dal_Language
    extends Zend_Db_Table_Abstract
{
    protected $_name = "language";
    protected $_rowClass = "Llv_Entity_Dal_Row_Abstract";
    protected static $_instance;

    /**
     * @static
     * @return mixed
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @static
     * @return array
     */
    public static function getAll()
    {
        $sql = Llv_Db::getInstance()->select()
            ->from(self::getInstance()->_name);
        return Llv_Db::getInstance()->fetchAll($sql);
    }
}