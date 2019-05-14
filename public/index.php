<?php
header("HTTP/1.1 403 Forbidden");

require_once __DIR__ . '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

define('APP_START', microtime(true));
// echo APP_START;die;

function emp($a, $def = '') {
    if (empty($a)) {
        return $def;
    } else {
        return $a;
    }
    // return empty($a) ? $def : $a;
}

if (empty($a)) {
    echo 1;
} else {
    echo $a;
}
// echo emp($s, 1);