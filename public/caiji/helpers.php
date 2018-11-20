<?php

header("Content-type: text/html; charset=utf-8");
set_time_limit(0);

function setHttp($url) {
    if (strpos($url, 'http') === false) {
        $url = 'http://'.$url;
    }
    return $url;
}

function has_keyword($str, $words) {
    if (is_string($words)) {
        if (mb_stripos($str, $words) !== false ) {
            return $words;
        }
    } else {
        foreach ($words as $w) {
            if (mb_stripos($str, $w) !== false ) {
                return $w;
            }
        }
    }
}


function create_img_array ($content) {
    $arrimg = array();

    $doc = new DOMDocument();
    @$doc->loadHTML($content);
    $xpath = new DOMXPath($doc);
    $result = $xpath->query("//img");

    // print_r($result);
    if (!empty($result)) {
        $img_num = 0;
        foreach ($result as $value) {
            $img_num ++;
            if ($img_num >= 3) {
                break;
            }
            $imgsrc = $value->getAttribute('src');
            // echo $imgsrc;
            if ($imgsrc) {
                array_push($arrimg, $imgsrc);
            }
        }

        // echo $img_num;
    }

    return $arrimg;
}
function img_url_local($content, $flag = '')
{
    $doc = new DOMDocument('1.0', 'utf-8');
    @$doc->loadHTML($content);
    $xpath = new DOMXPath($doc);
    $result = $xpath->query("//img");
    // print_r( $result);
    foreach ($result as $value) {
        $imgsrc = $value->getAttribute('src');
        // echo $imgsrc;

        if (strpos($imgsrc, '//') === 0) {
            $himgsrc = 'http:'.$imgsrc;
        } else if (strpos($imgsrc, 'http') === false) {
            $himgsrc = 'http://'.$imgsrc;
        } else {
            $himgsrc = $imgsrc;
        }

        if ($flag == 'qu') {
            if (strpos($imgsrc, '?') === false) {
                $himgsrc = $imgsrc . '?imageView2/2/w/750/q/80/format/jpeg';
            }
        }
        echo $himgsrc . "<br>";

        $lj = dirname(__DIR__) . '/uploads/'  . date('ymd') . '/';
        $xinarc = create_img($himgsrc, $lj);
        $xinarc = str_replace(dirname(__DIR__), "http://php-study.test", $xinarc);
        $content = str_replace($imgsrc, $xinarc, $content);
    }
    return $content;
}

function create_img($img_src, $img_path)
{

    list($width, $height, $type) = getimagesize($img_src);
    $imgdst = md5($img_src);

    $new_width = $width;
    $new_height = $height;

    if (!is_dir($img_path)) {
        if (!mkdir($img_path, 0777, true)) {
            return false;
        }
    }

    $imgdst = $img_path . $imgdst;
    switch ($type) {

        case 1:
            $image_wp = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromgif($img_src);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst . '.gif', 75);
            imagedestroy($image_wp);
            return $imgdst . '.gif';
            break;

        case 2:
            $image_wp = imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($img_src);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst . '.jpg', 75);
            imagedestroy($image_wp);
            return $imgdst . '.jpg';
            break;

        case 3:
            $image_wp = imagecreatetruecolor($new_width, $new_height);
            imagealphablending($image_wp, false);
            imagesavealpha($image_wp, true);
            $image = imagecreatefrompng($img_src);
            imagesavealpha($image, true);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagepng($image_wp, $imgdst . '.png');
            imagedestroy($image_wp);
            return $imgdst . '.png';
            break;
    }

}

// 过滤段落
function filter_section($content, $contains = array()) {

    $content = strtr($content, array('div' => 'p'));
    // $content->find('div[id="article-bottom"]')->remove();
    // $content->find('div[class="blk-zcapp clearfix"]')->remove();
    // $content->find('div[class="blk-wxfollow clearfix"]')->remove();
    // $content->find('div[id="wrap_bottom_omment"]')->remove();
    // $content->find('div[id="tab_related"]')->remove();
    // $content->find('div[class="astro-center"]')->remove();
    // $content->find('div[class="content-page"]')->remove();
    // 过滤方法
    $content = phpQuery::newDocumentHTML($content);
    $content->find('script')->remove();
    $content->find('video')->remove();

    $content->find('p[id="article-bottom"]')->remove();
    $content->find('p[class="blk-zcapp clearfix"]')->remove();
    $content->find('p[class="blk-wxfollow clearfix"]')->remove();
    $content->find('p[id="wrap_bottom_omment"]')->remove();
    $content->find('p[id="tab_related"]')->remove();
    $content->find('p[class="astro-center"]')->remove();
    $content->find('p[class="content-page"]')->remove();

    $patterns = array(
        "转载",
        "不得转载",
        "编辑",
        "责任编辑",
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
    $patterns = array_merge($patterns, $contains);
    foreach ($patterns as $pa) {
        $content->find("p:contains('".$pa."')")->remove();
        $content->find("div:contains('".$pa."')")->remove();
    }
    $content->find('a')->attr('href', 'javascript:(void);')
        ->attr('target', '_self');
    $content = $content->html();

    // $replaces = array(
    //     'strong'
    // );
    // $replaces = array_merge($replaces, $replace_white);
    // $content = str_replace($replaces, 'span', $content);
    // $content = str_replace('<strong>', '', $content);
    // $content = str_replace('</strong>', '', $content);
    return trim($content);
}

function filter_tags () {

}

function get_images($content) {
    $arrimg = array();
    $litpic = '';
    $doc = new DOMDocument('1.1', 'utf8');
    $doc->loadHTML($content);
    $xpath = new DOMXPath($doc);
    $result = $xpath->query("//img");

    // print_r($result);die;
    if (!empty($result)) {
        $img_num = 0;
        foreach ($result as $value) {
            if ($img_num >= 3) {
                break;
            }
            $imgsrc = $value->getAttribute('src');
            if ($imgsrc) {
                $arrimg[]['url'] = $imgsrc;
                if ($img_num == 0) {
                    $litpic = $imgsrc;
                }
            }
            $img_num ++;
        }
        echo $img_num;
    }
    return $arrimg;
}