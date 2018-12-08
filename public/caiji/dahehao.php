<?php
/**
 * 大河号
 * https://dhh.dahe.cn/
 */

set_time_limit(0);
header("Content-type: text/html; charset=utf-8");

function curl_post($url, $data = array(), $headers = array()) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, ($data));
    // curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $output = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);
    return $output;
}


$url = 'https://dhh.dahe.cn/list';
$data = array('page' => 0, 'size' => 1, 'pageId' => 0);
$res = curl_post($url, $data);
$arr = json_decode($res, true);

// print_r($arr);
// die;
foreach ($arr['obj']['content'] as $con) {
    $url = 'https://dhh.dahe.cn/con/'.$con['selfUrl'];
    echo $url  . "<br>";
    $html = file_get_contents($url);
    // echo $html;die;

    preg_match('/<div class="detail-content">([\s\S]*?)<div id="comment"/', $html, $ma);
    // print_r($ma);die;
    $content = trim($ma[1]);

    $content = preg_replace('/\s*?style=("|\')[^"\']*?\1/', '', $content);
    $content = preg_replace('/\s*?data-[a-z]*=("|\')[^"\']*?\1/i', '', $content);

    $content = preg_replace('/<p>(\s|<br>)*?<\/p>/', '', $content);
    $content = preg_replace('/<([a-z]*)[^>]*>[^<>]*大河号[^<>]*<\/\1>/', '', $content);
    $content = preg_replace('/<(article|section)[^<>]*?>/', '', $content);
    $content = preg_replace('/<\/(article|section)>/', '', $content);

    echo $content . "<br>";
}

