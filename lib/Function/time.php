<?php

if (!function_exists('str_microtime')) {
    /**
     * 获取当前毫秒级时间
     */
    function get_microtime()
    {
        return round(microtime(true)*1000);
        // 或者
        // list($t1, $t2) = explode(' ', microtime());
        // return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }
}

function check_time($date) {
    // $date = '2015-08-11 20:06:08';
    if( date('Y-m-d H:i:s', strtotime($date))  == $date ) {
        return true;
    } else {
        return false;
    }
}