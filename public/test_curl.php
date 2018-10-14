<?php

// 类自动加载
spl_autoload_register(function ($class) {
    include dirname(__DIR__) . '/class/' . $class . '.class.php';
});
// echo 2233;die;
$curl = new Curl();
$res = $curl->https_post('http://dev.local.test/api.test.php', array(
    'name' => 'wangqiang',
    'token' => '8888'
));
print_r($res);
?>

