<?php

/**
 * @Author: thaodt97
 * @Date:   2018-06-13 11:43:52
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-13 11:44:04
 */
if (!function_exists('get_json_item'))
{
    /**
     * Get Item from Json String
     * @param string $json_string
     * @param string $item_output
     * @return null|string
     */
    function get_json_item($json_string = '', $item_output = '')
    {
        $result = json_decode(trim($json_string));
        if ($result !== null)
        {
            if (isset($result->$item_output))
            {
                return trim($result->$item_output);
            }
        }
        return null;
    }
}