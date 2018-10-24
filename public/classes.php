<?php

// 类自动加载
spl_autoload_register(function ($class) {
    include PUBLIC_PATH . '/class/' . $class . '.class.php';
});