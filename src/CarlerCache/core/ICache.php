<?php
namespace CarlerCache\core;
/**
 * Created by PhpStorm.
 * User: carler
 * Date: 2018/3/26
 * Time: 12:03
 */
interface ICache
{
    public function get($key);

    public function set($key, $val, $ttl);

    public function delete($key);
}

