
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 06/06/2018
 * Time: 8:42 SA
 */

class Config extends MX_Controller
{
    public $modules_class;
    public $modules_name;
    public $modules_link;
    public $modules_action;

    /*
     * Config constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('config_model');

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
        $this->modules_name = 'Cấu hình';
        $this->modules_link = config_item('modules_url_backend_cms_web_tung_van_config');
        $this->modules_temp = 'config/';
        $this->_uploads_path = 'uploads/';

    }

    /*
     * trang index
     */
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
                    'config_model'
                ));
                //mảng data lưu thông tin truyền sang view
                $data = array();
                $data['title']      = 'Danh sách cấu hình';
                $data['type']       = $this->input->get_post('type', TRUE);
                $data['label']      = $this->input->get_post('label', TRUE);
                $data['max_results']= $this->input->get_post('max_results', TRUE);
                $data['page']       = $this->input->get_post('page', TRUE);

                // add action to dashboard
                $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'index', $data);

                // Filter: type
                if ($data['type'] === null || $data['type'] == 'select_type') {
                    $data['is_type'] = '';
                    $type_code = null;
                } else {
                    $data['is_type'] = intval($data['type']);
                    $type_code = intval($data['type']);
                }
                // Filter: label
                if ($data['label'] === null || empty($data['label'])) {
                    $data['is_label'] = '';
                    $label_code       = null;
                } else {
                    $data['is_label'] = ($data['label']);
                    $label_code       = ($data['label']);
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

                $data['item_lists']   = $this->config_model->get_result($max_results_code, $page_results_code,$label_code, $type_code);
                $data['count_result'] = $this->config_model->get_result($max_results_code, $page_results_code,$label_code, $type_code,  true);

                // GET Data
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->modules_temp . 'index',
                    'data' => $data
                ));

            }
        }
    }

    /*
     * Trang thêm mới config
     */
    public function create(){
        if (!$this->_user_roles_id)
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->assets_header = config_item('template_cms_libraries') . 'form_widget_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'form_widget_bottom';

                if ($this->input->post('Create_new_Items', true) == config_item('confirm_key_create')) {
                    $array              = array();
                    $array['id']        = $this->input->post('id',TRUE);
                    $array['label']     = $this->input->post('label', TRUE);
                    $array['type']      = $this->input->post('type', TRUE);
                    $array['value']     = $this->input->post('value', TRUE);

                    //gan tung gia tri vao tung mang rieng
                    //them nhieu option cung luc
                    for ($count = 0; $count < count($array['id']); $count++) {
                        $data               = array();
                        $data['id']         = $array['id'][$count];
                        $data['label']      = $array['label'][$count];
                        $data['type']       = $array['type'][$count];
                        $data['value']      = $array['value'][$count];

                        // add action to dashboard
                        $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'index', $data);
                        //add to database
                        $create_id          = $this->config_model->add($data);
                    }
                    $this->session->set_flashdata('notice_action_flashdata', 'Thêm mới cấu hình ' . $data['id'] . ' thành công');
                    redirect($this->modules_link);
                    // Debug
                    log_message('debug', 'Add Config: ' . $create_id);
                }
            }
        }
        $data                = array();
        $this->modules_class = get_class($this);
        $data['title']       = "Thêm mới cấu hình";
        $this->load->view(config_item('template_cms_master_layout'), array(
            'sub' => $this->modules_temp .'create',
            'data' => $data
        ));
    }

    public function edit($id = ''){
//        var_dump($id); die();
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->assets_header = config_item('template_cms_libraries') . 'form_widget_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'form_widget_bottom';
                $configInfo          = $this->config_model->get_info($id);
                if ($this->input->post('Update_the_Items', true) == config_item('confirm_key_update')) {
                    $data          = array();
                    $data['label'] = $this->input->post('label', TRUE);
                    $data['type']  = $this->input->post('type', TRUE);
                    $data['value'] = $this->input->post('value', TRUE);
                    // add action to dashboard
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'edit', $data);
                    $data_id       = $this->config_model->update($configInfo->id, $data);
                    // Debug
                    log_message('debug', 'Update Config: ' . $configInfo->id);
                    $this->session->set_flashdata('notice_action_flashdata', 'Cập nhật thành công, ID: ' . $configInfo->id . ' - Config: ' . $configInfo->label);
                    redirect($this->modules_link);
                }
                else {
                    $data          = array();
                    // GET Data
                    $data['item']  = $configInfo;
                    //var_dump($data['item']);die;
                    $data['title'] = 'Sửa cấu hình: ' . $data['item']->label;
                    $this->load->view(config_item('template_cms_master_layout'), array(
                        'sub' => $this->modules_temp . 'edit',
                        'data' => $data
                    ));
                }
            }
        }
    }

    public function delete()
    {
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $id = $this->input->post('delete_id', true);
                $confirm_hash = $this->input->post('Delete_the_Item', true);
                // add action to dashboard
                $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'delete',  array(
                    'id_deleted'=>$id
                ));
                if ($confirm_hash == config_item('confirm_key_delete')) {
                    $result_id = $this->config_model->delete($id);

                    if ($result_id === 1) {
                        $this->session->set_flashdata('notice_action_flashdata', 'Xóa cấu hình thành công!');
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