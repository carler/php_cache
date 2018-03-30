# php_cache
composer php cache

使用方法:

1.下载

书写composer.json,内容如下:
{
    "require":{
        "carler/php_cache":"dev-master",
        "php" : ">5.3.0"
    },
    "minimum-stability":"dev"
}

2.然后执行composer install

3.调用Carler\CCache($param,$cache_type)

例子：
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


redis参数：

$config = [

    'redis' => [
    
        'host' => '127.0.0.1',
        
        'port' => '9001',
        
        'select' => '0',
        
        'password' => 'redis123'
        
    ]
    
];

$cache = new CCache($config['redis'], 'redis');

ssdb参数：

$config = [

    'ssdb' => [
    
        'host' => '127.0.0.1',
        
        'port' => '8888',
        
        'password' => '1234567890qwertyuiopasdfghjklzxcvbnm'
        
    ]
    
];

$cache = new CCache($config['ssdb'], 'ssdb');

然后调用方式：

 $cache->get($key);  //获取key值
 
 $cache->set($key, $val, $ttl);; //设置key 的value值 ttl是有效期 时间为秒，默认600s
 
 $cache->delete($key) ; //删除key值
