<?php
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';

// header("Content-type: text/html; charset=GB2312");

for ($i = 1; $i <= 20; $i++) {

    $json = file_get_contents('http://qc.wa.news.cn/nodeart/list?nid=11146700&pgnum='.$i.'&cnt=12&attr=63&tp=1&orderby=1&mulatt=1');
    $json = ltrim($json, '(');
    $json = rtrim($json, ')');

    $data = json_decode($json, true);

    // print_r($data);die;
    foreach($data['data']['list'] as $d) {
        $id = 'xh_' . $d['DocID'];
        $title = $d['SubTitle'];
        echo $id . "<br>";
        // echo $title . "<br>";
        $html = phpQuery::newDocumentFile($d['LinkUrl']);
        $re = $html->find('div[id="p-detail"]');
        $re->find('.standard_lb')->remove();
        $re->find('.video-url')->remove();
        $re->find('.zan-wap')->remove();
        $re->find('.p-tags')->remove();
        $re->find('img')->remove();
        $re->find('div[id="div_currpage"]')->remove();
        $content = '';
        if (!empty($d['allPics'][0])) {
            $content .= '<p><img src="'.$d['allPics'][0].'"></p>';
        }
        $content .= $re->contents();
        $content = img_url_local($content);
        // echo $content;
    }
}
