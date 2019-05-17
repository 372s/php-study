<?php
require __DIR__.'/autoload.php';

/**
 * 获取文件夹内文件
 */
use Symfony\Component\Finder\Finder;

$finder = Finder::create()->files()->ignoreDotFiles(true)->in(dirname(__FILE__))->depth(0);
print_r($finder);die;

$arr = [];
foreach ($finder as $key => $file) {
    $arr[$key]['getPathName'] = $file->getPathName();

    // dumps the absolute path
    $arr[$key]['getRealPath'] = $file->getRealPath();

    // dumps the relative path to the file, omitting the filename
    $arr[$key]['getRelativePath'] = $file->getRelativePath();

    // dumps the relative path to the file
    $arr[$key]['getRelativePathname'] = $file->getRelativePathname();
}
print_r($arr);die;

$arr = iterator_to_array(
    Finder::create()->files()->ignoreDotFiles(true)->in(dirname(__FILE__))->depth(0),
    false
);
$arr = array_map(function($file) {
    return $file->getPathName();
}, $arr);
print_r($arr);die;
