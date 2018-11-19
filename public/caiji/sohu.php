<?php
/**
 *  搜狐
 */
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';


//$souhu = file_get_contents('https://v2.sohu.com/integration-api/mix/region/98');
//$json = file_get_contents('https://v2.sohu.com/integration-api/mix/region/98');
//$data = json_decode($json, true);
//print_r($data);die;

header("Content-type: text/html; charset=utf-8");
set_time_limit(0);
$urls = array(
    'https://v2.sohu.com/integration-api/mix/region/90',// xinwen
    'https://v2.sohu.com/integration-api/mix/region/92',//wenhua
    'https://v2.sohu.com/integration-api/mix/region/94',//caijing
    'https://v2.sohu.com/integration-api/mix/region/95', //shishang
    'https://v2.sohu.com/integration-api/mix/region/96',//jiaoyu
    'https://v2.sohu.com/integration-api/mix/region/98', //xingzuo
    'https://v2.sohu.com/integration-api/mix/region/99', //
    'https://v2.sohu.com/integration-api/mix/region/101',
    'https://v2.sohu.com/integration-api/mix/region/100', // lvyou
    'https://v2.sohu.com/integration-api/mix/region/104',//shenghuo
    'https://v2.sohu.com/integration-api/mix/region/113',//jiankang
);

foreach ($urls as $url) {
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    // print_r($data);die;
    // echo count($data['data']);die;

    foreach ($data['data'] as $item) {

        if (empty($item['url'])) continue;

        if (strpos($item['url'], 'http') !== false) {
            $url = $item['url'];
        } else {
            $url = 'https://m.sohu.com'. $item['url'];
        }

        $id = 'sohu_' . $item['id'];

        // $url = 'https://m.sohu.com/a/276512573_428290';
        $doc = phpQuery::newDocumentFileHTML($url);

        if (!empty($item['title'])) {
            $title = $item['title'];
        } else {
            $title = pq('h2[class="title-info"]')->contents();
        }

        $content1 = pq("div[class='display-content']")->html();
        if (!trim($content1)) {
            continue;
        }
        $content2 = pq("div[class='hidden-content hide']");
        if (trim($content2->html())) {
            $content2->find('footer')->remove();
            $content2->find('section')->remove();
            // $content2 = preg_replace('/<footer[\s\S]*?<\/footer>/', '', $content2);
            // $content2 = preg_replace('/<section[\s\S]*?<\/section>/', '', $content2);
        }

        $content = $content1 . trim($content2->html());
        $content = str_replace('data-src', 'src', $content);
        $content = filter_section($content, array('原标题', '原题为', '声明'));
        // $content = img_url_local($content, 'sohu');
        $content = img_url_local($content);
        echo $id . "<br>";
        echo $title . "<br>";
        echo $content . "<br>";
    }
    die;
}
