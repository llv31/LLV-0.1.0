<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'dev'));
//    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
             realpath(APPLICATION_PATH . '/../library'),
             get_include_path(),
        )
    )
);

ini_set('log', APPLICATION_ENV . '/../data/logs/error.log');
ini_set('date.timezone', 'Europe/Paris');

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance()
    ->registerNamespace('Llv_')
    ->registerNamespace('Enum_');


//Zend_Debug::dump(Llv_Config::getInstance()->toArray());die;
$application->bootstrap()
    ->run();