<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-02 17:17:01
 * @Last Modified by:   thaodt97
<<<<<<< HEAD
 * @Last Modified time: 2018-07-06 16:14:53
=======
 * @Last Modified time: 2018-06-12 08:30:21
>>>>>>> 7e749169133bd027f3414ade60d3ed1e1eb55e64
 */
class Service extends MX_Controller
{
    /**
     * Service constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'html',
            'assets',
            'url',
            'text'
        ));
        $this->load->library(array(
            'db_config',
            'Db_photo',
            'ShowMenu',
            'seo'
        ));
        $this->view_template = 'service/';
        $this->web_header    = config_item('master_layout_header');
        $this->web_footer    = config_item('master_layout_footer');
    }
    /**
     * Trang chủ
     */
    public function index()
    {
        $this->load->model('pages_model');
        $data['services'] = $this->pages_model->get_list_service();
        $this->load->view($this->view_template . 'index', $data);
    }
    /**
     * Trang list
     */
    public function service()
    {
        $this->load->model('pages_model');
        $data       = array();
        $menu_id    = 4; // ví dụ menu_id= 4  dịch vụ
        $language   = 'vietnamese'; //ngôn ngữ, ví dụ là tiếng việt

        $data['site_title'] = "Dịch vụ";
        $data['site_name']  = $this->db_config->get_data('site_name');
        $data['site_slogan'] = $this->db_config->get_data('site_slogan');
        $data['meta_equiv'] = meta(array(
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
        //danh sach cac dich vu
        $data['list_pages'] = $this->pages_model->get_list_pages($menu_id, $language);
        $this->load->view(config_item('template_web_service') . config_item('master_layout_index'), array(
            'sub' => $this->view_template . 'service',
            'data' => $data
        ));
    }
    /**
     * Trang chi tiết
     */
    public function detail()
    {
        $data = array();
        $slug = $this->uri->segment(2);
        $this->load->model('pages_model');
        $data['site_title']    = "Dịch vụ";
        $data['site_name']     = $this->db_config->get_data('site_name');
        $data['site_slogan']   = $this->db_config->get_data('site_slogan');
        $data['site_images']   = assets_url($this->db_config->get_data('site_images'));
        $data['site_author']   = get_json_item($this->db_config->get_data('googleplus_profile'), 'profile_author');
        $data['feeds_url']     = base_url('rss/index.rss');
        $data['feeds_title']   = $this->db_config->get_data('site_name');
        $data['canonical_url'] = base_url();
        $data['meta_equiv']    = meta(array(
            array(
                'name' => 'X-UA-Compatible',
                'content' => 'IE=edge',
                'type' => 'http-equiv'
            ),
            array(
                'name' => 'refresh',
                'content' => '1800',
                'type' => 'http-equiv'
            ),
            array(
                'name' => 'content-language',
                'content' => 'vi',
                'type' => 'http-equiv'
            ),
            array(
                'name' => 'audience',
                'content' => 'general',
                'type' => 'http-equiv'
            )
        ));
        $data['meta_content']  = meta(array(
            array(
                'name' => 'robots',
                'content' => $this->db_config->get_data('seo_robots')
            ),
            array(
                'name' => 'revisit-after',
                'content' => $this->db_config->get_data('seo_revisit-after')
            ),
            array(
                'name' => 'description',
                'content' => $this->db_config->get_data('site_description')
            ),
            array(
                'name' => 'keywords',
                'content' => $this->db_config->get_data('site_keywords')
            ),
            array(
                'name' => 'news_keywords',
                'content' => $this->db_config->get_data('site_keywords')
            ),
            array(
                'name' => 'copyright',
                'content' => $this->db_config->get_data('site_name')
            ),
            array(
                'name' => 'generator',
                'content' => $this->db_config->get_data('site_name')
            ),
            array(
                'name' => 'author',
                'content' => $this->db_config->get_data('web_author')
            ),
            array(
                'name' => 'web_author',
                'content' => $this->db_config->get_data('web_author')
            ),
            array(
                'name' => 'dc.created',
                'content' => $this->db_config->get_data('dc.created')
            ),
            array(
                'name' => 'dc.publisher',
                'content' => $this->db_config->get_data('site_name')
            ),
            array(
                'name' => 'dc.rights.copyright',
                'content' => $this->db_config->get_data('site_name')
            ),
            array(
                'name' => 'dc.creator.name',
                'content' => $this->db_config->get_data('site_name')
            ),
            array(
                'name' => 'dc.creator.email',
                'content' => $this->db_config->get_data('site_email')
            ),
            array(
                'name' => 'dc.identifier',
                'content' => base_url()
            ),
            array(
                'name' => 'dc.language',
                'content' => 'vi-VN'
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
                'name' => 'geo.position',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'position')
            ),
            array(
                'name' => 'ICBM',
                'content' => get_json_item($this->db_config->get_data('seo_geo_tagging'), 'ICBM')
            )
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

        $menu_id              = 4;
        $language             = 'vietnamese';
//        lấy chi tiết bài viết
        $data['page']         = $this->pages_model->get_page_detail($slug);
//        lấy danh sách các bài viết
        $data['list_pages']   = $this->pages_model->get_list_pages($menu_id, $language);
        $this->load->view(config_item('template_web_service') . config_item('master_layout_index'), array(
            'sub' => $this->view_template . 'details',
            'data' => $data
        ));
    }
    /**
     * Trang list
     *
     * @param string $categories
     */
    public function get_page_by_slug($slug = '')
    {
        $this->load->model('pages_model');
        $data              = array();
        $language          = 'vietnamese';
        $menu_id           = 4;

        //lấy danh sách các trang
        $data['list_pages']= $this->pages_model->get_list_pages($menu_id,$language);
        //lấy chi tiết trang
        $data['page'] = $this->pages_model->get_page_detail($slug);
        $this->load->view(config_item('template_web_service') . config_item('master_layout_index'), array(
            'sub' => $this->view_template . 'details',
            'data' => $data
        ));
    }
}
