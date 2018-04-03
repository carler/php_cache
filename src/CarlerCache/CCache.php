<?php
namespace CarlerCache;

class CCache
{
    private $instance;

    public function __construct($params = [], $cache_type = 'file')
    {
        switch ($cache_type) {
            case 'redis':
                if (!extension_loaded('redis')) {
                    print_r("no extension of redis");
                    return FALSE;
                }
                $this->instance = new CRedisCache($params);
                break;
            case 'file':
                $this->instance = new  CFileCache($params);
                break;
            case 'ssdb':
                $this->instance = new  CSsdbCache($params);
                break;
            default:
                return FALSE;
        }
        return $this->instance;
    }

    public function get($key)
    {
        return $this->instance->get($key);
    }

    public function set($key, $value, $ttl = 360, $mode = 'wb')
    {
        return $this->instance->set($key, $value, $ttl, $mode);
    }

    public function delete($key)
    {
        return $this->instance->delete($key);
    }

}

