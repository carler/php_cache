# php_cache
composer php cache

#使用方法:

##1.下载

书写composer.json,内容如下:       
>>{       
>>>>    "require":{      
          "carler/php_cache":"dev-master",          
          "php" : ">5.3.0"      
     },         
     "minimum-stability":"dev"      
}         

##2.然后执行composer install

##3.调用Carler\CCache($param,$cache_type)

例子：<br/>
<?php <br/>
require 'vendor/autoload.php';<br/>
use CarlerCache\CCache;<br/>
$config = [<br/>
    'file' => [<br/>
        'path' => '/tmp/' <br/>
    ]   <br/>
];<br/>
$cache = new CCache($config['file'],'file');<br/>


$key = 'test';<br/>
$value = '12312312';<br/>
$ttl = 3;<br/>

$ret = $cache->set($key, $value, $ttl);<br/>

if ($ret != 0) {<br/>
    echo "set success, value is $value \nttl is $ttl \n";<br/>
}<br/>

$ret = $cache->get($key);<br/>
if (!empty($ret)) {<br/>
    echo "get success , value is $ret \n";<br/>
}<br/>

$ret = $cache->delete($key);<br/>
if (!file_exists($config['file']['path'] . $key)) {<br/>
    echo 'delete file success';<br/>
}<br/>
<br/>
redis参数：<br/>
$config = [<br/>
    'redis' => [<br/>
        'host' => '127.0.0.1',<br/>
        'port' => '9001',<br/>
        'select' => '0',<br/>
        'password' => 'redis123'<br/>
    ] <br/>   
];<br/>
<br/>
$cache = new CCache($config['redis'], 'redis');<br/>
<br/>
ssdb参数：<br/>
$config = [<br/>
    'ssdb' => [<br/>
        'host' => '127.0.0.1',      <br/>
        'port' => '8888',      <br/>
        'password' => '1234567890qwertyuiopasdfghjklzxcvbnm'   <br/>
    ]    <br/>
];<br/>

$cache = new CCache($config['ssdb'], 'ssdb');<br/>

###然后调用方式：<br/>
 $cache->get($key);  //获取key值<br/>
 $cache->set($key, $val, $ttl);; //设置key 的value值 ttl是有效期 时间为秒，默认600s<br/>
 $cache->delete($key) ; //删除key值<br/>
