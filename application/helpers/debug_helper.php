<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 713uk13m
 * Date: 5/2/18
 * Time: 15:37
 */
if (!function_exists('dump'))
{
    /**
     * Dump string
     * @param string $str
     */
    function dump($str = '')
    {
        echo "<pre>";
        var_dump($str);
        echo "</pre>";
    }
}
