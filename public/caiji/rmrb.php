<?php
/**
 * 人民日报
 */
require_once __DIR__ . '/helpers.php';

$urls = array(
    'http://m.people.cn/22/index.html',
    // 'http://m.people.cn/23/index.html',
    // 'http://m.people.cn/52/index.html', // xinwen
    // 'http://m.people.cn/26/index.html', // caijing
    // 'http://m.people.cn/34/index.html', //jiankang
    // 'http://m.people.cn/1141/1198/index.html', // beijing
    // 'http://m.people.cn/30/index.html', //shehui
    // 'http://m.people.cn/204473/index.html', // chanjing
    // 'http://m.people.cn/4051/index.html', // nengyuan
    // 'http://m.people.cn/28/index.html', // keji
    // 'http://m.people.cn/902/index.html', // lvyou
    // 'http://m.people.cn/33/index.html', //shishang
    // 'http://m.people.cn/645/index.html', // jiaoyu
    // 'http://m.people.cn/29/index.html', // qiche
    // 'http://m.people.cn/4048/index.html', // huanbao
    // 'http://m.people.cn/3381/index.html', // chuangtou
);
foreach ($urls as $u) {
    $html = file_get_contents($u);
    $list = new \DomDocument();
    @$list->loadHTML($html);
    $xpath = new \DomXPath($list);
    $h = $xpath->query('//ul[@class="news-txt-list"]/li/a/@href'); //output 2 -> correct
    foreach ($h as $v) {
        $url = 'http://m.people.cn'.$v->value;
        echo $url  . '<br>';

        $str = strrchr($url, '/');
        $id = 'rmrb_' . str_replace(array('/', '.html'), '', $str);
        // echo $id;die;
        $doc = file_get_contents($url);
// echo $doc;die;
        if (preg_match('/<h1>(.*?)<\/h1>/is', $doc, $t)) {
            $title = $t[1];
        } else {
            continue;
        }
        echo $title  . '<br>';

        if (preg_match('/(<div[^>]*id="p_content1".*)<div[^>]*?style="text-align:right"/is', $doc, $c)) {
            $content = $c[1];
        } else {
            continue;
        }

        $content = preg_replace('/<(div|p|span)[^>]*>\s*<\/\1>/is', '', $content);


        $content = format($content);
        $content = finder($content, array('作者：', '记者：','人民日报','产品策划：','声明：', '人民图片'));
        if (strlt100($content)) {
            continue;
        }
        echo $content . '<br>';die;
    }
}