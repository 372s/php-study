<?php
/**
 * 河南头条网
 */
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';


$urls = array(
    'http://www.zynews.cc/category/10017.html', // 新闻
    'http://www.zynews.cc/category/10018.html', // 体育
    'http://www.zynews.cc/category/10021.html', // 旅游
    'http://www.zynews.cc/category/10028.html', // 健康
);

$arr = array();
foreach ($urls as $sUrl) {
    for($i=1; $i <=3; $i++) {
        array_push($arr, $sUrl.'?p='.$i);
    }
}

$sUrl = '';
foreach ($arr as $sUrl) {
    $file = phpQuery::newDocumentFileHTML($sUrl);

    $list = $file->find('.focus');

    foreach ($list as $item) {
        $url = pq($item)->attr('href');
        echo $url . "<br>";

        $id = rtrim(ltrim(strrchr($url, '/'), '/'), '.html');
        echo 'hntt_' . $id . '<br>';

        $doc = phpQuery::newDocumentFileHTML($url);

        $title = $doc->find('.article-title a')->contents();
        echo $title . "<br>";

        $content = $doc->find('.article-content');
        $content->find('.article-tags')->remove();
        $content->find('.ads-post-footer')->remove();
        $content->find('.post-copyright')->remove();
        $content->find('.ads-post-01')->remove();
        $content->find("p:contains('文章永久链接')")->remove();
        $content->find("span:contains('返回搜狐，查看更多')")->remove();
        $content->find("p:contains('转载')")->remove();
        $content->find("p:contains('新浪声明')")->remove();
        $content->find("span:contains('免责声明')")->remove();
        $content->find("p:contains('责任编辑')")->remove();
        $content = $content->html();
        if (strlen($content) < 100) {
            continue;
        }
        echo $content . "<br>";
        echo '===========================================================' . "<br>";

    }
}
