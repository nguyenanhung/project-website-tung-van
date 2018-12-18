<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/23/2017
 * Time: 4:34 PM
 */
class Notify extends MX_Controller
{
    /**
     * Manage constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array(
            'common',
            'assets',
            'url',
            'html'
        ));
        $this->assets_header = config_item('template_cms_libraries') . 'manage_header';
        $this->assets_bottom = config_item('template_cms_libraries') . 'manage_bottom';
    }
    /**
     * Index of Notify Dashboard CMS
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @link        /dashboard/stop.html
     * @version     1.0.1
     * @since       21/01/2017
     */
    public function index()
    {
        if (!$this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id'))
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else
        {
            redirect(config_item('modules_url_cms_manage'));
        }
    }
    /**
     * Stop Access of Dashboard CMS
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @link        /dashboard/notify/stop.html
     * @version     1.0.1
     * @since       23/01/2017
     */
    public function stop()
    {
        if (!$this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id'))
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else
        {
            $data          = array();
            $data['title'] = 'Stop!';
            $this->load->view(config_item('template_cms_master_layout'), array(
                'sub' => 'notify_stop',
                'data' => $data
            ));
        }
    }
    /**
     * 404 of Dashboard CMS
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @link        /dashboard/notify/e404.html
     * @version     1.0.1
     * @since       23/01/2017
     */
    public function e404()
    {
        if (!$this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id'))
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else
        {
            $data          = array();
            $data['title'] = '404 - Page Not Found';
            $this->load->view(config_item('template_cms_master_layout'), array(
                'sub' => 'notify_404',
                'data' => $data
            ));
        }
    }
}
