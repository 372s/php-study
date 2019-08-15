<?php
require_once __DIR__ . '/start.php';
define('APP_START', microtime(true));
// header("HTTP/1.1 404 Not Found");die;
// header("HTTP/1.1 403 Forbidden");die;
$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();


$str = "C:\Users\wangqiang\AppData\Local\Temp\php9724.tmp";
echo addslashes($str);die;
//用户ID加密
$hash = 'dasfgfsdbz';
$check = 'hiewrsbzxc';
$user_id = 1118660;
echo hashUser($user_id, $hash). "<br>";
echo hashUser($user_id, $check). "<br>";die;

function hashUser($user, $downloadKey='') {
    if (empty($user)) {
        return '0';
    }
    $crc = intval(sprintf('%u', crc32($downloadKey . "asdfwrew.USER_SEED")));
    $hash = $crc - $user;
    $hash2 = sprintf('%u', crc32($hash . 'werhhs.USER_SEED2'));
    $k1 = substr($hash2, 0, 3);
    $k2 = substr($hash2, -2);
    return $k1 . $hash . $k2;
}

echo time();die;
echo (strtotime('+7 days') - time()) / 3600 / 24 . "\n\t";
echo strtotime('+7 days');die;
echo "<pre>";

$total = $loop = 100;
$i = 0;
while($loop--) {
    $r = mt_rand(1,100);
    ($r <= 10) && ($i++);
}
echo '执行'.$total.'次,命中'.$i;die;


function get_rand($proArr)
{
    print_r($proArr);
    $result = '';
    //概率数组的总概率精度
    $proSum = array_sum($proArr); //计算数组中元素的和
    //概率数组循环
    foreach ($proArr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        echo $randNum . "<br>";
        if ($randNum <= $proCur) { //如果这个随机数小于等于数组中的一个元素，则返回数组的下标
            $result = $key;
            break;
        } else {
            $proSum -= $proCur;
        }
    }
    unset($proArr);
    return $result;
}
$prize_arr = array(
    '0' => array('id' => 1, 'prize' => '平板电脑', 'v' => 1),
    '1' => array('id' => 2, 'prize' => '数码相机', 'v' => 5),
    '2' => array('id' => 3, 'prize' => '音箱设备', 'v' => 10),
    '3' => array('id' => 4, 'prize' => '4G优盘', 'v' => 12),
    '4' => array('id' => 5, 'prize' => '10Q币', 'v' => 22),
    '5' => array('id' => 6, 'prize' => '下次没准就能中哦', 'v' => 50),
);

foreach ($prize_arr as $key => $val) {
    $arr[$val['id']] = $val['v']; //将$prize_arr放入数组下标为$prize_arr的id元素，值为v元素的数组中
}

$rid = get_rand($arr); //根据概率获取奖项id 

$res['yes'] = $prize_arr[$rid - 1]['prize']; //获取中奖项 

unset($prize_arr[$rid - 1]); //将中奖项从数组中剔除，剩下未中奖项 
shuffle($prize_arr); //打乱数组顺序 
for ($i = 0; $i < count($prize_arr); $i++) {
    $pr[] = $prize_arr[$i]['prize'];
}
$res['no'] = $pr;
print_r($res);die;


$arr = array(
    'ml' => 5,
    'wxw' => 40,
    'zsyh' => 45,
    'xzq' => 5,
);
echo rand(1, 100);
die;

// echo phpinfo();die;
// $foo = new stdClass();
$foo = array();
if ($foo) {
    echo 1;
} else {
    echo 0;
}
var_dump($foo);
die;

$a = '1';
$b = &$a;
$b = "2$b";
echo $a . $b;
die;
echo (int) (0.58 * 100);
die;
$uri = $_SERVER['REQUEST_URI']; //. '&url='.urlencode('http://www.medlive.cn');
$str = parse_url($uri, PHP_URL_QUERY);
var_dump($str);

function getValue(callable $callable, array $array)
{
    if (is_callable($callable)) {
        return call_user_func_array($callable, $array);
    }
}
$a = 1;
$b = 2;
$s = getValue(function ($a, $b) {
    return $a + $b;
}, array($a, $b));
echo $s;
die;

$arr = [1, 2, 3];
array_unshift($arr, 4);
print_r($arr);
die;

echo date('Y-m-d', 1556099880);
die;

$startTime = "20190614100517";
$startTime = substr($startTime, 0, 4) . '-' . substr($startTime, 4, 2) . '-' . substr($startTime, 6, 2) . ' ' . substr($startTime, 8, 2) . ':' . substr($startTime, 10, 2) . ':' . substr($startTime, 12, 2);
echo $startTime;
die;

$time = preg_replace('/(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/', "$1-$2-$3 $4:$5:$6", $startTime);
echo $time;
die;

// $time = strtotime('2019-5-2 7:10');
// var_dump($time);die;
// $date = date('Y-m-d H:i', $time);
// var_dump($date);die;

if ('2019-6-26 15:00' < '2019-06-26 4:00') {
    echo 1;
} else {
    echo 2;
}
die;

echo date('Y-m-d H:i', strtotime('-60 minutes'));
die;

$a = date('H:i');
preg_match('/^\d{1,2}:\d{2}:*\d{0,2}$/', $a, $match);
print_r($match);
die;

function emp($a, $def = '')
{
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
// 