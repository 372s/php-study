<?php
require_once __DIR__. '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();


$a = true;

var_dump(empty($a));
