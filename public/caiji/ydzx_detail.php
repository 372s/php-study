<?php
require_once 'curl.php';
require_once dirname(__DIR__) . '/../vendor/autoload.php';


/* 详情 */
$url = 'http://www.yidianzixun.com/article/0KIXYQGS?s=';
$content = curl_get_content($url);
//echo get_query_fuc($content);
echo get_dom_fuc($content);



function get_dom_fuc($content) {
    $dom = new DOMDocument();
    @$dom->loadHTML($content);
    $xpath = new DomXPath($dom);
    $article = $xpath->query('//article[@id="js-article"]'); //output 2 -> correct
    return $dom->saveHTML($article->item(0));
}

function get_query_fuc($content) {
    phpQuery::newDocumentHTML($content);
    return pq("article[id='js-article']")->html();
}