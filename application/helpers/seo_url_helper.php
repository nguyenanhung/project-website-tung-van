<?php

/**
 * @Author: thaodt97
 * @Date:   2018-06-12 10:53:00
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-12 10:55:36
 */
if (!function_exists('seo_url_post')) {
    /**
     * seo_url_post
     *
     * @access      public
     * @author      Hung Nguyen <dev@nguyenanhung.com>
     * @link        http://www.nguyenanhung.com
     * @version     1.0.1
     * @since       27/12/2016
     *
     * @structure   /Danh-muc/ten-bai-viet-postHUSNNDK.html
     *
     * @param number $post_id
     * @param string $post_slugs
     * @param string $cat_slugs
     */
    function seo_url_post($post_id = '', $post_slugs = '', $cat_slugs = '')
    {
        $cms =& get_instance();
        $cms->load->helper('url');
        // Encode ID
        $url_data = html_escape($cat_slugs).'/'.html_escape($post_slugs).'-post'.encodeId_Url_byHungDEV($post_id);
        $url = site_url($url_data);
        return $url;
    }
}
