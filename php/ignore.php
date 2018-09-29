<?php

var_dump(connection_aborted());
// if (connection_aborted()){
//     die ("Script was aborted by the user.");
// }

/**
 * 主动断开与客户端浏览器的连接
 * 如果是 Nginx 服务器需要输出大于等于 fastcgi_buffer_size 缓存的数据才能即时输出 header 断开连接, 若还是不行可尝试关闭 gzip
 * 如: fastcgi_buffer_size 64k; 即: 需要 64*1024 字符(可多不可少),
 * 可使用 str_repeat(' ', 65536); 另外 str_repeat('          ', 6554); 这种方式其实生成速度更慢
 * @param null|string $str 当前输出的内容, 若无需输出则设置为空
 */
function connectionClose($str = null)
{
    $str = ob_get_contents() . $str; // 若实际输出内容长度小于该值将可能导致主动断开失败
    header('Content-Length: ' . strlen($str));
    header('Connection: Close');
    ob_start();
    echo $str;
    ob_flush();
    flush();
}

connectionClose();
