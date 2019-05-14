<?php

include dirname(__DIR__) . '/../lib/Class/ExportCsv.class.php';
include dirname(__DIR__) . '/../lib/Class/CsvReader.class.php';


function http_send($url, $params = array(), $method = 'get')
{
    $ch = curl_init();
    if ($method == 'get') {
        $sParam = http_build_query($params);
        if (!empty($sParm)) {
            $url = $url . '?' . $sParam;
        }
    } else {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    }

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 500);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
$arr = array(
    '医脉通ID',
    '姓名',
    '省份',
    '城市',
    '区',
    '地址',
    '职称类型',
    '执业证号',
    '医院',
    '医院级别',
    '职称级别',
    '专业',
    '注册来源',
    '注册时间',
    '是否绑定邮箱',
    '是否绑定手机',
    '用户等级',
    '手机号',
    '邮箱',
    '绑定微信',
);
$row = eval('return ' . iconv('utf-8', 'gbk', var_export($arr, true)) . ';');
// print_r($row);die;
// $tm = [];
// foreach ($arr as $item) {
//     $tm[] = mb_convert_encoding($item, 'gbk');
// }
// print_r($tm);die;

$ids = [108292, 936159, 2199162, 425210];
$data = array();
foreach ($ids as $id) {
    $api = "http://api.medlive.cn/user/action/user_info.php?user_id=".$id;
    $res = http_send($api);
    $arr = json_decode($res, true);
    $user = $arr['data'];
    $user['user_id'] = $user['user_id'] . "\t";
    $user['practice_number'] = $user['practice_number'] . "\t";
    $user['bind_email'] = $user['bind_email'] ? "是" : "否";
    $user['bind_mobile'] = $user['bind_mobile'] ? "是" : "否";
    $data[] = $user;
}
ExportCsv::export_csv_2($data, $row);
