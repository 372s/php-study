<?php

define('APP_START', microtime(true));

define('ROOT_PATH', dirname(__DIR__));

define('PUBLIC_PATH', ROOT_PATH. '/public');

require_once __DIR__ . '/helpers.php';

// 类自动加载
spl_autoload_register(function ($class) {
    include PUBLIC_PATH . '/class/' . $class . '.class.php';
});


$word = array("/价格/", "/购买/", "/￥/", "/QQ群/", "/股票/", "/彩票/", "/王者荣耀/", "/传真/", "/互粉/", "/电话/", "/足彩/", "/大乐透/", "/双色球/", "/套花呗/", "/信用卡套现/");
$str = ' 会议介绍
国家神经心理学院成立于1975年，/价格/ 自成立以来，其成员人数稳步增长。 它已经发展成为神经心理学领域的科学家从业者，临床医师和研究人员的充满活力的组织。 现有会员总数超过3300名，有24个国家代表。今年的大会主题是“成为变革的代理人”，我们将邀请世界知名的研究人员和临床医生进行演讲，欢迎参加。

    2018年美国国家神经心理学院第38届大会将于10月17-20日在美国新奥尔良召开。';
var_dump(has_keyword($str, $word));
