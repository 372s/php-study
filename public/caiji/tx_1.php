<?php
/**
 * 腾讯网
 */
require_once dirname(__FILE__) . '/helpers.php';

$arrJson = array(
    'https://openapi.inews.qq.com/getQQNewsIndexAndItems?chlid=news_news_bj&refer=mobilewwwqqcom&srcfrom=newsapp&otype=json', // 北京
    'https://openapi.inews.qq.com/getQQNewsIndexAndItems?chlid=news_news_19&refer=mobilewwwqqcom&srcfrom=newsapp&otype=json', // 新时代
    'https://openapi.inews.qq.com/getQQNewsIndexAndItems?chlid=news_news_football&refer=mobilewwwqqcom&srcfrom=newsapp&otype=json', //足球
    'https://openapi.inews.qq.com/getQQNewsIndexAndItems?chlid=news_news_world&refer=mobilewwwqqcom&srcfrom=newsapp&otype=json', // 国际
    'https://openapi.inews.qq.com/getQQNewsIndexAndItems?chlid=news_news_cba&refer=mobilewwwqqcom&srcfrom=newsapp&otype=json', // CBA
    'https://openapi.inews.qq.com/getQQNewsIndexAndItems?chlid=news_news_twentyf&refer=mobilewwwqqcom&srcfrom=newsapp&otype=json', // 24小时
    'https://openapi.inews.qq.com/getQQNewsIndexAndItems?chlid=news_news_nba&refer=mobilewwwqqcom&srcfrom=newsapp&otype=json', // NBA
);

foreach ($arrJson as $url) {
    // echo $url . "<br>";
    $file = file_get_contents($url);
    $arr = json_decode($file, true);
    $ids = $arr['idlist'][0]['ids'];
    foreach ($ids as $row) {

        if (!empty($row['id'])) {
            $app_id = $row['id'];
            $id = 'tx_'.$app_id;
        } else {
            continue;
        }

        $doc = file_get_contents('https://openapi.inews.qq.com/getQQNewsNormalContent?id='.$app_id.'&chlid=news_rss&refer=mobilewwwqqcom&otype=json&ext_data=all&srcfrom=newsapp');
        $arr_doc = json_decode($doc, true);
        // print_r($arr_doc);die;

        $title = $arr_doc['title'];
        $url = $arr_doc['url'];
        $content = '';
        foreach ($arr_doc['ext_data']['content'] as $r) {
            // 图片
            if ($r['type'] == 'img_url') {
                $content .= '<p><img src="' . $r['img_url_wifi'] . '"></p>';
            }
            if ($r['type'] == 'cnt_article') {
                $content .= '<p>'.$r['desc'].'</p>';
            }
        }

        if (! trim($content)) {
            continue;
        }
        $content = img_url_local($content);

        echo $id . "<br>" ;
        echo $title . "<br>" ;
        echo $content . "<br>" ;
        die;
    }
}