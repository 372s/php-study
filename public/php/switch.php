<?php


// 一系列if语句和switch语句之间的区别在于，您要比较的表达式在switch语句中只计算一次。我认为这个事实需要更多的关注

$a = 0;

if (++$a == 3) echo 3;
elseif (++$a == 2) echo 2;
elseif (++$a == 1) echo 1;
else echo "No match!";

// Outputs: 2
echo "<br>";

$a = 0;

switch (++$a) {
    case 3:
        echo 3;
        break;
    case 2:
        echo 2;
        break;
    case 1:
        echo 1;
        break;
    default:
        echo "No match!";
        break;
}

// Outputs: 1
