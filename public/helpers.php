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

function json_encode_zh($array)
{
    if(version_compare(PHP_VERSION,'5.4.0','<')){
        $str = json_encode($array);
        $str = preg_replace_callback("#\\\u([0-9a-f]{4})#i",function($matchs){
            return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
        },$str);
        return $str;
    }else{
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}

/**
 * 创建匿名函数 和 json_encode()中文不转义处理
 * @param string $str
 * @return string
 */
function decodeUnicode($str)
{
    return preg_replace_callback('/\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
}
