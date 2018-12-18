<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 27/06/2018
 * Time: 8:49 SA
 */
class Product extends MX_Controller{
    public $modules_class;
    public $modules_name;
    public $modules_link;
    public $modules_action;
    protected $_user_roles_id;
    protected $_user_roles_group;

    /*
     * Product constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'session',
            'dashboard_recently_action',
            'menu',
            'sub_categories'
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
        $this->modules_name      = 'Sản phẩm';
        $this->modules_link      = config_item('modules_url_backend_cms_web_tung_van_product');
        $this->modules_temp      = 'product/';
        $this->_uploads_path     = 'uploads/';

    }
    /*
     * Index of Cms  Products
     */
    public function index()
    {
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->assets_header = config_item('template_cms_libraries') . 'buttons_table_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'buttons_table_bottom';
                //load model
                $this->load->model(array(
                    'product_model',
                    'dashboard_recently_action_model',
                    'categories_model'
                ));

                $data = array();
                $data['title']       = 'Danh sách sản phẩm';
                $data['name']        = $this->input->get_post('name', TRUE);
                $data['categories']  = $this->input->get_post('categories',TRUE);
                $data['max_results'] = $this->input->get_post('max_results', TRUE);
                $data['page']        = $this->input->get_post('page', TRUE);
                $data['begin_date']  = $this->input->get_post('begin_date', TRUE);
                $data['end_date']    = $this->input->get_post('end_date', TRUE);

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


                // Filter: categories
                if ($data['categories'] === null || $data['categories'] == 'select_categories')
                {
                    $data['is_categories'] = '';
                    $categories_code       = null;
                }
                else
                {
                    $data['is_categories'] = intval($data['categories']);
                    $categories_code       = intval($data['categories']);
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


                $data['item_lists']   = $this->product_model->get_result($max_results_code, $page_results_code,$begin_date_code,$end_date_code, $name_code, $categories_code);
//                var_dump($data['item_lists']); die();
                $data['count_result'] = $this->product_model->get_result($max_results_code, $page_results_code,$begin_date_code,$end_date_code, $name_code, $categories_code, true);
                $data['categories_lists'] = $this->categories_model->get_result_distinct('parent, name, id');
//                var_dump($data['categories_lists']); die();
                // GET Data
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->modules_temp . 'index',
                    'data' => $data
                ));

            }
        }
    }
    /*
     * Create Products
     */
    public function create(){
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->assets_header = config_item('template_cms_libraries') . 'form_widget_header';
                $this->assets_bottom = config_item('template_cms_libraries') . 'form_widget_bottom';
                $this->load->model(array(
                    'product_model',
                    'categories_model',
                ));
                if ($this->input->post('Create_new_Items', true) == config_item('confirm_key_create'))
                {
                    $data                = array();
                    $data['name']        = $this->input->post('name', TRUE);
                    $data['summary']     = $this->input->post('summary', TRUE);
                    $data['slugs']       = $this->input->post('slugs',TRUE);
                    $data['description'] = $this->input->post('description', TRUE);
                    $data['categories']  = $this->input->post('categories', TRUE);
                    $data['link']        = $this->input->post('link',TRUE);

                    $check_upload        = $this->input->post('check_upload', TRUE);
                    $url_image           = $this->input->post('url_image', TRUE);
                    $data['created_by']  = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');

                    // Filter: slugs
                    if ($data['slugs'] === null || empty($data['slugs']))
                    {
                        $data['slugs'] = getPermalinksSEO($data['name']);
                    }
                    // Filter: summary
                    if ($data['summary'] === null || empty($data['summary']))
                    {
                        $data['summary'] = $data['title'];
                    }
                    // Filter: description
                    if ($data['description'] === null || empty($data['description']))
                    {
                        $data['description'] = $data['title'];
                    }

                    // Filter: categories
                    if ($data['categories'] === null || empty($data['categories']) || $data['categories'] == 'select_categories')
                    {
                        $data['categories'] = 0;
                    }
                    else
                    {
                        $data['categories'] = intval($data['categories']);
                    }

                    // check upload image || paste link image
                    if (isset($check_upload))
                    {
                        // Upload Photos
                        $config                 = array();
                        $target_upload_cms      = $this->_uploads_path  .'Product/';
                        $target_upload_cms_date = $target_upload_cms . date('Y-m-d') . '/';
                        $target_upload_cms_slug = $target_upload_cms_date . $data['slugs'] . '/';

                        if (is_dir($target_upload_cms_slug) === false) {
                            if (is_dir($target_upload_cms) === false) {
                                new_folder($target_upload_cms);
                                new_folder($target_upload_cms_date);
                                new_folder($target_upload_cms_slug);
                            }elseif(is_dir($target_upload_cms_date) === false){
                                new_folder($target_upload_cms_date);
                                new_folder($target_upload_cms_slug);
                            }else{
                                new_folder($target_upload_cms_slug);
                            }
                        }
                        $target_upload           = $target_upload_cms_slug;
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
                        else
                        {
                            $data['photo'] = 'assets/images/system/no_avatar.jpg';
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
                    $create_id          = $this->product_model->add($data);
                    // Debug
                    log_message('debug', 'Add Product: ' . $create_id);
                    $this->session->set_flashdata('notice_action_flashdata', 'Create Successfully, ID: ' . encodeId_Url_byHungDEV($create_id) . ' - Category: ' . $data['msisdn']);
                    redirect($this->modules_link);
                }
                else
                {
                    $data                     = array();
                    // GET Data
                    $data['categories_lists'] = $this->categories_model->get_result_distinct('name, id, parent');
                    $data['title']            = 'Thêm mới sản phẩm';
                    $this->load->view(config_item('template_cms_master_layout'), array(
                        'sub' => $this->modules_temp . 'create',
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
    /*
     * Edit Products
     */
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
        else {

            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access')))
            {
            $id                  = decodeId_Url_byHungDEV($keyid);
            $this->assets_header = config_item('template_cms_libraries') . 'form_widget_header';
            $this->assets_bottom = config_item('template_cms_libraries') . 'form_widget_bottom';
            $this->load->model(array(
                'product_model',
                'categories_model'
            ));
            $productInfo = $this->product_model->get_info($id);
//          var_dump($productInfo);die;
//          var_dump ($this->input->post('Update_the_Items', true) == config_item('confirm_key_update'));
            if ($this->input->post('Update_the_Items', true) == config_item('confirm_key_update')) {

                $data               = array();
                $data['name']       = $this->input->post('name', TRUE);
                $data['slugs']      = $this->input->post('slugs', TRUE);
                $data['summary']    = $this->input->post('summary', TRUE);
                $data['description']= $this->input->post('description', TRUE);
                $data['link']       = $this->input->post('link', TRUE);
                $data['categories'] = $this->input->post('categories', TRUE);
                $check_upload       = $this->input->post('check_upload', TRUE);
                $url_image          = $this->input->post('url_image', TRUE);
                $data['created_by'] = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');

                $this->session->set_flashdata('notice_action_flashdata', 'Update Successfully, ID: ' . encodeId_Url_byHungDEV($productInfo->id) . ' - Category: ' . $productInfo->name);

                // Filter: slugs
                if ($data['slugs'] === null || empty($data['slugs'])) {
                    $data['slugs'] = getPermalinksSEO($data['name']);
                }
                // Filter: summary
                if ($data['summary'] === null || empty($data['summary'])) {
                    $data['summary'] = $data['name'];
                }

                // Filter: description
                if ($data['description'] === null || empty($data['description'])) {
                    $data['description'] = $data['name'];
                }
                // Filter: link
                if ($data['link'] === null || empty($data['link'])) {
                    $data['link'] = $data['link'];
                }

                // Filter: categories
                if ($data['categories'] === null || empty($data['categories']) || $data['categories'] == 'select_categories') {
                    $data['categories'] = 0;
                } else {
                    $data['categories'] = intval($data['categories']);
                }

                // check upload image || paste link image
                if (isset($check_upload)) {
                    // Upload Photos
                    $config                 = array();
                    $target_upload_cms      = $this->_uploads_path . 'Product/';
                    $target_upload_cms_date = $target_upload_cms . date('Y-m-d') . '/';
                    $target_upload_cms_slug = $target_upload_cms_date . $data['slugs'] . '/';

                    if (is_dir($target_upload_cms_slug) === false) {
                        if (is_dir($target_upload_cms) === false) {
                            new_folder($target_upload_cms);
                            new_folder($target_upload_cms_date);
                            new_folder($target_upload_cms_slug);
                        } elseif (is_dir($target_upload_cms_date) === false) {
                            new_folder($target_upload_cms_date);
                            new_folder($target_upload_cms_slug);

                        } else {
                            new_folder($target_upload_cms_slug);
                        }
                    }
                    $target_upload          = $target_upload_cms_slug;
                    $config['upload_path']  = $target_upload;
                    $config['allowed_types']= 'gif|jpg|png|jpeg|GIF';
                    $config['encrypt_name'] = TRUE;
                    $this->load->library('upload', $config);
                    $this->load->library('image_lib');
                    if ($this->upload->do_upload('photo')) {
                        $img                     = $this->upload->data();
                        $data['photo']           = $target_upload . $img['file_name'];
                        $config['image_library'] = 'gd2';
                        $config['source_image']  = $data['photo'];
                        $config['maintain_ratio']= TRUE;
                        $config['width']         = 263;
                        $config['height']        = 198;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                        unset($config);
                    }
                } else {
                    $data['photo'] = $url_image;
                    $data['thumb'] = $url_image;
                }
                // Time
                $data['updated_at'] = config_item('cf_datetime');
                $data_id = $this->product_model->update($productInfo->id, $data);
                // Debug
                log_message('debug', 'Update Category: ' . $productInfo->id);
                redirect($this->modules_link);
            } else {
                $data                     = array();
                // GET Data
                $data['categories_lists'] = $this->categories_model->get_result_distinct('name, id, parent');
                $data['item']             = $productInfo;
                $data['title']            = 'Sửa sản phẩm: ' . $data['item']->name;
                $this->load->view(config_item('template_cms_master_layout'), array(
                    'sub' => $this->modules_temp . 'edit',
                    'data' => $data
                ));
            }
        } else {
                redirect(config_item('modules_url_cms_stop'));
        }
        }
    }

    /*
     * Delete Products
     */
    public function delete(){
        if (!$this->_user_roles_id) {
            redirect(config_item('modules_url_cms_login'));
        } else {
            // Phân quyền
            if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_content_access'))) {
                $this->load->model('product_model');
                $keyid        = $this->input->post('delete_id', true);
                $confirm_hash = $this->input->post('Delete_the_Item', true);


                if ($confirm_hash == config_item('confirm_key_delete')) {
                    $id = decodeId_Url_byHungDEV($keyid);
                    $result_id = $this->product_model->delete($id);

                    if ($result_id === 1){
                        $this->session->set_flashdata('notice_action_flashdata', 'Xóa sản phẩm thành công!');
                    }
                    else {
                        $this->session->set_flashdata('notice_action_flashdata', 'Xóa sản phẩm không thành công!');
                    }
                    // add action to dashboard
                    $this->dashboard_recently_action->add_recently_action($this->modules_name, $this->modules_class, 'delete',  array(
                        'id_deleted'=>$id
                    ));
                    // Debug
                    log_message('debug', 'Delete product: ' . $id . ' - Result: ' . $result_id);
                }
                redirect($this->modules_link);
            }
        }

    }
}