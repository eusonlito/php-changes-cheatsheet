<?php declare(strict_types=1);

error_reporting(E_ALL);

ini_set('error_reporting', (string)E_ALL);

define('PATH_BASE', dirname(__DIR__));
define('PATH_SRC', __DIR__);

require PATH_SRC.'/autoload.php';

register_shutdown_function(array('App\Error\Shutdown', 'handle'));
set_error_handler(array('App\Error\Error', 'handle'));
set_exception_handler(array('App\Error\Exception', 'handle'));
