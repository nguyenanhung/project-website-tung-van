<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 713uk13m
 * Date: 5/17/18
 * Time: 16:33
 */
use \nguyenanhung\VnTelcoPhoneNumber\Phone_number as PhoneNumber;
class Phone_number
{
    protected $CI;
    /**
     * Phone_number constructor.
     */
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    /**
     * Format Phone Number
     * @param string $my_number
     * @param string $format
     * @return null|string
     * @throws \libphonenumber\NumberParseException
     */
    public function format($my_number = '', $format = '')
    {
        if (empty($my_number))
        {
            return null;
        }
        $phoneNumber = new PhoneNumber();
        return $phoneNumber->format($my_number, $format);
    }
    /**
     * Detect Carrier
     * @param string $my_number
     * @param bool $id
     * @return null|string
     * @throws \libphonenumber\NumberParseException
     */
    public function detect_carrier($my_number = '', $id = false)
    {
        $phoneNumber = new PhoneNumber();
        if ($id === true)
        {
            return $phoneNumber->detect_carrier($my_number, 'id');
        }
        $phoneNumber->setNormalName(true);
        return $phoneNumber->detect_carrier($my_number);
    }
}
