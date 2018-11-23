<?php
/**
 * http://47.244.140.215:8091/feeds/toutiao?pageNo=1&num=20
 */
require_once dirname(__FILE__) . '/helpers.php';

// echo preg_replace('/<div[\s\S]*?style=\"display:none\"[\s\S]*?<\/div>/', '', $str);
// die;

$arr = range(1, 20);
foreach ($arr as $v) {
    $url = 'http://47.244.140.215:8091/feeds/toutiao?pageNo='.$v.'&num=20';

    $json = file_get_contents($url);

    $data = json_decode($json, true);

    // print_r($data);die;

    foreach ($data['articles'] as $value) {
        $id = $value['newsId'];
        $title = $value['title'];
        $url = $value['real_url'];

        // $html = file_get_contents($url);

        $html = phpQuery::newDocumentFile($url);
        $content = $html->find('div[class="article-content"]')->html();
        $content = str_replace('alt_src', 'src', $content);
        $content = preg_replace('/<script[\s\S]*?<\/script>/', '', $content);
        $content = preg_replace('/<div[\s\S]*?style=\"display:none\"[\s\S]*?<\/div>/', '', $content);
        $content = img_url_local($content);
        echo $content . "<br>";
        $content = $value['content'];
        $cate = $value['category'];
    }
}
