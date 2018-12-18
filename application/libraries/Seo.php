<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 713uk13m
 * Date: 5/2/18
 * Time: 15:54
 */
use Cocur\Slugify\Slugify;
use Hashids\Hashids;
class Seo
{
    protected $CI;
    protected $hashids;
    /**
     * Seo constructor.
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->config('config_seo');
        $this->hashids = config_item('hashids');
    }
    /**
     * SEO Slugify
     * @param string $str
     * @return string
     */
    public function slugify($str = '')
    {
        $slugify = new Slugify();
        return $slugify->slugify($str);
    }
    /**
     * SEO Search Slugify
     * @param string $str
     * @return string
     */
    public function search_slugify($str = '')
    {
        $options = array(
            'separator' => '+'
        );
        $slugify = new Slugify($options);
        return $slugify->slugify($str);
    }
    /**
     * Str To English
     * @param string $str
     * @return string
     */
    public function str_to_en($str = '')
    {
        $options = array(
            'separator' => ' '
        );
        $slugify = new Slugify($options);
        return $slugify->slugify($str);
    }
    /**
     * Encode ID to String
     * @param $id
     * @return string
     */
    public function encodeId($id)
    {
        $hash = new Hashids($this->hashids['salt'], $this->hashids['minHashLength'], $this->hashids['alphabet']);
        return $hash->encode($id);
    }
    /**
     * Decode String to ID
     * @param $string
     * @return array
     */
    public function decodeId($string)
    {
        $hash   = new Hashids($this->hashids['salt'], $this->hashids['minHashLength'], $this->hashids['alphabet']);
        $decode = $hash->decode($string);
        if (count($decode) > 1)
        {
            return $decode;
        }
        return $decode[0];
    }
    /**
     * Get URL Post
     * @param string $category_slug
     * @param string $post_slug
     * @param string $post_id
     * @param string $post_type
     * @return string http://domain.com/Category-name/Post-name-postID.html
     */
    public function url_post($category_slug = '', $post_slug = '', $post_id = '', $post_type = '')
    {
        $url = site_url(trim($category_slug) . '/' . trim($post_slug) . '-post' . $this->encodeId(trim($post_id)));
        return $url;
    }
    /**
     * Get URL Page
     * @param string $page_slug
     * @param string $page_id
     * @return string http://domain.com/pages/page-slug-pageID.html
     */
    public function url_page($page_slug = '', $page_id = '')
    {
        $url = site_url('pages/' . trim($page_slug) . '-page' . $this->encodeId(trim($page_id)));
        return $url;
    }
}
