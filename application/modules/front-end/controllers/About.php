<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 11/06/2018
 * Time: 3:57 CH
 */
class About extends MX_Controller
{
    /**
     * About constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'html',
            'url',
            'assets',
            'form',
            'common'
        ));
        $this->load->model(array(
            'option_model',
            'staff_model',
            'photo_model',
            'posts_model',
            'tung-van/menu_model'
        ));
        $this->load->library(array(
            'Db_config',
            'Db_photo',
            'ShowMenu',
            'seo'
        ));
        $this->view_template = 'about/';
        $this->web_header    = config_item('master_layout_header');
        $this->web_footer    = config_item('master_layout_footer');
    }
    /**
     * Thể hiện tại trang chủ
     */
    public function index()
    {
        $data                = array();
        //tôn chỉ hoạt động, giá trị cốt lõi, lĩnh vực hđ chính
        $data['about_us_1']  = $this->option_model->get_data_option('about_us_1',1);
//        var_dump($data['about_us_1']);die;
        //"Về chúng tôi" với đoạn text ở dưới
        $data['about_us']    = $this->option_model->get_data_option('title',1);
        //title đội ngũ sáng tạo với đoạn giới thiệu đội ngũ sang tạo
        $data['humans']      = $this->option_model->get_data_option('title',2);
        //danh sách đội ngũ sáng tạo
        $data['staff']       = $this->staff_model->get_data();
        //tile Liên hệ + dòng chữ ở dưới
        $data['contatc_us']  = $this->option_model->get_data_option('contact_us');
        //các cách liên hệ
        $data['contact']     = $this->option_model->get_data_option('contact');
        //trước nút ứng tuyển ngay
        $data['intro']       = $this->option_model->get_data_option('title',6);

        //lay so luong mems/projects/partners
        $data['members']     = $this->staff_model->count_all();
        $data['projects']    = $this->posts_model->count_all();
        $data['partners']    = $this->photo_model->get_array_photo('partner', true);
        $this->load->view($this->view_template . 'index', $data);
    }
    /**
     * Trang chi tiết
     */
    public function details()
    {
        $data                = array();
        //3 đoạn text giới thiệu
        $data['list_item']   = $this->option_model->get_data_option('web_about');
        //các thế mạnh
        $data['list_item_1'] = $this->option_model->get_data_option('activity');
        //title đội ngũ sáng tạo với đoạn giới thiệu đội ngũ sang tạo
        $data['humans']      = $this->option_model->get_data_option('title',2);

        //danh sách đội ngũ sáng tạo
        $data['staff']       = $this->staff_model->get_data();
        //danh sach logo đối tác
        $data['logo']        = $this->photo_model->get_array_photo('partner');
        //thế mạnh của chúng tôi
        $data['strength']    = $this->option_model->get_data_option('title',7);
        //lay ra Trang chủ
        $data['home']        = $this->menu_model->get_data_menu('1');
        //về chúng tôi
        $data['about']       = $this->menu_model->get_data_menu('2');

        $data['site_title'] = 'Giới thiệu';
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
        $this->load->view(config_item('template_web_service') . config_item('master_layout_index'), array(
            'sub' => $this->view_template . 'details',
            'data' => $data
        ));
    }

    public function staff(){
        $this->load->view($this->view_template . 'staff');
    }
}
