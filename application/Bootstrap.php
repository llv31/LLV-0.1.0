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
    /**
     * Cette méthode permet d'initaliser en session la configuration de l'application
     * - Langue (fr_FR, es_ES, etc.)
     * - Application (back, front, etc.)
     */
    protected function _initApplicationConfiguration()
    {
        Zend_Layout::startMvc();
        $sitesConf = Llv_Config::getInstance()->sites->toArray();
        if (array_key_exists('HTTP_HOST', $_SERVER)) {
            $currentHost = $_SERVER['HTTP_HOST'];
        } else {
            $currentHost = $sitesConf[0]['host'];
        }
        /** En dev, on doit préciser le port de l'host donc il faut patcher */
        if (APPLICATION_ENV == 'dev') {
            $currentHost = explode(':', $currentHost);
            $currentHost = $currentHost[0];
        }
        foreach ($sitesConf as $site) {
            if ($site['host'] == $currentHost) {
                Llv_Context_Application::getInstance()
                    ->setLocale(new Llv_Locale($site['locale']));
                Llv_Context_Application::getInstance()
                    ->setCurrentSite($site['idSite']);
            }
        }
        $currentModule = Llv_Context_Application::getInstance()->getActiveModule();
        $loader = new Zend_Loader_Autoloader_Resource(
            array(
                 'basePath' => APPLICATION_PATH . '/module/' . $currentModule,
                 'namespace'=> Zend_Filter::filterStatic(
                     strtr($currentModule, '-', '_'),
                     'Word_UnderscoreToCamelCase'
                 )
            )
        );
        $loader->addResourceType('form', 'forms', 'Form');
    }

    /**
     * Chargement de nouveaux espaces de noms
     *
     * @return Zend_Loader_Autoloader_Resource
     */
    protected function _initAutoload()
    {
        $autoloader = new Zend_Loader_Autoloader_Resource(
            array(
                 'namespace'     => '',
                 'basePath'      => APPLICATION_PATH,
                 'ressourceTypes'=> array(
                     'form'   => array(
                         'path'     => 'forms',
                         'namespace'=> 'App_Form'
                     ),
                     'element'=> array(
                         'path'     => 'forms/elements',
                         'namespace'=> 'App_Form_Element'
                     ),
                     'model'  => array(
                         'path'     => 'models',
                         'namespace'=> 'App_Model'
                     )
                 )
            )
        );
        return $autoloader;
    }

    /**
     * Initialise les routes (url rewriting)
     */
    public function _initRoutes()
    {
        $router = new Llv_Router();
        $router->setIdLangue(Llv_Context_Application::getInstance()->getLocale()->getIdLangue());
        $router->setModule(Llv_Context_Application::getInstance()->getActiveModule());

        $routerInstance = Zend_Controller_Front::getInstance();
        $routerInstance->setRouter($router);
        $routerInstance->getRouter()->addDefaultRoutes();
    }

    /**
     * Initialisation des plugins
     * - Modules
     * - Layouts
     * - Vues et helpers
     */
    public function _initPlugins()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new App_Plugin_ApplicationScriptFallback())
//            ->registerPlugin(new App_Plugin_ModuleActivation())
            ->registerPlugin(new App_Plugin_ModuleLayout());
    }

    /**
     * Initialise l'i18n du projet
     */
    protected function _initTranslator()
    {
        if (function_exists('bindtextdomain')) {
            bindtextdomain('application', APPLICATION_PATH . '/../data/locales/');
            bind_textdomain_codeset('application', Llv_Config::getInstance()->project->charset);
            textdomain('application');
        }
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
