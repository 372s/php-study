<?php

/**
 * 类导入
 * @param string $name
 * @param string $ext
 * @return mixed
 * @throws \RuntimeException
 */
function import($name, $ext = '.class.php') {
    $name = strtr($name, '.', '/');
    $file = LIB_PATH. $name . $ext;
    echo $file;
    if (! file_exists($file)) {
        throw new \RuntimeException('Error: CLASS ' . $name . ' NOT FOUND');
    } else {
        require_once $file;
    }
}

/**
 * 类导入
 * @param string $name
 * @param string $ext
 * @return mixed
 * @throws \RuntimeException
 */
function load($name, $ext = '.php') {
    return import($name, $ext);
}

/**
 * 类自动加载
 */
function class_loader() {
    spl_autoload_register(function ($class) {
        require_once CLASS_PATH. $class . CLASS_EXT;
    });
}

/**
 * 处理目录 后面 / DIRECTORY_SEPARATOR
 * @param string $path
 * @return string
 */
function parse_directory($path)
{
    if (substr($path, -1) != '/') {
        $path .= '/';
    }
    return $path;
}