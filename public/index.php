<?php
require __DIR__ . '/../bootstrap/autoload.php';

// 类自动加载
spl_autoload_register(function ($class) {
    include dirname(__DIR__) . '/class/' . $class . '.class.php';
});

$request = Requests::get('http://s.eastday.com/json/search/dajiakan.json?jsonpCallback=jsonpCallback&_=1538989265954');
print_r($request->body);die;

// curl类
$curl = new Curl();
$res = $curl->https_get('http://s.eastday.com/json/search/dajiakan.json?jsonpCallback=jsonpCallback&_=1538989265954');
preg_match_all('/.*?jsonpCallback\((.*?)\)/', trim($res), $data);
$da = json_decode($data[1][0], true);
print_r($da['data']);die;

echo date('Y-m-d H:i:s', '1538989265954');die;
$report = 'report=13800000000|DELIVRD|777342392938043392|73249|2016-09-10 11:08:00; 13800000001|DELIVRD|777342392938043393|73249|2016-09-10 11:08:00;13800000001|REPEATD|777342392938043393|73249|2016-09-10 11:08:00';

$str = 1234134;
echo json_decode($str, true);die;

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

print_r($matchs);die;

$matchs = $matchs[0];

$data = array(
    'username' => 'wangqiang',
    'short_url' => 'http://www.baidu.com',
);
$config = array(
    '{user_name}' => 'username',
    '{URL}' => 'short_url',
    '{link}' => 'link',
);

$arr = array();
foreach ($data as $k => $v) {
    if ($key = array_search($k, $config)) {
        $arr[$key] = $data[$k];
    }
}

$new = strtr($str, $arr);
print_r($new);
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

function shutdown()
{
    // This is our shutdown function, in
    // here we can do any last operations
    // before the script is complete.

    echo 'Script executed with success', PHP_EOL;
}

register_shutdown_function('shutdown');
die;

echo '123456789123456789123';die;
$i = 1;
while ($i < 5 && $i) {
    echo 23423 . "\n";
    $i++;
}
echo date('Y-m-d H:i:s', '1536283681') . "\n";
echo date('Y-m-d H:i:s', '1536653955') . "\n";
echo max('2', 2);die;

print_r($_SERVER);die;

$array1 = array("a" => "green", "red", "blue");
$array2 = array("b" => "green", "red", "yellow");
$result = array_diff($array2, $array1);

print_r($result);die;

echo $_GET['a'] ?: 0;die; // 1
echo !empty($_GET['a']) ?: 0;die; // 1

function gen_one_to_three()
{
    for ($i = 1; $i <= 3; $i++) {
        //注意变量$i的值在不同的yield之间是保持传递的。
        yield $i;
    }
}

$generator = gen_one_to_three();

print_r(iterator_to_array($generator));die;
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
$e->export_excel('234234', $exprot);die;

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
$list = array
    (
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
    null, null, RecursiveIteratorIterator::LEAVES_ONLY
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
