<?php
/**
 * http://47.244.140.215:8091/feeds/toutiao?pageNo=1&num=20
 */
require_once dirname(__FILE__) . '/helpers.php';

$content = "<div>\n      <p style=\"text-align: center;\">图片来源：视觉中国</p>\r\n<p style=\"text-align: left;\">今年5月，中建投信托前总经理刘屹因 个人原因辞职，此后一直暂由副总经理谭硕代为<a href=\"\">履职</a>。谭硕，现年46岁，25年金融从业经历，博士研究生学历，自2014年12月起担任中建投信托副总经理；曾任职于四川省涪陵市人民政府办公室（中国建设银行下派挂职锻炼）、中国建设银行四川省分行、四川美益投资有限公司。</p>\r\n<p>据中建投信托官网介绍，中建投信托前身是浙江省国际信托投资公司（以下简称浙江国投），始创于1979年，总部位于杭州，是国内最早经营信托投资业务的公司之一。2007年4月，中国建银投资有限责任公司（以下简称中国建投）收购浙江国投的全部股权；同年11月，更名为中投信托有限责任公司。2013年6月，公司正式更名为中建投信托有限责任公司。</p>\r\n<p>中建投信托注册资本金为50亿元，中国建投与建投控股有限责任公司分别持有中建投信托90.05%与9.95%股权。截至2017年末，中建投信托管理的信托资产规模总计为1702.46亿元，其中房地产业务占比最高，占信托资产规模的44.39%；分布在基础产业、实业、金融机构领域的信托资产较为均衡，占比均在12.5%上下。2017年末，中建投信托固有资产余额为88.44亿元。</p>\n      <img alt_src=\"http://static.nbd.com.cn/images/nbd_v4/ydrss640.jpg\"/>\n      <div style=\"display:none\">\n\n  <!--51la-->\n<!--  <script language=\"javascript\" type=\"text/javascript\" src=\"//js.users.51.la/19198657.js\"></script>\n  <noscript><a href=\"//www.51.la/?19198657\" target=\"_blank\"><img alt=\"我要啦免费统计\" src=\"//img.users.51.la/19198657.asp\" style=\"border:none\" /></a></noscript>\n-->\n\n  <!-- youmeng statistics -->\n<!--\n  <script type=\"text/javascript\">var cnzz_protocol = ((\"https:\" == document.location.protocol) ? \" https://\" : \" http://\");document.write(unescape(\"%3Cspan id='cnzz_stat_icon_1260046885'%3E%3C/span%3E%3Cscript src='\" + cnzz_protocol + \"s4.cnzz.com/z_stat.php%3Fid%3D1260046885' type='text/javascript'%3E%3C/script%3E\"));</script>\n  <script> $(\"#cnzz_stat_icon_1260046885\").hide(); </script>\n-->\n\n  <!--baidu-->\n  <script type=\"text/javascript\">var _bdhmProtocol = ((\"https:\" == document.location.protocol) ? \" https://\" : \" http://\");document.write(unescape(\"%3Cscript src='\" + _bdhmProtocol + \"hm.baidu.com/h.js%3Fde6470f7123b10c2a7885a20733e9cb1' type='text/javascript'%3E%3C/script%3E\"));</script>\n\n  <!--google-->\n<!--\n  <script>\n    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){\n      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\n        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\n      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');\n  ga('create', 'UA-100046212-1', 'auto');\n  ga('send', 'pageview');\n  </script>\n-->\n\n</div>\n\n    </div>\n\t\r    ";

// $content = format($content);
// echo $content;die;
$content = preg_replace('/<(div|p|span)[^>]*>\s*<\/\1>/is', '', $content);
$content = preg_replace('/(<img)[^<>]*?(src="[^<>"\']*?")[^<>]*?(>)/is', '$1 $2$3', $content);
$content = preg_replace('/<a[^>]*?href=[^>]*?>/is', '', $content);
$content = preg_replace('/<\/a>/i', '', $content);
$content = trim($content);

if (preg_match('/^<(div)[^>]*>(.*)<\/\1>$/is', $content, $matches)) {
    $content = trim($matches[2]);
}


// $content = strip_tags($content, '<div><img><p><span><blockquote><sup><sub><br><table><tr><td><ul><li><ol>');
// echo $content;die;

// $content = format($content);
// $appends = array('深圳', '大鹏新区', '很难想象','资料图','图片来源：');
// $content = finder($content, $appends);
$content = img_url_local($content);

echo $content;die;


$arr = range(1, 20);
foreach ($arr as $v) {
    $url = 'http://47.244.140.215:8091/feeds/toutiao?pageNo='.$v.'&num=20';

    $json = file_get_contents($url);

    $data = json_decode($json, true);

    // print_r($data);die;

    foreach ($data['articles'] as $value) {
        $id = $value['newsId'];
        $title = $value['title'];
        $url = $value['real_url'];

        // $html = file_get_contents($url);

        $html = phpQuery::newDocumentFile($url);
        $content = $html->find('div[class="article-content"]')->html();
        $content = str_replace('alt_src', 'src', $content);
        $content = preg_replace('/<script[\s\S]*?<\/script>/', '', $content);
        $content = preg_replace('/<div[\s\S]*?style=\"display:none\"[\s\S]*?<\/div>/', '', $content);
        $content = img_url_local($content);
        echo $content . "<br>";
        $content = $value['content'];
        $cate = $value['category'];
    }
}
