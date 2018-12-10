<?php
header("HTTP/1.1 403 Forbidden");

require_once __DIR__. '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

echo '<pre>';
print_r($_SERVER);die;
echo md5(strrev('18612651314') . '1544431838' . '123' . 'hahdjflkadfhadfp9uwradkdhf20170925');die;

echo  time();die;
$a = true;

var_dump(empty($a));
