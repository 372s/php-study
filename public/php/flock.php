<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2019/1/11
 * Time: 14:42
 */


$file = dirname(__DIR__) . '/uploads/test.txt';

$fp = fopen($file, 'a');

if(flock($fp, LOCK_EX)){            // 取得独占锁
    fwrite($fp, "Hello World\r\n"); // 写入数据
    sleep(10);                      // sleep 10秒，文件被锁定
    fwrite($fp, "Hello PHP\r\n");   // 写入数据
    flock($fp, LOCK_UN);            // 解锁
}
fclose($fp);