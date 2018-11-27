<?php

// print_r($_POST);die;
// print_r($_REQUEST);die;
// echo file_get_contents('php://input');

$a = '{"apiUser":"postmaster@medlive-daily.sendcloud.org","apiUserId":66328,"id":"1542124800707_25558_11214_5831.sc-10_9_4_48-inbound","labelId":0,"messageId":"1542124800707_25558_11214_5831.sc-10_9_4_48-inbound","netease":false,"rcptToList":["ss72@163.com"],"status":18,"taskId":"","timestamp":1542124800717,"userHeaders":{},"userId":25558}';
// print_r(json_decode($a, true));die;

set_time_limit(0);
$fp = fopen("25558-2018-11-14.tag_(2)", "r");
$i = 0;
echo filesize("25558-2018-11-14.tag_(2)");die;
while (!feof($fp) && $i < 100) {
    $i ++;
    $line = fgets($fp);
    // $line = preg_replace_callback(
    //     '/msg([\s\S]*?)process1/',
    //     function ($matches) {
    //         return $matches[1] . "\n";
    //     },
    //     $line
    // );

    $line = preg_replace('/process1[\s\S]*?msg=/', '', $line);
    $line = str_replace('\'.', '\'', $line);
    $line = str_replace(', publish or delete', '', $line);
    $line = str_replace('\'{', '{', $line);
    $line = str_replace('}\'', '}', $line);
    // $line = trim($line, '\'');
    // echo $line;die;
    print_r(json_decode($line, true));
    // echo $line . "<br>";die;
}
fclose($fp);