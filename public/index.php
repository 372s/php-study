<?php
header("HTTP/1.1 403 Forbidden");

require_once __DIR__. '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

$date = date('Y-m-d');
if ($date <= '2019-01-01' && $date >= '2018-12-20') {
    echo $date;
} else {
    echo 0;
}
die;
// list($t1, $t2) = explode(' ', microtime());
// echo microtime() . "<br>";
// echo sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);die;

// function get_rand1($proArr) {
//     $result = array();
//     foreach ($proArr as $key => $val) {
//         $arr[$key] = $val['v'];
//     }
//     // print_r($arr);
//     // 概率数组的总概率
//     $proSum = array_sum($arr);
//     asort($arr);
//     // 概率数组循环
//     foreach ($arr as $k => $v) {
//         echo "proSum:" . $proSum . "<br>";
//         $randNum = mt_rand(1, $proSum);
//         echo 'randNum:' . $randNum . "<br>";
//         if ($randNum <= $v) {
//             $result = $proArr[$k];
//             break;
//         } else {
//             $proSum -= $v;
//         }
//     }
//     return $result;
// }

// $arr = array(
//     array('id'=>1,'name'=>'特等奖','v'=>1),
//     array('id'=>2,'name'=>'一等奖','v'=>5),
//     array('id'=>3,'name'=>'二等奖','v'=>10),
//     array('id'=>4,'name'=>'三等奖','v'=>12),
//     array('id'=>5,'name'=>'四等奖','v'=>22),
//     array('id'=>6,'name'=>'没中奖','v'=>50)
// );
// $arr = array(
//     array('id'=>1,'name'=>'一等奖','v'=>1),
//     array('id'=>2,'name'=>'没中奖','v'=>99)
// );
//
// echo '<pre>';
// print_r(get_rand1($arr));die;

// echo date('Y-m-d', strtotime("-1 days"));die;
// var_dump('2018-12-01' <= '2018-12-02');die;

// $str = '11612651314';
// echo preg_match('/1[2-9]\d{9}/', $str);die;
// echo '<pre>';
// print_r($_SERVER);die;

$time = time();
echo $time . '<br>';
echo md5(strrev('18612651314') . $time . '123' . 'hahdjflkadfhadfp9uwradkdhf20170925');die;

$a = true;
var_dump(empty($a));
