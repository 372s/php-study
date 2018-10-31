<?php

define('APP_START', microtime(true));

define('ROOT_PATH', dirname(__DIR__) . '/');

define('PUBLIC_PATH', ROOT_PATH. '/public/');

define('APP_HOST', 'http://php-study.test');

require_once PUBLIC_PATH . 'helpers.php';
require_once PUBLIC_PATH . 'classes.php';

// var_dump(spl_autoload_functions());

print_r(spl_classes());

echo date('ymd');die;
$url = 'http://m.medlive.cn/cms/news/150446';
$res = parse_url($url, PHP_URL_PATH);
print_r($res);