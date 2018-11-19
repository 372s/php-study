<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/10/16
 * Time: 16:48
 */
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';
require_once 'ydzx_curl.php';


set_time_limit(0);
$content = curl_get_content('http://www.yidianzixun.com/home/q/news_list_for_channel?channel_id=best&cstart=0&cend=10&infinite=true&refresh=1&__from__=wap&docids=0KJCWV23%2C0KIh4jyU%2C0KIXYQGS%2CV_01wylP3P%2C0KJGp5WD&_spt=yz~eaodhoy~%3A%3B%3A&appid=web_yidian&_=1540052655146');
$res = json_decode($content, true);
// print_r($res);die;

foreach ($res['result'] as $value) {
    if (empty($value['docid'])) {
        continue;
    }

    $id = 'ydzx_'. $value['docid'];
    echo $id . '<br>';
    $title = $value['title'];
    // $word_titles = array('佛教', '聚餐', '钥匙');
    // if (filter($title, $word_titles)) continue;

    $url = 'http://www.yidianzixun.com/article/' . $value['docid'];
    // $content = curl_get_content($url);
    $doc = phpQuery::newDocumentFileHTML($url);
    $title = $doc->find('.left-wrapper h2')->contents();
    echo $title . '<br>';
    // echo $doc;die;
    // $content = $doc->find('#imedia-article')->html();
    $content = $doc->find('.content-bd')->html();


    // 过滤方法
    $content = phpQuery::newDocumentHTML($content);
    $content->find('script')->remove();
    $content->find('video')->remove();
    $content->find("p:contains('原标题：')")->remove();
    $content->find("p:contains('不得转载')")->remove();
    $content->find("p:contains('责任编辑')")->remove();
    $content->find('a')->attr('href', 'javascript:(void);');
    $content = $content->html();


    $content = img_url_local($content, 'yidian');

    $arr = create_img_array($content);
    // echo $content . "<br>";
    print_r($arr);
    echo "<br>";
    // die;
}
