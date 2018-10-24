<?php

$html = '我<article class="blue" style="width: 10px;"><p style="width: 10px;">我们是公司的分公司的风格</p></article><div>公司弗兰克的结果是浪费的恐惧感</div>';
preg_match('/^(<\/*[a-z]*[\s\S]*>)*我/i', $html, $matches);
print_r($matches);die;

function filter_me($html) {
    return preg_match('/^(<\/*[a-z]*[\s\S]*>)*我/i', $html);
}