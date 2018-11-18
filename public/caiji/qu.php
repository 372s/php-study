<?php
/**
 * 趣头条
 */
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';


for ($i = 1; $i <= 30; $i++) {

    $url = "http://api.1sapp.com/content/outList?cid=" . $i . "&tn=1&page=1&limit=20";

    $data = file_get_contents($url);
    $arr = json_decode($data, true);

    /**插入数据库**/
    foreach ($arr['data']['data'] as $art) {

        $title = trim($art['title']);
        $id = "qu" . $art['id'];
        $url = $art['url'];

        echo $id . "<br>";
        // echo $url;

        // $url = 'http://html2.qktoutiao.com/detail/2018/11/18/138293272.html?content_id=138293272&key=4dc0lnj47Fd3P_fWUm1jtA9VWXOknjX_Z4YMRbxcEWqxTkcheyndDenpxnUDCeXXF3nWGql0euaod_Ly7KPAV_YT40CY0XLltsngNLsXQoJkodpMZxwTZx6WjfjjI-NYnUp6lA&pv_id=%7B233EAC53-EDDE-2A02-60E3-C5E732ADCB37%7D&cid=1&cat=1&rss_source=&fr=15&hj=0&mod_id=&o=1&p=1&fqc_flag=0&skip_ad=0&is_h5_content_type=0&is_origin_new=0';
        $html = phpQuery::newDocumentFileHTML($url);
        // echo $html;die;
        $content = $html->find('.content');
        $content->find('#img')->remove();
        $content->find('script')->remove();
        $pattern = array(
            "转载",
            "编辑",
            "公众号",
            "一点号",
            "微信号",
            "蓝字",
            "头条号",
            "电话",
            "关注我们",
            "原文链接",
            "本文",
            "原文链接",
            "微信平台",
            "来源",
            "作者",
            "搜狐知道",
            "关注我",
            "加威信",
            "加微心",
            "本文来源",
            "新浪女性",
            "心理公开课",
            'qq',
            'QQ',
        );
        foreach ($pattern as $pa) {
            $content->find("p:contains('".$pa."')")->remove();
        }
        $content->find('img')->removeAttr('data-size')->removeAttr('alt');
        $content->find('a')->attr('href', 'javascript:;');
        $content = $content->html();
        $content = str_ireplace('data-src', 'src', $content);

        $doc = new DOMDocument('1.0', 'utf8');
        @$doc->loadHTML($content);
        $xpath = new DOMXPath($doc);
        $result = $xpath->query("//img");

        foreach ($result as $value) {
            $imgsrc = $value->getAttribute('src');
            if (strpos($imgsrc, '?') === false) {
                $content = str_replace($imgsrc, $imgsrc.'?imageView2/2/w/750/q/80/format/jpeg', $content);
            }
        }
        echo $content . "<br>";die;
    }
}