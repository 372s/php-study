<?php
/**
 * 百讯网
 * 河南
 */
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';

// $text = "Line 1 Line 2 Line 3";
// echo strrchr($text, 10);die;
// $last = substr(strrchr($text, 10), 1 );
// echo $last;die;

// 'http://www.bxkxw.com/news/China/',
// 'http://www.bxkxw.com/news/International/',
// 'http://www.bxkxw.com/wenxue/',
// 'http://www.bxkxw.com/trip/',

$urls = array(
    'http://www.bxkxw.com/news/hnxw',
    'http://www.bxkxw.com/news/hnxw/2.html',
    'http://www.bxkxw.com/news/zhengzhou/',
    'http://www.bxkxw.com/shehui/',
    'http://www.bxkxw.com/chengxiang/',
);

foreach ($urls as $url) {
    $file = phpQuery::newDocumentFile($url);
    $list = $file->find('dd a');

    foreach ($list as $item) {
        $sUrl = pq($item)->attr('href');

        $id = rtrim(strrchr($sUrl, '/'), '.html');
        $id = 'bx_' . trim($id, '/');
        echo $id;

        $html = phpQuery::newDocumentFile($sUrl);

        $title = $html->find('#title')->contents();
        echo $title;

        $content = $html->find('.article-inner')->html();

        $content = str_replace('src="', 'src="http://www.bxkxw.com', $content);
        echo $content;
    }
}





die;
$html = file_get_contents('http://www.bxkxw.com/news/hnxw/');
$doc = new DOMDocument('1.1', 'utf-8');
@$doc->loadHTML($html);
$xpath = new DOMXpath($doc);
$res = $xpath->query('//dd/a/@href');
foreach ($res as $re) {
    echo $re->value . "<br>";
}