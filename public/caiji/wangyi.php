<?php
/**
 * 网易新闻
 */
require_once __DIR__ . '/helpers.php';

$us = array(
    'http://3g.163.com/touch/reconstruct/article/list/BBM54PGAwangning/0-10.html', // xinwen
    'http://3g.163.com/touch/reconstruct/article/list/BD29LPUBwangning/0-10.html', // guonei
    'http://3g.163.com/touch/reconstruct/article/list/BD29MJTVwangning/0-10.html', //guoji
    'https://3g.163.com/touch/reconstruct/article/list/BA10TA81wangning/0-10.html',//yule
    'https://3g.163.com/touch/reconstruct/article/list/BA8E6OEOwangning/0-10.html', // tiyu
    'https://3g.163.com/touch/reconstruct/article/list/BA8EE5GMwangning/0-10.html', // caijing
    'https://3g.163.com/touch/reconstruct/article/list/BA8D4A3Rwangning/0-10.html', //keji
    'https://3g.163.com/touch/reconstruct/article/list/BAI6I0O5wangning/0-10.html', // shouji
    'https://3g.163.com/touch/reconstruct/article/list/BAI6JOD9wangning/0-10.html', //shuma
    'https://3g.163.com/touch/reconstruct/article/list/BBM50AKDwangning/0-10.html', // wangyihao
    'https://3g.163.com/touch/reconstruct/article/list/DE0DNAFFwangning/0-10.html', // meirituijian
    'https://3g.163.com/touch/reconstruct/article/list/BA8F6ICNwangning/0-10.html', //shishang
    'https://3g.163.com/touch/reconstruct/article/list/BA8FF5PRwangning/0-10.html', // jiaoyu
    'https://3g.163.com/touch/reconstruct/article/list/DJFFJBSLlizhenzhen/0-10.html', // gongkaike
    'https://3g.163.com/touch/reconstruct/article/list/BDC4QSV3wangning/0-10.html', // jiankang
    'https://3g.163.com/touch/reconstruct/article/list/BEO4GINLwangning/0-10.html', // lvyou
    'https://3g.163.com/touch/reconstruct/article/list/BEO4PONRwangning/0-10.html', // qin zi
    'https://3g.163.com/touch/reconstruct/article/list/CKKS0BOEwangning/0-10.html', // yishu
);

$tmp = [];
foreach ($us as $u) {
    for ($i = 1; $i <= 4; $i++) {
        $tmp[] = str_replace('0-10', $i.'-10', $u);
    }
}

$us = array_merge($us, $tmp);
// print_r($us);die;

foreach ($us as $u) {
    $data = file_get_contents($u);
    $data = trim($data);
    $data = ltrim($data, 'artiList(');
    $data = rtrim($data, ')');
    $data = json_decode($data, true);


    if (! preg_match('/list\/(.*)\//', $u, $ma)) {
        continue;
    }
    // $key =$ma[1];
    // echo $ma[1] . '<br>';
    // print_r($data);die;
    foreach ($data[$ma[1]] as $row) {
        // print_r($row);
        $id = 'wy_' . $row['docid'];
        // echo $id . '<br>';
        $title = $row['title'];
        $url = $row['url'];

        if (strpos($url, 'http://') === false) {
            continue;
        }
        echo $url . '<br>';

        $doc = file_get_contents($url);
        // echo $doc;die;

        if (preg_match('/(<div class="content"[^>]*?>[\s\S]*?)<div class="footer"/', $doc, $matches)) {
            $content = $matches[1];
        } else {
            continue;
        }

        $content = preg_replace('/<!--[\s\S]*?-->/', '', $content);
        $content = preg_replace('/<script[\s\S]*?<\/script>/', '', $content);
        $content = preg_replace('/<(div)[^<>]*?display:\s*none[^<>]*?>[\s\S]*?<\/\1>/i', '', $content);
        $content = preg_replace('/<(h\d{1})[\s\S]*?>([\s\S]*?)<\/\1>/i', '<p>$2</p>', $content);
        $content = preg_replace('/(<img)[\s\S]*?(src="[\s\S]*?")[\s\S]*?(\/?>)/', '$1 $2$3', $content);
        $content = preg_replace('/<a[^<>]*?>([\s\S]*?)<\/a>/is', '$1', $content);
        $content = preg_replace('/\s??(style|class|id)="[^"]*?"/', '', $content);
        $content = preg_replace('/<(p|span)[^>]*?>(\s|<br>)*<\/\1>/', '', $content);

        $content = ltrim($content, '<div>');
        $content = rtrim($content, '</div>');

        $content = preg_replace_callback(
            '/<p[\s\S]*?>([\s\S]*?)<\/p>/i',
            function ($matches) {
                $patterns = [
                    '/不得转载/', '/责任编辑[:：]?/',  '/作者[:：]?/',
                    '/本文来源[:：]?/', '/原文链接[:：]?/', '/原标题[:：]?/',
                    '/公众号/', '/一点号/', '/微信号/', '/头条号/', '/微信平台/', '/蓝字/',
                    '/加威信/', '/加微心/', '/关注我们/', '/关注我/', '/欢迎关注/',
                ];
                foreach ($patterns as $pattern) {
                    if (preg_match($pattern, $matches[1])) {
                        return '';
                    }
                    else if (! trim($matches[1])) {
                        return '';
                    }
                }
                return "<p>$matches[1]</p>";
            },
            $content);
        $content = img_url_local($content, 'wangyi');
        echo $content . '<br>';die;
    }
    die;
}


