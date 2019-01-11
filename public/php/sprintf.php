<?php

// 字符串处理

echo sprintf('%09d', 3322) . "<br>"; // 十位数
echo sprintf('$req: %d; $opt: %d; number of params: %d.', 1, 2, 1) . "<br>";

echo sprintf('The %2$s contains %1$d monkeys', 1, 'd');


echo sprintf('The %2$s contains %1$d monkeys', 1, 'd');die;
echo sprintf('%.0f', 3322.1212);die;
var_dump(round(microtime(true)*1000));die;
echo intval('1 ');die;

echo sprintf('%.0f', 3322.1212); // float
echo sprintf('%.0d', 3322.1212); // int