<?php
/**
 * PHP Class Translator.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/12/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Translator
    extends Zend_Translate
{
    /**
     * @var Llv_Translator
     */
    private static $_instance;

    /**
     * @static
     * @return Llv_Translator
     */
    public static function get()
    {
        self::$_instance->getAdapter()->setLocale(Llv_Context_Application::getInstance()->getCurrentLocale());
        return self::$_instance;
    }
}