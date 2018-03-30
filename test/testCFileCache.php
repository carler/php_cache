<?php
/**
 * Created by PhpStorm.
 * User: carler
 * Date: 2018/3/26
 * Time: 15:09
 */
require   dirname(__DIR__).'/authload.php';
use CarlerCache\CFileCache;
$config = [
    'file' => [
        'path' => '/tmp/'
    ]
];
$cache = new CFileCache($config['file']);

$key = 'test';
$value = '12312312';
$ttl = 3;
$ret = $cache->set($key, $value, $ttl);
if($ret != 0){
  echo "set success, value is $value \nttl is $ttl \n";
}
sleep(10);
$ret = $cache->get($key);
if(!empty($ret)){
    echo "get success , value is $ret \n";
}
$ret = $cache->delete($key);
if(!file_exists($config['file']['path'].$key)){
    echo 'delete file success';
}
