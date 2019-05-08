<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2019/5/8
 * Time: 16:43
 */

$res= mkdir('./up2/', 0777);
var_dump($res);die;

// 递归创建文件夹
$res= mkdir('./up1/w/q', 0777, true);
var_dump($res);die;