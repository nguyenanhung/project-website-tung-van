<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 09/07/2018
 * Time: 2:03 CH
 */
class Feedback extends MX_Controller{
    public $modules_class;
    public $modules_name;
    public $modules_link;
    public $modules_action;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('feedback_model');

        $this->load->library(array(
            'session',
            'dashboard_recently_action'
        ));
        $this->_user_roles_id = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
        $this->_user_roles_group = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_group');
        $this->load->helper(array(
            'common',
            'assets',
            'url',
            'html',
            'string',
            'form',
            'file',
            'uuid'
        ));
        $this->modules_class = get_class($this);
        $this->modules_name = 'Phản hồi';
        $this->modules_link = config_item('modules_url_backend_cms_web_tung_van_feedback');
        $this->modules_temp = 'feedback/';
        $this->_uploads_path = 'uploads/';
    }

    public function index()
    {
        if (!$this->_user_roles_id)
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->assets_header = config_item('template_cms_libraries') . 'buttons_table_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'buttons_table_bottom';
                //load model
                $this->load->model(array(
                    'dashboard_recently_action_model',
                    'feedback_model'
                ));
                //mảng data lưu thông tin truyền sang view
                $data = array();
                $data['title']      = 'Danh sách phản hồi';
                $data['type']       = $this->input->get_post('type', TRUE);
                $data['label']      = $this->input->get_post('label', TRUE);
                $data['begin_date'] = $this->input->get_post('begin_date', TRUE);
                $data['end_date']   = $this->input->get_post('end_date', TRUE);
                $data['max_results']= $this->input->get_post('max_results', TRUE);
                $data['page']       = $this->input->get_post('page', TRUE);

                // add action to dashboard
                $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'index', $data);

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

                // Filter: max_results
                if ($data['max_results'] == 'no_limit') {
                    $max_results_code = 'no_limit';
                    $data['is_max_results'] = 75;
                } elseif ($data['max_results'] === NULL OR $data['max_results'] == 0) {
                    $max_results_code = 75;
                    $data['is_max_results'] = 75;
                } else {
                    $data['is_max_results'] = $data['max_results'];
                    $max_results_code = $data['max_results'];
                }
                // Filter: page_results
                if ($data['page'] === NULL OR $data['page'] == 0) {
                    $page_results_code = 1;
                    $data['is_page_results'] = 1;
                } else {
                    $page_results_code = $data['page'];
                    $data['is_page_results'] = $data['page'];
                }

                $data['item_lists']   = $this->feedback_model->get_result($max_results_code, $page_results_code, $begin_date_code,$end_date_code);
                $data['count_result'] = $this->feedback_model->get_result($max_results_code, $page_results_code,$begin_date_code,$end_date_code,true);

                // GET Data
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->modules_temp . 'index',
                    'data' => $data
                ));

            }
        }
    }
}