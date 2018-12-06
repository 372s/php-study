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
    // 'http://h5.btime.com/index/list?cname=%E8%B4%A2%E7%BB%8F&cid=5669459fffd471c7adb81621ccc652f2', // 财经
    // 'http://h5.btime.com/index/list?cname=%E7%94%9F%E6%B4%BB&cid=4e9715a3087a5cf063107c9132be55f5', // 生活
    'http://h5.btime.com/index/list?cname=%E7%BE%8E%E9%A3%9F&cid=711eb84d9b95d66b86cd397eaba55d12', // 美食
    'http://h5.btime.com/index/list?cname=%E6%96%87%E5%8C%96&cid=b513112bbf4fae3127e405d4ec73d466', // 文化
    'http://h5.btime.com/index/list?cname=%E5%81%A5%E5%BA%B7&cid=6732ac35350bcbbc2a8dda02a08a98dd', // 健康
    'http://h5.btime.com/index/list?cname=%E6%83%85%E6%84%9F&cid=8199cf9f2aa82c7ab093eda868cb32bb', // 情感

    'https://h5.btime.com/index/list?cname=%E6%8E%A8%E8%8D%90&cid=2da8f707e9d514c562162540d2b0ad57&offset=0&refresh_type=1&refresh=1&count=12&last=null&is_paging=2&citycode=&_=1544092643392&callback=jsonp1', // 新时代
);

foreach ($arr as $item) {
    $json = file_get_contents($item);

    $data = json_decode($json, true);

    print_r($data);die;
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

        // $url = 'http://h5.btime.com/item/router?gid=f0actsluouk87591a9rbntlucib';
        $html = file_get_contents($url);

        if (preg_match('/window\.detailData =([\s\S]*?)window\.wxSign/', $html, $ma)) {
            $res = trim($ma[1]);
            $res = trim($res, ';');
            $res = json_decode($res, true);
        } else {
            continue;
        }
        // print_r($res);die;

        $content = '';
        if ($res) {
            foreach($res['content'] as $r) {
                if ($r['type'] == 'img') {
                    $content .= '<div><img src ="' . $r['value'] . '"></div>';
                } else if ($r['type'] == 'txt') {
                    $content .= '<p>' .strip_tags($r['value']) . '</p>';
                }
            }
        }

        echo $content . '<br>';die;
    }
}