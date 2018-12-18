<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('isEmpty'))
{
    /**
     * Check is Empty
     * @param string $input
     * @return bool
     */
    function isEmpty($input = '')
    {
        $isset = isset($input);
        if ($isset === true)
        {
            return empty($input) ? true : false;
        }
        return true;
    }
}
