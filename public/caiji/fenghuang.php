<?php

require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';

$urls = array(
    'https://inews.ifeng.com/32_0/data.shtml', //新闻
    'https://inews.ifeng.com/32_1/data.shtml', //新闻
    'https://inews.ifeng.com/32_2/data.shtml', //新闻
    'http://itech.ifeng.com/7_0/data.shtml', //科技
    'https://iculture.ifeng.com/10009_0/data.shtml', //文化
);
// $url = 'https://inews.ifeng.com/32_1/data.shtml';

foreach ($urls as $url) {
    $res = file_get_contents($url);
    $res = trim($res);
    $res = ltrim($res, 'getListDatacallback(');
    $res = rtrim($res, ');');
    $data = json_decode($res, true);
    // print_r($data);die;

    foreach ($data as $item) {
        $arr = explode('/', $item['pageUrl']);
        // print_r($arr);die;
        $id = 'fh_' . $arr[1];
        echo $id . "<br>";
        $url = 'https://inews.ifeng.com' . $item['pageUrl'];
        $title = $item['title'];
        echo $title . "<br>";
        $doc = phpQuery::newDocumentFile($url);
        $content = $doc->find('div[id="whole_content"]');
        $content->find('div[id="artical_real"]')->remove();
        // $content->find('script')->remove();
        $content = $content->html();
        echo $content;die;
    }
}
