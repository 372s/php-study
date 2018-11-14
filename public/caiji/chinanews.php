<?php
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';

// header("Content-type: text/html; charset=GB2312");
// http://www.ha.chinanews.com/news/hnjk/index.shtml // 健康
// http://www.ha.chinanews.com/news/hnly/index.shtml // 旅游
// http://www.ha.chinanews.com/news/myhn/index.shtml // 媚眼河南
// http://www.ha.chinanews.com/news/hnty/index.shtml // 体育
$html = file_get_contents('http://www.ha.chinanews.com/news/hncj/index.shtml');
preg_match('/<div\s*?class=\"neiron_liebiao\">([\s\S]*?)<\/div>/', $html, $m);
// print_r($m[1]);die;

preg_match_all('/<a[\s\S]*?href=\"([\s\S]*?)\"[\s\S]*?>[\s\S]*?<\/a>/', $m[1], $a);
print_r($a[1]);die;

$doc = file_get_contents('http://www.ha.chinanews.com/news/hncj/2018/1114/21288.shtml');
preg_match('/<div\s*?class=\"neiron_kong\">([\s\S]*?)<\/div>/', $doc, $ma);
print_r($ma);die;
echo $doc;die;
$dom = phpQuery::newDocumentHTML($doc);
echo $dom->find('.neiron_kong')->html();
// $html = phpQuery::newDocumentFile('http://www.ha.chinanews.com/news/hncj/index.shtml');
// $re = $html->find('ul a');
// echo $re;die;
// foreach ($re  as $r) {
//     $h = pq($r)->attr('href');
//     echo $h . "<br>";
// }