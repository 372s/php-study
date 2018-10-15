<?php
require __DIR__ . '/../bootstrap/autoload.php';

// 类自动加载
spl_autoload_register(function ($class) {
    include dirname(__DIR__) . '/class/' . $class . '.class.php';
});

function zynews() {
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
        $html =  $this->my_curl($url);
        // echo $html;die;
        preg_match_all("/<div class=\"newslistbox\">[\s\S]*?<a[\s\S]*?href=\"([\s\S]*?)\"[\s\S]*?>([\s\S]*?)<\/a>/", $html, $matches);
        // print_r($matches);die;
        $url_c_s = $matches[1];
        $title_c_s = $matches[2];

        foreach ($url_c_s as $k => $u) {
            preg_match_all("/.*?content_(\d*)\.htm/", $u, $ids);
            $id = 'zy'.$ids[1][0];
            $title = $title_c_s[$k];

            $html_s = $this->my_curl($prefix.$u);
            // echo 'http://news.zynews.cn/'.$u;die;
            $res = preg_match_all("/(<div class=\"content\"[\s\S]*?>[\s\S]*?)<div class=\"editor\"/", $html_s, $matchs);
            // print_r($matchs);die;
            if ($res) {
                $content = $matchs[1][0]."</div>";
                $content = preg_replace("/<script>[\s\S]*?<\/script>/i", '', $content);

                // echo $id . "<br>";
                // echo $title . "<br>";
                $content = $this->img_replace($content);
                echo $content . "<br>";
                $i++;
                $this->addNews("中原网", $prefix.$u, "新闻", $title, $content,1,$id);
            } else {
                continue;
            }

        }
    }
}


/*$html = Requests::get('http://news.zynews.cn/node_4263.htm');
// print_r($html);die;
preg_match_all("/class=\"newslistbox\"[\s\S]*?<a[\s\S]*?href=\"([\s\S]*?)\"[\s\S]*?>([\s\S]*?)<\/a>/", $html->body, $matches);
print_r($matches);die;*/
//<div id="_3fz6j9jkphq"></div>
$html = Requests::get('http://news.zynews.cn/zz/2018-10/15/content_11547549.htm');
preg_match_all("/(<div class=\"content\".*?>[\s\S]*?)<div class=\"editor\"/", $html->body, $matchs);

$content = $matchs[1][0]."</div>";

$content = preg_replace("/<script>[\s\S]*?<\/script>/", '', $content);
echo $content;die;
print_r($matchs);die;

// http://news.zynews.cn
// $str = '{"province":["\u5317\u4eac"],"city_level":["\u4e00\u7ebf"],"dept_name":["\u666e\u901a\u5185\u79d1"],"carclass2":["\u975e\u533b\u836f\u7c7b\u4e2d\u7ea7"]}';
// $res = preg_replace_callback('/\\\u([0-9a-f]{4})/i',function($match) {
//     return $match[1];
// }, $str);
// print_r($res);die;
function decodeUnicode($str)
{
    return preg_replace_callback('/\\\u([0-9a-f]{4})/i',
    create_function(
        '$matches',
        'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
    ),
    $str);
}
$arr = array('姓名' =>'张三', '李四');
echo serialize($arr);
echo json_encode($arr);
echo json_encode($arr, JSON_UNESCAPED_UNICODE);
$res = decodeUnicode(json_encode($arr));
print_r(json_decode($res, true));
die;



$b = array(1,1,2,3,5,8);
$arr = get_defined_vars();
// 打印 $b
print_r($arr["b"]);

// 打印 PHP 解释程序的路径（如果 PHP 作为 CGI 使用的话）
// 例如：/usr/local/bin/php
echo $arr["_"]; 

// 打印命令行参数（如果有的话）
print_r($arr["argv"]);

// 打印所有服务器变量
print_r($arr["_SERVER"]);

// print_r($arr['php_errormsg']);

// 打印变量数组的所有可用键值
print_r(array_keys(get_defined_vars()));
die;

function fuc () {
    // $arr = func_get_args();
    // extract($arr, EXTR_PREFIX_ALL, 'var');
    print_r(get_defined_vars());
}
fuc(1, 2);die;

$newfunc = create_function('$a,$b', 'return "ln($a) + ln($b) = " . log($a * $b);');
// echo "New anonymous function: $newfunc\n";
// echo $newfunc(2, M_E) . "\n";

$farr = create_function('$a,$b', 'return $a+$b;');
echo $farr . "\n\r";
echo $farr(1, 2);
die;

$str = 'aaaa1111';
// preg_replace('/\d*/', '', $str);
header("Content-Type:text/html;charset=utf-8");
// 新浪列表
$res = file_get_contents('https://interface.sina.cn/wap_api/layout_col.d.json?showcid=12635&col=12658&level=1%2C2%2C3');
// echo $res;die;
// $arr = json_decode($res['result']['data']['list'], true);
// 新浪详情
$content = file_get_contents('https://eladies.sina.cn/feel/answer/2018-10-14/detail-ihkvrhps4532630.d.html?&cid=12635');
// echo $content;die;
//(<p class="art_p">.*?<\/p>)\s\S*?
$num = preg_match_all("/(<img class=\"sharePic hide\"[\s\S]*?>)([\s\S]*?)(<figure class=\"art_img_mini j_p_gallery\"[\s\S]*?>[\s\S]*?<\/figure>)([\s\S]*?)<p class=\"art_p\">.*?<a onmouseover[\s\S]*?>/", trim($content), $data);
// echo $num;die;

$img = preg_replace("/(<img[\s\S]*?src=\")([\s\S]*?)(\"[\s\S]*?>)/", '${1}http:${2}${3}', $data[1][0]);
echo "<div>".$data[2][0].$img.$data[4][0]."</div>";die;
print_r($data);die;
$content = $data[0][0];
// print_r($content);die;
// 匹配图片
preg_match_all("/<img class=\"sharePic hide\"[\s\S]*?>/", $content, $img);
// print_r($img[0][0]);die;
// 匹配figure
$content = preg_replace("/<figure class=\"art_img_mini j_p_gallery\"[\s\S]*?>[\s\S]*?<\/figure>/", '', $content);
print_r($content);die;

// 搜狐
$souhu = file_get_contents('https://v2.sohu.com/integration-api/mix/region/98');
print_r(json_decode($souhu, true)['data']);
die;

$ress = file_get_contents('https://interface.sina.cn/wap_api/layout_col.d.json?showcid=34978&col=34978&level=1%2C2&show_num=30&page=2&act=more&jsoncallback=callbackFunction&_=1539500212952&callback=Zepto1539500207743');
// echo $ress;die;
preg_match_all('/.*?\((.*?)\)$/', trim($ress), $data);
$ress = $data[1][0];
// print_r($ress);die;
print_r(json_decode($ress, true));
die;

// echo strlen ('7b17b22fa32eb0e0ab9772594a34bb08.csv');die;
$input = array("red", "green", "blue", "yellow");
echo md5(json_encode($input));die;
$arr = array_splice($input, 0, 2);
print_r($arr);
print_r($input);
$arr = array_splice($input, 0, 1);
print_r($arr);
print_r($input);
die;

echo PUBLIC_PATH;die;

// $request = Requests::post('http://api.medlive.test/sms/custom_sms_send.php', array(), array(
//     'mobile' => '18612651314',
//     'content' => '您的验证码是351556【医脉通】',
//     'dstime' => '',
// ));
// print_r($request->body);die;

// curl类
$curl = new Curl();

$res = $curl->https_post('http://api.medlive.test/sms/custom_sms_send.php', array(
    'mobile' => '18612651314',
    'content' => '您的验证码是351556【医脉通】',
));
print_r($res);
die;

$res = $curl->https_get('http://s.eastday.com/json/search/dajiakan.json?jsonpCallback=jsonpCallback&_=1539137510506');
preg_match_all('/.*?\((.*?)\)/', trim($res), $data);
print_r($data[1][0]);
die;

// $phrase = "You should eat fruits, vegetables, and fiber every day.";
// $healthy = array("fruits", "vegetables", "fiber");
// $yummy = array("pizza", "beer", "ice cream");

// $newphrase = str_replace($healthy, $yummy, $phrase);

// echo $newphrase;die;

// $arrrr = array(2, 3, 1, 4);
// sort($arrrr);
// print_r($arrrr);die;

$str = '{user_name}老师，你好！文案+{URL}+回TD退订。';
$pattern = '/{.+?}/';
preg_match_all($pattern, $str, $matchs);
print_r($matchs);
die;


// set_time_limit(0);
// ignore_user_abort(false);
// while (0) {
//     $isAborted = connection_aborted();
//     $status = connection_status();
//     file_put_contents('test.txt', 'time: ' . date('Y-m-d H:i:s') . '; abroted:' . $isAborted . '; status: ' . $status);
//     if (0 !== $status || $isAborted) {
//         break;
//     }
//     break;
//     sleep(2);
// }
// die;

print_r($_SERVER);
die;

$array1 = array("a" => "green", "red", "blue");
$array2 = array("b" => "green", "red", "yellow");
$result = array_diff($array2, $array1);

print_r($result);
die;

echo $_GET['a'] ? : 0;
die; // 1
echo !empty($_GET['a']) ? : 0;
die; // 1

function gen_one_to_three()
{
    for ($i = 1; $i <= 3; $i++) {
        //注意变量$i的值在不同的yield之间是保持传递的。
        yield $i;
    }
}

$generator = gen_one_to_three();

print_r(iterator_to_array($generator));
die;
foreach ($generator as $value) {
    echo "$value\n";
}
die;
// $file = new CsvReader();
// $res = $file->readFile('export.csv');
// print_r($res);die;

// $c = new CSV('export.csv');
// $start_time = time();
// $res = $c->get_data(0, 1);
// print_r(var_export($res, true));die;

$e = new ExportCsv();
$exprot = array(
    0 => array(
        0 => 'ID',
        1 => '姓名',
    ),
    1 => array(
        0 => '1',
        1 => 'wangqiang1',
    ),
    2 => array(
        0 => '2',
        1 => 'wangqiang2',
    ),
    3 => array(
        0 => '3',
        1 => 'wangqiang3',
    ),
    4 => array(
        0 => '4',
        1 => 'wangqiang4',
    ),
    5 => array(
        0 => '5',
        1 => 'wangqiang5',
    ),
);
// $e->export_csv_2($exprot);die;
$e->export_excel('234234', $exprot);
die;

// echo microtime(true);die; // 浮点型

###############################
# Carbon\Carbon
###############################
// use Carbon\Carbon;

// printf("Right now is %s", Carbon::now()->toDateTimeString() . "\n");
// printf("Right now in Shanghai is %s", Carbon::now());  //implicit __toString()

// 验证码
// use Gregwar\Captcha\CaptchaBuilder;

// header('Content-type: image/jpeg');

// CaptchaBuilder::create()->build()->output();
// print_r(glob(dirname(__FILE__).'/*.php'));die;

// 验证码
// use Qous\Captcha\Captcha;
// $cap = new Captcha();
// // print_r($cap);die;
// $cap->create();

// 获取文件夹内文件
// use Symfony\Component\Finder\Finder;

// $finder = Finder::create()->files()->ignoreDotFiles(true)->in(dirname(__FILE__))->depth(0);
// print_r($finder);die;

// $arr = [];
// foreach ($finder as $key => $file) {
//     $arr[$key]['getPathName'] = $file->getPathName();

//     // dumps the absolute path
//     $arr[$key]['getRealPath'] = $file->getRealPath();

//     // dumps the relative path to the file, omitting the filename
//     $arr[$key]['getRelativePath'] = $file->getRelativePath();

//     // dumps the relative path to the file
//     $arr[$key]['getRelativePathname'] = $file->getRelativePathname();
// }
// print_r($arr);die;

// $arr = iterator_to_array(
//     Finder::create()->files()->ignoreDotFiles(true)->in(dirname(__FILE__))->depth(0),
//     false
// );
// $arr = array_map(function($file) {
//     return $file->getPathName();
// }, $arr);
// print_r($arr);die;

// 随机数 1~2之间
// echo mt_rand(0, 99)/100+1;

###############################
# 正则验证
###############################
// require 'preg.class.php';
// $str = '455122@qq.com.';
// $preg = new Preg();
// var_dump($preg->checkEmail($str));

// mb_strpos | strpos
// $mystring = 12345678;
// $findme   = 8;
// $pos = mb_strpos($mystring, $findme);

// 注意这里使用的是 ===。简单的 == 不能像我们期待的那样工作，
// 因为 'a' 是第 0 位置上的（第一个）字符。
// if ($pos === false) {
//     echo "The string '$findme' was not found in the string '$mystring'";
// } else {
//     echo "The string '$findme' was found in the string '$mystring'";
//     echo " and exists at position $pos";
// }

// $im = imagecreatetruecolor(100, 100);
// // 将背景设为红色
// $red = imagecolorallocate($im, 255, 0, 0);
// imagefill($im, 0, 0, $red);
// header('Content-type: image/png');
// imagepng($im);
// imagedestroy($im);

##########################################################
# 递归函数
##########################################################
$arr = array(
    array('id' => 1, 'name' => '河南省', 'pid' => 0),
    array('id' => 2, 'name' => '信阳市', 'pid' => 1),
    array('id' => 3, 'name' => '开封市', 'pid' => 1),
    array('id' => 6, 'name' => '广州市', 'pid' => 4),
    array('id' => 4, 'name' => '广东省', 'pid' => 0),
    array('id' => 5, 'name' => '深圳市', 'pid' => 4),
);

function recursive($data, $pid = 0)
{
    $arr = array();
    $i = 0;
    foreach ($data as $k => $v) {
        if ($v['pid'] == $pid) {
            $arr[$i] = $v;
            // $arr[$i]=array_merge($arr,recursive($data, $v['id']));
            $arr[$i]['city'] = recursive($data, $v['id']);
        }
        $i++;
    }
    return $arr;
}
// print_r(recursive($arr, 0));

##########################################################
# 读取目录下所有文件和子目录
# 队列方式：read_dir_queue
# 递归方式：read_dir
##########################################################
function read_dir_queue($dir)
{
    $files = array();
    $queue = array($dir);
    while ($data = each($queue)) {
        // print_r($data);die;
        $path = $data['value'];
        if (is_dir($path) && $handle = opendir($path)) {
            while ($file = readdir($handle)) {
                if ($file == '.' || $file == '..') {
                    continue;
                }

                $files[] = $real_path = $path . '/' . $file;
                if (is_dir($real_path)) {
                    $queue[] = $real_path;
                }

            }
        }
        closedir($handle);
    }
    return $files;
}
// print_r(read_dir_queue('E:/laragon/www/study/php-study'));

function read_dir($dir)
{
    $files = array();
    $dir_list = scandir($dir);
    foreach ($dir_list as $file) {
        if ($file != '..' && $file != '.') {
            if (is_dir($dir . '/' . $file)) {
                $files[] = read_dir($dir . '/' . $file);
            } else {
                $files[] = $file;
            }
        }
    }
    return $files;
}

#########################################################
# fputcsv
#########################################################
// $nav = array('aa', 'bb', 'cc', 'dd');
$nav = array('姓名', '外号', '曾用名', '国家');
$list = array(
    "George,John,Thomas,USA",
    "James,Adrew,Martin,USA",
);
file_put_contents("./a.txt", var_export($list, true) . "\n");
$file = fopen("./contacts.csv", "a+");
fputcsv2($file, $nav);
foreach ($list as $line) {
    fputcsv2($file, explode(',', $line));
}
fclose($file);

// $filename = "订单查询结果" . date('Y-m-d H:i:s');
// // 设置输出头部信息
// header('Content-Encoding: UTF-8');
// header("Content-Type: text/csv; charset=UTF-8");
// header("Content-Disposition: attachment; filename={$filename}.csv");
// $tableHead = array('#', '订单id', '订单号', '分类', '客户信息', '工匠信息', '订单状态', '施工状态', '付款状态', '订单金额', '下单时间', '备注');
// // 获取句柄
// $output = fopen('php://output', 'w') or die("can't open php://output");
// // 输出头部标题
// fputcsv2($output, $tableHead);
// $list = array();
// foreach ($list as $item) {
//     fputcsv2($output, array_values($item));
// }
// // 关闭句柄
// fclose($output) or die("can't close php://output");

function fputcsv2($handle, array $fields, $delimiter = ",", $enclosure = '"', $escape_char = "\\")
{
    foreach ($fields as $k => $v) {
        $fields[$k] = iconv("UTF-8", "GB2312//IGNORE", $v); // 这里将UTF-8转为GB2312编码
    }
    fputcsv($handle, $fields, $delimiter, $enclosure, $escape_char);
}

##########################################################
# RecursiveTreeIterator 以可视在方式显示一个树形结构。
##########################################################
$hey = array("a" => "lemon", "b" => "orange", array("a" => "apple", "p" => "pear"));
$awesome = new RecursiveTreeIterator(
    new RecursiveArrayIterator($hey),
    null,
    null,
    RecursiveIteratorIterator::LEAVES_ONLY
);
foreach ($awesome as $line) {
    // echo $line . PHP_EOL;
}

##########################################################
# 迭代器 CachingIterator
##########################################################
//
$cache = new CachingIterator(new ArrayIterator(range(1, 100)), CachingIterator::FULL_CACHE);
foreach ($cache as $c) {

}
// print_r($cache->getCache());

##########################################################
# 迭代器 目录文件遍历器
##########################################################
$it = new DirectoryIterator("./");
foreach ($it as $file) {
    //用isDot()方法分别过滤掉“.”和“..”目录
    if (!$it->isDot() && $file->isFile()) {
        // echo $file->getFilename() . "\n" . $file->getExtension() . "<br />";
    }
}

$it = new FilesystemIterator(dirname(__FILE__));
foreach ($it as $fileinfo) {
    if ($fileinfo->isFile()) {
        // echo $fileinfo->getFilename() . "\n";
    }
}

##########################################################
# php数组函数 each()和reset()连用
##########################################################
$a = array(1, 2, 3);
foreach ($a as $k => $v) {
    $a[$k] = 2 * $v;
}

// If you forget to reset the array before each(), the same code may give different results with different php versions.
reset($a);
while (list($k2, $v2) = each($a)) {
    // echo($v2."\n");
}

##########################################################
# 迭代器 ArrayIterator() | ArrayObject()
##########################################################
$b = array(
    'name' => 'mengzhi',
    'age' => '12',
    'city' => 'shanghai',
);
$a = new ArrayIterator($b);
// $a->append(array(
//                 'home' => 'china',
//                 'work' => 'developer'
//            ));
$c = $a->getArrayCopy();

$obj = new ArrayObject($b); //创建数组对象
$d = $obj->getIterator();
$e = $obj->getArrayCopy();
// print_r($a);
// print_r($c);
// print_r($obj);
// print_r($d);
// print_r($e);

foreach ($a as $key => $value) {
    // echo $key ." : ".$value."<br/>";
}

foreach ($d as $key => $value) {
    // echo $key ." : ".$value."<br/>";
}

$d->rewind(); //如果要使用current必须使用rewind
while ($d->valid()) {
    // echo $d->key()." : ".$d->current()."<br/>";
    $d->next();
}
