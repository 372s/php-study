<?php
/**
 * 网易新闻
 */
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/Filter.php';

class wy extends Filter {

    public function get_content() {
        $us = array(
            'http://3g.163.com/touch/reconstruct/article/list/BBM54PGAwangning/0-10.html',
            'http://3g.163.com/touch/reconstruct/article/list/BBM54PGAwangning/1-10.html',
            'http://3g.163.com/touch/reconstruct/article/list/BBM54PGAwangning/2-10.html',
            'http://3g.163.com/touch/reconstruct/article/list/BBM54PGAwangning/3-10.html',
            'http://3g.163.com/touch/reconstruct/article/list/BBM54PGAwangning/4-10.html',

            'http://3g.163.com/touch/reconstruct/article/list/BD29LPUBwangning/0-10.html',
            'http://3g.163.com/touch/reconstruct/article/list/BD29LPUBwangning/1-10.html',
            'http://3g.163.com/touch/reconstruct/article/list/BD29LPUBwangning/2-10.html',


            'http://3g.163.com/touch/reconstruct/article/list/BD29MJTVwangning/0-10.html',
            'http://3g.163.com/touch/reconstruct/article/list/BD29MJTVwangning/1-10.html',
            'http://3g.163.com/touch/reconstruct/article/list/BD29MJTVwangning/2-10.html',
            'http://3g.163.com/touch/reconstruct/article/list/BD29MJTVwangning/3-10.html',
        );
        $tmp = [];
        foreach ($us as $u) {
            $data = file_get_contents($u);
            $data = trim($data);
            $data = ltrim($data, 'artiList(');
            $data = rtrim($data, ')');
            $data = json_decode($data, true);
            // print_r($data);

            foreach ($data['BBM54PGAwangning'] as $row) {
                $id = 'wy_' . $row['docid'];
                echo $id . '<br>';
                $title = $row['title'];
                $url = $row['url'];
                $tmp[] = $id;
                $doc = file_get_contents($url);
                // echo $doc;die;

                if (preg_match('/(<div class="content"[\s\S]*?)<div class="footer"/', $doc, $matches)) {
                    $content = $matches[1];
                } else {
                    continue;
                }
                $content = $this->format($content);
                $content = $this->handle($content);
                // $content = preg_replace_callback("|<p[\s\S]*?<\/p>|", array('Filter', 'finder'), $content);
                echo $content . '<br>';die;
            }
        }
        $t = array_unique($tmp);
        // print_r($t);
    }
}

$t = new wy();
$t->get_content();


