<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/10/16
 * Time: 16:48
 */

require_once 'curl.php';
require('phpQuery/phpQuery.php');

set_time_limit(0);
//http://www.yidianzixun.com/home/q/news_list_for_channel?channel_id=22658408728&cstart=0&cend=10&infinite=true&refresh=1&__from__=wap&_spt=yz~eaod88%3C%3F2%3E%3A2%3D82%3A%3B%3A&appid=web_yidian&_=1539879352210
//http://www.yidianzixun.com/home/q/news_list_for_channel?channel_id=best&cstart=0&cend=10&infinite=true&refresh=1&__from__=wap&docids=0KII0UX6%2C0KGdSHmh%2C0KI5XUrI%2C0KI9laum%2C0KGM4vJb&_spt=yz~eaodhoy~%3A%3B%3A&appid=web_yidian&_=1539879112123
$content = curl_get_content('http://www.yidianzixun.com/home/q/news_list_for_channel?channel_id=best&cstart=0&cend=10&infinite=true&refresh=1&__from__=wap&docids=0KII0UX6%2C0KGdSHmh%2C0KI5XUrI%2C0KI9laum%2C0KGM4vJb&_spt=yz~eaodhoy~%3A%3B%3A&appid=web_yidian&_=1539879112123');
//echo $content;
/*preg_match('/<div id=\"js-content\"[\s\S]*?>(.*?)<\/div>/', $content, $matches);*/
//$content = $matches[1];
/*$content = preg_replace("/<div id=\"article-img-[\s\S]*?>[\s\S]*?<\/div>/", '<div><img src="http://i1.go2yd.com/image.php?url="></div>', $content);*/
//echo $content;die;
//$doc = phpQuery::newDocumentHTML($content);
//$imgs = pq("img");
//print_r($imgs);die;
//$div = pq("div[id='js-content']")->html();
$res = json_decode($content, true);
 print_r($res);die;
$res = $res['result'];

foreach ($res as $value) {
    $id = 'ydzx_' . $value['docid'];
    $title = $value['title'];
    $filter_titles = array('佛教', '聚餐', '钥匙');
    foreach ($filter_titles as $ft) {
        if (strpos($title, $ft) !== false) {
            continue;
        }
    }

    $url = 'http://www.yidianzixun.com/article/' . $value['docid'];
    $content = $this->curl_get_content($url);
    // 处理图片
    if (!empty($value['image_urls'])) {
        foreach ($value['image_urls'] as $k => $img) {
            $content = preg_replace("/<div id=\"article-img-$k\"[\s\S]*?>[\s\S]*?<\/div>/", '<img src="http://i1.go2yd.com/image.php?url=' . $img . '">', $content);
        }
    }
    if (preg_match('/<div id=\"js-content\"[\s\S]*?>(.*?)<\/div>/', $content, $matches)) {
        $content = $matches[1];
        $content = preg_replace('/<script[\s\S]*?<\/script>/i', '', $content);
        $content = preg_replace('/<video[\s\S]*?<\/video>/i', '', $content);
        $word = array("价格", "购买", "￥", "QQ群", "股票", "彩票", "王者荣耀", "传真", "互粉", "电话", "足彩", "大乐透", "双色球", "套花呗", "信用卡套现");
        foreach ($word as $w) {
            if (strpos($content, $w) !== false) {
                continue;
            }
        }
        $content = preg_replace('/(<a href=\")([\s\S]*?)(\"[\s\S]*?>)/i', "$1javascript:;$3", $content);
        if (strlen($content) < 100) continue; //如果内容少于33字就跳过
        $content = $this->img_url_local($content);
    } else {
        continue;
    }
}
preg_match('/<img[\s\S]*?src=\"([\s\S]*?)\"[\s\S]*?>/', $content, $imgs);
print_r($imgs);die;



function getMillisecond() {
    list($s1, $s2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
}
$ids = [];
for ($i = 0; $i < 10; $i++) {
    $content = curl_get_content('http://www.yidianzixun.com/home/q/news_list_for_channel?channel_id=best&cstart=0&cend=10&infinite=true&refresh=1&__from__=wap&_spt=yz~eaodhoy~%3A%3B%3A&appid=web_yidian&_=' . getMillisecond());
    $res = json_decode($content, true);
    $res = $res['result'];
    foreach ($res as $value) {
        $id = 'ydzx_'. $value['docid'];
        if(! in_array($id, $ids)) {
            array_push($ids, $id);
        }
        $title = $value['title'];
        $url = 'http://www.yidianzixun.com/article/' . $value['docid']. '?s=';
        $content = curl_get_content($url);
        $content = preg_replace('/(<div id=\"article-img-[\s\S]*?>[\s\S]*?<\/div>)/', "", $content);
        if (preg_match('/<div id=\"js-content\"[\s\S]*?>.*?<\/div>/', $content, $matches)) {
            $content = $matches[0];

            $content = preg_replace('/(<div id=\"article-img[\s\S]*?><\/div>)/', "", $content);
            $content = preg_replace('/<script[\s\S]*?<\/script>/i', '', $content);
            $content = preg_replace('/<video[\s\S]*?<\/video>/i', '', $content);
            $content = preg_replace('/(<a href=\")([\s\S]*?)(\"[\s\S]*?>)/i', "$1javascript:;$3", $content);
            if (strlen($content) < 100) continue; //如果内容少于33字就跳过
//        $content = str_replace("src=\"//", "src=\"http://", $content);
        } else {
            continue;
        }

//        echo $id . "<br>";
//        echo $title . "<br>";
//     echo $content . "<br>";
    }
    sleep(1);
}

print_r($ids);

//$content = curl_get_content('http://www.yidianzixun.com/article/0KHPPm3Y');

//$content = curl_get_content('http://www.yidianzixun.com/article/0KHahxoG');
/*preg_match('/<div id=\"js-content\"[\s\S]*?>.*?<\/div>/', $content, $matches);*/
//print_r($matches);die;
//
/*if (preg_match('/<div id=\"js-article\"[\s\S]*?>.*?<\/div>/', $content, $matches)) {*/
//    print_r($matches);die;
//}
//echo $content;die;
//$res = json_decode($content, true);
//print_r($res['result']);die;

//$dom = new DomDocument();
//$dom->loadHTML($html);
//$xpath = new DomXPath($dom);
//// $tag1 = $dom->getElementsByTagName("tag1")->item(0);
//
//$href = $xpath->query('//div[@class="news-list"]/a/@href'); //output 2 -> correct
//
//foreach ($href as $url) {
//    echo $url->value;
//}