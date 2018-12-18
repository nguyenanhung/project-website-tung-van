<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-02 17:17:01
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-07-06 16:13:11
 */
class Product extends MX_Controller
{
    /**
     * Product constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'html',
            'url',
            'assets',
            'debug',
            'text'
        ));
        $this->load->model(array(
            'product_model',
            'option_model',
            'tung-van/menu_model'
        ));
        $this->load->library(array(
            'db_config',
            'db_photo',
            'ShowMenu',
            'seo'
        ));
        $this->web_header    = config_item('master_layout_header');
        $this->web_footer    = config_item('master_layout_footer');
        $this->view_template = 'product/';
    }
    /**
     * hiển thị ở Trang chủ
     */
    public function index()
    {
        $data['title']    = $this->option_model->get_data_option('title',3);
        $data['products'] = $this->product_model->get_list_product();
//        var_dump($data['services']); die();
        $this->load->view($this->view_template . 'index', $data);
    }
    /**
     * Trang chi tiết
     */
    public function details()
    {
        $data                   = array();
        $menu_id                = 5;
        $language               = 'vietnamese';
        $data['categories']     = $this->product_model->get_list_cat($menu_id,$language);
        $data['list_product']   = $this->product_model->get_list_product();

        //lay ra Trang chủ
        $data['home']           = $this->menu_model->get_data_menu('1');
        //Liên hệ
        $data['product']        = $this->menu_model->get_data_menu('4');
        //
        $data['title']          = $this->option_model->get_data_option('title',3);
        $data['site_title']     = "Sản phẩm";
        $data['site_name']      = $this->db_config->get_data('site_name');
        $data['site_slogan']    = $this->db_config->get_data('site_slogan');
        $data['meta_equiv']     = meta(array(
            array(
                'name' => 'X-UA-Compatible',
                'content' => 'IE=edge',
                'type' => 'http-equiv'
            ),
            array(
                'name' => 'content-language',
                'content' => 'vi',
                'type' => 'http-equiv'
            ),
        ));
        $data['meta_content'] = meta(array(
            array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1',
            ),
            array(
                'name' => 'robots',
                'content' => $this->db_config->get_data('Seo_robots')
            ),
            array(
                'name' => 'revisit-after',
                'content' => $this->db_config->get_data('Seo_revisit-after')
            ),
            array(
                'name' => 'description',
                'content' => $this->db_config->get_data('Site_description')
            ),
            array(
                'name' => 'keywords',
                'content' => $this->db_config->get_data('Site_keywords')
            ),
            array(
                'name' => 'coppyright',
                'content' => $this->db_config->get_data('Site_name')
            ), 
            array(
                'name' => 'generator',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'author',
                'content' => $this->db_config->get_data('Web_author')
            ),
            array(
                'name' => 'Web author',
                'content' => $this->db_config->get_data('Web_author')
            ),
            array(
                'name' => 'dc.created',
                'content' => $this->db_config->get_data('dc.created')
            ), 
            array(
                'name' => 'db.publiser',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.right.copyright',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.creator.name',
                'content' => $this->db_config->get_data('Site_name')
            ),
            array(
                'name' => 'dc.creator.mail',
                'content' => $this->db_config->get_data('Site_mail')
            ),
            array(
                'name' => 'db.identifier',
                'content' => base_url()
            ),
            array(
                'name' => 'dc.language',
                'content' => 'vi-Vn'
            ),
            array(
                'name' => 'geo.placename',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'placename')
            ),
            array(
                'name' => 'geo.region',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'region')
            ),
            array(
                'name' => 'seo.position',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'position')
            ),
            array(
                'name' => 'ICBM',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'ICBM')
            ),
        ));
        $data['meta_property'] = meta_property(array(
            array(
                'property' => 'fb:app_id',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'app_id')
            ),
            array(
                'property' => 'fb:admins',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'admins')
            ),
            array(
                'property' => 'og:locale',
                'content' => get_json_item($this->db_config->get_data('facebook_profile'), 'locale')
            ),
            array(
                'property' => 'og:type',
                'content' => 'website'
            ),
            array(
                'property' => 'og:title',
                'content' => $this->db_config->get_data('site_title')
            ),
            array(
                'property' => 'og:description',
                'content' => $this->db_config->get_data('site_description')
            ),
            array(
                'property' => 'og:url',
                'content' => base_url()
            ),
            array(
                'property' => 'og:image',
                'content' => assets_url($this->db_config->get_data('site_images'))
            ),
            array(
                'property' => 'og:image:alt',
                'content' => $this->seo->slugify($this->db_config->get_data('site_name'))
            ),
            array(
                'property' => 'og:site_name',
                'content' => $this->db_config->get_data('site_slogan')
            ),
            array(
                'property' => 'title',
                'content' => $this->db_config->get_data('site_title'),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'description',
                'content' => $this->db_config->get_data('site_slogan'),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'url',
                'content' => base_url(),
                'type' => 'itemprop'
            ),
            array(
                'property' => 'image',
                'content' => assets_url($this->db_config->get_data('site_images')),
                'type' => 'itemprop'
            )
        ));

        $this->load->view(config_item('template_web_service') . config_item('master_layout_index'), array(
            'sub' => $this->view_template . 'details',
            'data' => $data
        ));

    }
}
