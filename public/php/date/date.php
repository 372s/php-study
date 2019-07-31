<?php
/**
 * http://php.net/manual/zh/function.date.php
 */

/**
 *  计算两个日期相隔时间：年、月、日、时、分、秒 总计天数
 * @author TekinTian <tekintian#gmail.com>
 * @param string $start_time 开始时间 必须 [格式如：2011-11-5 10:01:01]
 * @param string $end_time 结束时间 选填，不提供默认未当前时间 [格式如：2012-12-01 10:01:01]
 * @return array Array ( [y] => 年 [m] => 月 [d] => 日 [h] => 时 [i] => 分 [s] => 秒 [a] => 合计天数 )
 */
function get_date_diff($start_time,$end_time=''){
    $end_time = ($end_time=='')?date("Y-m-d H:i:s"):$end_time;
    $datetime1 = new \DateTime($start_time);
    $datetime2 = new \DateTime($end_time);
    $interval = $datetime1->diff($datetime2);
    $time['y'] = $interval->format('%y');
    $time['m'] = $interval->format('%m');
    $time['d'] = $interval->format('%d');
    $time['h'] = $interval->format('%H');
    $time['i'] = $interval->format('%i');
    $time['s'] = $interval->format('%s');
    $time['a'] = $interval->format('%a');    // 两个时间相差总天数
    return $time;
}

//demo use
// echo '<pre>';
print_r(get_date_diff('2016-10-15 10:01:56'));
// echo '</pre>';

/* 时间戳格式化 */
$date = new DateTime();
echo $date->getTimestamp() . "<br>"; // 获取时间戳 1523604211
echo $date->setTimestamp(1171502725)->format('U = Y-m-d H:i:s') . "<br>"; // 把时间戳格式化  1171502725 = 2007-02-15 01:25:25

//面向过程
$date_create = date_create();
echo date_format($date_create, 'U = Y-m-d H:i:s') . "<br>"; //1523604211 = 2018-04-13 07:23:31
echo date_timestamp_get(date_create()) . "<br>"; // 1523604255
echo time() . "<br>"; // 1523604255
echo microtime() . "<br>"; // 0.92173800 1523606156



// 把时间戳格式化
$ts = 1171502725;
$date = new DateTime("@$ts");
echo $date->format('U = Y-m-d H:i:s') . "\n";



die;
/* 时间增减 */
$date = new DateTime();
print_r($date->format('Y-m-d H:i:s') . "<br>"); // 当前时间
// print_r(strtotime($date)); // error

// 加10天
$date->add(new DateInterval('P10D'));
echo $date->format('Y-m-d H:i:s') . "<br>";

// 加1月
$date->add(new DateInterval('P1M'));
echo $date->format('Y-m-d H:i:s') . "<br>";

// 加1年
$date->add(new DateInterval('P1Y'));
echo $date->format('Y-m-d H:i:s') . "<br>";

// 加1周
$date->add(new DateInterval('P1W'));
echo $date->format('Y-m-d H:i:s') . "<br>";

// 加1小时
$date->add(new DateInterval('PT1H'));
echo $date->format('Y-m-d H:i:s') . "<br>";

// 加1分钟
$date->add(new DateInterval('PT1M'));
echo $date->format('Y-m-d H:i:s') . "<br>";

// 加1秒钟
$date->add(new DateInterval('PT1S'));
echo $date->format('Y-m-d H:i:s') . "<br>";



