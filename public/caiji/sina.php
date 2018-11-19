<?php
/**
 * Created by PhpStorm.
 * User: wq455
 * Date: 2018/10/28
 * Time: 23:48
 */

require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';

header("Content-type: text/html; charset=utf-8");
set_time_limit(0);

$urls = array(
    // 'https://cre.dp.sina.cn/api/v3/get?cateid=1o&cre=tianyi&mod=wnews&merge=3&statics=1&length=20', //xinwen article
    // 'https://cre.dp.sina.cn/api/v3/get?cateid=2L&cre=tianyi&mod=wspt&merge=3&statics=1', // tiyu aribody
    // 'https://cre.dp.sina.cn/api/v3/get?cateid=1Q&cre=tianyi&mod=went&merge=3&statics=1&length=20', // yule artibody
    // 'https://cre.dp.sina.cn/api/v3/get?cateid=1z&cre=tianyi&mod=wtech&merge=3&statics=1', // keji artibody
    // 'https://cre.dp.sina.cn/api/v3/get?cateid=I&cre=tianyi&mod=wedu&merge=3&statics=1&length=20', // jiaoyu artibody
    // 'https://cre.dp.sina.cn/api/v3/get?cateid=l&cre=tianyi&mod=wxz&merge=3&statics=1&length=20', // 星座 artibody
    'https://cre.dp.sina.cn/api/v3/get?cateid=2i&cre=tianyi&mod=wladies&merge=3&statics=1', // nv xing  artibody
    'https://cre.dp.sina.cn/api/v3/get?cateid=2m&cre=tianyi&mod=whealth&merge=3&statics=1&length=20', // jiankang artibody
    // 'https://interface.sina.cn/wap_api/layout_col.d.json?showcid=12635&col=12658&level=1%2C2%2C3', // qinggan  区别
    // 'https://interface.sina.cn/wap_api/layout_col.d.json?showcid=74401&col=72340%2C205144&level=1%2C2%2C3&show_num=30', // nba

);

foreach ($urls as $url) {
    $data = file_get_contents($url);
    $arr = json_decode($data, true);

    // print_r($arr);die;
    foreach ($arr['data'] as $k => $row) {
        if (!empty($row['contentTag']) && $row['contentTag'] == '专题') {
            continue;
        }
        if (!empty($row['video_url'])) {
            continue;
        }
        if (empty($row['f_docid'])) {
            continue;
        }

        if ($ss = strstr($row['f_docid'], ':')) {
            $id = 'sina'. $ss;
        } else {
            $id = 'sina'. $row['f_docid'];
        }

        echo $k . "<br>";
        echo $id . "<br>";
        $title = $row['title'];
        echo $title . "<br>";
        $url = $row['url'];
        echo $url . "<br>";
        $doc = phpQuery::newDocumentFileHTML($url);
        // echo $doc . "<br>";
        $content = $doc->find("div[id='artibody']");
        $content->find('div[id="article-bottom"]')->remove();
        $content->find('div[class="blk-zcapp clearfix"]')->remove();
        $content->find('div[class="blk-wxfollow clearfix"]')->remove();
        $content->find('div[id="wrap_bottom_omment"]')->remove();
        $content->find('div[id="tab_related"]')->remove();
        $content->find('div[class="astro-center"]')->remove();
        $content->find('div[class="content-page"]')->remove();

        $content->find("p:contains('点击')")->remove();
        $content = $content->html();

        $content = filter_section($content, array('原标题', '原题为', '声明'));
        $content = preg_replace('/<!--[\s\S]*?-->/', '', $content);
        $content = img_url_local($content);
        // if (mb_strlen(strip_tags($content)) < 100) {
        //     continue;
        // }
        echo $content . "<br>";

    }
    die;
}

$url = "https://interface.sina.cn/wap_api/layout_col.d.json?showcid=12635&col=12658&level=1%2C2%2C3";
$data = file_get_contents($url);
$arr = json_decode($data, true);

foreach ($arr['result']['data']['list'] as $art) {
    $url = $art['pc_url'];
    $content = file_get_contents($url);
    $doc = phpQuery::newDocumentHTML($content);
    $content = pq("div[id='artibody']")->html();
    $content = preg_replace('/<script[\s\S]*?>[\s\S]*?<\/script>/', '', $content);

    $content = preg_replace('/<a onmouseover[\s\S]*?<\/a>/', '', $content);
}


// 备份
// function sina($res) {
/*    $pertten = "/(<img class=\"sharePic hide\"[\s\S]*?>)([\s\S]*?)(<figure class=\"art_img_mini j_p_gallery\"[\s\S]*?>[\s\S]*?<\/figure>)([\s\S]*?)<p class=\"art_p\">.*?<a onmouseover[\s\S]*?>/";*/
//     if (preg_match_all($pertten, $res, $c)) {
//
/*        /*$img = preg_replace("/(<img[\s\S]*?src=\")([\s\S]*?)(\"[\s\S]*?>)/", '${1}http:${2}${3}', $c[1][0]);*/
//         // $content = "<div>".$c[2][0].$img.$c[4][0]."</div>";
//         $content = "<div>" . $c[2][0] . $c[1][0] . $c[4][0] . "</div>";
/*        $content = preg_replace("/<figure class=\"art_img_mini j_p_gallery\"[\s\S]*?>[\s\S]*?<\/figure>/", '', $content);*/
//         $content = str_replace("src=\"//", "src=\"http://", $content);
//         // $content = $this->img_location($content);
//         $content = $this->img_replace($content);
//
//         // echo $title . "<br>";
//         // echo $content . "<br>";
//         // die;
//         //插入数据库
//         // $this->addNews("手机新浪", $url, "情感", $title, $content, 1, $id);
//
//     }
// }