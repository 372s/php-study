<?php
$number = !empty($_GET['number']) ? intval($_GET['number']) : 0;
$little_zm = !empty($_GET['little_zm']) ? intval($_GET['little_zm']) : 0;
$big_zm = !empty($_GET['big_zm']) ? intval($_GET['big_zm']) : 0;
$bdfh = !empty($_GET['bdfh']) ? intval($_GET['bdfh']) : 0;
$length = !empty($_GET['length']) ? intval($_GET['length']) : 20;

$sn = '0123456789';
$slz = 'abcdefghijklmnopqrstuvwxyz';
$sbz = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$s = '!@#$%^&*';

$pool = '';
if ($number) {
    $pool .= $sn;
}
if ($little_zm) {
    $pool .= $slz;
}
if ($big_zm) {
    $pool .= $sbz;
}
if ($bdfh) {
    $pool .= $s;
}
$res = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);

$path = __DIR__ . '/';
$file = $path . 'file.txt';

if (!is_file($file)) {
    mkdir($file, 0777, true);
}
$fp = fopen($file, 'a+');
fwrite($fp, $res."\n");
fclose($fp);
echo json_encode($res);die;