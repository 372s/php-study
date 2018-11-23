<?php

require_once dirname(__FILE__) . '/helpers.php';

header("Content-type: text/html; charset=GB2312");

// $html = file_get_contents('http://www.ha.chinanews.com/news/hncj/index.shtml');
// preg_match('/<div\s*?class=\"neiron_liebiao\">([\s\S]*?)<\/div>/', $html, $m);
// // print_r($m[1]);die;
//
/*preg_match_all('/<a[\s\S]*?href=\"([\s\S]*?)\"[\s\S]*?>[\s\S]*?<\/a>/', $m[1], $a);*/
// print_r($a[1]);die;
//
// $doc = file_get_contents('http://www.ha.chinanews.com/news/hncj/2018/1114/21288.shtml');
// preg_match('/<div\s*?class=\"neiron_kong\">([\s\S]*?)<\/div>/', $doc, $ma);
// print_r($ma);die;


$urls = array(
    'http://www.ha.chinanews.com/news/hnjk/index.shtml', //健康
    'http://www.ha.chinanews.com/news/hnly/index.shtml', //旅游
    'http://www.ha.chinanews.com/news/myhn/index.shtml', //媚眼河南
    'http://www.ha.chinanews.com/news/hnty/index.shtml', //体育
    'http://www.ha.chinanews.com/news/hncj/index.shtml', //财经
);
foreach ($urls as $url) {
    $html = file_get_contents($url);
    if (preg_match('/<div\s*?class=\"neiron_liebiao\">([\s\S]*?)<\/div>/', $html, $m)) {
        if (preg_match_all('/<a[\s\S]*?href=\"([\s\S]*?)\"[\s\S]*?>[\s\S]*?<\/a>/', $m[1], $a)) {
            $list = $a[1];
            // print_r($a[1]);die;
        }
    } else {
        continue;
    }

    if (empty($list)) {
        continue;
    }

    foreach ($list as $row) {

        $sUrl = 'http://www.ha.chinanews.com' . $row;
        $dot = strrpos($sUrl, '/');
        $imgUrl = substr($sUrl, 0, $dot+1);
        echo $imgUrl;

        $id = 'cn_' . rtrim(substr($sUrl, $dot+1, strlen($sUrl)), '.shtml');

        $doc = file_get_contents($sUrl);

        if (preg_match('/<div\s*?class=\"neiron_title\">([\s\S]*?)<\/div>/', $doc, $t)) {
            $title = trim($t[1]);
        } else {
            continue;
        }
        echo $title;die;


        if (preg_match('/<div\s*?class=\"neiron_kong\">([\s\S]*?)<\/div>/', $doc, $ma)) {
            // print_r($ma[1]);die;
            $content = $ma[1];
        } else {
            continue;
        }


        $content = img_local($content, $imgUrl);
        // $content = str_replace('src="','src="'. $imgUrl, $content);
        echo $content;die;

    }

}

function img_local($content, $url)
{
    $doc = new DOMDocument('1.0', 'utf-8');
    @$doc->loadHTML($content);
    $xpath = new DOMXPath($doc);
    $result = $xpath->query("//img");
    foreach ($result as $value) {
        $imgsrc = $value->getAttribute('src');
        $lj = dirname(__DIR__) . '/uploads/'  . date('ymd') . '/';
        $xinarc = create_img($url.$imgsrc, $lj);
        $xinarc = str_replace(dirname(__DIR__), "http://php-study.test", $xinarc);
        $content = str_replace($imgsrc, $xinarc, $content);
    }
    return $content;
}