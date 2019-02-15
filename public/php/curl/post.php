<?php

function post($url, $params = array())
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 2500);
    // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    $response = curl_exec($ch);
    if ($response === false) {
        if(curl_errno($ch) == CURLE_OPERATION_TIMEDOUT) {
            //超时的处理代码
            $response = array('error' => 'timeout');
        }
    }
    curl_close($ch);
    return $response;
}

$data = array(
    'foo'=>'bar',
    'baz'=>'boom',
    'site'=>'www.example.net',
    'name'=>'nowa magic'
);
$url = "http://php-study.test/php/request/test1.php";
$res = post($url, $data);
print_r($res);