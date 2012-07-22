<?php
/**
 * PHP class     : Db.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 20/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Db
{
    /** @var Llv_Db */
    protected static $_instance;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Zend_Db_Adapter_Abstract
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = Zend_Db::factory(Llv_Config::getInstance()->database);
        }
        return self::$_instance;
    }

}