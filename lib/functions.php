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
    $file = trim(LIB_PATH, '/') . '/' . trim($name, '/') . $ext;
    // echo $file;
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
function parse_directory($path) {
    if (substr($path, -1) != '/') {
        $path .= '/';
    }
    return $path;
}


function cache_read($file, $path = '', $iscachevar = 0) {
    if(!$path) $path = CACHE_PATH;
    $cachefile = $path.$file;
    if($iscachevar) {
        global $TEMP;
        $key = 'cache_'.substr($file, 0, -4);
        return isset($TEMP[$key]) ? $TEMP[$key] : $TEMP[$key] = @include $cachefile;
    }
    return @include $cachefile;
}

function cache_write($file, $array, $path = '') {
    if(!is_array($array)) return false;
    $array = "<?php\nreturn ".var_export($array, true).";\n";
    $cachefile = ($path ? $path : CACHE_PATH).$file;
    $strlen = file_put_contents($cachefile, $array);
    @chmod($cachefile, 0777);
    return $strlen;
}

function is_empty(&$val, $def = '') {
    return empty($val) ? $def : $val;
}