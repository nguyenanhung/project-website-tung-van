<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 13/06/2018
 * Time: 3:10 CH
 */
class Option extends MX_Controller{
    public $modules_class;
    public $modules_name;
    public $modules_link;
    public $modules_action;
    protected $_user_roles_id;
    protected $_user_roles_group;
    /*
     * About contructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'session',
            'dashboard_recently_action'
        ));
        $this->load->helper(array(
            'common',
            'assets',
            'url',
            'html',
            'string',
            'form',
            'file',
            'folder' //folder_helper:
        ));

        // Session
        $this->_user_roles_id    = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
        $this->_user_roles_group = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_group');

        $this->load->config('config');

        $this->modules_class     = get_class($this);
        $this->modules_name      = 'Option';
        $this->modules_link      = config_item('modules_url_backend_cms_web_tung_van_option');
        $this->modules_temp      = 'options/';
        $this->_uploads_path     = 'uploads/';
    }
    /*
     * Trang index
     */
    public function index(){
        if (!$this->_user_roles_id)
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->assets_header = config_item('template_cms_libraries') . 'buttons_table_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'buttons_table_bottom';

                $this->load->model(array(
                    'dashboard_recently_action_model',
                    'options_model'
                ));
                $data = array();
                $data['title']       = 'Danh sách Option';
                $data['name']        = $this->input->get_post('name', TRUE);
                $data['value']       = $this->input->get_post('value', TRUE);
                $data['type']        = $this->input->get_post('type', TRUE);
                $data['max_results'] = $this->input->get_post('max_results', TRUE);
                $data['page']        = $this->input->get_post('page', TRUE);

                // add action to dashboard
                $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'index', $data);
                // Filter: name
                if ($data['name'] === null || empty($data['name']) || $data['name'] == 'select_name')
                {
                    $data['is_name'] = '';
                    $name_code       = null;
                }
                else
                {
                    $data['is_name'] = strtolower($data['name']);
                    $name_code       = strtolower($data['name']);
                }
                // Filter: type
                if ($data['type'] === null || $data['type'] == 'select_type')
                {
                    $data['is_type'] = '';
                    $type_code       = null;
                }
                else
                {
                    $data['is_type'] = strtolower($data['type']);
                    $type_code       = strtolower($data['type']);
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

                $data['type_lists']   = $this->options_model->get_result_distinct('type');
//                var_dump($data['type_lists']); die();
                $data['item_lists']   = $this->options_model->get_result($max_results_code, $page_results_code, $name_code, $type_code );
                $data['count_result'] = $this->options_model->get_result($max_results_code, $page_results_code, $name_code, $type_code,true);

                // GET Data
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->modules_temp . 'index',
                    'data' => $data
                ));
            }
        }
    }
    /*
     * Trang tạo mới
     */
    public function create(){
        if (!$this->_user_roles_id)
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->assets_header    = config_item('template_cms_libraries') . 'form_widget_header';
                $this->assets_bottom    = config_item('template_cms_libraries') . 'form_widget_bottom';
                $this->load->model('options_model');
                if ($this->input->post('Create_new_Items', true) == config_item('confirm_key_create')) {
                    $array              = array();
                    $array['value']     = $this->input->post('value', TRUE);
                    $array['name']      = $this->input->post('name', TRUE);
                    $array['type']      = $this->input->post('type', TRUE);
                    $array['order_stt'] = $this->input->post('order_stt', TRUE);
                    $array['icon_font'] = $this->input->post('icon_font', TRUE);

                    //gan tung gia tri vao tung mang rieng
                    //them nhieu option cung luc
                    for ($count = 0; $count < count($array['name']); $count++) {
                        $data = array();
                        $data['value']      = $array['value'][$count];
                        $data['name']       = $array['name'][$count];
                        $data['type']       = $array['type'][$count];
                        $data['order_stt']  = $array['order_stt'][$count];
                        $data['icon_font']  = $array['icon_font'][$count];

                        // var_dump($data['type']);die;
                        // add action to dashboard
                        $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'index', $data);
                        //add to database
                        $create_id          = $this->options_model->add($data);
                    }
                    $this->session->set_flashdata('notice_action_flashdata', 'Thêm mới cấu hình ' . $data['id'] . ' thành công');
                    redirect($this->modules_link);
                    // Debug
                    log_message('debug', 'Add Config: ' . $create_id);
                }
            }
        }
        $data                   = array();
        $this->modules_class    = get_class($this);
        $data['title']          = "Thêm mới option";
        $this->load->view(config_item('template_cms_master_layout'), array(
            'sub' => $this->modules_temp .'create',
            'data' => $data
        ));
    }

    /*
     * Trang chỉnh sửa
     */
    public function edit($id = ''){
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->assets_header    = config_item('template_cms_libraries') . 'form_widget_header';
                $this->assets_bottom    = config_item('template_cms_libraries') . 'form_widget_bottom';
                $this->load->model('options_model');
                $optionInfo            = $this->options_model->get_info($id);
                if ($this->input->post('Update_the_Items', true) == config_item('confirm_key_update')) {
                    $data               = array();
                    $data['value']      = $this->input->post('value', TRUE);
                    $data['name']       = $this->input->post('name', TRUE);
                    $data['type']       = $this->input->post('type', TRUE);
                    $data['order_stt']  = $this->input->post('order_stt',TRUE);
                    $data['icon_font']  = $this->input->post('icon_font',TRUE);
                    // add action to dashboard
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'edit', $data);
//                    var_dump($data);die();
                    $data_id            = $this->options_model->update($optionInfo->id, $data);
                    // Debug
                    log_message('debug', 'Update option: ' . $optionInfo->id);
                    $this->session->set_flashdata('notice_action_flashdata', 'Cập nhật thành công, ID: ' . $optionInfo->id . ' - Option: ' . $optionInfo->name);
                    redirect($this->modules_link);
                }
                else {
                    $data          = array();
                    // GET Data
                    $data['item']  = $optionInfo;
                    $data['title'] = 'Sửa option: ' . $data['item']->name;
                    $this->load->view(config_item('template_cms_master_layout'), array(
                        'sub' => $this->modules_temp . 'edit',
                        'data' => $data
                    ));
                }
            }
        }
    }

    /*
     * xóa option
     */
    public function delete()
    {
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->load->model('options_model');
                $id             = $this->input->post('delete_id', true);
                $confirm_hash   = $this->input->post('Delete_the_Item', true);
                // add action to dashboard
                $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'delete',  array(
                    'id_deleted'=>$id
                ));
                if ($confirm_hash == config_item('confirm_key_delete')) {
                    $result_id = $this->options_model->delete($id);

                    if ($result_id === 1) {
                        $this->session->set_flashdata('notice_action_flashdata', 'Xóa option thành công!');
                    } else {
                        $this->session->set_flashdata('notice_action_flashdata', 'Xóa không thành công!');
                    }
                    // Debug
                    log_message('debug', 'Delete Service: ' . $id . ' - Result: ' . $result_id);
                }
                redirect($this->modules_link);
            }
        }
    }
}