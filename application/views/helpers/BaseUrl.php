<?php
/**
 * PHP Class BaseUrl.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 21/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_BaseUrl
    extends Zend_View_Helper_Abstract
{
    /**
     * Retourne la racine du site
     * @return string
     */
    public static function baseUrl()
    {
        $baseUrl = "";
        if (APPLICATION_ENV == 'dev') {
            $expScriptName = explode('/', $_SERVER['SCRIPT_NAME']);
            unset($expScriptName[count($expScriptName) - 1]);
            $baseUrl = implode('/', $expScriptName);
        } else if (APPLICATION_ENV == 'dev') {
            $baseUrl = $_SERVER['SERVER_NAME'];
        } else if (APPLICATION_ENV == 'production') {
            $baseUrl = 'http://' . $_SERVER['SERVER_NAME'];
        }
        return $baseUrl . '/';
    }
}