<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/10/16
 * Time: 16:48
 */

require_once 'curl.php';

function getMillisecond() {
    list($s1, $s2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
}

//echo time() . "\n";
//echo microtime(true). "\n";
//$d = substr('1539785236223', 0, 10);
//echo date('Y-m-d H:i:s', $d);die;
//$content = curl_get_content('http://www.yidianzixun.com/home/q/news_list_for_channel?channel_id=best&cstart=0&cend=10&infinite=true&refresh=1&__from__=wap&docids=&_spt=yz~eaodhoy~%3A%3B%3A&appid=web_yidian');
//$content = curl_get_content('http://www.yidianzixun.com/home/q/news_list_for_channel?channel_id=hot&cstart=0&cend=30&infinite=true&refresh=1&__from__=wap&_spt=yz~eaodbe~%3A%3B%3A&appid=web_yidian&_=1539783212046');
//$time =

$content = curl_get_content('http://www.yidianzixun.com/home/q/news_list_for_channel?channel_id=best&cstart=0&cend=10&infinite=true&refresh=1&__from__=wap&_spt=yz~eaodhoy~%3A%3B%3A&appid=web_yidian&_=' . getMillisecond());
$res = json_decode($content, true);
//print_r($res);
$res = $res['result'];
foreach ($res as $value) {
    $id = 'ydzx_'. $value['docid'];
    $title = $value['title'];
    $url = 'http://www.yidianzixun.com/article/' . $value['docid']. '?s=';
    // echo $url;die;
    $content = curl_get_content($url);
//    echo $content;
/*    preg_match_all('/<img src=\"([\s\S]*?)\"[\s\S]*?>/', $content, $imgs);*/
//    print_r($imgs);
//    if (!empty($imgs)) {
//        foreach ($imgs[0] as $k => $img) {
/*                $content = preg_replace('/(<div id=\"article-img-'.$k.'[\s\S]*?>[\s\S]*?<\/div>)/', "$img", $content);*/
//        }
//    }
    $content = preg_replace('/(<div id=\"article-img-[\s\S]*?>[\s\S]*?<\/div>)/', "", $content);
    if (preg_match('/<div id=\"js-content\"[\s\S]*?>.*?<\/div>/', $content, $matches)) {
        $content = $matches[0];

        $content = preg_replace('/(<div id=\"article-img[\s\S]*?><\/div>)/', "", $content);
        $content = preg_replace('/<script[\s\S]*?<\/script>/i', '', $content);
        $content = preg_replace('/<video[\s\S]*?<\/video>/i', '', $content);
        $content = preg_replace('/(<a href=\")([\s\S]*?)(\"[\s\S]*?>)/i', "$1javascript:;$3", $content);
        if (strlen($content) < 100) continue; //如果内容少于33字就跳过
//        $content = str_replace("src=\"//", "src=\"http://", $content);
        // $content = $this->img_replace($content);
    } else {
        continue;
    }


     echo $id . "<br>";
     echo $title . "<br>";
     echo $content . "<br>";
}

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