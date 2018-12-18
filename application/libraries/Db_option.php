<?php

/**
 * @Author: thaodt97
 * @Date:   2018-06-21 14:19:30
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-21 14:24:37
 */
class Db_option
{
	protected $CI;
    /**
     * Db_option constructor.
     */
    public function __construct()
    {
    	$this->CI =& get_instance();
    }
    /**
     * Get Data Option
     * @param string $type
     * @return mixed
     */
    public function get_data($type = '')
    {
        $this->CI->load->driver('cache', config_item('main_cache_adapter'));
        $cache_file = GLOBAL_CACHE_PREFIX . '-' . get_class($this) . '-' . __FUNCTION__ . 'Site-Library-DB-Config-Get-Data-Config-' . md5($configId);
        $cache_ttl  = 86400;
        if (!$result = $this->CI->cache->get($cache_file))
        {
            $this->CI->load->model('tung-van/option_model');
            $result = $this->CI->config_model->get_value($type, 'type', 'name, value');
            if ($result !== null)
            {
                $this->CI->cache->save($cache_file, $result, $cache_ttl);
            }
        }
        return $result;
    }
}