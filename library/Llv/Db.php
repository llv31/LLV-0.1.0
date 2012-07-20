<?php
/**
 * PHP class     : Db.php
 *
 * PHP Version 5
 *
 * @category Default
 * @package  Default
 * @author   : Galilée <contact@galilee.fr>
 * @date     : 20/07/12
 * @license  : None
 * @link     : None
 */

/**
 * DESCRIPTION
 *
 * @category Default
 * @package  Default
 * @author   : Galilée <contact@galilee.fr>
 * @date     : 20/07/12
 * @license  : None
 * @link     : None
 */

class Llv_Db
{
    /** @var Llv_Db */
    protected static $_instance;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Llv_Db
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = Zend_Db::factory(Llv_Config::getInstance()->database);
        }
        return self::$_instance;
    }

}