<?php
header("HTTP/1.1 403 Forbidden");

require_once __DIR__. '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

// echo date('Y-m-d', strtotime("-1 days"));die;
// var_dump('2018-12-01' <= '2018-12-02');die;

// $str = '11612651314';
// echo preg_match('/1[2-9]\d{9}/', $str);die;
// echo '<pre>';
// print_r($_SERVER);die;

$time = time();
echo $time . '<br>';
echo md5(strrev('18612651314') . $time . '123' . 'hahdjflkadfhadfp9uwradkdhf20170925');die;

$a = true;
var_dump(empty($a));
