<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 15/06/2018
 * Time: 8:41 SA
 */
class Contact extends MX_Controller
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
            'common',
        ));
        $this->load->library(array(
            'Db_config',
            'Db_photo',
            'session',
            'ShowMenu',
            'form_validation',
            'seo'
        ));
        $this->load->model(array(
            'option_model',
            'comments_model',
            'photo_model',
            'tung-van/menu_model'
        ));

        $this->modules_link  = 'lien-he';
        $this->view_template = 'contact/';
        $this->web_header    = config_item('master_layout_header');
        $this->web_footer    = config_item('master_layout_footer');
    }
    /**
     * Thể hiện tại trang chủ
     */
    public function index()
    {

        $data['contact_us'] = $this->option_model->get_data_option('title',5);
        $data['message']    = $this->option_model->get_data_option('title',8);
        $this->load->view($this->view_template . 'index',$data);
    }
    /**
     * Trang chi tiết
     */
    public function details()
    {

        $data = array();
        $data['contact_us'] = $this->option_model->get_data_option('title',5);
        $data['message']    = $this->option_model->get_data_option('title',8);
        $data['banner']     = $this->photo_model->get_data_photo('banner');
        //lay ra Trang chủ
        $data['home']       = $this->menu_model->get_data_menu('1');
        //Liên hệ
        $data['contact']       = $this->menu_model->get_data_menu('7');
        $data['site_title'] = 'Liên hệ';
        $data['site_name']  = $this->db_config->get_data('site_name');
        $data['site_slogan']= $this->db_config->get_data('site_slogan');
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
    /**
     * form gửi tin nhắn
     */
    public function send_message(){
        $this->load->model('feedback_model');

        if ($this->input->get_post('Create_new_Items', true) == config_item('confirm_key_create'))
        {
            //mảng data nhận dữ liệu form gửi về bằng ajax
            $data                = array();
            $data['user_name']   = $this->input->get_post('username',TRUE);
            $data['user_email']  = $this->input->get_post('email',TRUE);
            $data['subject']     = $this->input->get_post('sub',TRUE);
            $data['msg']         = $this->input->get_post('message',TRUE);
            $data['created_at']  = config_item('cf_datetime');

            //thêm dữ liệu vào bảng feedback
            $createId            = $this->feedback_model->add($data);
            //gửi kết quả
            $result              = array(
                'check' => $createId,
                'message' => 'Gửi thành công',
            );
            echo json_encode($result);
            exit();

        }
        else{
            $this->load->view($this->view_template . 'send_message');
        }
    }
    /*
    * phần hiển thị chung cả trang index và details
    */
    public function form_contact(){
        $this->load->view($this->view_template . 'form_contact');
    }
}