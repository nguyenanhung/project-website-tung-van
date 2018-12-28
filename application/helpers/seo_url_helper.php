<?php

/**
 * @Author: thaodt97
 * @Date  :   2018-06-12 10:53:00
 * @Last  Modified by:   thaodt97
 * @Last  Modified time: 2018-06-12 10:55:36
 */
if (!function_exists('seo_url_post')) {
    /**
     * Function seo_url_post
     *
     * @author: 713uk13m <dev@nguyenanhung.com>
     * @time  : 2018-12-28 11:18
     *
     * @param string $post_id
     * @param string $post_slugs
     * @param string $cat_slugs
     *
     * @return string
     */
    function seo_url_post($post_id = '', $post_slugs = '', $cat_slugs = '')
    {
        $cms =& get_instance();
        $cms->load->helper('url');
        // Encode ID
        $url_data = html_escape($cat_slugs) . '/' . html_escape($post_slugs) . '-post' . encodeId_Url_byHungDEV($post_id);
        $url      = site_url($url_data);

        return $url;
    }
}
