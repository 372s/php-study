<?php


/**
 * 类导入
 * @param string $name
 * @param string $ext
 * @return mixed
 */
function load($name, $ext = '.php') {
    $name = strtr($name, '.', '/');
    $file = LIB_PATH. $name . $ext;
    if (! file_exists($file)) {
        echo 'Error: CLASS ' . $name . ' NOT FOUND';
        // exit();
    } else {
        require_once $file;
    }
}

/**
 * 类导入
 * @param string $name
 * @param string $ext
 * @return mixed
 */
function import($name, $ext = '.class.php') {
    $name = strtr($name, '.', '/');
    $file = LIB_PATH. $name . $ext;
    if (! file_exists($file)) {
        echo 'Error: CLASS ' . $name . ' NOT FOUND';
        // exit();
    } else {
        require_once $file;
    }
}

/**
 * 类自动加载
 */
function class_loader() {
    spl_autoload_register(function ($class) {
        require_once CLASS_PATH. $class . CLASS_EXT;
    });
}