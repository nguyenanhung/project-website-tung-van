<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 08/06/2018
 * Time: 2:52 CH
 */
class Pages extends MX_Controller{
    public $modules_class;
    public $modules_name;
    public $modules_link;
    public $modules_action;
    protected $_user_roles_id;
    protected $_user_roles_group;
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'session',
            'dashboard_recently_action',
            'menu'
        ));
        $this->load->helper(array(
            'common',
            'assets',
            'url',
            'html',
            'string',
            'form',
            'file',
            'uuid',
            'folder',
            //folder_helper:
        ));
        // Session
        $this->_user_roles_id    = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
        $this->_user_roles_group = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_group');

        $this->modules_class     = get_class($this);
        $this->modules_name      = 'Trang';
        $this->modules_link      = config_item('modules_url_backend_cms_web_tung_van_pages');
        $this->modules_temp      = 'pages/';
        $this->_uploads_path     = 'uploads/';
    }
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
                    'pages_model',
                    'tung-van/menu_model'
                ));
                $data = array();
                $data['title']       = 'Danh sách trang';
                $data['name']        = $this->input->get_post('name', TRUE);
                $data['status']      = $this->input->get_post('status', TRUE);
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
                // Filter: status
                if ($data['status'] === null || $data['status'] == 'select_status')
                {
                    $data['is_status'] = '';
                    $status_code       = null;
                }
                else
                {
                    $data['is_status'] = intval($data['status']);
                    $status_code       = intval($data['status']);
                }
                // Filter: type
                if ($data['type'] === null || $data['type'] == 'select_type')
                {
                    $data['is_type'] = '';
                    $type_code       = null;
                }
                else
                {
                    $data['is_type'] = intval($data['type']);
                    $type_code       = intval($data['type']);
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
                $data['status_lists'] = $this->pages_model->get_result_distinct('status');
                $data['type_lists']   = $this->pages_model->get_result_distinct('type');
                $data['list_menu']    = $this->menu_model->get_result_distinct('title, id, parent');
                $data['item_lists']   = $this->pages_model->get_result($max_results_code, $page_results_code, $name_code, $status_code, $type_code);
                $data['count_result'] = $this->pages_model->get_result($max_results_code, $page_results_code,$name_code, $status_code, $type_code, true);


                // GET Data
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->modules_temp . 'index',
                    'data' => $data
                ));
            }
        }
    }

    public function create(){
        if(!$this->_user_roles_id){
            redirect(config_item('modules_url_cms_login'));
        }
        else{
            //phan quyen
            if(in_array($this->_user_roles_group,config_item('cms_dashboard_group_content_access'))){
                $this->assets_header = config_item('template_cms_libraries') . 'form_widget_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'form_widget_bottom';
                $this->load->model(array(
                    'pages_model',
                    'tung-van/menu_model'
                ));
                if(($this->input->post('Create_new_Items', true)) == config_item('confirm_key_create')){
                    $data = array();
                    $data['name']        = $this->input->post('name', TRUE);
                    $data['uuid']        = generate_uuid_v4();
                    $data['title']       = $this->input->post('title', TRUE);
                    $data['slugs']       = $this->input->post('slugs', TRUE);
                    $data['summary']     = $this->input->post('summary', TRUE);
                    $data['content']     = $this->input->post('editor1', TRUE);
                    $data['description'] = $this->input->post('description', TRUE);
                    $data['tags']        = $this->input->post('tags', TRUE);
                    $data['source']      = $this->input->post('source', TRUE);
                    $data['type']        = $this->input->post('type', TRUE);
                    $data['status']      = $this->input->post('status', TRUE);
                    $data['menu']        = $this->input->post('menu', TRUE);
                    //check upload image
                    $check_upload        = $this->input->post('check_upload', TRUE);
                    $url_image           = $this->input->post('url_image', TRUE);
                    $data['created_by']  = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');

                    // add action to dashboard
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'index', $data);
                    // Filter: menu
                    if ($data['menu'] === null || empty($data['menu']))
                    {
                        $data['menu'] = 1;
                    }
                    else
                    {
                        $data['menu'] = intval($data['menu']);
                    }
                    // Filter: title
                    if ($data['title'] === null || empty($data['title']))
                    {
                        $data['title'] = $data['name'];
                    }
                    // Filter: slugs
                    if ($data['slugs'] === null || empty($data['slugs']))
                    {
                        $data['slugs'] = getPermalinksSEO($data['name']);
                        //getPermalinksSEO: trong url helper, ham de tao slug dua vao name
                    }
                    // Filter: summary: tom tat
                    if ($data['summary'] === null || empty($data['summary']))
                    {
                        $data['summary'] = $data['name'];
                    }
                    // Filter: content
                    if ($data['content'] === null || empty($data['content']))
                    {
                        $data['content'] = $data['name'];
                    }
                    // Filter: description
                    if ($data['description'] === null || empty($data['description']))
                    {
                        $data['description'] = $data['name'];
                    }
                    // Filter: tags
                    if ($data['tags'] === null || empty($data['tags']))
                    {
                        $data['tags'] = $data['name'];
                    }
                    // Filter: source
                    if ($data['source'] === null || empty($data['source']))
                    {
                        $data['source'] = $data['name'];
                    }
                    // Filter: type
                    if ($data['type'] === null || empty($data['type']) || $data['type'] == 'select_type')
                    {
                        $data['type'] = 2;
                    }
                    else
                    {
                        $data['type'] = intval($data['type']);
                    }
                    // Filter: status
                    if ($data['status'] === null || empty($data['status']) || $data['status'] == 'select_status')
                    {
                        $data['status'] = 1;
                    }
                    else
                    {
                        $data['status'] = intval($data['status']);
                    }

                    // check upload anh
                    if (isset($check_upload))
                    {
                        // Upload Photos
                        $config              = array();
                        $target_upload_pages = $this->_uploads_path . 'Pages/';
                        $target_upload       = $target_upload_pages . $data['slugs'] . '/'; //uploads/pages/ten_anh
                        //ham is_dir: kiem tra xem duong dan co ton tai k?, ho tro san
                        if (is_dir($target_upload) == false)
                        {
                            if(is_dir($target_upload_pages) == false)
                            {
                                //ham new_folder: trong folder_helper ,de tao folder moi neu chua co
                                new_folder($target_upload_pages);
                                new_folder($target_upload);
                            }
                            else{
                                new_folder($target_upload);
                            }
                        }
                        //
                        $config['upload_path']   = $target_upload;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF';
                        $config['encrypt_name']  = TRUE;
                        $this->load->library('upload', $config);
                        //image_lib: thu vien nay CI ho tro, dung de xu li anh, vi du nhu chinh sua kich co....
                        $this->load->library('image_lib');
                        //ham do_upload co san tron thu vien cua CI
                        //neu duoc up anh thi
                        if ($this->upload->do_upload('photo')){
                            //ham data de upload file
                            $img                      = $this->upload->data();
                            $data['photo']            = $target_upload . $img['file_name'];
                            $config['image_library']  = 'gd2';
                            $config['source_image']   = $data['photo'];
                            $config['create_thumb']   = TRUE;
                            $config['maintain_ratio'] = TRUE;
                            $config['width']          = 263;
                            $config['height']         = 198;
                            $data['thumb']            = $target_upload . $img['raw_name'] . '_thumb' . $img['file_ext'];
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                            unset($config);
                        }
                        else
                        {
                            $data['photo'] = 'assets/images/system/no_avatar.jpg';
                            $data['thumb'] = 'assets/images/system/no_avatar_100x100.jpg';
                        }
                    }
                    else
                    {
                        $data['photo'] = $url_image;
                        $data['thumb'] = $url_image;
                    }

                    // Time
                    $data['created_at'] = config_item('cf_datetime');
                    $data['updated_at'] = config_item('cf_datetime');
                    $create_id          = $this->pages_model->add($data);
                    // add action to dashboard
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'create', $data);
                    $this->session->set_flashdata('notice_action_flashdata', 'Thêm mới trang ' . $data['name'] . ' thành công.');
                    redirect($this->modules_link);

                }
                else{
                    $this->modules_class = get_class($this);
                    $data['title'] = "Thêm mới trang";
                    $data['list_menu'] = $this->menu_model->get_result_distinct('title, id, parent');
                    $this->load->view(config_item('template_cms_master_layout'), array(
                        'sub' => $this->modules_temp .'create',
                        'data' => $data
                    ));
                }
            }

        }

    }
    public function edit($id = '')
    {
        if(!$this->_user_roles_id){
            redirect(config_item('modules_url_cms_login'));
        }
        else {
            //phan quyen
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $id                  = decodeId_Url_byHungDEV($id);
                $this->assets_header = config_item('template_cms_libraries') . 'form_widget_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'form_widget_bottom';
                $this->load->model(array(
                    'pages_model',
                    'tung-van/menu_model'
                ));
                $pagesInfo = $this->pages_model->get_info($id);
                if ($this->input->post('Update_the_Items', true) == config_item('confirm_key_update')) {
                    $data = array();
                    $data['menu']        = $this->input->post('menu', TRUE);
                    $data['name']        = $this->input->post('name', TRUE);
                    $data['slugs']       = $this->input->post('slugs', TRUE);
                    $data['title']       = $this->input->post('title', TRUE);
                    $data['summary']     = $this->input->post('summary', TRUE);
                    $data['content']     = $this->input->post('editor1', TRUE);
                    $data['description'] = $this->input->post('description', TRUE);
                    $data['tags']        = $this->input->post('tags', TRUE);
                    $data['source']      = $this->input->post('source', TRUE);
                    $data['type']        = $this->input->post('type', TRUE);
                    $data['status']      = $this->input->post('status', TRUE);
                    $check_upload        = $this->input->post('check_upload', TRUE);
                    $url_image           = $this->input->post('url_image', TRUE);
                    $data['created_by']  = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
                    // add action to dashboard
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'edit', $data);

                    //Filter: menu
                    if ($data['menu'] === null || empty($data['menu']))
                    {
                        $data['menu'] = 1;
                    }
                    else
                    {
                        $data['menu'] = intval($data['menu']);
                    }
                    // Filter: title
                    if ($data['title'] === null || empty($data['title']))
                    {
                        $data['title'] = $data['name'];
                    }

                    // Filter: slugs
                    if ($data['slugs'] === null || empty($data['slugs']))
                    {
                        $data['slugs'] = getPermalinksSEO($data['slugs']);
                    }

                    // Filter: summary
                    if ($data['summary'] === null || empty($data['summary']))
                    {
                        $data['summary'] = $data['summary'];
                    }
                    // Filter: content
                    if ($data['content'] === null || empty($data['content']))
                    {
                        $data['content'] = $data['content'];
                    }
                    // Filter: description
                    if ($data['description'] === null || empty($data['description']))
                    {
                        $data['description'] = $data['description'];
                    }
                    // Filter: tags
                    if ($data['tags'] === null || empty($data['tags']))
                    {
                        $data['tags'] = $data['tags'];
                    }
                    // Filter: source
                    if ($data['source'] === null || empty($data['source']))
                    {
                        $data['source'] = $data['source'];
                    }
                    // Filter: type
                    if ($data['type'] === null || empty($data['type']) || $data['type'] == 'select_type')
                    {
                        $data['type'] = 2;
                    }
                    else
                    {
                        $data['type'] = intval($data['type']);
                    }
                    // Filter: status
                    if ($data['status'] === null || empty($data['status']) || $data['status'] == 'select_status')
                    {
                        $data['status'] = 1;
                    }
                    else
                    {
                        $data['status'] = intval($data['status']);
                    }

                    // check upload image || paste link image
                    if (isset($check_upload))
                    {
                        // Upload Photos
                        $config        = array();
                        $target_upload_pages = $this->_uploads_path . 'Pages/';
                        $target_upload = $target_upload_pages . $data['slugs'] . '/';
                        if (is_dir($target_upload) == false)
                        { if(is_dir($target_upload_pages) == false){
                            new_folder($target_upload_pages);
                            new_folder($target_upload);
                        }else{
                            new_folder($target_upload);
                        }
                        }
                        $config['upload_path']   = $target_upload;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg|GIF';
                        $config['encrypt_name']  = TRUE;
                        $this->load->library('upload', $config);
                        $this->load->library('image_lib');
                        if ($this->upload->do_upload('photo'))
                        {
                            $img                      = $this->upload->data();
                            $data['photo']            = $target_upload . $img['file_name'];
                            $config['image_library']  = 'gd2';
                            $config['source_image']   = $data['photo'];
                            $config['create_thumb']   = TRUE;
                            $config['maintain_ratio'] = TRUE;
                            $config['width']          = 263;
                            $config['height']         = 198;
                            $data['thumb']            = $target_upload . $img['raw_name'] . '_thumb' . $img['file_ext'];
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                            unset($config);
                        }
                    }
                    else
                    {
                        $data['photo'] = $url_image;
                        $data['thumb'] = $url_image;
                    }

                    // Time
                    $data['updated_at'] = config_item('cf_datetime');
                    $data_id            = $this->pages_model->update($pagesInfo->id, $data);
                    $this->session->set_flashdata('notice_action_flashdata', 'Cập nhật trang '.$pagesInfo->name.' thành công');
                    redirect($this->modules_link);
                }
                else
                {
                    $data          = array();
                    // GET Data
                    $data['item']  = $pagesInfo;
                    $data['title'] = 'Sửa trang: ' .$data['item']->name;
                    $data['list_menu'] = $this->menu_model->get_result_distinct('title, id, parent');
                   // var_dump($data['title']); die();
                    $this->load->view(config_item('template_cms_master_layout'), array(
                        'sub' => $this->modules_temp.'edit',
                        'data' => $data
                    ));

                }

            }
        }
    }
    public function delete(){
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->load->model('pages_model');
                $keyid        = $this->input->post('delete_id', true);
                $confirm_hash = $this->input->post('Delete_the_Item', true);


                if ($confirm_hash == config_item('confirm_key_delete')) {
                    $id = decodeId_Url_byHungDEV($keyid);
                    $result_id = $this->pages_model->delete($id);

                    if ($result_id === 1){
                        $this->session->set_flashdata('notice_action_flashdata', 'Xóa trang thành công!');
                    }
                    else {
                        $this->session->set_flashdata('notice_action_flashdata', 'Xóa trang không thành công!');
                    }
                    // add action to dashboard
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'delete',  array(
                        'id_deleted'=>$id
                    ));
                    // Debug
                    log_message('debug', 'Delete Service: ' . $id . ' - Result: ' . $result_id);
                }
                redirect($this->modules_link);
            }
        }

    }

    public function change_type()
    {
//        $data = array();
        $check = $this->input->server('REQUEST_METHOD');
        if($check === 'POST'){
            $get_id = $this->input->post('get_id');
            $get_type = $this->input->post('get_type');
            if($get_type == 2)
            {
                $arr_data =array(
                    'type' => '1'
                );
            }
            else
            {
                $arr_data =array(
                    'type' => '2'
                );
            }
            $this->load->model('pages_model');
            $check_update = $this->pages_model->update($get_id,$arr_data);
            $result = json_encode(array(
                'type' => $arr_data['type'],
                'check' => $check_update
            ));

            echo $result;
        }

    }

    public function change_status()
    {
//        $data = array();
        $check = $this->input->server('REQUEST_METHOD');
        if($check === 'POST'){
            $get_id = $this->input->post('get_id');
            $get_type = $this->input->post('get_type');
            if($get_type == 0)
            {
                $arr_data =array(
                    'status' => '1'
                );
            }
            else
            {
                $arr_data =array(
                    'status' => '0'
                );
            }
            $this->load->model('pages_model');
            $check_update = $this->pages_model->update($get_id,$arr_data);
            $result = json_encode(array(
                'status' => $arr_data['status'],
                'check' => $check_update
            ));
            echo $result;
        }

    }
}