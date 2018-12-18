<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 713uk13m
 * Date: 5/23/18
 * Time: 14:06
 */
if (!function_exists('parse_sitemap'))
{
    /**
     * Generates property tags from an array of key/values
     * @param string $loc
     * @param string $lastmod
     * @param string $type
     * @param string $newline
     * @return string
     */
    function parse_sitemap($loc = '', $lastmod = '', $type = 'property', $newline = "\n")
    {
        // Since we allow the data to be passes as a string, a simple array
        // or a multidimensional one, we need to do a little prepping.
        if (!is_array($loc))
        {
            $loc = array(
                array(
                    'loc' => $loc,
                    'lastmod' => $lastmod,
                    'type' => $type,
                    'newline' => $newline
                )
            );
        }
        elseif (isset($loc['loc']))
        {
            // Turn single array into multidimensional
            $loc = array(
                $loc
            );
        }
        $str = '';
        foreach ($loc as $meta)
        {
            $type    = (isset($meta['type']) && $meta['type'] !== 'loc') ? 'loc' : 'loc';
            $loc     = isset($meta['loc']) ? $meta['loc'] : '';
            $lastmod = isset($meta['lastmod']) ? $meta['lastmod'] : '';
            $newline = isset($meta['newline']) ? $meta['newline'] : "\n";
            $str .= "\n<sitemap>\n";
            $str .= '<' . $type . '>' . base_url($loc . '.xml') . '</loc>';
            $str .= "\n<lastmod>" . $lastmod . "</lastmod>";
            $str .= "\n</sitemap>";
            $str .= $newline;
        }
        return $str;
    }
}
