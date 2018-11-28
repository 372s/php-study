<?php

$st = time();
set_time_limit(0);
$fp = fopen(__DIR__."/uploads/25558-2018-11-14.tag", "r");
$i = 0;
// echo filesize("25558-2018-11-14.tag_(2)");die;
while (!feof($fp)) {
    $i ++;
    $line = fgets($fp);

    $line = preg_replace_callback(
        '/[\s\S]*?process1[\s\S]*?msg=([\s\S]*)/',
        function ($matches) {
            return $matches[1];
        },
        $line
    );
    echo $line . "<br>";

    ob_flush();
    flush();
}
fclose($fp);
echo time()-$st;