<?php
/**
 * 知音
 * User: wq455
 * Date: 2019/01/17
 * Time: 21:58
 */
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';
header("Content-type: text/html; charset=gb2312");

for($i = 1; $i <= 27; $i ++) {
    if ($i > 1) {
        $url = 'http://www.zhiyin.cn/jinghua/' . $i . '.html';
    } else {
        $url = 'http://www.zhiyin.cn/jinghua';
    }

    $list = file_get_contents($url);

    $dom = new \DOMDocument();
    @$dom->loadHTML($list);
    $xpath = new \DOMXPath($dom);
    $hrefs = $xpath->query("//*[@class='list_youbt']/a/@href");
    foreach ($hrefs as $href) {
        $h = $href->value;
        // echo $h;die;
        $id = trim(strrchr($h, '/'), '/');
        $id = trim($id, '.html');
        $id = '583176';
        $doc = file_get_contents('http://wap.zhiyin.cn/item-401-'.$id);
        if (preg_match('/<h1>(.*?)<\/h1>/s', $doc, $title)) {
            $title = $title[1];
        } else {
            continue;
        }
        if (preg_match('/id="content"[^<>]*?>([\s\S]*?)<div class="pages"/', $doc, $con)) {
            // print_r($con[1]);die;
            $content = $con[1];
        } else {
            continue;
        }

        // $patterns = array('禁止转载', '编辑');
        /*$content = preg_replace_callback('/<p[\s\S]*?>([\s\S]*?)<\/p>/', function ($matches) use ($patterns) {*/
        //     foreach ($patterns as $pattern) {
        //         if (preg_match('/' . $pattern . '/', $matches[1])) {
        //             // if ($)
        //             return '';
        //         } else if (!trim($matches[1])) {
        //             return '';
        //         }
        //     }
        //     return '<p>' . trim($matches[1]) . '</p>';
        // }, $content);

        // echo $content;die;
        $preg = iconv('utf-8', 'gb2312', '家长荟萃|禁止转载|编辑');
        // preg_match('#'.$t.'#', $content, $cm);
        // print_r($cm);die;

        $s = '';
        if (preg_match_all('/<p[\s\S]*?>([\s\S]*?)<\/p>/', $content, $matches)) {
            $tmp = $matches[0];
            // array_pop($tmp);
            // array_pop($tmp);
        }
        $preg = iconv('utf-8', 'gb2312', '家长荟萃|禁止转载|编辑');
        foreach ($tmp as $k => $m) {
            if (preg_match('/'.$preg.'/', strip_tags($m))) {
                // echo 1;die;
                break;
            } else {
                $s .= $m;
            }
        }
        // print_r($tmp);die;
        $content = $s;
        echo $content;die;
        // $content = '';
        // for ($j = 1; $j < 10; $j++) {
            // if ($j == 1) {
            //     $sUrl = $h;
            // } else {
            //     $sUrl = str_replace('.html', '_'.$j.'.html', $h);
            // }
            // echo $sUrl . "<br>";
            // $doc = get_content($sUrl);
            // echo $doc;die;
            /*if (preg_match('/(<div[\s\S]*?id="endtext"[\s\S]*?>)<div\s*class="zuozhe2"/', $doc, $con)) {*/
            //     print_r($con);die;
            // }
        // }
        die;
    }
    die;
}
