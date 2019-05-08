<?php
$content = '{name}用户，您的验证码是{str(10)}，点击链接{url}【医脉通】';

$arr = ['{name}' => 'wangqinag', ];

if (stripos($content, '{name}') !== false) {
    $content = str_ireplace('{NAME}', 'wang', $content);
    echo $content;die;
}