<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * get_ip_address
 * 
 * @access      public 
 * @author      Hung Nguyen <dev@nguyenanhung.com>
 * @link        http://www.nguyenanhung.com
 * @version     1.0.1
 * @since       01/06/2016
 */
if (!function_exists('get_ip_address'))
{
    function get_ip_address($convertToInteger = false)
    {
        $ip = '';
        if ($_SERVER)
        {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            elseif (isset($_SERVER['HTTP_CLIENT_IP']))
            {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            else
            {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }
        else
        {
            if (getenv('HTTP_X_FORWARDED_FOR'))
            {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
            }
            elseif (getenv('HTTP_CLIENT_IP'))
            {
                $ip = getenv('HTTP_CLIENT_IP');
            }
            else
            {
                $ip = getenv('REMOTE_ADDR');
            }
        }
        // Convert IP string to Integer
        // Example, IP: 127.0.0.1 --> 2130706433
        if ($convertToInteger)
        {
            $ip = ip2long($ip);
        }
        return $ip;
    }
}
/* End of file ip_address_helper.php */
/* Location: ./application/helpers/ip_address_helper.php */
