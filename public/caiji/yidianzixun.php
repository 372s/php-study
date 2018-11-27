<?php
/**
 * 一点资讯
 */
require_once dirname(__FILE__) . '/helpers.php';
require_once 'ydzx_curl.php';

$content = curl_get_content('http://www.yidianzixun.com/home/q/news_list_for_channel?channel_id=best&cstart=0&cend=10&infinite=true&refresh=1&__from__=wap&docids=0KJCWV23%2C0KIh4jyU%2C0KIXYQGS%2CV_01wylP3P%2C0KJGp5WD&_spt=yz~eaodhoy~%3A%3B%3A&appid=web_yidian&_=1540052655146');
$res = json_decode($content, true);
// print_r($res);die;

foreach ($res['result'] as $value) {
    if (empty($value['docid'])) {
        continue;
    }

    $id = 'ydzx_'. $value['docid'];
    echo $id . '<br>';

    $title = $value['title'];

    $url = 'http://www.yidianzixun.com/article/' . $value['docid'];
    echo $url . '<br>';
    // $content = curl_get_content($url);
    $doc = phpQuery::newDocumentFileHTML($url);

    if (empty($title)) {
        $title = $doc->find('.left-wrapper h2')->contents();
    }
    echo $title . '<br>';

    $content = $doc->find('.content-bd')->html();

    // 过滤方法
    $content = phpQuery::newDocumentHTML($content);
    // $content->find('div')->replaceAll('p');
    // $content->removeData('');
    $content = $content->html();
    //
    // $content = format($content);
    // $content = img_url_local($content);

    echo $content . "<br>";die;
}
