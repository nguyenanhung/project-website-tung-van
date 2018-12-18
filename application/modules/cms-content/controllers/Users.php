<?php

/**
 * @Author: thaodt97
 * @Date:   2018-06-07 12:00:07
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-07-11 11:35:47
 */
class Users extends MX_Controller
{
	public $modules_class;
	public $modules_name;
	public $modules_link;
	public $modules_action;
	protected $_user_roles_id;
	protected $_uer_roles_group;
	protected $_uploads_path;

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array(
			'session',
		));

		$this->_user_roles_id = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
		$this->_user_roles_group = $this->session->userdata(
			DASHBOARD_CMS_SESSION . 'user_group');
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
		$this->load->config('config');
		$this->modules_class = get_class($this);
		$this->modules_name = 'Người dùng';
		$this->modules_link = config_item('modules_url_backend_user');
		$this->modules_temp = 'users/';

		$this->_uploads_path = 'uploads/users/';
	}

	public function index()
	{
		if (!$this->_user_roles_id) {
			redirect(config_item('modules_url_cms_login'));
		} else {
			if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_admin'))) {
				$this->assets_header = config_item('template_cms_libraries') . 'buttons_table_header';
				$this->assets_bottom = config_item('template_cms_libraries') . 'buttons_table_bottom';
				$this->load->model('user_model');
				$data                = array();
				$data['username']    = $this->input->get_post('username', TRUE);
				$data['level']       = $this->input->get_post('level', TRUE);
				$data['max_results'] = $this->input->get_post('max_results', TRUE);
				$data['page']        = $this->input->get_post('page', TRUE);
				$data['begin_date']  = $this->input->get_post('begin_date', TRUE);
				$data['end_date']    = $this->input->get_post('end_date', TRUE);

				// Filter: Username
				if ($data['username'] === null || empty($data['username'])) {
					$data['is_username'] = '';
					$username_code       = null;
				} else {
					$data['is_username'] = strtolower($data['username']);
					$username_code       = strtolower($data['username']);
				}
            	// Filter: Level
				if ($data['level'] === null || empty($data['level']) || $data['level'] == 'select_level') {
					$data['is_level'] = '';
					$level_code       = null;
				} else {
					$data['is_level'] = intval($data['level']);
					$level_code       = intval($data['level']);
				}
            	// Filter: max_results
				if ($data['max_results'] == 'no_limit') {
					$max_results_code       = 'no_limit';
					$data['is_max_results'] = 75;
				} elseif ($data['max_results'] === NULL OR $data['max_results'] == 0) {
					$max_results_code       = 75;
					$data['is_max_results'] = 75;
				} else {
					$data['is_max_results'] = $data['max_results'];
					$max_results_code       = $data['max_results'];
				}
            	// Filter: page_results
				if ($data['page'] === NULL OR $data['page'] == 0) {
					$page_results_code       = 1;
					$data['is_page_results'] = 1;
				} else {
					$page_results_code       = $data['page'];
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
				$data['item_lists']                   = $this->user_model->get_result($max_results_code, $page_results_code, $begin_date_code, $end_date_code, $username_code, $level_code);
				$data['count_result']                 = $this->user_model->get_result($max_results_code, $page_results_code, $begin_date_code, $end_date_code, $username_code, $level_code, true);
				$data['title']                        = 'Danh sách người dùng';
				$this->load->view(config_item('template_cms_master_layout'), array(
					'sub' => $this->modules_temp . 'index',
					'data' => $data
				));
			}
			else {
				redirect(config_item('modules_url_cms_stop'));
			}
		}
	}
	public function create()
	{
		if (!$this->_user_roles_id) {
			redirect(config_item('modules_url_cms_login'));
		}
		else {
			if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_admin'))) {
				$this->assets_header = config_item('template_cms_libraries') . 'buttons_table_header';
				$this->assets_bottom = config_item('template_cms_libraries') . 'buttons_table_bottom';
				$this->load->model(array(
					'user_model',
				));
				//echo $this->input->post('Create_new_Items', true) ;die;
				if ($this->input->post('Create_new_Items', true) == config_item('confirm_key_create')) {
					
					$data                   = array();
					$data['salt']           = random_string('md5');
					$data['token']          = random_string('sha1');
					$data['activation_key'] = random_string('md5');
					$data['username']       = strtolower($this->input->post('username', true));
					$data['group_id']       = $this->input->post('group_level', true);
					$data['fullname']       = $this->input->post('fullname', true);
					$data['email']          = $this->input->post('email', true);
					$data['phone']          = $this->input->post('phone', true);
					$data['status']         = $this->input->post('status', true);
					$data['note']           = 'null';
					// Genarate Password
					$input_password = $this->input->post('password', true);
					$str_password = $input_password . $data['salt'];
					$data['password']       = password_hash($str_password, PASSWORD_BCRYPT);
					// Upload Photos
					$config = array();
					$target_upload  = $this->_uploads_path . $data['username'] . '/';
					if (is_dir($target_upload) == false) {
						mkdir($target_upload);
						genarate_file_index($target_upload);
						genarate_file_htaccess($target_upload);
					}
					$config['uploads_path'] = $target_upload;
					$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);
					$this->load->library('image_lib');
					if ($this->upload->do_upload('photo')) {
						$img = $this->upload->data();
						$data['photo'] = $target_upload . $img['file_name'];
						$config['image_libarry'] = 'gd2';
						$config['source_image'] = $data['photo'];
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 263;
						$config['heigt'] = 198;
						$data['thumb'] = $target_upload . $img['raw_name'] . '_thumb' . $img['file_ext'];
						$this->image_lib->initialize($config);
						$this->image_lib->resize();
						$this->image_lib->clear();
						unset($config);
					} else {
						$data['photo'] = 'assets/images/system/no_avatar.jpg';
						$data['thumb'] = 'assets/images/system/no_avatar_100x100.jpg';
					}
					// Time
					$data['created_at'] = config_item('cf_datetime');
					$data['updated_at'] = config_item('cf_datetime');
					$create_id          = $this->user_model->add($data);
					$this->session->set_flashdata('notice_action_flashdata', 'Tạo mới người dùng '. $data['username'].' thành công.');
					redirect($this->modules_link);
				} else {
					//echo 2;die;
					$data                = array();
                    // GET Data
					$data['title']       = 'Thêm mới người dùng';
					$this->load->view(config_item('template_cms_master_layout'), array(
						'sub' => $this->modules_temp . 'create',
						'data' => $data
					));
				}
			}
			else {
				redirect(config_item('modules_url_cms_stop'));
			}
		}
	}
	public function edit($keyid = '')
	{
		if (!$this->_user_roles_id) {
			redirect(config_item('modules_url_cms_login'));
		} 
		elseif (empty($keyid)) {
			redirect(config_item('modules_url_cms_404'));
		} 
		else {
			$id                  = decodeId_Url_byHungDEV($keyid);
			$this->assets_header = config_item('template_cms_libraries') . 'buttons_table_header';
			$this->assets_bottom = config_item('template_cms_libraries') . 'buttons_table_bottom';
			$this->load->model(array(
				'user_model',
			));
			$userInfo = $this->user_model->get_info($id);
            // Phân quyền
            // Tạm thời chỉ phân quyền cho cấp độ Admin trở lên được phép truy cập
			if (in_array($this->_user_roles_group, config_item('cms_dashboard_group_admin'))) {
				if ($this->input->post('Update_the_Items', true) == config_item('confirm_key_update')) {
					$data                   = array();
					$data['token']          = random_string('sha1');
					$data['activation_key'] = random_string('md5');
					$data['group_id']       = $this->input->post('group_level', true);
					$data['fullname']       = $this->input->post('fullname', true);
					$data['email']          = $this->input->post('email', true);
					$data['phone']          = $this->input->post('phone', true);
					$data['status']         = $this->input->post('status', true);
                	// Genarate Password
					if ($this->input->post('change_password', true) == 'Yes') {
						$data['salt']     = random_string('md5');
						$input_password   = $this->input->post('password', true);
						$input_password_confirm = $this->input->post('password_confirm', true);
						if (strcasecmp($input_password,$input_password_confirm) === 0) {
							$str_password     = $input_password . $data['salt'];
							$data['password'] = password_hash($str_password, PASSWORD_BCRYPT);
						}
						else {
							$this->session->set_flashdata('notice_action_flashdata', 'Cập nhật mật khẩu không thành công, Mật khẩu không trùng khớp');
							redirect($this->modules_link . '/edit/' . encodeId_Url_byHungDEV($userInfo->id));
						}

						
					}

                	// Upload Photos
					$config        = array();
					$target_upload = $this->_uploads_path . $userInfo->username . '/';
					if (is_dir($target_upload) == false) {
						mkdir($target_upload);
						genarate_file_index($target_upload);
						genarate_file_htaccess($target_upload);
					}
					$config['upload_path']   = $target_upload;
					$config['allowed_types'] = 'gif|jpg|png|jpeg|GIF';
					$config['encrypt_name']  = TRUE;
					$this->load->library('upload', $config);
					$this->load->library('image_lib');
					if ($this->upload->do_upload('photo')) {
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
                	// Time
					$data['updated_at']                = config_item('cf_datetime');
					$data_id                           = $this->user_model->update($userInfo->id, $data);
					$this->session->set_flashdata('notice_action_flashdata', 'Cập nhật người dùng ' . $userInfo->username.' thành công.');
					redirect($this->modules_link);
				} 
				else {
					$data                                      = array();
                	// GET data
					$data['item']                              = $userInfo;
					$data['title']                             = 'Sửa người dùng ' . $data['item']->username;
					$this->load->view(config_item('template_cms_master_layout'), array(
						'sub' => $this->modules_temp . 'edit',
						'data' => $data
					));
				}  
			}
			else {
				redirect(config_item('modules_url_cms_stop'));
			}
		}
	}

	public function delete()
	{
		if (!$this->_user_roles_id) {
			redirect(config_item('modules_url_cms_login'));
		}
		else {
			if (in_array($this->_user_roles_group,config_item('cms_dashboard_group_admin'))) {
				$keyid        = $this->input->post('delete_id', true);
				$confirm_hash = $this->input->post('Delete_the_Item', true);
				if ($confirm_hash == config_item('confirm_key_delete')) {
					$id = decodeId_Url_byHungDEV($keyid);
					$this->load->model('user_model');
					if ($id == 1) {
                        // Cấm xóa UserID = 1
						$this->session->set_flashdata('notice_action_flashdata', 'Bạn không thể xóa User này vì đây là user thuộc nhóm Root.');
					} elseif ($id == $this->_user_roles_id) {
                        // Bạn không thể tự xóa User của mình
						$this->session->set_flashdata('notice_action_flashdata', 'Bạn không thể tự xóa User của chính mình.');
					} else {
						$userInfo = $this->user_model->get_info($id);
                        // Cấm xóa User Level = 2
                        // Cấm xóa Supper Admin -> Khi cần có thể unset quyền trong db
						if ($userInfo->group_id == 2) {
							$this->session->set_flashdata('notice_action_flashdata', 'Bạn không thể xóa user này vì đây là user thuộc nhóm Supper Administrator.');
						} elseif ($userInfo->group_id == 3) {
							if (!in_array($this->_user_roles_group, config_item('cms_dashboard_group_supper_admins'))) {
								$this->session->set_flashdata('notice_action_flashdata', 'User này thuộc quyền Administrator, vì vậy bạn cần được cấp quyền Supper Administrator để thực hiện hành động này.');
							} else {
                                // supper admin được quyền xóa admin
								$result_id = $this->user_model->delete($id);
							}
						} else {
							$result_id = $this->user_model->delete($id);
						}
					}
					redirect($this->modules_link);
				}
			}
			else {
				redirect(config_item('modules_url_cms_stop'));
			}
		}
	}

}
