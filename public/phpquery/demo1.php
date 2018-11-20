<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/11/20
 * Time: 11:39
 */
require_once dirname(__DIR__) . '/../lib/PHPQuery/phpQuery.php';
// require_once dirname(__FILE__) . '/helpers.php';


$html = '<div>虽然空乘人员没有提供真的窗户，但别出心裁地对待乘客的需求，让网民感叹：“我们生活在一个多么富有同情心的世界。” </div>
<p>虽然空乘人员没有提供真的窗户，让网民感叹：“我们生活在一个多么富有同情心的世界。” </p>';
$content = phpQuery::newDocumentHTML($html);
$content->find('*:contains("让网民感叹")')->remove();
$content = $content->html();
echo $content;