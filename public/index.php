<?php
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * 时间类
 */
// use Carbon\Carbon;

// printf("Right now is %s", Carbon::now()->toDateTimeString() . "\n");
// printf("Right now in Shanghai is %s", Carbon::now());  //implicit __toString()

/**
 * 验证码
 * 
 */
// use Gregwar\Captcha\CaptchaBuilder;

// header('Content-type: image/jpeg');

// CaptchaBuilder::create()->build()->output();
// print_r(glob(dirname(__FILE__).'/*.php'));die;


/**
 * 验证码
 * 
 */
// use Qous\Captcha\Captcha;
// $cap = new Captcha();
// // print_r($cap);die;
// $cap->create();

/**
 * finder
 * 
 */
// use Symfony\Component\Finder\Finder;

// $finder = Finder::create()->files()->ignoreDotFiles(true)->in(dirname(__FILE__))->depth(0);
// print_r($finder);die;

// $arr = [];
// foreach ($finder as $key => $file) {
//     $arr[$key]['getPathName'] = $file->getPathName();

//     // dumps the absolute path
//     $arr[$key]['getRealPath'] = $file->getRealPath();

//     // dumps the relative path to the file, omitting the filename
//     $arr[$key]['getRelativePath'] = $file->getRelativePath();

//     // dumps the relative path to the file
//     $arr[$key]['getRelativePathname'] = $file->getRelativePathname();
// }
// print_r($arr);die;

// $arr = iterator_to_array(
//     Finder::create()->files()->ignoreDotFiles(true)->in(dirname(__FILE__))->depth(0),
//     false
// );
// $arr = array_map(function($file) {
//     return $file->getPathName();
// }, $arr);
// print_r($arr);die;


/**
 * mt_rand
 * 
 */
// echo mt_rand(0, 99)/100+1;




/**
 * 正则验证
 * 
 */
require 'preg.class.php';
$str = '455122@qq.com';
$preg = new Preg();
var_dump($preg->checkEmail($str));



/**
 * mb_strpos
 * strpos
 * 
 */
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
