<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/21/2017
 * Time: 7:53 PM
 */
class Logout extends MX_Controller
{
    /**
     * Logout constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    /**
     * Logout Action
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @link        /dashboard/logout.html
     * @version     1.0.1
     * @since       21/01/2017
     */
    public function index()
    {
        // Kiểm ra nếu đang đăng nhập thì sẽ Update dữ liệu vào Database
        if ($this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id'))
        {
            // Delete Session
            $this->session->sess_destroy();
        }
        redirect(config_item('modules_url_cms_login'));
    }
}
