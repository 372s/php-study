<?php

// 它们的不同之处：Closure 必须是匿名函数,  callable 同时还可以为常规函数.
function callFunc1(Closure $closure) {
    $closure();
}
 
function callFunc2(Callable $callback) {
    $callback();
}
 
function xy() {
    echo 'Hello, World!';
}
$function = function() {
    echo 'Hello, World!';
};
 
callFunc1("xy"); // Catchable fatal error: Argument 1 passed to callFunc1() must be an instance of Closure, string given
callFunc2("xy"); // Hello, World!
 
callFunc1($function); // Hello, World!
callFunc2($function); // Hello, World!
 
//从php7.1开始可以使用以下代码转换
callFunc1(Closure::fromCallable("xy"));

is_callable('functionName');
is_callable([$foo, 'bar']);//$foo->bar()
is_callable(['foo','bar']);//foo::bar()
is_callable(function(){});//closure