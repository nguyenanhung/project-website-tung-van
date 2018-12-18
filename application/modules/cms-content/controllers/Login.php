<?php 

class Login extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array(
			'session'
		));
		$this->load->helper(array(
			'common',
			'assets',
			'url',
			'html',
			'form'
		));

		$this->view_template = 'login';
		$this->assets_header = config_item('template_cms_libraries') . 'login_header';
		$this->assets_bottom = config_item('template_cms_libraries') . 'login_bottom';
	}

	public function index()
	{
		if (!$this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id'))
		{
			if (count($_POST) < 2)
			{
				$this->load->view($this->view_template);
			}
			else
			{
				$this->load->model(array(
					'user_model'
				));
				$login_username = strtolower(html_escape($this->input->post('username',true)));
				$check_username = $this->user_model->check_exists($login_username, 'username');
				if ($check_username == 0)
				{
					$error = 'Sai Username hoặc Password';
					$this->load->view($this->view_template, array(
						'error' => $error
					));
				}
				else
				{
					$userInfo = $this->user_model->get_info($login_username, 'username');
					$login_password = $this->input->post('password', true);
					$password_str = $login_password . $userInfo->salt;
					$password_hash = $userInfo->password;
					// echo password_verify($password_str, $password_hash);die;
					if (password_verify($password_str, $password_hash) === true)
					{
						if (!in_array($userInfo->group_id, config_item('cms_dashboard_group_access')))
						{
							// Được quyền truy cập
							if ($userInfo->status == '2')
							{
								// User chờ kích hoạt
								$error = 'Tài khoản của bạn không có quyền truy câp.';
								$this->load->view($this->view_template, array(
									'error' => $error
								));
							}
							else
							{
								// Đăng nhập thành công
								$this->session->set_userdata(array(
									DASHBOARD_CMS_SESSION . 'user_id' => $userInfo->id,
									DASHBOARD_CMS_SESSION . 'user_status' => $userInfo->status,		
									DASHBOARD_CMS_SESSION . 'user_group' => $userInfo->group_id,
									DASHBOARD_CMS_SESSION . 'user_fullname' => $userInfo->fullname,
									DASHBOARD_CMS_SESSION . 'user_token' => $userInfo->token,
									DASHBOARD_CMS_SESSION . 'user_email' => $userInfo->email,
									DASHBOARD_CMS_SESSION . 'user_photo' => $userInfo->photo,
									DASHBOARD_CMS_SESSION . 'user_thumbnail' => $userInfo->thumb,
									DASHBOARD_CMS_SESSION . 'user_update_at' => $userInfo->update_at,
									DASHBOARD_CMS_SESSION . 'user_login_cms_status' => 'Login_Success'
								));
								// Đăng nhập thành công -> chuyển về trang quản lý
								redirect(config_item('modules_url_cms_manage'));
							}
						}
						else
						{
							$error = 'Tài khoản của bạn không có quyền truy cập.';
							$this->load->view($this->view_template, array(
								'error' => $error	
							));
						}
					}
					else
					{
						$error = 'Sai username hoặc Password.';
						$this->load->view($this->view_template, array(
							'error' => $error
						));
					}
				}
			}
		}
		else
		{
			redirect(config_item('modules_url_cms_manage'));
		}
	}
}
?>