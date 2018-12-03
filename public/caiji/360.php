<?php
/**
 * 360
 */
require_once __DIR__ . '/helpers.php';


$urls = array(
    'http://third.api.btime.com/News/shNews?from=so&cid=1&os=win&timestamp=12232323&c=domestic',
    'http://third.api.btime.com/News/shNews?from=so&cid=4&os=win&timestamp=12232323&c=fun',
    'http://third.api.btime.com/News/shNews?from=so&cid=12&os=win&timestamp=12232323&c=social',
    'http://third.api.btime.com/News/shNews?from=so&cid=3&os=win&timestamp=12232323&c=sport',
    'http://third.api.btime.com/News/shNews?from=so&cid=15&os=win&timestamp=12232323&c=health',
    'http://third.api.btime.com/News/shNews?from=so&cid=33&os=win&timestamp=12232323&c=education',
    'http://third.api.btime.com/News/shNews?from=so&cid=13&os=win&timestamp=12232323&c=it',
    'http://third.api.btime.com/News/shNews?from=so&cid=5&os=win&timestamp=12232323&c=science',
    'http://third.api.btime.com/News/shNews?from=so&cid=2&os=win&timestamp=12232323&c=economy',
    'http://third.api.btime.com/News/shNews?from=so&cid=24&os=win&timestamp=12232323&c=estate',
    'http://third.api.btime.com/News/shNews?from=so&cid=9&os=win&timestamp=12232323&c=car',
    'http://third.api.btime.com/News/shNews?from=so&cid=18&os=win&timestamp=12232323&c=travel',
);

foreach ($urls as $url) {
    $data = file_get_contents($url);
    $data = json_decode($data, true);
    // print_r($data);

    if (empty($data)) continue;

    foreach ($data as $row) {

        $title = $row['t'];
        $id = '360_'.$row['id'];

        // echo $id  . "<br>";

        $u = $row['u'];
        $html = file_get_contents($u);
        if (preg_match('/(<div id="content-pure"[\s\S]*?)<div data-seed="111"/', $html, $ma)) {
            $content = $ma[1];
            echo $title  . "<br>";
        } else {
            continue;
        }
        // echo $content . "<br>";
    }
}