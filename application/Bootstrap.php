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

    /**
     * Cette méthode permet d'initaliser en session la configuration de l'application
     * - Langue (fr_FR, es_ES, etc.)
     * - Application (back, front, etc.)
     */
    protected function _initApplicationConfiguration()
    {
        if (array_key_exists('HTTP_HOST', $_SERVER)) {
            $currentHost = $_SERVER['HTTP_HOST'];
        } else {
            $currentHost = self::HOST_FRONT;
        }

        $sitesConf = Llv_Config::getInstance()->sites->toArray();
        Zend_Debug::dump($currentHost);die;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        /** @var $front Zend_Controller_Front */
        $front = $this->getResource('frontController');
        $front->addModuleDirectory(APPLICATION_PATH . '/modules/');

        Zend_Db_Table::setDefaultAdapter(Llv_Db::getInstance());

        return parent::run();
    }
}
