<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 2/18/2017
 * Time: 7:03 PM
 */
class Maintenance extends MX_Controller
{
    public $modules_class;
    public $modules_name;
    public $modules_link;
    public $modules_action;
    protected $_user_roles_id;
    protected $_user_roles_group;
    protected $_sess_username;
    protected $_uploads_path;
    protected $_allowed_types;
    /**
     * Maintenance constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'session',
            'encrypt',
            'roles',
            'dashboard_recently_action'
        ));
        // Session
        $this->_user_roles_id    = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
        $this->_user_roles_group = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_group');
        $this->_sess_username    = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_username');
        // Load Helper
        $this->load->helper(array(
            'common',
            'assets',
            'url',
            'html',
            'string',
            'form',
            'paginations',
            'folder',
            'file'
        ));
        $this->modules_class  = get_class($this);
        $this->modules_name   = 'Maintenance';
        $this->modules_link   = config_item('modules_url_cms_maintenance');
        $this->modules_temp   = 'maintenance/';
        // Uploads Configures
        $this->_uploads_path  = config_item('cf_storages_folder');
        $this->_allowed_types = config_item('cf_storages_allowed_types');
    }
    /**
     * Index of Function
     */
    public function index()
    {
        if (!$this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id'))
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else
        {
            $this->assets_header = config_item('template_cms_libraries') . 'manage_header';
            $this->assets_bottom = config_item('template_cms_libraries') . 'manage_bottom';
            $data                = array();
            $data['title']       = 'Bảo trì dữ liệu';
            $this->load->view(config_item('template_cms_master_layout'), array(
                'sub' => $this->modules_temp . 'index',
                'data' => $data
            ));
        }
    }
    /**
     * Module Clean cache
     */
    public function clean_cache()
    {
        $this->assets_header = config_item('template_cms_libraries') . 'manage_header';
        $this->assets_bottom = config_item('template_cms_libraries') . 'manage_bottom';
        if (!$this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id'))
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else
        { 
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_admin')))
            {
                $this->load->driver('cache', array(
                    'adapter' => 'apc',
                    'backup' => 'file'
                ));
                $this->cache->clean();
                $data          = array();
                $data['title'] = 'Clean Cache';
                /**
                 * Ghi log việc xóa log
                 * rảnh
                 */
                $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'clean_cache', $data);
                // Parse data to view
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->modules_temp . 'clean_cache',
                    'data' => $data
                ));
            }
            else
            {
                redirect(config_item('modules_url_cms_stop'));
            }
        }
    }
    /**
     * Module Clean Log Action
     */
    public function clean_log_action()
    {
        $this->assets_header = config_item('template_cms_libraries') . 'manage_header';
        $this->assets_bottom = config_item('template_cms_libraries') . 'manage_bottom';
        if (!$this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id'))
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else
        {
           if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_admin')))
            {
                // anh police đẹp trai đi dẹp loạn
                $police_log         = $this->dashboard_recently_action->police();
                // Parse Data
                $data               = array();
                $data['title']      = 'Clean Log Action';
                $data['log_result'] = $police_log;
                /**
                 * Ghi log việc xóa log
                 * rảnh
                 */
                $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'clean_log_action', $data);
                // Parse data to view
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->modules_temp . 'clean_log_action',
                    'data' => $data
                ));
            }
            else
            {
                redirect(config_item('modules_url_cms_stop'));
            }
        }
    }
}
