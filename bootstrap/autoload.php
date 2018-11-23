<?php

require_once __DIR__ . '/ClassLoader.php';

$loader = new ClassLoader();
// register classes with namespaces
$loader->addPsr4('PHPPager\\', dirname(__DIR__).'/lib/PHPPager');



// activate the autoloader
$loader->register();
// to enable searching the include path (eg. for PEAR packages)
$loader->setUseIncludePath(true);



function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require $fileName;
}
spl_autoload_register('autoload');