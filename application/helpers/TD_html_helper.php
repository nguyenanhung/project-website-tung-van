<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 713uk13m
 * Date: 5/4/18
 * Time: 11:52
 */
if (!function_exists('meta_property'))
{
    /**
     * Generates property tags from an array of key/values
     *
     * @param string $property
     * @param string $content
     * @param string $type
     * @param string $newline
     * @return string
     */
    function meta_property($property = '', $content = '', $type = 'property', $newline = "\n")
    {
        // Since we allow the data to be passes as a string, a simple array
        // or a multidimensional one, we need to do a little prepping.
        if (!is_array($property))
        {
            $property = array(
                array(
                    'property' => $property,
                    'content' => $content,
                    'type' => $type,
                    'newline' => $newline
                )
            );
        }
        elseif (isset($property['property']))
        {
            // Turn single array into multidimensional
            $property = array(
                $property
            );
        }
        $str = '';
        foreach ($property as $meta)
        {
            $type     = (isset($meta['type']) && $meta['type'] !== 'property') ? 'itemprop' : 'property';
            $property = isset($meta['property']) ? $meta['property'] : '';
            $content  = isset($meta['content']) ? $meta['content'] : '';
            $newline  = isset($meta['newline']) ? $meta['newline'] : "\n";
            $str .= '<meta ' . $type . '="' . $property . '" content="' . $content . '" />' . $newline;
        }
        return $str;
    }
}
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
if (!function_exists('clean_title'))
{
    /**
     * Clean Title
     * @param string $str
     * @return string
     */
    function clean_title($str = '')
    {
        $str = html_escape($str);
        $str = strip_tags($str);
        return trim($str);
    }
}
if (!function_exists('placeholder_img'))
{
    /**
     * Render Placeholder Image
     * @param string $size
     * @param string $background_color
     * @param string $text_color
     * @param string $text
     * @return string
     */
    function placeholder_img($size = '300x250', $background_color = '', $text_color = '', $text = '')
    {
        if (!empty($background_color))
        {
            $background_color = '/' . $background_color;
        }
        if (!empty($text_color))
        {
            $text_color = '/' . $text_color;
        }
        if (!empty($text))
        {
            $text = '/' . $text;
        }
        $link = 'http://via.placeholder.com/' . trim($size) . trim($background_color) . trim($text_color) . trim($text);
        $html = '<img src="' . $link . '">';
        return $html;
    }
}
