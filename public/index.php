<?php
require_once __DIR__. '/start.php';
require_once dirname(__DIR__) . '/lib/helpers.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

$str1 = 'hello1';
$str2 = 'hello1';
echo strcasecmp ($str1, $str2) . "<br>";

// class_loader();
import('Class.Page');
$page = new Page(10);
print_r($page);