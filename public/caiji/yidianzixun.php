<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/10/16
 * Time: 16:48
 */

require_once 'curl.php';

// $html = file_get_contents('http://www.yidianzixun.com/?id=hot&name=%E8%A6%81%E9%97%BB'); // 要闻
// $html = file_get_contents('http://www.yidianzixun.com/#/?id=best&name=%E6%8E%A8%E8%8D%90'); // 推荐
// $html = curl('http://www.yidianzixun.com');
$html = curl('http://www.yidianzixun.com/home/q/news_list_for_channel?channel_id=best&cstart=0&cend=10&infinite=true&refresh=1&__from__=pc&multi=5&_spt=yz~eaodhoy~%3A%3B%3A&appid=web_yidian&_=1539682464359');
echo $html;die;
$dom = new DomDocument();
$dom->loadHTML($html);
$xpath = new DomXPath($dom);
// $tag1 = $dom->getElementsByTagName("tag1")->item(0);

$href = $xpath->query('//div[@class="news-list"]/a/@href'); //output 2 -> correct

foreach ($href as $url) {
    echo $url->value;
}