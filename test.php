<?php

require 'vendor/autoload.php';

use CarlerCache\CCache;
$config = [
    'file' => [
        'path' => '/tmp/'
    ]
];
$cache = new CCache($config['file'],'file');

$key = 'test';
$value = '12312312';
$ttl = 3;

$ret = $cache->set($key, $value, $ttl);
if ($ret != 0) {
    echo "set success, value is $value \nttl is $ttl \n";
}

$ret = $cache->get($key);
if (!empty($ret)) {
    echo "get success , value is $ret \n";
}

$ret = $cache->delete($key);
if (!file_exists($config['file']['path'] . $key)) {
    echo 'delete file success';
}

