<?php
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';

$url = 'http://res.fawan.com/fawan/fawanJSON.json?_=20181154';

$res = file_get_contents($url);
$res = json_decode($res, true);
// print_r($res);die;
foreach ($res as $item) {
    $url = $item['link'];
    $doc = phpQuery::newDocumentFile($url);
    // echo $doc;die;
    $title = $doc->find('h2')->text();
    $yeshu = $doc->find('#yeshu')->text();
    if ($yeshu) {
        // continue;
        // echo $yeshu;die;
        // $yeshu = $yeshu->text();
        // $yeshu = explode('/', $yeshu);
        // print_r($yeshu);die;
        // $totle = $yeshu[1];
        //
        // $content = $doc->find('.faW_h5_pic')->html();
        // // echo $content;die;
        // for($i = 1; $i < $totle; $i ++) {
        //     if ($i > 1) {
        //         $url = str_replace('.html', '_'. $i.'.html', $url);
        //     }
        //     $doc = phpQuery::newDocumentFile($url);
        // }
        // $pic = $doc->find('.faW_h5_pic');
    } else {
        $article = $doc->find('section[class="faW_h5_detail"]');
        // echo $article;
        $article->find('h2')->remove();
        $article->find('div[class="faW_h5_infor"]')->remove();
        $content = $article->html();
        $content = strtr($content, array('src="' => 'src="http:'));
        $content = img_url_local($content);
        echo $content . "<br>";
    }


}