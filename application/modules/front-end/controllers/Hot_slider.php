<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-02 14:51:37
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-07-07 09:33:50
 */
class Hot_slider extends MX_Controller
{
    /**
     * Hot_slider constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            'html',
            'assets',
            'seo_url'
        ));
    }
    /**
     * Slider ngoài trang chủ
     */
    public function index()
    {
        $this->load->model('posts_model');
        $data              = array();
        $data['list_item'] = $this->posts_model->get_recent_post(3, 1, null, true);
        //var_dump($data['list_item']) ;die;
        $this->load->view('slide', $data);
    }
}
