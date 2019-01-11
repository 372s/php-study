<?php
$file = dirname(__DIR__) . '/uploads/test.txt';

$fp = fopen($file, 'r');

if(flock($fp, LOCK_SH)){ // 取得贡献锁
    while(!feof($fp)){
        echo fread($fp, 100);
    }
    flock($fp, LOCK_UN);
}

fclose($fp);
?>