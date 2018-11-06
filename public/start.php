<?php

define('APP_START', microtime(true));
define('ROOT_PATH', dirname(__DIR__));
define('PUBLIC_PATH', ROOT_PATH. '/public/');
define('CLASS_PATH', ROOT_PATH. '/lib/Class/');
define('CLASS_EXT', '.class.php');

require_once ROOT_PATH . '/lib/helpers.php';

// 类自动加载
spl_autoload_register(function ($class) {
    require_once CLASS_PATH. $class . CLASS_EXT;
});
