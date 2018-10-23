<?php

$html = '我<article><p>我们是公司的分公司的风格</p></article><div>公司弗兰克的结果是浪费的恐惧感</div>';
preg_match('/^(<\/*[a-z]*>)*我/i', $html, $matches);
print_r($matches);die;
//
//$html = preg_replace('/<[\/\w]*>/', '', $html);
//if (preg_match('/^我/', $html)) {
//    echo 1;
//} else {
//    echo 0;
//}

var_dump(filter_me($html));

function filter_me($html) {
    return preg_match('/^(<\/*a-z>)*我/', $html);
}