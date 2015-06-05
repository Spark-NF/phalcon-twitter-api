<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;

// App path constant
define('APP_PATH', realpath('..') . '/');

// Config
$config = new ConfigIni(APP_PATH . 'app/config/config.ini');

// Autoloader
require APP_PATH . 'app/config/loader.php';

// Services
$di = new FactoryDefault();
require APP_PATH . 'app/config/services.php';

// Application
try
{
	$application = new Application($di);
	echo $application->handle()->getContent();
}
catch(\Exception $e)
{
	echo "PhalconException: ", $e->getMessage();
}
