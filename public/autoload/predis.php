<?php

require __DIR__.'/autoload.php';

function redis_version($info)
{
    if (isset($info['Server']['redis_version'])) {
        return $info['Server']['redis_version'];
    } elseif (isset($info['redis_version'])) {
        return $info['redis_version'];
    } else {
        return 'unknown version';
    }
}

$single_server = array(
    'host' => '127.0.0.1',
    'port' => 6379,
    'database' => 15,
);

$multiple_servers = array(
    array(
        'host' => '127.0.0.1',
        'port' => 6379,
        'database' => 15,
        'alias' => 'first',
    ),
    array(
        'host' => '127.0.0.1',
        'port' => 6380,
        'database' => 15,
        'alias' => 'second',
    ),
);

$client = new Predis\Client($single_server);

$client->mset(array('wq:foo' => 'bar', 'wq:lol' => 'wut', 'wq:dota'));
var_export($client->mget(array('foo', 'lol')));
/*
array (
  0 => 'bar',
  1 => 'wut',
)
*/

var_export($client->keys('wq*'));
/*
array (
  0 => 'nrk:foo',
  1 => 'nrk:lol',
)
*/

