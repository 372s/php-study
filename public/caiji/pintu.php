<?php
/**
 * https://m.pintu360.com/
 */
require_once dirname(__FILE__) . '/helpers.php';

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


for($i = 0; $i < 10; $i++) {
    $api = 'https://m.pintu360.com/service/ajax_article_service.php';
    $data = array('fnName' => 'getArticleList', 'type' => 'recommend', 'pageNumber' => $i);
    $data1 = array('fnName' => 'getArticleList', 'type' => 'classId', 'id'=> 1, 'pageNumber' => $i);
    $data2 = array('fnName' => 'getArticleList', 'type' => 'classId', 'id'=> 10, 'pageNumber' => $i);
    $data3 = array('fnName' => 'getArticleList', 'type' => 'classId', 'id'=> 9, 'pageNumber' => $i);
    $data4 = array('fnName' => 'getArticleList', 'type' => 'classId', 'id'=> 87, 'pageNumber' => $i);
    $data4 = array('fnName' => 'getArticleList', 'type' => 'classId', 'id'=> 70, 'pageNumber' => $i);
    $data4 = array('fnName' => 'getArticleList', 'type' => 'classId', 'id'=> 8, 'pageNumber' => $i);


    $api2 = 'https://m.pintu360.com/service/think_tank_service.php';
    $data5 = array('page' => 0);

    $res = curl_post($api, $data);
    $arr = json_decode($res, true);
    foreach ($arr['content'] as $row) {
        $id = $row['id'];

        $url = 'https://m.pintu360.com/a'.$row['id'].'.html?'.$row['op'];
        echo $url . '<br>';

        $title = $row['title'];
        echo $title . '<br>';

        $html = file_get_contents($url);
        if (preg_match('/<div class="text"[^>]*?>([\s\S]*?)(<\/div>\s*)*<div class="note"/', $html, $m)) {
            $content = trim($m[1]);
            echo $content;
        }
    }
}

// print_r($arr);
// $html = file_get_contents('https://m.pintu360.com/a61501.html?s=10&o=0');
/*if (preg_match('/<div class="text"[^>]*?>([\s\S]*?)(<\/div>\s*)*<div class="note"/', $html, $m)) {*/
//     $content = trim($m[1]);
//     echo $content;die;
// }


