<?php
header("HTTP/1.1 403 Forbidden");

require_once __DIR__ . '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

define('APP_START', microtime(true));

function getValue(callable $callable, array $array) {
    if (is_callable($callable)) {
        return call_user_func_array($callable, $array);
    }
}
$a = 1;
$b = 2;
$s = getValue(function ($a, $b) {
    return $a + $b;
}, array($a, $b));
echo $s;die;

$arr = [1,2,3];
array_unshift($arr, 4);
print_r($arr);die;


echo date('Y-m-d', 1556099880);die;

$startTime = "20190614100517";
$startTime = substr($startTime, 0,4).'-'.substr($startTime, 4,2).'-'.substr($startTime, 6,2).' '.substr($startTime, 8,2).':'.substr($startTime, 10,2).':'.substr($startTime, 12,2);
echo $startTime;die;

$time = preg_replace('/(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/', "$1-$2-$3 $4:$5:$6", $startTime);
echo $time;die;


// $time = strtotime('2019-5-2 7:10');
// var_dump($time);die;
// $date = date('Y-m-d H:i', $time);
// var_dump($date);die;

if ('2019-6-26 15:00' < '2019-06-26 4:00') {
    echo 1;
} else {
    echo 2;
}
die;

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