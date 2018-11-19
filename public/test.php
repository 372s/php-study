<?php
$res = file_get_contents('php://input');
print_r($res);
// $arr = parse_str($res, $output);

// print_r($output);die;
// print_r('file_get_contents 数据是:'.$res);