<?php
header("HTTP/1.1 403 Forbidden");

require_once __DIR__ . '/start.php';

function sg(&$val, $def = '') {
    $val = trim($val);
    return empty($val) ? $def : $val;
}


$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();


$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://php-study.local/test4.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "deliver=你好|78249|8|13800000000|abcd|2016-09-10 11:08:14"
));
$response = curl_exec($curl);
$code = curl_getinfo($curl,CURLINFO_HTTP_CODE); // 获取HTTP状态码
$err = curl_error($curl);
curl_close($curl);
echo $code . "\n";
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response . "\n";
}
die;

$content = '{name}用户，您的验证码是{str(10)}，点击链接{url}【医脉通】';

$arr = ['{name}' => 'wangqinag', ];

if (stripos($content, '{name}') !== false) {
    $content = str_ireplace('{NAME}', 'wang', $content);
    echo $content;die;
}


$arr = array(18612651314, 18512121212);
$farr = array_flip($arr);
var_dump(isset($farr[18612651314]));die;
print_r($farr);die;

echo intval("-1");die;
echo date("Y-m-d", 1556174790);die;

echo $_SERVER['HTTP_USER_AGENT'];die;
echo date('Y-m-d', "2018-8-8");die;


$a = '19612651314';
var_dump(preg_match('/^1[3-9]\d{9}$/', $a));die;



// 全局变量使用  定义一个变量，在一个方法中定义它为全局变量
$arr = [1,2,3];
function setArr() {
    global $arr;
    $arr[0] = 4;
}
setArr();
var_dump($arr);die;
/**********************************************/
// var_dump("2019-4-5 10:00" >= "2019-4-5 09:00");die;

echo strtotime('2019-4-5 8:00') . "\n";
echo strtotime('2019-04-05 08:00') . "\n";die;

echo date('Y-m-d', strtotime('+6 days'));die;

$a = array('1', 2);
$b = array(1, 2);
var_dump($a == $b);die;

// $a = [1,2,3];
// $b = [3,4,5,6,7];
// print_r($a+$b);die;
$aMeetingDesc = array (
    'company_id' => 1,
    'company_product_id' => 2,
);
$aMeetingDesc2 = array (
    'company_id' => 0,
    'company_product_id' => 2,
);
print_r(array_diff($aMeetingDesc, $aMeetingDesc2));die;