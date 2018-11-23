<?php
/**
 * 腾讯网
 */
require_once dirname(__FILE__) . '/helpers.php';

header("Content-type: text/html; charset=utf-8");
set_time_limit(0);


$arrJson = array(
    'https://pacaio.match.qq.com/xw/topNews?num=30&expIds=20181030011842%7C20181030A1JRFI%7C20181030013477%7C20181030013641%7C20181030A1KF2X%7C20181029009942%7C20181030A1A5OQ%7C20181030A1WE3L%7C20181030A1WJCB%7C20181026A01AWP%7C20181030A0AEXV%7C20181030A1VQN3&refresh=0', // 要闻
    'https://pacaio.match.qq.com/xw/site?uid=0_9c228729fba13&ext=ent&num=20&expIds=&page=0', // 娱乐
    'https://pacaio.match.qq.com/xw/site?uid=0_9c228729fba13&ext=sports&num=20&expIds=&page=0', // 体育
    'https://pacaio.match.qq.com/irs/rcd?cid=56&ext=astro&token=c786875b8e04da17b24ea5e332745e0f&num=20&expIds=20181122A1H7SQ%7C20181123A0E2CG&page=0', // 星座
    'https://pacaio.match.qq.com/xw/site?uid=0_9c228729fba13&ext=finance&num=20&expIds=&page=0', //财经
    'https://pacaio.match.qq.com/xw/site?uid=0_6d3466ab3f225&ext=tech&num=20&expIds=&page=0', // 科技
    'https://pacaio.match.qq.com/irs/rcd?cid=56&ext=digi&token=c786875b8e04da17b24ea5e332745e0f&num=20&expIds=&page=0', // 数码
    'https://pacaio.match.qq.com/xw/site?uid=0_9c228729fba13&ext=fashion&num=20&expIds=&page=0', // 时尚
    'https://pacaio.match.qq.com/xw/site?uid=0_9c228729fba13&ext=auto&num=20&expIds=&page=0', // 汽车
    'https://pacaio.match.qq.com/irs/rcd?cid=56&ext=house&token=c786875b8e04da17b24ea5e332745e0f&num=20&expIds=20181030A0C4P3%7C20181030A1P775&page=0', // 房产
    'https://pacaio.match.qq.com/xw/site?uid=0_135d373857b4a&ext=edu&num=20&expIds=&page=0', //教育
    'https://pacaio.match.qq.com/irs/rcd?cid=56&ext=cul&token=c786875b8e04da17b24ea5e332745e0f&num=20&expIds=20181030013486%7C20181030A1U7M0&page=0', // 文化
    'https://pacaio.match.qq.com/irs/rcd?cid=56&ext=health&token=c786875b8e04da17b24ea5e332745e0f&num=20&expIds=20181030A14GU1%7C20181024A0UB44&page=0', // 健康
    'https://pacaio.match.qq.com/irs/rcd?cid=56&ext=fun&token=c786875b8e04da17b24ea5e332745e0f&num=20&expIds=&page=0', //搞笑
    'https://pacaio.match.qq.com/irs/rcd?cid=56&ext=science&token=c786875b8e04da17b24ea5e332745e0f&num=20&expIds=20181123A09KV4%7C20181123A0A47A&page=0', // 科学
    'https://pacaio.match.qq.com/irs/rcd?cid=56&ext=food&token=c786875b8e04da17b24ea5e332745e0f&num=20&expIds=20181123A09SN8%7C20181123A0KVU4&page=0', // 美食
    'https://pacaio.match.qq.com/irs/rcd?cid=56&ext=society&token=c786875b8e04da17b24ea5e332745e0f&num=20&expIds=20181122A10YE7%7C20181123A04VM9&page=0', //民生
    'https://pacaio.match.qq.com/irs/rcd?cid=144&ext=103&token=106223c3af0c63517f9e05675ca1a282&num=20&expIds=&page=0', // 综艺
);

// 新方法
foreach ($arrJson as $url) {
    $file = file_get_contents($url);

    $arr = json_decode($file, true);

    foreach ($arr['data'] as $row) {
        
        if (!empty($row['app_id'])) {
            $app_id = $row['app_id'];
            $id = 'tx_'.$app_id;
        } else {
            continue;
        }

        $doc = file_get_contents('https://openapi.inews.qq.com/getQQNewsNormalContent?id='.$app_id.'&chlid=news_rss&refer=mobilewwwqqcom&otype=json&ext_data=all&srcfrom=newsapp');
        $data = json_decode($doc, true);

        $title = $data['title'];
        $url = $data['url'];
        $content = '';
        foreach ($data['ext_data']['content'] as $r) {
            // 图片
            if ($r['type'] == 'img_url') {
                $content .= '<p><img src="' . $r['img_url_wifi'] . '"></p>';
            }
            if ($r['type'] == 'cnt_article') {
                $content .= '<p>'.$r['desc'].'</p>';
            }
        }

        echo $id . "<br>" ;
        echo $title . "<br>" ;
        // echo $content . "<br>" ;
        // die;
    }
}

die;
// 老方法
foreach ($arrJson as $url) {
    $file = file_get_contents($url);

    $arr = json_decode($file, true);

    foreach ($arr['data'] as $row) {

        if (!empty($row['app_id'])) {
            $id = $row['app_id'];
        } else {
            continue;
        }

        $url = $row['url'];
        $title = $row['title'];

        $doc = file_get_contents($url);
        // echo $doc;die;
        if(! preg_match("/contents:\s*(\[[\s\S]*?\]),\s*?ext_data/", $doc, $ma)) {
            continue;
        }
        $res = json_decode($ma[1], true);

        if (preg_match('/\"cnt_attr\":([\s\S]*?),\"cnt_html\"/', $doc, $ext)) {
            $arr_img = json_decode($ext[1], true);
        } else {
            $arr_img = array();
        }
        $content = '';
        $i = 0;
        foreach ($res as $r) {
            // 图片
            if ($r['type'] == 2 && !empty($arr_img['IMG_'.$i]['all']['img']['imgurl641']['imgurl'])) {
                $imgsrc = $arr_img['IMG_'.$i]['all']['img']['imgurl641']['imgurl'];

                $lj = dirname(__DIR__) . '/uploads/'  . date('ymd') . '/';
                $xinarc = create_img($imgsrc, $lj);
                $xinarc = str_replace(dirname(__DIR__), "http://php-study.test", $xinarc);
                $content .= '<img src="' . $xinarc . '">';
                $i++;
            }
            if ($r['type'] == 1) {
                $content .= '<p>'.$r['value'].'</p>';
            }
        }
        echo $id . "<br>" ;
        echo $title . "<br>" ;
        // echo $content . "<br>" ;
        // die;
    }
    // die;
    // break;
}