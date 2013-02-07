<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
$appEnv = ($_SERVER['REMOTE_ADDR'] == '127.0.0.1') ? 'dev' : 'production';
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : $appEnv));

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


//set_include_path(
//    implode(
//        PATH_SEPARATOR,
//        array(
//             realpath(APPLICATION_PATH . '/../library/Zend/'),
//             realpath(APPLICATION_PATH . '/../library/Llv/'),
//             realpath(APPLICATION_PATH . '/../library/Enum/'),
//             realpath(APPLICATION_PATH . '/../library/PHPMailer/'),
//             realpath(APPLICATION_PATH . '/../library/PHPMailer/'),
//             '.',
//              get_include_path(),
//        )
//    )
//);


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
    ->registerNamespace('Enum_')
    ->registerNamespace('PHPMailer_')
    ->registerNamespace('ZFDebug_');

$application->bootstrap()
    ->run();