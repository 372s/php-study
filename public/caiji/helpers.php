<?php
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';

// header("Content-type: text/html; charset=utf-8");
set_time_limit(0);


/**
 * 处理URL
 * @param string $url
 * @return string
 */
function setHttp($url) {
    if (strpos($url, 'http') === false) {
        $url = 'http://'.$url;
    }
    return $url;
}

/**
 * 检查关键字
 * @param string $str
 * @param array $words
 * @return bool
 */
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

/**
 * 获取文章中三张以内图片
 * @param string $content
 * @return array
 */
function img_array ($content) {
    $arrimg = array();
    $doc = new DOMDocument();
    @$doc->loadHTML($content);
    $xpath = new DOMXPath($doc);
    $result = $xpath->query("//img");

    // print_r($result);
    if (!empty($result)) {
        $img_num = 0;
        foreach ($result as $value) {
            if ($img_num >= 3) {
                break;
            }
            $imgsrc = $value->getAttribute('src');
            // echo $imgsrc;
            if ($imgsrc) {
                array_push($arrimg, $imgsrc);
            }
            $img_num ++;
        }
    }

    return $arrimg;
}

/**
 * 生成的图片存为本地
 * @param string $content
 * @param string $flag
 * @return string
 */
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
        // echo $himgsrc . "<br>";

        $lj = dirname(__DIR__) . '/uploads/'  . date('ymd') . '/';
        $xinarc = create_img($himgsrc, $lj);
        $xinarc = str_replace(dirname(__DIR__), "http://php-study.test", $xinarc);
        $content = str_replace($imgsrc, $xinarc, $content);
    }
    return $content;
}


/**
 * 生成图片
 * @param string $img_src
 * @param array $img_path
 * @return string
 */
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

/**
 * 过滤段落
 * @param string $content
 * @param array $contains 要过滤的文字
 * @return string
 */
function filter_section($content, $contains = array()) {

    $content = strtr($content, array('div' => 'p'));

    // 过滤方法
    $content = \phpQuery::newDocumentHTML($content);

    $content->find('p[id="article-bottom"]')->remove();
    $content->find('script')->remove();
    $content->find('video')->remove();

    $patterns = array(
        "转载", "不得转载",
        "编辑", "责任编辑",
        "公众号", "一点号", "微信号", "蓝字", "头条号", "微信平台",
        "原文链接", "本文", "来源", "作者", "本文来源",
        "搜狐知道",
        "关注我", "加威信", "加微心", "关注我们",
        "新浪女性", "心理公开课",
        "电话", 'qq', 'QQ',
    );
    $patterns = array_merge($patterns, $contains);
    foreach ($patterns as $pa) {
        $content->find("p:contains('".$pa."')")->remove();
    }
    $content->find('a')->attr('href', 'javascript:(void);')->removeAttr('target'); //attr('target', '_self');
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


/**
 * 获取文章中三张以内图片
 * @param string $content
 * @return array
 */
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


/**
 * 简化图片属性
 * @param string $content
 * @return string
 */
function simpleImg($content) {
    return preg_replace('/<img[\s\S]*?src/', '<img src', $content);
}

/**
 * 检查是否有图片
 * phpQuery
 * @param string $content
 * @return string
 */
function check_img($content) {
    // 检查是否有图片
    $content = \phpQuery::newDocumentHTML($content);
    // $content = $content->find('img')->remove();
    $res = $content->find('img');
    $data = $res->elements;
    // foreach ($data as $row) {
    //     echo pq($row)->attr('src');
    // }
    // print_r($res->elements);die;
    return empty($data) ? false : true;
}


/**
 * 格式化标签
 * phpQuery
 * @param string $content
 * @return string
 */
function format_tags($content) {



    $content = str_replace(array("\r", "\n", "\t"), '', $content);
    $content = stripslashes($content);

    $content = str_replace("        ", " ", $content);
    $content = str_replace(array("<strong>", "</strong>"), "", $content);

    $content = preg_replace('/<div[\s\S]*?style=\"display:none\"[\s\S]*?<\/div>/', '', $content);
    $content = preg_replace('/<!--[\s\S]*?-->/', '', $content);

    $content = preg_replace('/href="[\s\S]*?"/', 'href="javascript:(void);"', $content);
    $content = preg_replace('/(<img)[\s\S]*?(src="[\s\S]*?")[\s\S]*?(>)/', '$1 $2$3', $content);

    $content = preg_replace('/(<\/?)h\d{1}[\s\S]*?(>)/i', '$1p$2', $content);

    $content = str_replace('div', 'p', $content);
    $content = preg_replace('/(<p)[\s\S]*?(>)/', '$1$2', $content);
    $content = preg_replace('/<p>[\s]*?<\/p>/', '', $content);
    $content = preg_replace('/<p>[\s]*?<br>[\s]*?<\/p>/', '', $content);
    $content = preg_replace('/(<p>)\s*?<p>/', '$1', $content);
    $content = preg_replace('/(<\/p>)\s*?<\/p>/', '$1', $content);

    $content = preg_replace('/<script[\s\S]*?<\/script>/', '', $content);

    $patterns = array(
        "转载", '不得转载',
        "编辑", '责任编辑',
        "来源", "本文来源",
        "公众号", "一点号", "微信号", "头条号", "微信平台", "蓝字",
        "加威信", "加微心", "电话", "关注我们", "关注我",
        "原文链接", "作者", "author",
        "搜狐知道", "新浪女性",
    );
    $content = \phpQuery::newDocumentHTML($content);
    foreach ($patterns as $p) {
        $content->find('p:contains("' . $p . '")')->remove();
    }
    $content = trim($content->html());
    return $content;
}