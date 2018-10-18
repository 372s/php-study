<?php
/**
 * Created by PhpStorm.
 * User: wq455
 * Date: 2018/10/18
 * Time: 02:10
 */

$html = file_get_contents('http://m.zynews.cn/zz/node_9025.htm');
//建立Dom对象，分析HTML文件；
$doc = new DOMDocument;
@$doc->loadHTML($html);
$doc->validateOnParse = true;
$doc->preserveWhiteSpace = false;
$params = $doc->getElementsByTagName("li");
echo $doc->saveHTML($doc->getElementsByTagName("li")->item(0));die;
$i=0;
foreach($params as $param)
{
    foreach($params->item($i)->childNodes as $node)
    {
        if($node->nodeName == 'a')
        {
            //assert ($node != null);
            echo $node->getAttribute("href") . "<br>"; // bug? empty
            echo $node->nodeValue . "<br>";
        }
    }
    $i++;
}
die;
$as = $doc->getElementsByTagName("a");
foreach ($as as $finance) {
//    $child = $finance->childNodes;
    assert ($finance != null);
    echo $finance->getAttribute("href") . "<br>";
}
die;
assert ($res != null);
$strId = $res->getAttribute("id"); // bug? empty
print_r($strId);die;


$html = file_get_contents('http://m.zynews.cn/zz/2018-10/15/content_11547998.htm');
// echo $html;die;
//建立Dom对象，分析HTML文件；
$doc = new DOMDocument;
$doc->validateOnParse = true;
@$doc->loadHTML($html);
$doc->preserveWhiteSpace = false;
$res = $doc->getElementById("text");
assert ($res != null);
$strId = $res->getAttribute("id"); // bug? empty
print_r($strId);die;
echo $res->nodeValue; die;

$doc = new DOMDocument();
@$doc->loadHTML($html);
$xpath = new DOMXpath($doc);
$elements = $xpath->query("//div[@class='text']");
// print_r($elements);die;
if (!is_null($elements)) {
    foreach ($elements as $element) {
        echo "<br/>[" . $element->nodeName . "]";
        print_r($element) ;die;
        $nodes = $element->childNodes;
        foreach ($nodes as $node) {
            echo $node->nodeValue . "\n";
        }
    }
}
die;

/**
 * 中原网
 */
function zynews()
{
    header("Content-Type:text/html;charset=utf-8");
    set_time_limit(0);

    $urls = array(
        'http://news.zynews.cn/node_4263.htm',
        'http://news.zynews.cn/zz/node_4277.htm',
        'http://news.zynews.cn/hn/node_4276.htm',
    );
    $i = 0;
    foreach ($urls as $url) {

        preg_match_all("/(http:\/\/.*?\/)node/", $url, $u_matches);
        // print_r($u_matches);die;
        $prefix = $u_matches[1][0];
        // echo $prefix;die;
        $html = $this->my_curl($url);
        // echo $html;die;
        preg_match_all("/<div class=\"newslistbox\">[\s\S]*?<a[\s\S]*?href=\"([\s\S]*?)\"[\s\S]*?>([\s\S]*?)<\/a>/", $html, $matches);
        // print_r($matches);die;
        $url_c_s = $matches[1];
        $title_c_s = $matches[2];

        foreach ($url_c_s as $k => $u) {
            preg_match_all("/.*?content_(\d*)\.htm/", $u, $ids);
            $id = 'zy' . $ids[1][0];
            $title = $title_c_s[$k];

            $html_s = $this->my_curl($prefix . $u);
            // echo 'http://news.zynews.cn/'.$u;die;
            $res = preg_match_all("/(<div class=\"content\"[\s\S]*?>[\s\S]*?)<div class=\"editor\"/", $html_s, $matchs);
            // print_r($matchs);die;
            if ($res) {
                $content = $matchs[1][0] . "</div>";
                $content = preg_replace("/<script>[\s\S]*?<\/script>/i", '', $content);

                // echo $id . "<br>";
                // echo $title . "<br>";
                $content = $this->img_replace($content);
                echo $content . "<br>";
                $i++;
                $this->addNews("中原网", $prefix . $u, "新闻", $title, $content, 1, $id);
            } else {
                continue;
            }

        }
    }
}