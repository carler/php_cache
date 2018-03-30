<?php
namespace CarlerCache;

class CCache
{
    static $instance;

    public function __construct($params = [], $cache_type = 'file')
    {
        if (empty(self::$instance)) {
            switch ($cache_type) {
                case 'redis':
                    if (!extension_loaded('redis')) {
                        print_r("no extension of redis");
                        return FALSE;
                    }
                    self::$instance = new CRedisCache($params);
                    break;
                case 'file':
                    self::$instance = new  CFileCache($params);
                    break;
                case 'ssdb':
                    self::$instance = new  CSsdbCache($params);
                    break;
                default:
                    return FALSE;
            }
        }
        return self::$instance;
    }

    public function get($key)
    {
        return self::$instance->get($key);
    }

    public function set($key, $value, $ttl = 360, $mode = 'wb')
    {
        return self::$instance->set($key, $value, $ttl, $mode);
    }

    public function delete($key)
    {
        return self::$instance->delete($key);
    }

}

