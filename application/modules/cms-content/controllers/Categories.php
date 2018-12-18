<?php
/**
 * Created by PhpStorm.
 * User: Welcome
 * Date: 6/8/2018
 * Time: 5:02 PM
 */

class Categories extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'session',
            'roles',
            'dashboard_recently_action',
            'sub_categories',
            'menu'
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
            'paginations',
            'file',
            'uuid',
            'debug',
            'date',
            'slugs',
            'folder'
        ));
        $this->load->config('config_template');
        $this->modules_class = get_class($this);
        $this->modules_name = 'Quản lý danh mục';
        $this->modules_link = 'cms-content/categories';
        $this->_uploads_path = 'uploads/';
    }

    public function index()
    {
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
//            chỉ quản trị viên mới có quyền thêm mới
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->assets_header = config_item('template_cms_libraries') . 'buttons_table_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'buttons_table_bottom';
                $this->load->model(array(
                    'categories_model',
                    'menu_model'
                    // 'group_categories_model'
                ));
                $data = array();
                $data['name'] = $this->input->get_post('name', TRUE);
                $data['status'] = $this->input->get_post('status', TRUE);
                $data['type'] = $this->input->get_post('type', TRUE);
                $data['max_results'] = $this->input->get_post('max_results', TRUE);
                $data['page'] = $this->input->get_post('page', TRUE);
                $data['begin_date'] = $this->input->get_post('begin_date', TRUE);
                $data['end_date'] = $this->input->get_post('end_date', TRUE);
                // add action to dashboard
                $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'index', $data);
                // Filter: name
                if ($data['name'] === null || empty($data['name']) || $data['name'] == 'select_name') {
                    $data['is_name'] = '';
                    $name_code = null;
                } else {
                    $data['is_name'] = strtolower($data['name']);
                    $name_code = strtolower($data['name']);
                }
                // Filter: status
                if ($data['status'] === null || $data['status'] == 'select_status') {
                    $data['is_status'] = '';
                    $status_code = null;
                } else {
                    $data['is_status'] = intval($data['status']);
                    $status_code = intval($data['status']);
                }
                // Filter: type
                if ($data['type'] === null || $data['type'] == 'select_type') {
                    $data['is_type'] = '';
                    $type_code = null;
                } else {
                    $data['is_type'] = intval($data['type']);
                    $type_code = intval($data['type']);
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
                // Filter: begin_date
                if ($data['begin_date'] != '' OR !empty($data['begin_date'])) {
                    $begin_date_code = $data['begin_date'];
                } else {
                    $begin_date_code = '';
                }
                // Filter: end_date
                if ($data['end_date'] != '' OR !empty($data['end_date'])) {
                    $end_date_code = $data['end_date'];
                } else {
                    $end_date_code = '';
                }
                // Show Title date
                if ($begin_date_code != '' && $end_date_code != '') {
                    if ($begin_date_code == $end_date_code) {
                        $data['by_day'] = 'Kết quả ngày: <strong>' . $begin_date_code . '</strong>';
                    } else {
                        $data['by_day'] = 'Từ ngày: <strong>' . $begin_date_code . '</strong> đến ngày <strong>' . $end_date_code . '</strong>';
                    }
                }
                $data['list_items'] = $this->categories_model->get_result_distinct('name');
                $data['item_lists'] = $this->categories_model->get_result($max_results_code, $page_results_code, $begin_date_code, $end_date_code, $name_code, $status_code);
                $data['count_result'] = $this->categories_model->get_result($max_results_code, $page_results_code, $begin_date_code, $end_date_code, $name_code, $status_code, true);
                $data['categories_lists'] = $this->categories_model->get_result_distinct('parent, name, id');
                //$data['list_menu'] = $this->menu_model->get_result_distinct('parent, title, id');
                //var_dump($data['group_categories_lists']); die();
                $data['title'] = ' Danh mục';
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => 'categories/index',
                    'data' => $data
                ));
            }
        }
    }

    public function create()
    {
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_admin'))) {
                $this->assets_header = config_item('template_cms_libraries') . 'form_widget_header'; //include header
                $this->assets_bottom = config_item('template_cms_libraries') . 'form_widget_bottom'; //include footer
                $this->load->model(array(
                    'categories_model',
                    'menu_model'
                ));
                if ($this->input->post('name') != null) {
                    $data = array();
                    $data['name']        = $this->input->post('name',TRUE);
                    $data['uuid']        = generate_uuid_v4();
                    $data['slugs']       = $this->input->post('slugs',TRUE);
                    $data['title']       = $this->input->post('title', TRUE);
                    $data['language']    = $this->input->post('language', TRUE);
                    $data['order_stt']   = $this->input->post('order_stt', TRUE);
                    $data['description'] = $this->input->post('description', TRUE);
                    $data['keywords']     = $this->input->post('keyword', TRUE);
                    $data['show_home']   = $this->input->post('show_home', TRUE);
                    $data['show_top']    = $this->input->post('show_top', TRUE);
                    $data['show_right']  = $this->input->post('show_right', TRUE);
                    $data['show_bottom'] = $this->input->post('show_bottom', TRUE);
                    $data['parent']      = $this->input->post('parent', TRUE);
                    $data['menu_id']        = $this->input->post('menu', TRUE);
                    $data['status']      = $this->input->post('status',TRUE);
                    $data['created_at']  = config_item('cf_datetime');
                    if ($data['title'] === null || empty($data['title']))
                    {
                        $data['title'] = $this->input->post('name');
                    }
                    // Filter: status
                    if (isset($data['status']))
                    {
                        $data['status'] = 1;
                    }
                    else
                    {
                        $data['status'] = 0;
                    }
                    // Filter: description
                    if ($data['description']  === null || empty($data['description']))
                    {
                        $data['description']  = $this->input->post('name');

                    }
                    else
                    {
                        $data['description'] = ($data['description']);
                    }
                    // Filter: keywords
                    if ($data['keywords'] === null || empty($data['keywords']))
                    {
                        $data['keywords'] = $this->input->post('name');
                    }
                    else
                    {
                        $data['keywords'] = ($data['keywords']);
                    }
                    // Filter: parent
                    if ($data['parent'] === null || empty($data['parent']) || $data['parent'] == 'select_parent')
                    {
                        $data['parent'] = 0;
                    }
                    else
                    {
                        $data['parent'] = intval($data['parent']);
                    }
                    //Filter: menu
                    if ($data['menu_id'] === null || empty($data['menu_id']) || $data['menu_id'] == 'select_menu')
                    {
                        $data['menu_id'] = 1;
                    }
                    else
                    {
                        $data['menu_id'] = intval($data['menu_id']);
                    }
                    // Filter: languages
                    if ($data['language'] === null || empty($data['language']))
                    {
                        $data['language'] = 'vietnamese';
                    }
                    else
                    {
                        $data['language'] = $data['language'];
                    }
                    // Filter: status
                    if ($data['order_stt'] === null || empty($data['order_stt']))
                    {
                        $data['order_stt'] = 0;
                    }
                    else
                    {
                        $data['order_stt'] = intval($data['order_stt']);
                    }
                    // Filter: status
                    if (isset($data['status'] ))
                    {
                        $data['status']  = 1;
                    }
                    else
                    {
                        $data['status']  = 0;
                    }
                    // Filter: show_home
                    if (isset($data['show_home']))
                    {
                        $data['show_home']  = 1;
                    }
                    else
                    {
                        $data['show_home']  = 0;
                    }
                    // Filter: show_top
                    if (isset($data['show_top']))
                    {
                        $data['show_top'] = 1;
                    }
                    else
                    {
                        $data['show_top'] = 0;
                    }
                    // Filter: show_right
                    if (isset($data['show_right']))
                    {
                        $data['show_right'] = 1;
                    }
                    else
                    {
                        $data['show_right'] = 0;
                    }
                    // Filter: show_bottom
                    if (isset($data['show_bottom']))
                    {
                        $data['show_bottom'] = 1;
                    }
                    else
                    {
                        $data['show_bottom'] = 0;
                    }
                    if ($this->categories_model->check_exists($data['slugs'], 'slugs') == 0) {
                        $insert = $this->categories_model->add($data); // trả về id mới được thêm vào csdl
                        $result = array('status' => 'Thêm thành công');
                        $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'create', $data);
                        echo json_encode($result);
                        exit();
                    } else {
                        $result = array('error' => 'Danh mục đã tồn tại');
                        echo json_encode($result);
                        exit();
                    }
                }
                $data['title'] = 'Thêm mới danh mục';
                $data['parent_lists'] = $this->categories_model->get_result_distinct('name, id, parent');
                $data['list_menu'] = $this->menu_model->get_result_distinct('title, id, parent');
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => 'categories/create',
                    'data' => $data
                ));
            } else {
                redirect(config_item('modules_url_cms_stop'));
            }
        }
    }
    public function edit($keyid = '')
    {
        if (!$this->_user_roles_id)
        {
            redirect(config_item('modules_url_cms_login'));
        }
        elseif (empty($keyid))
        {
            redirect(config_item('modules_url_cms_404'));
        }
        else
        {
            $id                  = decodeId_Url_byHungDEV($keyid);
            $this->assets_header = config_item('template_cms_libraries') . 'form_widget_header';
            $this->assets_bottom = config_item('template_cms_libraries') . 'form_widget_bottom';
            $this->load->model(array(
                'categories_model',
                'menu_model'
            ));
            $categorieInfo     = $this->categories_model->get_info($id);
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_admin')))
            {
                if ($this->input->post('Update_the_Items', true) == config_item('confirm_key_update'))
                {
                    $data                = array();
                    $data['name']        = $this->input->post('name', TRUE);
                    $data['slugs']       = $this->input->post('slugs', TRUE);
                    $data['uuid']        = generate_uuid_v4();
                    $data['status']      = $this->input->post('status', TRUE);
                    $data['title']       = $this->input->post('title', TRUE);
                    $data['description'] = $this->input->post('description', TRUE);
                    $data['language']    = $this->input->post('laguage', TRUE);
                    $data['keywords']    = $this->input->post('keywords', TRUE);
                    $data['parent']      = $this->input->post('parent', TRUE);
                    $data['menu_id']      = $this->input->post('menu', TRUE);
                    $data['order_stt']   = $this->input->post('order_stt', TRUE);
                    $data['show_home']   = $this->input->post('show_home', TRUE);
                    $data['show_top']    = $this->input->post('show_top', TRUE);
                    $data['show_right']  = $this->input->post('show_right', TRUE);
                    $data['show_bottom'] = $this->input->post('show_bottom', TRUE);
                    // Filter: title
                    if ($data['title'] === null || empty($data['title']))
                    {
                        $data['title'] = $data['name'];
                    }
                    else
                    {
                        $data['title'] = ($data['title']);
                    }
                    // Filter: status
                    if (isset($data['status']))
                    {
                        $data['status'] = 1;
                    }
                    else
                    {
                        $data['status'] = 0;
                    }
                    // Filter: description
                    if ($data['description'] === null || empty($data['description']))
                    {
                        $data['description'] = $data['name'];
                    }
                    else
                    {
                        $data['description'] = ($data['description']);
                    }
                    // Filter: keywords
                    if ($data['keywords'] === null || empty($data['keywords']))
                    {
                        $data['keywords'] = $data['name'];
                    }
                    else
                    {
                        $data['keywords'] = ($data['keywords']);
                    }
                    // Filter: parent
                    if ($data['parent'] === null || empty($data['parent']) || $data['parent'] == 'select_parent')
                    {
                        $data['parent'] = 0;
                    }
                    else
                    {
                        $data['parent'] = intval($data['parent']);
                    }
                    //Filter: menu
                    if ($data['menu_id'] === null || empty($data['menu_id']) || $data['menu_id'] == 'select_parent')
                    {
                        $data['menu_id'] = 1;
                    }
                    else
                    {
                        $data['menu_id'] = intval($data['menu_id']);
                    }
                    // Filter: language
                    if ($data['language'] === null || empty($data['language']))
                    {
                        $data['language'] = 'vietnamese';
                    }
                    else
                    {
                        $data['language'] = intval($data['language']);
                    }
                    // Filter: show_home
                    if (isset($data['show_home']))
                    {
                        $data['show_home'] = 1;
                    }
                    else
                    {
                        $data['show_home'] = 0;
                    }
                    // Filter: order_stt
                    if ($data['order_stt'] === null || empty($data['order_stt']))
                    {
                        $data['order_stt'] = 0;
                    }
                    else
                    {
                        $data['order_stt'] = intval($data['order_stt']);
                    }
                    // Filter: show_top
                    if (isset($data['show_top']))
                    {
                        $data['show_top'] = 1;
                    }
                    else
                    {
                        $data['show_top'] = 0;
                    }
                    // Filter: show_right
                    if (isset($data['show_right']))
                    {
                        $data['show_right'] = 1;
                    }
                    else
                    {
                        $data['show_right'] = 0;
                    }
                    // Filter: show_bottom
                    if (isset($data['show_bottom']))
                    {
                        $data['show_bottom'] = 1;
                    }
                    else
                    {
                        $data['show_bottom'] = 0;
                    }
                    // check upload image || paste link image
                    // Time
                    $data['updated_at'] = config_item('cf_datetime');
                    $create_id          = $this->categories_model->update($categorieInfo->id, $data);
                    // add action to dashboard
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'edit', $data);
                    $this->session->set_flashdata('notice_action_flashdata', 'Cập nhật danh mục ' . $data['name'] . ' thành công.');
                    redirect($this->modules_link);
                }
                else
                {
                    $data                 = array();
                    // GET Data
                    $data['parent_lists'] = $this->categories_model->get_result_distinct('name, id, parent');
                    $data['list_menu'] = $this->menu_model->get_result_distinct('title, id, parent');
                    $data['item']         = $categorieInfo;
                    $data['title']        = 'Sửa danh mục: ' . $data['item']->name;
                    $this->load->view(config_item('template_cms_master_layout'), array(
                        'sub' => 'categories/edit',
                        'data' => $data
                    ));
                }
            }
            else
            {
                redirect(config_item('modules_url_cms_stop'));
            }
        }
    }
    public function delete()
    {
        if (!$this->_user_roles_id)
        {
            redirect(config_item('modules_url_cms_login'));
        }
        else
        {
            // check quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_admin')))
            {
                $keyid        = $this->input->get_post('delete_id', true);
                $confirm_hash = $this->input->get_post('Delete_the_Item', true);
                if ($confirm_hash == config_item('confirm_key_delete'))
                {
                    $id = decodeId_Url_byHungDEV($keyid);
                    $this->load->model('categories_model');
                    $result_id = $this->categories_model->delete($id);
                    //var_dump($result_id);die();
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'delete', array(
                        'id_deleted' => $id
                    ));
                }
                $this->session->set_flashdata('notice_action_flashdata', 'Xóa danh mục thành công');
                redirect($this->modules_link);
            }
            else
            {
                redirect(config_item('modules_url_cms_stop'));
            }
        }
    }
    public function change_status()
    {
        $data = array();
        $this->load->model(array(
            'categories_model'
        ));
        $check = $this->input->server('REQUEST_METHOD');
        if($check === 'POST'){
            $get_id = $this->input->post('get_id');
            $get_type = $this->input->post('get_type');
            if($get_type == 1)
            {
                $arr_data =array(
                    'status' => '2'
                );
            }
            else
            {
                $arr_data =array(
                    'status' => '1'
                );
            }
            $check_update = $this->categories_model->update($get_id,$arr_data);
            $result = json_encode(array(
                'status' => $arr_data['status'],
                'check' => $check_update
            ));
            echo $result;
        }
    }
}
