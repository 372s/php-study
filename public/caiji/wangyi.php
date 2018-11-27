<?php
/**
 * 网易新闻
 */
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/Filter.php';

class wy extends Filter {

    public function phpquery ($content, $append = array()) {
        $patterns = array(
            '不得转载', '版权声明：', '版权声明:',
            '责任编辑', '责任编辑:', '责任编辑:',
            "本文来源", "本文来源:", "本文来源：",
            "公众号", "公众号：", "公众号:",
            "一点号", "一点号:", "一点号：",
            "微信号", "微信号：", "微信号:",
            "头条号","头条号:", "头条号：", "新浪女性",
            "加威信","加微心", "关注我们", "关注我",
            "原文链接","原文链接:","原文链接：",
            "作者：","作者:",
            '原标题', '原标题：', '原标题:',
        );
        $patterns = array_merge($patterns, $append);
        $content = \phpQuery::newDocumentHTML($content);
        foreach ($patterns as $p) {
            $content->find('p:contains("' . $p . '")')->remove();
        }
        return trim($content->html());
    }

    public function get_content() {
        $us = array(
            'http://3g.163.com/touch/reconstruct/article/list/BBM54PGAwangning/0-10.html', // xinwen
            'http://3g.163.com/touch/reconstruct/article/list/BD29LPUBwangning/0-10.html', // guonei
            'http://3g.163.com/touch/reconstruct/article/list/BD29MJTVwangning/0-10.html', //guoji
            'https://3g.163.com/touch/reconstruct/article/list/BA10TA81wangning/0-10.html',//yule
            'https://3g.163.com/touch/reconstruct/article/list/BA8E6OEOwangning/0-10.html', // tiyu
            'https://3g.163.com/touch/reconstruct/article/list/BA8EE5GMwangning/0-10.html', // caijing
            'https://3g.163.com/touch/reconstruct/article/list/BA8D4A3Rwangning/0-10.html', //keji
            'https://3g.163.com/touch/reconstruct/article/list/BAI6I0O5wangning/0-10.html', // shouji
            'https://3g.163.com/touch/reconstruct/article/list/BAI6JOD9wangning/0-10.html', //shuma
            'https://3g.163.com/touch/reconstruct/article/list/BBM50AKDwangning/0-10.html', // wangyihao
            'https://3g.163.com/touch/reconstruct/article/list/DE0DNAFFwangning/0-10.html', // meirituijian
            'https://3g.163.com/touch/reconstruct/article/list/BA8F6ICNwangning/0-10.html', //shishang
            'https://3g.163.com/touch/reconstruct/article/list/BA8FF5PRwangning/0-10.html', // jiaoyu
            'https://3g.163.com/touch/reconstruct/article/list/DJFFJBSLlizhenzhen/0-10.html', // gongkaike
            'https://3g.163.com/touch/reconstruct/article/list/BDC4QSV3wangning/0-10.html', // jiankang
            'https://3g.163.com/touch/reconstruct/article/list/BEO4GINLwangning/0-10.html', // lvyou
            'https://3g.163.com/touch/reconstruct/article/list/BEO4PONRwangning/0-10.html', // qin zi
            'https://3g.163.com/touch/reconstruct/article/list/CKKS0BOEwangning/0-10.html', // yishu
        );

        $tmp = [];
        foreach ($us as $u) {
            for ($i = 1; $i <= 4; $i++) {
                $tmp[] = str_replace('0-10', $i.'-10', $u);
            }
        }

        $us = array_merge($us, $tmp);
        // print_r($us);die;

        foreach ($us as $u) {
            $data = file_get_contents($u);
            $data = trim($data);
            $data = ltrim($data, 'artiList(');
            $data = rtrim($data, ')');
            $data = json_decode($data, true);


            if (! preg_match('/list\/(.*)\//', $u, $ma)) {
                continue;
            }
            // $key =$ma[1];
            // echo $ma[1] . '<br>';
            // print_r($data);die;
            foreach ($data[$ma[1]] as $row) {
                // print_r($row);
                $id = 'wy_' . $row['docid'];
                // echo $id . '<br>';
                $title = $row['title'];
                $url = $row['url'];

                if (strpos($url, 'http://') === false) {
                    continue;
                }
                // echo $url . '<br>';

                $doc = file_get_contents($url);
                // echo $doc;die;

                if (preg_match('/(<div class="content"[\s\S]*?)<div class="footer"/', $doc, $matches)) {
                    $content = $matches[1];
                } else {
                    continue;
                }
                $content = $this->format($content);
                $content = $this->phpquery($content);
                // $content = preg_replace_callback("|<p[\s\S]*?<\/p>|", array('Filter', 'finder'), $content);
                echo $content . '<br>';
            }
        }
    }
}

$t = new wy();
$t->get_content();


