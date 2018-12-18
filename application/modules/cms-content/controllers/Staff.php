<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 14/06/2018
 * Time: 10:51 SA
 */
class Staff extends MX_Controller{
    public $modules_class;
    public $modules_name;
    public $modules_link;
    public $modules_action;
    protected $_user_roles_id;
    protected $_user_roles_group;
    /*
     * Staff constructor
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

        $this->modules_class = get_class($this);
        $this->modules_name  = 'Đội ngũ sáng tạo';
        $this->modules_link  = config_item('modules_url_backend_cms_web_tung_van_staff');
        $this->modules_temp  = 'staff/';
        $this->_uploads_path = 'uploads/';
    }
    /*
     * Index Staff
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
                    'staff_model'
                ));
                $data                = array();
                $data['title']       = 'Danh sách đội ngũ sáng tạo';
                $data['name']        = $this->input->get_post('name', TRUE);
                $data['position']    = $this->input->get_post('position', TRUE);
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
                // Filter: position
                if ($data['position'] === null || $data['position'] == 'select_position')
                {
                    $data['is_position'] = '';
                    $position_code       = null;
                }
                else
                {
                    $data['is_position'] = strtolower($data['position']);
                    $position_code       = strtolower($data['position']);
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
                $data['position_lists'] = $this->staff_model->get_result_distinct('position');

                $data['item_lists']   = $this->staff_model->get_result($max_results_code, $page_results_code, $name_code, $position_code);
                $data['count_result'] = $this->staff_model->get_result($max_results_code, $page_results_code, $name_code, $position_code, true);


                // GET Data
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->modules_temp . 'index',
                    'data' => $data
                ));
            }
        }
    }

    /*
     * Create Staff
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
                $this->load->model('staff_model');
                if(($this->input->post('Create_new_Items', true)) == config_item('confirm_key_create')){
                    $data = array();
                    $data['name']         = $this->input->post('name', TRUE);
                    $data['position']     = $this->input->post('position', TRUE);
                    $data['link_fb']      = $this->input->post('link_fb', TRUE);
                    $data['link_twitter'] = $this->input->post('link_twitter', TRUE);
                    $data['link_google']  = $this->input->post('link_google', TRUE);
                    //check upload image
                    $check_upload         = $this->input->post('check_upload', TRUE);
                    $url_image            = $this->input->post('url_image', TRUE);

                    // Filter: name
                    if ($data['name'] === null || empty($data['name']))
                    {
                        $data['name'] = $data['name'];
                    }
                    // Filter: description
                    if ($data['position'] === null || empty($data['position']))
                    {
                        $data['position'] = $data['position'];
                    }
                    // Filter: linkFB
                    if ($data['link_fb'] === null || empty($data['link_fb']))
                    {
                        $data['link_fb'] = $data['link_fb'];
                    }
                    // Filter: linkTwitter
                    if ($data['link_twitter'] === null || empty($data['link_twitter']))
                    {
                        $data['link_twitter'] = $data['link_twitter'];
                    }
                    // Filter: linkGoogle
                    if ($data['link_google'] === null || empty($data['link_google']))
                    {
                        $data['link_google'] = $data['link_google'];
                    }

                    // check upload anh
                    if (isset($check_upload))
                    {
                        // Upload Photos
                        $config              = array();
                        $target_upload_staff = $this->_uploads_path . 'Staff/';
                        $target_upload       = $target_upload_staff . '/'; //uploads/pages/ten_anh
                        //ham is_dir: kiem tra xem duong dan co ton tai k?, ho tro san
                        if (is_dir($target_upload) == false)
                        {
                            if(is_dir($target_upload_staff) == false)
                            {
                                //ham new_folder: trong folder_helper ,de tao folder moi neu chua co
                                new_folder($target_upload_staff);
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
                        $data['photo']  = $url_image;
                    }
                    $create_id          = $this->staff_model->add($data);
                    // add action to dashboard
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'create', $data);
                    $this->session->set_flashdata('notice_action_flashdata', 'Thêm mới đội ngũ sáng tạo ' . $data['name'] . ' thành công.');
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
     * Edit Staff
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
                $this->load->model('staff_model');
                $staffInfo        = $this->staff_model->get_info($id);
//                var_dump($staffInfo); die();
                if ($this->input->post('Update_the_Items', true) == config_item('confirm_key_update')) {
                    $data = array();
                    $data['name']         = $this->input->post('name', TRUE);
                    $data['position']     = $this->input->post('position', TRUE);
                    $data['link_fb']      = $this->input->post('link_fb', TRUE);
                    $data['link_twitter'] = $this->input->post('link_twitter', TRUE);
                    $data['link_google']  = $this->input->post('link_google', TRUE);
                    $check_upload         = $this->input->post('check_upload', TRUE);
                    $url_image            = $this->input->post('url_image', TRUE);
                    
                    /// Filter: name
                    if ($data['name'] === null || empty($data['name']))
                    {
                        $data['name'] = $data['name'];
                    }
                    // Filter: description
                    if ($data['position'] === null || empty($data['position']))
                    {
                        $data['position'] = $data['position'];
                    }
                    // Filter: linkFB
                    if ($data['link_fb'] === null || empty($data['link_fb']))
                    {
                        $data['link_fb'] = $data['link_fb'];
                    }
                    // Filter: linkTwitter
                    if ($data['link_twitter'] === null || empty($data['link_twitter']))
                    {
                        $data['link_twitter'] = $data['link_twitter'];
                    }
                    // Filter: linkGoogle
                    if ($data['link_google'] === null || empty($data['link_google']))
                    {
                        $data['link_google'] = $data['link_google'];
                    }

                    // check upload image || paste link image
                    if (isset($check_upload))
                    {
                        // Upload Photos
                        $config              = array();
                        $target_upload_staff = $this->_uploads_path . 'Partners/';
                        $target_upload       = $target_upload_staff . '/';
                        if (is_dir($target_upload) == false)
                        { if(is_dir($target_upload_staff) == false){
                            new_folder($target_upload_staff);
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
                    $data_id            = $this->staff_model->update($staffInfo->id, $data);
                    $this->session->set_flashdata('notice_action_flashdata', 'Cập nhật '.$staffInfo->name.' thành công');
                    redirect($this->modules_link);
                }
                else
                {
                    $data          = array();
                    // GET Data
                    $data['item']  = $staffInfo;
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
     * Delete staff
     */
    public function delete(){
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->load->model('staff_model');
                $keyid           = $this->input->post('delete_id', true);
//                var_dump($id); die();
                $confirm_hash = $this->input->post('Delete_the_Item', true);

                if ($confirm_hash == config_item('confirm_key_delete')) {
                    $id = decodeId_Url_byHungDEV($keyid);
                    $result_id = $this->staff_model->delete($id);

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