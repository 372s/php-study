<?php
header("HTTP/1.1 403 Forbidden");

require_once __DIR__ . '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

define('APP_START', microtime(true));

$time = strtotime('2019-5-2 7:10');
var_dump($time);die;
$date = date('Y-m-d H:i', $time);
var_dump($date);die;


echo date('Y-m-d H:i', strtotime('-60 minutes'));die;

$a = date('H:i');
preg_match('/^\d{1,2}:\d{2}:*\d{0,2}$/', $a, $match);
print_r($match);die;


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