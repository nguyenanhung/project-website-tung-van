<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 8/9/2017
 * Time: 3:27 PM
 */
if (!function_exists('iso_8601_utc_time'))
{
    /**
     * ISO Time
     * @return string
     */
    function iso_8601_utc_time()
    {
        date_default_timezone_set('Zulu');
        $datetime = new DateTime("NOW");
        return $datetime->format("Y-m-d\TH:i:s\Z");
    }
}
