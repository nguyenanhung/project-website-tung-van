<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/21/2017
 * Time: 8:02 PM
 */
class Manage extends MX_Controller
{
    public $modules_class;
    public $modules_name;
    public $modules_link;
    protected $_user_roles_id;
    protected $_user_roles_group;
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
            'html',
            'string',
            'form',
            'paginations',
            'file'
        ));
        $this->_user_roles_id    = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
        $this->_user_roles_group = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_group');
        $this->view_template     = 'manage';
        $this->modules_class     = get_class($this);
        $this->modules_name      = 'Dashboard Manage';
        $this->modules_link      = config_item('modules_url_cms_manage');
       
    }
    /**
     * Module Index Manage of Dashboard CMS
     *
     * @access      public
     * @author 		Hung Nguyen <dev@nguyenanhung.com>
     * @link        /dashboard/manage.html
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
            // Phân quyền cho cấp độ Super Admin trở lên được phép truy cập
            //if (!in_array($this->_user_roles_group, config_item('cms_dashboard_group_supper_admins')))
            /**
             * Ngày 9/5/2017
             * Tạm thời chỉ phân quyền cho HungNA, TruongPD có thể view được log
             * edit by HungNA
             */
            if (!in_array($this->_user_roles_group, config_item('cms_dashboard_group_admin')))
            {
                $this->assets_header = config_item('template_cms_libraries') . 'manage_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'manage_bottom';
                $data                = array();
                $data['title']       = 'Dashboard';
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->view_template,
                    'data' => $data
                ));
            }
            else
            {
                $this->assets_header = config_item('template_cms_libraries') . 'buttons_table_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'buttons_table_bottom';
                $this->load->model(array(
                    'dashboard_recently_action_model',
                    'user_model'
                ));
                $data                = array();
                $data['user_id']     = $this->input->get_post('user_id', TRUE);
                $data['module']      = $this->input->get_post('module', TRUE);
                $data['controller']  = $this->input->get_post('controller', TRUE);
                $data['action']      = $this->input->get_post('action', TRUE);
                $data['max_results'] = $this->input->get_post('max_results', TRUE);
                $data['page']        = $this->input->get_post('page', TRUE);
                $data['begin_date']  = $this->input->get_post('begin_date', TRUE);
                $data['end_date']    = $this->input->get_post('end_date', TRUE);
                // Filter: user_id
                if ($data['user_id'] === null || empty($data['user_id']) || $data['user_id'] == 'select_user_id')
                {
                    $data['is_user_id'] = '';
                    $user_id_code       = null;
                }
                else
                {
                    $data['is_user_id'] = intval($data['user_id']);
                    $user_id_code       = intval($data['user_id']);
                }
                // Filter: module
                if ($data['module'] === null || empty($data['module']) || $data['module'] == 'select_module')
                {
                    $data['is_module'] = '';
                    $module_code       = null;
                }
                else
                {
                    $data['is_module'] = ($data['module']);
                    $module_code       = ($data['module']);
                }
                // Filter: controller
                if ($data['controller'] === null || empty($data['controller']) || $data['controller'] == 'select_controller')
                {
                    $data['is_controller'] = '';
                    $controller_code       = null;
                }
                else
                {
                    $data['is_controller'] = ($data['controller']);
                    $controller_code       = ($data['controller']);
                }
                // Filter: action
                if ($data['action'] === null || empty($data['action']) || $data['action'] == 'select_action')
                {
                    $data['is_action'] = '';
                    $action_code       = null;
                }
                else
                {
                    $data['is_action'] = ($data['action']);
                    $action_code       = ($data['action']);
                }
                // Filter: max_results
                if ($data['max_results'] == 'no_limit')
                {
                    $max_results_code       = 'no_limit';
                    $data['is_max_results'] = 75;
                }
                elseif ($data['max_results'] === NULL OR $data['max_results'] == 0)
                {
                    $max_results_code       = 75;
                    $data['is_max_results'] = 75;
                }
                else
                {
                    $data['is_max_results'] = $data['max_results'];
                    $max_results_code       = $data['max_results'];
                }
                // Filter: page_results
                if ($data['page'] === NULL OR $data['page'] == 0)
                {
                    $page_results_code       = 1;
                    $data['is_page_results'] = 1;
                }
                else
                {
                    $page_results_code       = $data['page'];
                    $data['is_page_results'] = $data['page'];
                }
                // Filter: begin_date
                if ($data['begin_date'] != '' OR !empty($data['begin_date']))
                {
                    $begin_date_code = $data['begin_date'];
                }
                else
                {
                    $begin_date_code = '';
                }
                // Filter: end_date
                if ($data['end_date'] != '' OR !empty($data['end_date']))
                {
                    $end_date_code = $data['end_date'];
                }
                else
                {
                    $end_date_code = '';
                }
                // Show Title date
                if ($begin_date_code != '' && $end_date_code != '')
                {
                    if ($begin_date_code == $end_date_code)
                    {
                        $data['by_day'] = 'Kết quả ngày: <strong>' . $begin_date_code . '</strong>';
                    }
                    else
                    {
                        $data['by_day'] = 'Từ ngày: <strong>' . $begin_date_code . '</strong> đến ngày <strong>' . $end_date_code . '</strong>';
                    }
                }
                // GET Data
                $data['user_list']       = $this->user_model->get_list_user('id, username');
                $data['module_list']     = $this->dashboard_recently_action_model->get_result_distinct('module');
                $data['controller_list'] = $this->dashboard_recently_action_model->get_result_distinct('controller');
                $data['action_list'] = $this->dashboard_recently_action_model->get_result_distinct('action');
                $data['item_lists']      = $this->dashboard_recently_action_model->get_result($max_results_code, $page_results_code, $begin_date_code, $end_date_code, $user_id_code, $module_code, $controller_code, $action_code);
                $data['count_result']    = $this->dashboard_recently_action_model->get_result($max_results_code, $page_results_code, $begin_date_code, $end_date_code, $user_id_code, $module_code, $controller_code, $action_code, true);
                $data['title']           = 'Dashboard Manage';
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => 'manage_super_admin',
                    'data' => $data
                ));
            }
        }
    }
}
