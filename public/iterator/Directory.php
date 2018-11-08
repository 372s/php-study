<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/11/8
 * Time: 18:04
 */

$path = dirname(__dir__) . '/js';

$iterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
$iterator = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);

foreach ($iterator as $item) {
    if ($item->isDir()) {
        var_dump($item->getPathname());
    }
}


// $it = new DirectoryIterator($path);
// foreach ($it as $file) {
//     //用isDot()方法分别过滤掉“.”和“..”目录
//     if (! $file->isDot() && $file->isDir()) {
//         var_dump($file->getPath(), $file->getPathname());
//         // echo $file->getFilename() . "\n" . $file->getExtension() . "<br />";
//     }
// }
