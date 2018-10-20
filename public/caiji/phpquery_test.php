<?php
// pq(); is using selected document as default phpQuery::selectDocument($doc);
// documents are selected when created or by above method
// query all unordered lists in last selected document pq('ul')->insertAfter('div');

require_once 'curl.php';
require_once dirname(__DIR__) . '/../vendor/autoload.php';

$url = 'http://www.yidianzixun.com/article/0KIXYQGS?s=';
$content = curl_get_content($url);
//echo $content;die;
$doc = phpQuery::newDocumentHTML($content);
$div = pq("article[id='js-article']")->html();
echo $div;die;