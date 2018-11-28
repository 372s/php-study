<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/11/23
 * Time: 13:27
 */
require_once dirname(__FILE__) . '/helpers.php';

header("Content-type: text/html; charset=utf-8");
set_time_limit(0);

$arr = array(
    'https://cre.dp.sina.cn/api/v3/get?cateid=1o&cre=tianyi&mod=wnews&merge=3&statics=1&length=20', //xinwen
    'https://cre.dp.sina.cn/api/v3/get?cateid=2L&cre=tianyi&mod=wspt&merge=3&statics=1', // tiyu
    'https://cre.dp.sina.cn/api/v3/get?callback=jQuery21409115093452749052_1542955267854&cateid=y&cre=tianyi&mod=wfin&merge=3&statics=1&impress_id=%2C&action=0&up=0&down=0',// caijing
    'https://cre.dp.sina.cn/api/v3/get?cateid=1Q&cre=tianyi&mod=went&merge=3&statics=1&length=20', // yule
    'http://cre.dp.sina.cn/api/v3/get?cateid=m&mod=wauto&cre=tianyi&merge=3&statics=1', // qiche
    'https://cre.dp.sina.cn/api/v3/get?cateid=1z&cre=tianyi&mod=wtech&merge=3&statics=1', // keji
    'https://cre.dp.sina.cn/api/v3/get?cateid=I&cre=tianyi&mod=wedu&merge=3&statics=1&length=20', // jiaoyu
    'https://cre.dp.sina.cn/api/v3/get?cateid=l&cre=tianyi&mod=wxz&merge=3&statics=1&length=20', // 星座
    'https://cre.dp.sina.cn/api/v3/get?cateid=2i&cre=tianyi&mod=wladies&merge=3&statics=1', // nv xing
    'https://cre.dp.sina.cn/api/v3/get?cateid=2m&cre=tianyi&mod=whealth&merge=3&statics=1&length=20', // jiankang
);

foreach ($arr as $u) {
    $data = file_get_contents($u);
    $data = json_decode($data, true);

    // print_r($data);die;

    foreach ($data['data'] as $row ) {
        // print_r($row);
        if (!empty($row['docid'])) {
            $id = 'sina:'. $row['docid'];
        } else if (!empty($row['f_docid'])) {
            if ($ss = strstr($row['f_docid'], ':')) {
                $id = 'sina'. $ss;
            } else {
                $id = 'sina'. $row['f_docid'];
            }
        } else {
            continue;
        }

        if (!empty($row['video_id'])) {
            continue;
        }
        echo $id . "<br>";

        $title = $row['title'];

        $url = $row['url'];
        echo $url . "<br>";

        $doc = \phpQuery::newDocumentFileHTML($url);
        $content = $doc->find("div[class='article']");

        if (! trim($content->html())) {
            $content = $doc->find('div[id="artibody"]');
        }

        $content->find('.wap_special')->remove();
        $content->find('.content-page')->remove();
        $content->find('.astro-center')->remove();
        $content->find('.show_statement')->remove();
        $content = $content->html();
        $content = format($content);
        $content = phpquery($content, array('特别声明：', '独家声明：', '敬请关注', '声明：', '来源：'));
        if (mb_strlen(strip_tags($content)) < 100) {
            continue;
        }
        echo $content . "<br>";
        die;

        // $doc = file_get_contents($url);
        // if (preg_match('/class="article"[\s\S]*?id=("|\')article-bottom("|\')/i', $doc, $matches)) {
        //     $content = $matches[0];
        //     $content = preg_replace('/<script[\s\S]*?<\/script>/', '', $content);
        //     $content = preg_replace('/<!--[\s\S]*?-->/', '', $content);
        //     $content = preg_replace('/\s{6,}/', '', $content);
        //     echo '<div ' . $content . '>';
        //     echo  "<br>";die;
        // } else {
        //     echo '======== continue ========='."<br>";
        //     continue;
        // }
        // echo $content;die;
    }
    // die;
}