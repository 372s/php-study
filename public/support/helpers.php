<?php

if (!function_exists('str_microtime')) {
    /**
     * 获取当前毫秒的时间
     */
    function format_microtime()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }
}

if (!function_exists('str_random')) {
    /**
     * 随机固定长度字符串
     * @param int $length
     * @param int $type
     * @return string
     */
    function str_random($length = 30, $type = 1)
    {
        if ($type == 1) {
            $pool = '0123456789';
        } else if ($type == 2) {
            $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } else if ($type == 3) {
            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } else {
            return 1;
        }
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}
