<?php
require dirname(__DIR__) . '/vendor/autoload.php';

require 'preg.class.php';

$str = '<>9_';
$str1 = 'http://www.baidu';
$preg = new Preg();
var_dump($preg->checkPsd($str));
var_dump($preg->checkURL($str1));

