<?php
/**
 * 北京时间 http://h5.btime.com
 * @time 2018.12.06 修改
 */

require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';


set_time_limit(0);

$arr = array(
    // 'http://h5.btime.com/index/list?cname=%E6%96%B0%E9%97%BB&cid=7389193781085e10178780f6bbb3c79e', // 新闻
    // 'https://h5.btime.com/index/list?cname=%E6%8E%A8%E8%8D%90&cid=2da8f707e9d514c562162540d2b0ad57', // 新时代
    // 'https://h5.btime.com/index/list?cname=%E5%A8%B1%E4%B9%90&cid=7af450a9dcc60c0af56db7421a461c02',
    // 'https://h5.btime.com/index/list?cname=%E4%BD%93%E8%82%B2&cid=eaabd3750a92632e39431d1197b80acc',
    // 'https://h5.btime.com/index/list?cname=%E7%A7%91%E6%8A%80&cid=ccaa7b3dafbdd70a7a0abeb17902e994',
    // 'http://h5.btime.com/index/list?cname=%E8%B4%A2%E7%BB%8F&cid=5669459fffd471c7adb81621ccc652f2', // 财经
    // 'http://h5.btime.com/index/list?cname=%E7%94%9F%E6%B4%BB&cid=4e9715a3087a5cf063107c9132be55f5', // 生活
    'https://h5.btime.com/index/list?cname=%E5%9B%BD%E9%99%85&cid=0cb13d67ec9dcf5c335fc1df70a05877',
    'https://h5.btime.com/index/list?cname=%E6%95%B0%E7%A0%81&cid=9f8829e7ef34b714e136b7dbbc283041',
    'https://h5.btime.com/index/list?cname=%E6%97%B6%E5%B0%9A&cid=963a9c98ca184610c2a3054749eec76f',
    // 'http://h5.btime.com/index/list?cname=%E5%81%A5%E5%BA%B7&cid=6732ac35350bcbbc2a8dda02a08a98dd', // 健康
    // 'http://h5.btime.com/index/list?cname=%E7%BE%8E%E9%A3%9F&cid=711eb84d9b95d66b86cd397eaba55d12', // 美食
    'https://h5.btime.com/index/list?cname=%E6%98%9F%E5%BA%A7&cid=14c4c9d4cc9cac1af79926a5fd5bd85f',
    'https://h5.btime.com/index/list?cname=%E6%88%BF%E4%BA%A7&cid=92db0f7330c8f3b412c048a65e6d6f66',
    'https://h5.btime.com/index/list?cname=%E6%97%85%E6%B8%B8&cid=74b8334b484cbcb5d07e0ba82833e51d&offset=0',
    'https://h5.btime.com/index/list?cname=%E8%B6%B3%E7%90%83&cid=7409440d13cc5d06b272cfb53e06059e&offset=0',
    'https://h5.btime.com/index/list?cname=%E6%B1%BD%E8%BD%A6&cid=f5fc97507007cf44a70d940311b952d2&offset=0',

    // 'http://h5.btime.com/index/list?cname=%E6%83%85%E6%84%9F&cid=8199cf9f2aa82c7ab093eda868cb32bb', // 情感
    // 'http://h5.btime.com/index/list?cname=%E6%96%87%E5%8C%96&cid=b513112bbf4fae3127e405d4ec73d466', // 文化

);

foreach ($arr as $item) {
    $json = file_get_contents($item);
    // echo $json;die;
    $data = json_decode($json, true);

    // print_r($data);die;
    if (empty($data)) {
        continue;
    }
    foreach ($data['data'] as $row) {

        // print_r($row);die;
        if (empty($row['m_url'])) {
            continue;
        }

        $id = $row['gid'];
        echo $id . '<br>';

        $title = $row['data']['title'];
        echo $title . '<br>';

        $url = $row['m_url'];
        echo $url . '<br>';

        $url = 'https://h5.btime.com/item/router?gid=30av26g1k7i8dsogilg9aslbe8a';
        $html = file_get_contents($url);

        if (preg_match('/window\.detailData =([\s\S]*?)window\.wxSign/', $html, $ma)) {
            $res = trim($ma[1]);
            $res = trim($res, ';');
            $res = json_decode($res, true);
        } else {
            continue;
        }
        print_r($res);
        // die;

        $content = '';
        if ($res) {
            foreach($res['content'] as $r) {
                if ($r['type'] == 'video') {
                    $content = '';
                    break;
                }
                if ($r['type'] == 'img') {
                    $content .= '<div><img src ="' . $r['value'] . '"></div>';
                }
                if ($r['type'] == 'txt' || $r['type'] == 'html') {
                    // 过滤关键字

                    if ($r['value'] == strip_tags($r['value'])) {
                        $content .= '<p>' .strip_tags($r['value']) . '</p>';
                    } else {
                        $content .= $r['value'];
                    }
                }
            }
        }

        // if (strlt100($content)) {
        //     continue;
        // }


        // echo $content . '<br>';die;
    }
    die;
}