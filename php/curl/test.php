<?php
// require_once dirname(__DIR__). '/../class/curl.class.php';
require_once dirname(dirname(__DIR__)). '/class/curl.class.php';

$curl = new Curl();
$res = $curl->https_get('api.medlive.cn/guideline/text_guide_info_v2.ajax.php?id=1000');
echo $res;die;
print_r(json_decode($res, true));
