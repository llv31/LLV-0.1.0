<?php
/**
 * PHP Class Llv_Context_Application.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 20/07/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Context_Application extends Llv_Context_Abstract
{
    /** @var Llv_Context_Application */
    protected static $_instance;
    /** @var Llv_Locale */
    private $_locale;
    /** @var int */
    private $_idSite;

    /**
     * Retourne une instance de la classe
     *
     * @static
     * @return Llv_Context_Application
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @param $idSite
     *
     * @throws Exception
     */
    public function setCurrentSite($idSite)
    {
        $this->_idSite = $idSite;
        $module = Llv_Context_Referential::getInstance()->getModuleByIdSite($idSite);
        if (is_null($module)) {
            throw new Exception(_('ERROR_EXCEPTION_SITE_UNKNOWN'));
        }
        $this->setActiveModule($module);
    }

    /**
     * @return int
     */
    public function getCurrentSite()
    {
        return $this->_idSite;
    }

    /**
     * @return \Llv_Locale
     */
    public function getDefautIdModule()
    {
        $sites = array_shift(Llv_Config::getInstance()->sites->toArray());
        return $sites['module'];
    }

    /**
     * @param $moduleName
     */
    public function setActiveModule($moduleName)
    {
        Zend_Controller_Front::getInstance()->setDefaultModule($moduleName);
    }

    /**
     * @return string
     */
    public function getActiveModule()
    {
        return Zend_Controller_Front::getInstance()->getDefaultModule();
    }

    /**
     * @param \Llv_Locale $locale
     */
    public function setLocale(Llv_Locale $locale)
    {
        $this->_locale = $locale;
        putenv('LC_ALL=' . $this->_locale->toString());
        setlocale(LC_ALL, $this->_locale->toString());
    }

    /**
     * @return \Llv_Locale
     */
    public function getLocale()
    {
        return $this->_locale;
    }

    /**
     * Retourne la locale par défaut
     *
     * @return \Llv_Locale
     */
    public function getDefaultLocale()
    {
        $sites = array_shift(Llv_Config::getInstance()->sites->toArray());
        return $sites['locale'];
    }

    /**
     * Retourne la locale courante
     *
     * @return \Llv_Locale
     */
    public function getCurrentLocale()
    {
        if (is_null($this->_locale)) {
            $this->_locale = $this->getDefaultLocale();
        }
        return $this->_locale;
    }
}