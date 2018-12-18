<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 3/29/2017
 * Time: 1:54 PM
 */
if (!function_exists('arrayToObject'))
{
    /**
     * Convert Array to Object
     *
     * @param array $array
     * @return array|bool|stdClass
     */
    function arrayToObject($array = array())
    {
        if (!is_array($array))
        {
            return $array;
        }
        $object = new stdClass();
        if (is_array($array) && count($array) > 0)
        {
            foreach ($array as $name => $value)
            {
                $name = trim($name);
                if (!empty($name))
                {
                    $object->$name = arrayToObject($value);
                }
            }
            return $object;
        }
        return false;
    }
}
