<?php
/**
 * Created by PhpStorm.
 * User: carler
 * Date: 2018/3/26
 * Time: 15:09
 */
require   dirname(__DIR__).'/authload.php';
use CarlerCache\CSsdbCache;
$config = [
    'ssdb' => [
        'host' => '127.0.0.1',
        'port' => '8888',
        'password' => '1234567890qwertyuiopasdfghjklzxcvbnm'
    ]
];
$cache = new CSsdbCache($config['ssdb']);

$key = 'test';
$value = '12312312';
$ttl = 3;
$ret = $cache->set($key, $value, $ttl);
if($ret != 0){
    echo "set success, value is $value \nttl is $ttl \n";
}
$ret = $cache->get($key);
if(!empty($ret)){
    echo "get success , value is $ret \n";
}
$ret = $cache->delete($key);
$ret = $cache->get($key);
if (!empty($ret)) {
    echo "delete error \n";
}else{
    echo "delete success \n";
}