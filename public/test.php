<?php

// print_r($_POST);die;
// print_r($_REQUEST);die;
// echo file_get_contents('php://input');

$st = time();
set_time_limit(0);
$fp = fopen(__DIR__."/uploads/25558-2018-11-14.tag", "r");
$i = 0;
// echo filesize("25558-2018-11-14.tag_(2)");die;
while (!feof($fp) && $i < 10000) {
    $i ++;
    $line = fgets($fp);

    if (preg_match('/[\s\S]*?process1[\s\S]*?msg=([\s\S]*)/', $line, $matches)) {
        // print_r($matches);
        echo $matches[1] . "<br>";
    }

    // $line = preg_replace('/process1[\s\S]*?msg=/', '', $line);
    // $line = str_replace('\'.', '\'', $line);
    // $line = str_replace(', publish or delete', '', $line);
    // $line = str_replace('\'{', '{', $line);
    // $line = str_replace('}\'', '}', $line);
    // $line = trim($line, '\'');
    // echo $line;die;
    // print_r(json_decode($line, true));
    // echo $line . "<br>";
    ob_flush();
    flush();
}
fclose($fp);
echo time()-$st;