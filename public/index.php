<?php
require_once __DIR__. '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

$img = "https://f12.baidu.com/it/u=2674946297,2122048651&fm=173&app=49&f=JPEG?w=640&h=480&s=D77816C50C72ECD65A3FF8240300B058&access=215967316";

// $img = 'http://static.nbd.com.cn/images/nbd_v4/ydrss640.jpg';
// print_r(getimagesize($img));die;
$hdrs = array(
    'http' =>array(
        'header' =>
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n".
            "Accept-Encoding: gzip, deflate, br\r\n" .
            "Accept-Language: zh-CN,en-US;q=0.7,en;q=0.3\r\n".
            "Cache-Control: max-age=0\r\n".
            "Connection: keep-alive\r\n".
            "cookie: BAIDUID=8667E5CD725AF880B79D96213972AF64:FG=1; BIDUPSID=8667E5CD725AF880B79D96213972AF64; PSTM=1542769852; x-logic-no=1; H_PS_PSSID=1421_21106_27509; delPer=0; PSINO=1; BDRCVFR[gltLrB7qNCt]=mk3SLVN4HKm\r\n".
            "DNT: 1\r\n".
            "Host: mbd.baidu.com\r\n".
            "Upgrade-Insecure-Requests: 1\r\n".
            "User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Mobile Safari/537.36\r\n",
        'timeout'=>30
    ),

);
$context = stream_context_create($hdrs);

// print_r($context);die;
$fp = fopen($img, "rb",false, $context) or die("Invalid file stream.");
$head_block = fread($fp, 256);
$size = getimagesize('data://image/jpeg;base64,'. base64_encode($head_block));
print_r($size);
exit;
