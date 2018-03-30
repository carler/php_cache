<?php

/**
 * Created by PhpStorm.
 * User: ZYN
 * Date: 2018/3/26
 * Time: 15:46
 */
class ClassAutoloader
{
    public function __construct()
    {
        spl_autoload_register(array($this, 'loader'));
    }

    private function loader($className)
    {
//        echo 'Trying to load ', $className, ' via ', __METHOD__, "()\n";
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        include_once __DIR__ .'/src/'. $className . '.php';
    }
}

$autoloader = new ClassAutoloader();