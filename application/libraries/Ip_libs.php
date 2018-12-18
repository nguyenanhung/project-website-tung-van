<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 3/15/2017
 * Time: 11:38 AM
 */
class Ip_libs
{
    protected $CI;
    protected $ip_key;
    /**
     * Ip_tools constructor.
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->ip_key = array(
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'HTTP_CLIENT_IP',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'REMOTE_ADDR'
        );
    }
    /**
     * Get IP by HA Proxy
     * @return bool|string
     */
    public function get_ip_by_ha_proxy()
    {
        $ip_keys = array(
            'HTTP_X_FORWARDED_FOR'
        );
        foreach ($ip_keys as $key)
        {
            if (array_key_exists($key, $_SERVER) === true)
            {
                foreach (explode(',', $_SERVER[$key]) as $ip)
                {
                    $ip = trim($ip);
                    if ($this->validate_ip($ip))
                    {
                        return $ip;
                    }
                }
            }
        }
        return false;
    }
    /**
     * Get IP Address
     * @param bool $convertToInteger
     * @return bool|int|string
     */
    public function ip_address($convertToInteger = false)
    {
        foreach ($this->ip_key as $key)
        {
            if (array_key_exists($key, $_SERVER) === true)
            {
                foreach (explode(',', $_SERVER[$key]) as $ip)
                {
                    $ip = trim($ip);
                    if ($this->validate_ip($ip))
                    {
                        if ($convertToInteger === true)
                        {
                            return ip2long($ip);
                        }
                        return $ip;
                    }
                }
            }
        }
        return false;
    }
    /**
     * Validate IP
     * @param $ip
     * @return bool
     */
    public function validate_ip($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false)
        {
            return false;
        }
        return true;
    }
    /**
     * Get API Infomation
     * @param string $ip
     * @return string
     */
    public function ip_infomation($ip = '')
    {
        if (empty($ip))
        {
            $ip = $this->ip_address();
        }
        $curl = new Curl\Curl();
        $curl->get('http://ip-api.com/json/' . $ip);
        $response = $curl->error ? "cURL Error: " . $curl->error_message : $curl->response;
        return $response;
    }
}
