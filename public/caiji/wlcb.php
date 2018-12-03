<?php
/**
 * 乌兰察布
 */

header("Content-type: text/html; charset=utf-8");
set_time_limit(0);
$urls = array(
    'http://www.wlcbnews.com/gnxwwz',
    // 'http://www.wlcbnews.com/gnxwwz?page=2',
    // 'http://www.wlcbnews.com/qnxwwz',
    // 'http://www.wlcbnews.com/qnxwwz?page=2',
    // 'http://www.wlcbnews.com/bsxwwz',
    // 'http://www.wlcbnews.com/bsxwwz?page=2',
    // 'http://www.wlcbnews.com/shxwgn',
    // 'http://www.wlcbnews.com/shxwgn?page=2',
); //采集连接

foreach ($urls as $url) {
    $data = file_get_contents($url);

    $host = 'http://www.wlcbnews.com';
    //Xport形式匹配页面URL
    $dom = new \DOMDocument();
    @$dom->loadHTML($data);
    $path = new \DOMXPath($dom);

    $res = $path->query("//div[@class='pic-summary']/a/@href");

    //匹配详情页URL
    foreach ($res as $r) {
        $url = $r->value;
        $url = $host . $url;
        echo $url . "<br/>";

        preg_match("/\/([a-z0-9]+?)\.html/i", $url, $ids);
        $id = "wlcb" . $ids[1];
        echo $id . "<br/>";

        //匹配内容
        $res = file_get_contents($url);
        if (preg_match('/<h2[^>]*?class="article-content-title"[^>]*?>([\s\S]*?)<\/h2>/', $res, $t)) {
            $title = trim($t[1]); //获取标题
        } else {
            continue;
        }
        echo $title . "<br/>";
        if (preg_match('/<div[^>]*?class="article-detail-inner"[^>]*?>([\s\S]*?)<div[^>]*?class="hr20"/', $res, $c)) {
            $content = '<div>' . trim($c[1]); //获取内容
        } else {
            continue;
        }
        if (preg_match('/^<(div)[^>]*>(.*)<\/\1>$/is', $content, $matches)) {
            print_r($matches[1]);die;
        } else {
            print_r($content);die;
        }
        $content = preg_replace('/<!--[\s\S]*?-->/', '', $content);
        $content = preg_replace('/<embed[\s\S]*?<\/embed>/', '', $content);
        if (strlen($content) < 100) {
            continue; //如果内容少于33字就跳过
        }
        echo $content . "<br/>";die;
    }
}