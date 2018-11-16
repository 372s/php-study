<?php
/**
 * 大豫网
 * 腾讯
 * 只看 文章来源；去来源采集
 */
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
require_once dirname(__FILE__) . '/helpers.php';


$url = 'https://xw.qq.com/service/api/proxy?key=Xw@2017Mmd&charset=utf-8&url=http:%2F%2Fopenapi.inews.qq.com%2FgetQQNewsIndexAndItems%3Fchlid%3Dnews_news_henan%26refer%3Dmobilewwwqqcom%26srcfrom%3Dnewsapp%26otype%3Djson%26ext_action%3DFimgurl33,Fimgurl32,Fimgurl30';
// $url = 'https://xw.qq.com/service/api/proxy?key=Xw@2017Mmd&charset=utf-8&url=http:%2F%2Fopenapi.inews.qq.com%2FgetQQNewsNormalContent%3Fids%3D20181115A10SJV00,20181115A1S70900,20181115A19M4200,20181115A1AM5N00,20181115A185HT00,20181115A1C2PJ00,20181115A187SK00,20181115A1QNJ500,20181115A13OHJ00,20181115A10IDH00%26refer%3Dmobilewwwqqcom%26srcfrom%3Dnewsapp%26otype%3Djson%26%26extActionParam%3DFimgurl33,Fimgurl32,Fimgurl30%26extparam%3Dsrc,desc';
$json = file_get_contents($url);

$data = json_decode($json, true);

print_r($data['idlist'][0]['newslist']);die;