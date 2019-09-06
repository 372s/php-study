<?php
echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);die;
$c = array();
print_r(array_keys($c));die;
$a = array(1,2,3);
$b = array(1,2,3);
var_dump($a == $b);die;
print_r(array_diff($a, $b));

$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$data = parse_url($url, PHP_URL_PATH);

print_r($data);