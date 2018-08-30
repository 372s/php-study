<?php

if (! function_exists('str_microtime')) {
    /**
     * 获取当前毫秒的时间
     */
    function str_microtime()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }
}

if (! function_exists('str_random')) {
    /**
     * 随机固定长度字符串
     */
    function str_random($length = 30) {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}
