<?php
/**
 * Created by PhpStorm.
 * User: ZYN
 * Date: 2018/3/26
 * Time: 14:58
 */
namespace CarlerCache;
use CarlerCache\core\ICache;
class CSsdbCache implements ICache
{
    private $ssdb;
    private $default = [
        'host' => '127.0.0.1',
        'port' => 8788,
        'password' => '',
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

        require dirname(__DIR__) . '/lib/ssdb-master/api/php/SSDB.php'; //加载ssdb api
        $this->ssdb = new \SimpleSSDB ($this->default['host'], $this->default['port']);
        if (!empty($this->default['password']))
            $this->ssdb->auth($this->default['password']);

//        $this->ssdb->select($this->default['select']);
    }


    public function get($key)
    {
        return $this->ssdb->get($key);
    }

    public function set($key, $val, $ttl)
    {
        return $this->ssdb->setx($key, $ttl, $val);
    }

    public function delete($key)
    {
        return $this->ssdb->del($key);
    }
}