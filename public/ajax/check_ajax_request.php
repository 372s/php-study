<?php

if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && 
    strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest"){ 
    // ajax 请求的处理方式 
    $server = $_SERVER['HTTP_X_REQUESTED_WITH']; // XMLHttpRequest
    echo json_encode(array('request' => $server));
} else { 
    // 正常请求的处理方式 
    echo json_encode(array('request' => 'not ajax request'));
}

