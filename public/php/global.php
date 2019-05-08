<?php

// 全局变量使用  定义一个变量，在一个方法中定义它为全局变量
$arr = [1,2,3];
function setArr() {
    global $arr;
    $arr[0] = 4;
}
setArr();
var_dump($arr);die;