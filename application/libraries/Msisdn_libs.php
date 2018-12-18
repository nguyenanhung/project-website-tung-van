<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 5/23/2017
 * Time: 4:53 PM
 */
class Msisdn_libs
{
    protected $DEBUG;
    protected $CI;
    protected $list_header;
    /**
     * Msisdn_libs constructor.
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->list_header = array(
            'HTTP_MSISDN',
            'X-Wap-MSISDN',
            'msisdn',
            'MSISDN'
        );
    }
    /**
     * Get Msisdn
     * @return mixed|null
     */
    public function get_msisdn()
    {
        $from_ci = self::get_msisdn_from_header_with_ci();
        if ($from_ci === null)
        {
            $from_php = self::get_msisdn_from_header_with_php();
            return $from_php === null ? null : $from_php;
        }
        return $from_ci;
    }
    /**
     * GET Msisdn from Header with CodeIgniter
     * @return mixed|null
     */
    public function get_msisdn_from_header_with_ci()
    {
        foreach ($this->list_header as $key)
        {
            if ($this->CI->input->server($key, true) !== null)
            {
                return $this->CI->input->server($key, true);
            }
        }
        return null;
    }
    /**
     * GET Msisdn from Header with PHP
     * @return null
     */
    public function get_msisdn_from_header_with_php()
    {
        foreach ($this->list_header as $key)
        {
            if (array_key_exists($key, $_SERVER) === true)
            {
                return $_SERVER[$key];
            }
        }
        return null;
    }
}
