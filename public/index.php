<?php
require_once __DIR__. '/start.php';

$spl_auto_func = spl_autoload_functions();
$spl_class = spl_classes();

// $str1 = 'hello1';
// $str2 = 'hello1';
// echo strcasecmp ($str1, $str2) . "<br>";
//
//
// echo date('Y-m-d', '1542738806');die;



$data = file_get_contents('./25558-2018-11-14.tag_(2)');

preg_match_all('/msg= \'([\s\S]*?)\'./', $data, $matches);

print_r($matches);die;









$fp = fopen("25558-2018-11-14.tag_(2)", "r") or die("can't read stdin");
while (!feof($fp)) {
    $line = fgets($fp);
    $line = preg_replace_callback(
        '/msg= \'([\s\S]*?)\'./',
        function ($matches) {
            return $matches[1] . "\n";
        },
        $line
    );
    echo $line;
}
fclose($fp);







// 将文本中的年份增加一年.
$text = "April fools day is 04/01/2002\n";
$text.= "Last christmas was 12/24/2001\n";

echo preg_replace('|(\d{2}/\d{2}/)(\d{4})|', "$1$2+1", $text);die;
// 回调函数
function next_year($matches)
{
    // 通常: $matches[0]是完成的匹配
    // $matches[1]是第一个捕获子组的匹配
    // 以此类推
    var_dump($matches);
    return $matches[1].($matches[2]+1);
}
echo preg_replace_callback(
    "|(\d{2}/\d{2}/)(\d{4})|",
    "next_year",
    $text);die;

$className = '\Dir\Name';
$className = ltrim($className, '\\');
echo $className;
