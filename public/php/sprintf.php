<?php

// 字符串处理

echo sprintf('%09d', 3322) . "<br>"; // 十位数 000003322

echo sprintf('$req: %d; $opt: %d; number of params: %d.', 1, 2, 1) . "<br>"; // $req: 1; $opt: 2; number of params: 1.

echo sprintf('The %2$s contains %1$d monkeys', 1, 'd') . "<br>"; // The d contains 1 monkeys

echo sprintf('%.0f', 3322.1212) . "<br>"; // 3322

echo round(microtime(true)*1000) . "<br>"; // 1559121870290

echo intval('1 ') . "<br>"; // 1

echo sprintf('%.0f', 3322.1212) . "<br>"; // float 3322

echo sprintf('%.0d', 3322.1212) . "<br>"; // int 3322