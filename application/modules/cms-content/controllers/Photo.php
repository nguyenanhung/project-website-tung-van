<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 14/06/2018
 * Time: 2:58 CH
 */
class Photo extends MX_Controller{
    public $modules_class;
    public $modules_name;
    public $modules_link;
    public $modules_action;
    protected $_user_roles_id;
    protected $_user_roles_group;
    /*
     * Photo construct
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
            'uuid',
            'folder' //folder_helper:
        ));
        // Session
        $this->_user_roles_id    = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
        $this->_user_roles_group = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_group');

        $this->load->config('config');
        $this->modules_class = get_class($this);
        $this->modules_name = 'Ảnh bìa';
        $this->modules_link = config_item('modules_url_backend_cms_web_tung_van_photo');
        $this->modules_temp = 'photo/';
        $this->_uploads_path = 'uploads/';
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
                    'photo_model'
                ));
                $data                = array();
                $data['title']       = 'Danh sách ảnh bìa';
                $data['name']        = $this->input->get_post('name', TRUE);
                $data['type']      = $this->input->get_post('type', TRUE);
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
                if ($data['type'] === null || $data['position'] == 'select_type')
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
                $data['name_lists']   = $this->photo_model->get_result_distinct('name');
                $data['type_lists']   = $this->photo_model->get_result_distinct('type');
                $data['item_lists']   = $this->photo_model->get_result($max_results_code, $page_results_code, $name_code, $type_code);
                $data['count_result'] = $this->photo_model->get_result($max_results_code, $page_results_code, $name_code, $type_code, true);


                // GET Data
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->modules_temp . 'index',
                    'data' => $data
                ));
            }
        }
    }
    /*
     * Trang tạo mới photo
     */
    public function create(){
        if(!$this->_user_roles_id){
            redirect(config_item('modules_url_cms_login'));
        }
        else{
            //phan quyen
            if(in_array($this->_user_roles_group,config_item('cms_dashboard_group_content_access'))){
                $this->assets_header = config_item('template_cms_libraries') . 'form_widget_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'form_widget_bottom';
                $this->load->model('photo_model');
                if(($this->input->post('Create_new_Items', true)) == config_item('confirm_key_create')){
                    $data           = array();
                    $data['name']   = $this->input->post('name', TRUE);
                    $data['type']   = $this->input->post('type', TRUE);
                    
                    //check upload image
                    $check_upload   = $this->input->post('check_upload', TRUE);
                    $url_image      = $this->input->post('url_image', TRUE);

                    // Filter: name
                    if ($data['name'] === null || empty($data['name']))
                    {
                        $data['name'] = $data['name'];
                    }
                    // Filter: type
                    if ($data['type'] === null || empty($data['type']))
                    {
                        $data['type'] = $data['type'];
                    }
                    
                    // check upload anh
                    if (isset($check_upload))
                    {
                        // Upload Photos
                        $config              = array();
                        $target_upload_photo = $this->_uploads_path . 'Photo/';
                        $target_upload       = $target_upload_photo . '/'; //uploads/pages/ten_anh
                        //ham is_dir: kiem tra xem duong dan co ton tai k?, ho tro san
                        if (is_dir($target_upload) == false)
                        {
                            if(is_dir($target_upload_photo) == false)
                            {
                                //ham new_folder: trong folder_helper ,de tao folder moi neu chua co
                                new_folder($target_upload_photo);
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
                            $config['maintain_ratio'] = TRUE;
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                            unset($config);
                        }
                        else
                        {
                            $data['photo'] = 'assets/images/system/no_avatar.jpg';
                        }
                    }
                    else
                    {
                        $data['photo'] = $url_image;
                    }
                    $create_id          = $this->photo_model->add($data);
                    // add action to dashboard
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'create', $data);
                    $this->session->set_flashdata('notice_action_flashdata', 'Thêm mới ảnh bìa ' . $data['name'] . ' thành công.');
                    redirect($this->modules_link);

                }
                else{
                    $this->modules_class = get_class($this);
                    $data['title']       = "Thêm mới";
                    $this->load->view(config_item('template_cms_master_layout'), array(
                        'sub' => $this->modules_temp .'create',
                        'data' => $data
                    ));
                }
            }

        }
    }
    /*
     * Trang chỉnh sửa photo
     */
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
                $this->load->model('photo_model');
                $photoInfo           = $this->photo_model->get_info($id);
                if ($this->input->post('Update_the_Items', true) == config_item('confirm_key_update')) {
                    $data = array();
                    $data['name']    = $this->input->post('name', TRUE);
                    $data['type']    = $this->input->post('type', TRUE);
                    $check_upload    = $this->input->post('check_upload', TRUE);
                    $url_image       = $this->input->post('url_image', TRUE);

                    /// Filter: name
                    if ($data['name'] === null || empty($data['name']))
                    {
                        $data['name'] = $data['name'];
                    }
                    // Filter: type
                    if ($data['type'] === null || empty($data['type']))
                    {
                        $data['type'] = $data['type'];
                    }

                    // check upload image || paste link image
                    if (isset($check_upload))
                    {
                        // Upload Photos
                        $config              = array();
                        $target_upload_photo = $this->_uploads_path . 'Photo/';
                        $target_upload       = $target_upload_photo . '/';
                        if (is_dir($target_upload) == false)
                        { if(is_dir($target_upload_photo) == false){
                            new_folder($target_upload_photo);
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
                            $config['maintain_ratio'] = TRUE;
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                            unset($config);
                        }
                    }
                    else
                    {
                        $data['photo'] = $url_image;
                    }

                    $data_id           = $this->photo_model->update($photoInfo->id, $data);

                    $this->session->set_flashdata('notice_action_flashdata', 'Cập nhật '.$photoInfo->name.' thành công');
                    redirect($this->modules_link);
                }
                else
                {
                    $data          = array();
                    // GET Data
                    $data['item']  = $photoInfo;
                    $data['title'] = 'Sửa : ' .$data['item']->name;
                    $this->load->view(config_item('template_cms_master_layout'), array(
                        'sub' => $this->modules_temp.'edit',
                        'data' => $data
                    ));

                }
            }
        }
    }

    /*
     * Xóa photo
     */
    public function delete(){
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->load->model('photo_model');
                $keyid           = $this->input->post('delete_id', true);
//                var_dump($id); die();
                $confirm_hash    = $this->input->post('Delete_the_Item', true);

                if ($confirm_hash == config_item('confirm_key_delete')) {
                    $id = decodeId_Url_byHungDEV($keyid);
                    $result_id = $this->photo_model->delete($id);

                    if ($result_id === 1){
                        $this->session->set_flashdata('notice_action_flashdata', 'Xóa thành công!');
                    }
                    else {
                        $this->session->set_flashdata('notice_action_flashdata', 'Xóa không thành công!');
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
}