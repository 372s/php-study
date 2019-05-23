<?php
header("HTTP/1.1 403 Forbidden");

require_once __DIR__ . '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

define('APP_START', microtime(true));
// echo APP_START;die;


$json = '{"tag_name":"奇奇怪怪","parent_id":"139694","parent_catid":"44"}';
$arr = json_decode($json, true);
unset($arr['tag_name'], $arr['parent_id']);
print_r($arr);
echo end($arr);die;

echo htmlspecialchars("恤彤&reg;丹参川芎嗪注射液临床应用专家共识");
echo htmlspecialchars_decode('恤彤&reg;丹参川芎嗪注射液临床应用专家共识');
die;

preg_match('/IF1395联系/', 'IF1395联系243234', $match);
print_r($match);die;


$img = 'http://news.medlive.cn/uploadfile/thumb/2018/0122/20180122025713150_jpg_h200';
$arr = getimagesize($img);
print_r($arr);die;
echo md5_file($img);die;

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