<?php
require dirname(__DIR__) . '/vendor/autoload.php';

// echo mt_rand(0, 99)/100+1;

// require 'preg.class.php';

// $str = '<>9_';
// $str1 = 'http://www.baidu';
// $preg = new Preg();
// var_dump($preg->checkPsd($str));
// var_dump($preg->checkURL($str1));


// $mystring = 12345678;
// $findme   = 8;
// $pos = mb_strpos($mystring, $findme);

// 注意这里使用的是 ===。简单的 == 不能像我们期待的那样工作，
// 因为 'a' 是第 0 位置上的（第一个）字符。
// if ($pos === false) {
//     echo "The string '$findme' was not found in the string '$mystring'";
// } else {
//     echo "The string '$findme' was found in the string '$mystring'";
//     echo " and exists at position $pos";
// }

// $im = imagecreatetruecolor(100, 100);
// // 将背景设为红色
// $red = imagecolorallocate($im, 255, 0, 0);
// imagefill($im, 0, 0, $red);
// header('Content-type: image/png');
// imagepng($im);
// imagedestroy($im);