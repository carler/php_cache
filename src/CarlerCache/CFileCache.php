<?php
/**
 * Created by PhpStorm.
 * User: carler
 * Date: 2018/3/26
 * Time: 12:07
 */
namespace CarlerCache;
use CarlerCache\core\ICache;
Class CFileCache implements ICache
{
    private $path = '/tmp/';

    public function __construct($params = [])
    {
        if (!empty($params['path'])) {
            $this->path = $params['path'];
        }
    }

    /*
     * @param key is file name
     * @return data or null
     * */
    public function get($key)
    {
        $file_path = $this->path . $key;
        $data = @file_get_contents($file_path);
        if (empty($data)) return null;
        $data = unserialize($data);
        $expire_time = $data['expire_time'];
        if (time() < $expire_time) {
            return $data['value'];
        }
        $this->delete($file_path);
        return null;
    }


    /*
     * @param key file name
     * @param data  string or array
     * @param ttl  expire time
     * @param mode  open file mode
     * @return false or not false
     * */
    public function set($key, $value, $ttl = 360, $mode = 'wb')
    {
        if (!$fp = @fopen($this->path . $key, $mode)) {
            return FALSE;
        }
        $data = [
            'value' => $value,
            'expire_time' => (time() + intval($ttl))
        ];
        $data = serialize($data);

        flock($fp, LOCK_EX);
        for ($result = $written = 0, $length = strlen($data);
             $written < $length; $written += $result) {
            if (($result = fwrite($fp, substr($data, $written))) === FALSE) {
                break;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        return is_int($result);
    }

    /*
    * @param key file name
     * */
    public function delete($key)
    {
        // Trim the trailing slash
        $path = rtrim($this->path . $key);
        @unlink($path);
        return (file_exists($path)) ? @rmdir($path) : TRUE;
    }


}