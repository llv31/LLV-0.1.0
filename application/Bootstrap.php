<?php
/**
 * PHP Class ${FILE_NAME}
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : ${DATE}
 * @author      : aroy <contact@aroy.fr>
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    const HOST_FRONT = 'front';

    protected function _initSiteConfiguration()
    {
        if (array_key_exists('HTTP_HOST', $_SERVER)) {
            $currentHost = $_SERVER['HTTP_HOST'];
        } else {
            $currentHost = self::HOST_FRONT;
        }
    }
}
