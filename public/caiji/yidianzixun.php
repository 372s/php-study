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
$doc = phpQuery::newDocumentHTML($content);
$imgs = pq("img");
//print_r($imgs);die;
$div = pq("div[id='js-content']")->html();
$res = json_decode($content, true);
 print_r($res);die;
$res = $res['result'];


$dom = new DomDocument();
$dom->loadHTML($html);
$xpath = new DomXPath($dom);
// $tag1 = $dom->getElementsByTagName("tag1")->item(0);

$href = $xpath->query('//div[@class="news-list"]/a/@href'); //output 2 -> correct

foreach ($href as $url) {
    echo $url->value;
}