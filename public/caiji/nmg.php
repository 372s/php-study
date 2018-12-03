<?php

/**
 * 内蒙古
 */
require_once __DIR__ . '/helpers.php';

header("Content-type: text/html; charset=utf-8");
set_time_limit(0);

$urls = array(
    'http://gov.nmgnews.com.cn/ffcl/index.shtml',
    // 'http://gov.nmgnews.com.cn/szxw/',
    // 'http://inews.nmgnews.com.cn/nmgxw/szxw/',
    // 'http://inews.nmgnews.com.cn/nmgxw/jjxw/',
    // 'http://inews.nmgnews.com.cn/nmgxw/kjwwxw/',
    // 'http://inews.nmgnews.com.cn/nmgxw/nmqxm/',
    // 'http://inews.nmgnews.com.cn/nmgxw/gzms/',
    // 'http://inews.nmgnews.com.cn/nmgxw/syxw/',
    // 'http://inews.nmgnews.com.cn/nmgxw/shfzxw/',
    // 'http://inews.nmgnews.com.cn/nmgxw/nmgsp/',
    // 'http://inews.nmgnews.com.cn/nmgxw/rwft/',
    // 'http://china.nmgnews.com.cn/ywsd/',
    // 'http://china.nmgnews.com.cn/rsrm/',
    // 'http://china.nmgnews.com.cn/ffdt/',
    // 'http://china.nmgnews.com.cn/sp/',
    // 'http://china.nmgnews.com.cn/bl/',
    // 'http://china.nmgnews.com.cn/zh/',
    // 'http://inews.nmgnews.com.cn/sx/ld/',
    // 'http://inews.nmgnews.com.cn/sx/pl/',
    // 'http://inews.nmgnews.com.cn/sx/xf/',
    // 'http://inews.nmgnews.com.cn/sx/ll/',
    // 'http://inews.nmgnews.com.cn/sx/gd/',
    // 'http://inews.nmgnews.com.cn/wp/',
    // 'http://inews.nmgnews.com.cn/sx/wph/',
    // 'http://inews.nmgnews.com.cn/sx/dpx/index.shtml',
    // 'http://economy.nmgnews.com.cn/yw/',
    // 'http://economy.nmgnews.com.cn/xyk/',
    // 'http://economy.nmgnews.com.cn/tzcy/',
    // 'http://economy.nmgnews.com.cn/lccp/',
    // 'http://economy.nmgnews.com.cn/jjsh/',
    // 'http://economy.nmgnews.com.cn/jjrw/',
); //采集连接

foreach ($urls as $url) {
    $data = file_get_contents($url);

    //Xport形式匹配页面URL
    $dom = new \DOMDocument();
    $dom->loadHTML($data);
    $path = new \DOMXPath($dom);
    $res = $path->query('//td/a/@href');

    //匹配详情页URL
    foreach ($res as $r) {
        $url = $r->value;

        echo $url . "<br/>";

        $id = strrchr($url, '/');
        $id = "nmg" . substr($id, 1, strpos($id, '.') - 1);
        echo $id . "<br/>";


        //匹配内容
        $res = file_get_contents($url);

        if (preg_match('#<div[^>]*?id="div2"[^>]*?>([\s\S]*?)<\/div>#i', $res, $t)) {
            $title = trim($t[1]); //获取标题
        } else {
            continue;
        }

        echo $title . "<br/>";

        // echo $res . "<br/>";die;

        if (preg_match('#(<div[^>]*?id="div_content"[\s\S]*?)<div[^>]*?id="div4"#', $res, $c)) {
            $content = trim($c[1]); //获取内容
        } else {
            continue;
        }
        $content = preg_replace('/<!--[\s\S]*?-->/', '', $content);
        $content = preg_replace('/<embed[\s\S]*?<\/embed>/', '', $content);
        $content = preg_replace('/<br[^>]*?>/', '', $content);
        $content = preg_replace('/\s??(style|class|id)=("|\')[^"\']*?\2/', '', $content);
        if (strlen($content) < 100) {
            continue; //如果内容少于33字就跳过
        }
        echo $content . "<br/>";die;
    }
}