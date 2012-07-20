<?php
/**
 * PHP Class Config.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 20/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Config
    extends Zend_Config_Ini
{
    /** @var Llv_Config */
    protected static $_instance;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Llv_Config
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self(
                APPLICATION_PATH . '/configs/application.ini',
                APPLICATION_ENV
            );
        }
        return self::$_instance;
    }
}
