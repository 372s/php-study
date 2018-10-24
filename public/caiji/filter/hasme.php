<?php

$html = '<article class="blue" style="width: 10px;">
<img src="http://41234128430908123.jpg" style="width: 200px;">
<p style="width: 10px;">我是公司的分公司的风格</p>
</article>';

echo has_me($html) . "<br>";
print_r(filter_me($html));die;

function filter_me($html) {
    /*preg_match('/^(<\/*[a-z]*[\s\S]*?>)*?我/i', $html,$matches);*/
    preg_match('/^(<[\s\S]*?>)*?我/i', $html, $matches);
    /*preg_match('/^(<\/*[a-z]*[\s\S]*?>)*我/i', $html, $matches);*/
    return $matches;
}

function has_me($html) {
    return preg_match('/^(<[\s\S]*?>)*?我/i', $html);
}
