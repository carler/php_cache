<?php
/**
 * Created by PhpStorm.
 * User: ZYN
 * Date: 2018/3/26
 * Time: 14:58
 */
namespace CarlerCache;
use CarlerCache\core\ICache;
class CRedisCache implements ICache
{
    private $redis;
    private $default = [
        'host' => '127.0.0.1',
        'port' => 6307,
        'password' => '',
        'select' => 0,
    ];

    public function __construct($params = [])
    {
        if (!empty($params['host'])) {
            $this->default['host'] = $params['host'];
        }
        if (!empty($params['port'])) {
            $this->default['port'] = $params['port'];
        }
        if (!empty($params['host'])) {
            $this->default['password'] = $params['password'];
        }

        $this->redis = new \Redis ();
        $this->redis->pconnect($this->default['host'], $this->default['port'], 1);

        if (!empty($this->default['password']))
            $this->redis->auth($this->default['password']);

        $this->redis->select($this->default['select']);
    }


    public function get($key)
    {
        return $this->redis->get($key);
    }

    public function set($key, $val, $ttl)
    {
        return $this->redis->setex($key, $ttl, $val);
    }

    public function delete($key)
    {
        return $this->redis->delete($key);
    }
}