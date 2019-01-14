<?php
header("HTTP/1.1 403 Forbidden");

require_once __DIR__. '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

echo strtotime('-1 days');die;
echo date('Y-m-d', strtotime('-1 days'));die;

preg_match('/' . str_replace(' ', '.{0,10}', '氰化钾 买') . '/', '买');

$se = 'a:6:{i:0;s:13:"氰化钾 买";i:1;s:11:"yishengshuo";i:2;s:15:"测试敏感词";i:3;s:6:"美女";i:4;s:7:"枪 支";i:5;s:7:"毒 品";}';
print_r(unserialize($se));die;

$str = 'app_id=1000001&account=1118568&content=抢劫&device_id=12341243123413134&device_type=1&ip=186.154.154.44&source=medlive_iphone&time=1547178106&key=5r6z5jc5te2369dbpkwv';
parse_str($str, $arr);
extract($arr);
echo md5($account.$app_id.$content.$device_id . $device_type.$ip.$source.$time.$key);die;

echo time() . '<br>';
echo md5(strrev('18612651314') . time() . '123' . 'hahdjflkadfhadfp9uwradkdhf20170925');die;
