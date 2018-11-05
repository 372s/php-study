<?php

require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';

$urls = array(
    'https://inews.ifeng.com/32_0/data.shtml?_=1541407751186', //新闻
    'https://inews.ifeng.com/32_1/data.shtml?_=1541407751186', //新闻
    'https://inews.ifeng.com/32_2/data.shtml?_=1541407751186', //新闻
    'http://itech.ifeng.com/7_0/data.shtml?_=1541408734788', //科技
    'https://iculture.ifeng.com/10009_0/data.shtml?_=1541408685267', //文化
);
// $url = 'https://inews.ifeng.com/32_1/data.shtml?_=1541407751186';

foreach ($urls as $url) {
    $res = file_get_contents($url);
    $res = trim($res);
    $res = ltrim($res, 'getListDatacallback(');
    $res = rtrim($res, ');');
// echo $res;die;
    $data = json_decode($res, true);
// print_r($data);die;

    foreach ($data as $item) {

        $url = 'https://inews.ifeng.com' . $item['pageUrl'];
        $parse_url = trim($item['pageUrl'], '/');
        $parse_url = explode('/', $parse_url);
        $id = 'fh_' . $parse_url[0];
        $title = $item['title'];

        $doc = phpQuery::newDocumentFile($url);
        $content = $doc->find('div[id="whole_content"]');
        $content->find('div[id="artical_real"]')->remove();
        // $content->find('script')->remove();
        $content = $content->html();
        echo $content;
    }
}

