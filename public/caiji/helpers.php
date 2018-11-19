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
    foreach ($result as $value) {
        $imgsrc = $value->getAttribute('src');
        if ($flag == 'yidian') {
            if (strpos($imgsrc, 'http') === false) {
                $himgsrc = 'http:'.$imgsrc;
            } else{
                $himgsrc = $imgsrc;
            }
        } else {
            $himgsrc = $imgsrc;
        }
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