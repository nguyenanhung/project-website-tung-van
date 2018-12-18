<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 713uk13m
 * Date: 5/9/18
 * Time: 10:52
 */
if (!function_exists('seo_meta_tag_equiv'))
{
    /**
     * Seo Meta Tag equiv
     * @param array $data
     * @return string
     */
    function seo_meta_tag_equiv($data = array())
    {
        $cms =& get_instance();
        $cms->load->helper('html');
        $meta_equiv = meta(array(
            array(
                'name' => 'X-UA-Compatible',
                'content' => 'IE=edge',
                'type' => 'http-equiv'
            ),
            array(
                'name' => 'refresh',
                'content' => isset($data['refresh']['content']) ? $data['refresh']['content'] : 1800,
                'type' => 'equiv'
            ),
            array(
                'name' => 'content-language',
                'content' => 'vi',
                'type' => 'equiv'
            ),
            array(
                'name' => 'audience',
                'content' => isset($data['audience']['content']) ? $data['audience']['content'] : 'general',
                'type' => 'equiv'
            )
        ));
        return trim($meta_equiv);
    }
}
