<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 713uk13m
 * Date: 5/4/18
 * Time: 10:03
 */
class Db_config
{
    protected $CI;
    /**
     * Db_config constructor.
     */
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    /**
     * Get Data Config
     * @param string $configId
     * @return mixed
     */
    public function get_data($configId = '')
    {
        $this->CI->load->driver('cache', config_item('main_cache_adapter'));
        $cache_file = GLOBAL_CACHE_PREFIX . '-' . get_class($this) . '-' . __FUNCTION__ . 'Site-Library-DB-Config-Get-Data-Config-' . md5($configId);
        $cache_ttl  = 86400;
        if (!$result = $this->CI->cache->get($cache_file))
        {
            $this->CI->load->model('tung-van/config_model');
            $result = $this->CI->config_model->get_value($configId, 'id', 'value');
            if ($result !== null)
            {
                $this->CI->cache->save($cache_file, $result, $cache_ttl);
            }
        }
        return $result;
    }
}
