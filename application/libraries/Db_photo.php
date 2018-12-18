<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-22 14:17:12
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-22 14:27:16
 */
class Db_photo
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
        $cache_file = GLOBAL_CACHE_PREFIX . '-' . get_class($this) . '-' . __FUNCTION__ . 'Site-Library-DB-Photo-Get-Data-Photo-' . md5($type);
        $cache_ttl  = 86400;
        if (!$result = $this->CI->cache->get($cache_file))
        {
            $this->CI->load->model('tung-van/photo_model');
            $result = $this->CI->photo_model->get_value($type, 'type', 'photo');
            if ($result !== null)
            {
                $this->CI->cache->save($cache_file, $result, $cache_ttl);
            }
        }
        return $result;
    }
}