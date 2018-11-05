<?php
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';


// $doc = phpQuery::newDocumentFile('http://h5.btime.com/index/list?cname=%E6%96%B0%E9%97%BB&cid=7389193781085e10178780f6bbb3c79e');
// $dom = $doc->find('script')->text();
// echo $dom;die;
function has_keyword($str, $words) {
    if (is_string($words)) {
        if (mb_stripos($str, $words) !== false ) {
            return $words;
        }
    } else {
        foreach ($words as $w) {
            if (mb_stripos($str, $w) !== false ) {
                return $w;
            }
        }
    }
}

set_time_limit(0);

$arr = array(
    array('url' => 'http://h5.btime.com/index/list?cname=%E6%96%B0%E9%97%BB&cid=7389193781085e10178780f6bbb3c79e', 'clips' => 'author'), // 新闻
    // array('url' => 'http://h5.btime.com/index/list?cname=%E8%B4%A2%E7%BB%8F&cid=5669459fffd471c7adb81621ccc652f2', 'clips' => 'author'), // 财经
    // array('url' => 'http://h5.btime.com/index/list?cname=%E7%94%9F%E6%B4%BB&cid=4e9715a3087a5cf063107c9132be55f5', 'clips' => 'author'), // 生活
    // array('url' => 'http://h5.btime.com/index/list?cname=%E7%BE%8E%E9%A3%9F&cid=711eb84d9b95d66b86cd397eaba55d12', 'clips' => 'author'), // 美食
    // array('url' => 'http://h5.btime.com/index/list?cname=%E6%96%87%E5%8C%96&cid=b513112bbf4fae3127e405d4ec73d466', 'clips' => 'author'), // 文化

    // array('url' => 'http://h5.btime.com/index/list?cname=%E5%81%A5%E5%BA%B7&cid=6732ac35350bcbbc2a8dda02a08a98dd', 'clips' => 'keyword'), // 健康
    // array('url' => 'http://h5.btime.com/index/list?cname=%E6%83%85%E6%84%9F&cid=8199cf9f2aa82c7ab093eda868cb32bb', 'clips' => 'keyword'), // 情感
);

foreach ($arr as $item) {
    $json = file_get_contents($item['url']);

    $data = json_decode($json, true);

    // print_r($data);die;
    foreach ($data['data'] as $row) {

        if (empty($row['m_url'])) {
            continue;
        }
        $url = $row['m_url'];
        echo $url . '<br>';
        $id = $row['gid'];
        $title = $row['data']['title'];

        if (has_keyword($title, array('夜总会', '夜总汇'))) {
            continue;
        }
        $res = file_get_contents($url);
        // echo $res;die;

        if ($item['clips'] == 'author') {
            if(preg_match("/\"content\":([\s\S.]*?)\"author\"/", $res, $ma)) {
                $content = trim($ma[1]);
            }
        } else {
            if(preg_match("/\"content\":([\s\S.]*?)\"keywords\"/", $res, $ma)) {
                $content = trim($ma[1]);
            }
        }

        if (empty($content)) {
            continue;
        }

        $content = trim($content, ',');
        $content = json_decode($content, true);
        // print_r($content);die;

        $count = count($content);
        if ($content[$count-1]['type'] == 'img') {
            array_pop($content);
        }
        $html = '';
        foreach($content as $cn) {
            if (empty($cn['type'])) {
                continue;
            }
            if ($cn['type'] == 'img') {
                // if (! has_keyword($cn['value'], array('t010ba36ffe4f50a44c', 't01832e097e38a02921'))) {
                //     $html .= '<div><img src ="' . $cn['value'] . '"></div>';
                // }
                $html .= '<div><img src ="' . $cn['value'] . '"></div>';
            } else {
                if (! has_keyword($cn['value'], array('北京时间', '北京时间出品', '扫小编微信', '传送门>>', '夜总汇'))) {
                    $html .= $cn['value'];
                }
            }
        }
        // if (has_keyword($html, array('夜总会', '夜总汇'))) {
        //     continue;
        // }
        // $html = img_url_local($html);
        echo $html . '<br>';die;
    }
}


function get_curl_content($url) {
    $curl = curl_init();
    $setopt = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
            "Accept-Encoding: gzip, deflate, br",
            "Accept-Language: zh-CN,zh;q=0.9",
            "Cache-Control: max-age=0",
            "Connection: keep-alive",
            "cookie: __guid=58b4621f-de12-457f-a2cf-548a41721cf4; __DC_sid=196757375.3219726103860115500.1541382750217.933; usid=033023127718467d6107813d5ff40761; test_cookie_enable=null; monitor_count=15; __DC_monitor_count=16; z_api_request_time=0.31228518486023; __DC_gid=196757375.555874027.1541382031473.1541384063909.53",
            "Host: item.btime.com",
            "Referer: https://4g.dahe.cn/index/",
            "If-Modified-Since: Mon, 05 Nov 2018 02:13:18 GMT",
            "Upgrade-Insecure-Requests: 1",
            "User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Mobile Safari/537.36",
        ),
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
    );
    curl_setopt_array($curl, $setopt);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}