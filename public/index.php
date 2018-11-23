<?php
require_once __DIR__. '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

// $str1 = 'hello1';
// $str2 = 'hello1';
// echo strcasecmp ($str1, $str2) . "<br>";
//
//
// echo date('Y-m-d', '1542738806');die;


$className = '\Dir\Name';
$className = ltrim($className, '\\');
echo $className;
