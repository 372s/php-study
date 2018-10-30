<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/10/29
 * Time: 15:53
 */

require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';

set_time_limit(0);
header("Content-type: text/html; charset=GBK2312");
// $html = curl_get('http://edu.zynews.cn/e/wap/show.php?classid=10&id=26865', true);
// echo $html;die;
//
// function curl_get($url, $gzip=false){
//     $curl = curl_init($url);
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
//
//     if($gzip) {
//         // 关键在这里
//         curl_setopt($curl, CURLOPT_ENCODING, "gzip");
//     }
//     $content = curl_exec($curl);
//     curl_close($curl);
//     return $content;
//
// }

$urls = array(
    // 'http://jk.zynews.cn/e/wap/',// 健康
    // 'http://lvyou.zynews.cn/e/wap/',// 旅游
    'http://edu.zynews.cn/e/wap/',// 教育
    // 'http://house.zynews.cn/e/wap/',// 房产
);

foreach ($urls as $url) {
    $html = file_get_contents($url);
    $dom = phpQuery::newDocumentHTML($html);
    $href = $dom->find('h3[class="image-margin-right"] > a');
    // print_r($href);die;

    foreach ($href as $h) {
        $h = pq($h)->attr('href');


        $arr = parse_url($h,PHP_URL_QUERY);
        parse_str($arr, $output);

        $id = 'zy_' . $output['classid'] . '_' . $output['id'];
        echo $id . "<br>";

        $content = file_get_contents($url . $h);

        // if (preg_match('/<article class=\"article\">([\s\S]*?)<\/article>/', $content, $matches)) {
        //     $content = $matches[1];
        // } else {
        //     continue;
        // }
        //
        // if (preg_match('/<header class=\"articleHeader\">([\s\S]*?)<\/header>/', $content, $title)) {
        //     $title = $title[1];
        // } else {
        //     continue;
        // }
        $doc = phpQuery::newDocumentHTML($content);
        $title = $doc->find('header[class="articleHeader"]')->children('h1')->contents();

        echo $title . "<br>";
        // $title = mb_convert_encoding($title, "GB2312", 'UTF-8');

        // echo mb_detect_encoding($title). "<br>";

        // $content = $doc->find('div[id="text"]')->contents();
        // $img_src = $doc->find('img');
        //
        // $host = 'http://' . parse_url($url, PHP_URL_HOST);
        // foreach ($img_src as $img) {
        //     $img = pq($img)->attr('src');
        //     if (strpos($img, 'http') === false) {
        //         $content = str_replace($img, $host . $img, $content);
        //     }
        // }
        // $content = img_url_local($content);
        // echo $content . "<br>";
    }
}


function setHttp($url) {
    if (strpos($url, 'http') === false) {
        $url = 'http://'.$url;
    }
    return $url;
}


function img_url_local($content)
{
    $doc = new DOMDocument('1.0', 'utf-8');
    $doc->loadHTML($content);
    $xpath = new DOMXPath($doc);
    $result = $xpath->query("//img");
    foreach ($result as $value) {
        $imgsrc = $value->getAttribute('src');
        $lj = dirname(__DIR__) . '/uploads/'  . date('ymd', time()) . '/';
        $xinarc = caiji_img($imgsrc, $lj);
        // echo $xinarc;die;
        // $xinarc = $this->img2($xinarc);
        $xinarc = str_replace(dirname(__DIR__), "http://php-study.test", $xinarc);
        $content = str_replace($imgsrc, $xinarc, $content);
    }
    return $content;
}


function caiji_img($imgsrc, $ximgsrc)
{

    list($width, $height, $type) = getimagesize($imgsrc);
    $imgdst = md5($imgsrc);

    $new_width = $width;
    $new_height = $height;

    if (!is_dir($ximgsrc)) {
        if (!mkdir($ximgsrc, 0777, true)) {
            return false;
        }
    }

    $imgdst = $ximgsrc . $imgdst;
    switch ($type) {

        case 1:
            $image_wp = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromgif($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst . '.gif', 75);
            imagedestroy($image_wp);
            return $imgdst . '.gif';
            break;

        case 2:
            $image_wp = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst . '.jpg', 75);
            imagedestroy($image_wp);
            return $imgdst . '.jpg';
            break;

        case 3:
            $image_wp = imagecreatetruecolor($new_width, $new_height);
            imagealphablending($image_wp, false);
            imagesavealpha($image_wp, true);
            $image = imagecreatefrompng($imgsrc);
            imagesavealpha($image, true);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagepng($image_wp, $imgdst . '.png');
            imagedestroy($image_wp);
            return $imgdst . '.png';
            break;
    }

}
