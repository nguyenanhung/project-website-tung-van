<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/22/2017
 * Time: 2:27 AM
 */
class Roles
{
    protected $CI;
    protected $fully_permission;
    protected $modules_all_permission;
    protected $modules_action_permission;
    protected $user_fully_permission;
    protected $user_modules_all_permission;
    protected $user_modules_action_permission;
    /**
     * Roles constructor.
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
    }
    /**
     * Check Roles Authencation
     *
     * @param null $modules
     * @param null $action
     * @param string $mode
     * @return bool|null
     *
     * @access      public
     * @author      Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       23/01/2017
     */
    public function auth($modules = null, $action = null, $mode = 'user_group')
    {
        if ($modules === null || $action === null)
        {
            $result = null;
        }
        else
        {
            if ($mode == 'user_id')
            {
                $result = self::auth_by_user_id($modules, $action);
            }
            else
            {
                $result = self::auth_by_user_group($modules, $action);
            }
        }
        return $result;
    }
    /**
     * Check Roles Auth by User Group
     *
     * @param null $modules
     * @param null $action
     * @return bool|null
     *
     * @access      public
     * @author      Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       23/01/2017
     */
    public function auth_by_user_group($modules = null, $action = null)
    {
        if ($modules === null || $action === null)
        {
            $result = null;
        }
        else
        {
            $session_group = $this->CI->session->userdata(DASHBOARD_CMS_SESSION . 'user_group');
            $this->CI->load->model(array(
                'Ultimate/authentication_model',
                'Ultimate/authentication_meta_model'
            ));
            // Fully Permission
            $auth_fully_permission = $this->CI->authentication_model->info_by_modules('fully', 'all');
            if ($auth_fully_permission === null)
            {
                $fully_permission_id = null;
            }
            else
            {
                $fully_permission_id = $auth_fully_permission->id;
            }
            if ($fully_permission_id === null)
            {
                $this->fully_permission = null;
            }
            else
            {
                $this->fully_permission = $this->CI->authentication_meta_model->check_exists_auth($session_group, $fully_permission_id);
            }
            // All Modules Permission
            $auth_all_modules_permission = $this->CI->authentication_model->info_by_modules($modules, 'all');
            if ($auth_all_modules_permission === null)
            {
                $all_modules_permission_id = null;
            }
            else
            {
                $all_modules_permission_id = $auth_all_modules_permission->id;
            }
            if ($all_modules_permission_id === null)
            {
                $this->modules_all_permission = null;
            }
            else
            {
                $this->modules_all_permission = $this->CI->authentication_meta_model->check_exists_auth($session_group, $all_modules_permission_id);
            }
            // Action Modules Permission
            $auth_action_modules_permission = $this->CI->authentication_model->info_by_modules($modules, $action);
            if ($auth_action_modules_permission === null)
            {
                $action_modules_permission_id = null;
            }
            else
            {
                $action_modules_permission_id = $auth_action_modules_permission->id;
            }
            if ($action_modules_permission_id === null)
            {
                $this->modules_action_permission = null;
            }
            else
            {
                $this->modules_action_permission = $this->CI->authentication_meta_model->check_exists_auth($session_group, $action_modules_permission_id);
            }
            // Return Result
            if ($this->fully_permission || $this->modules_all_permission || $this->modules_action_permission)
            {
                $result = true;
            }
            else
            {
                $result = false;
            }
        }
        return $result;
    }
    /**
     * Check Roles by UserID
     *
     * @param null $modules
     * @param null $action
     * @return bool|null
     *
     * @access      public
     * @author      Hung Nguyen <dev@nguyenanhung.com>
     * @version     1.0.1
     * @since       23/01/2017
     */
    public function auth_by_user_id($modules = null, $action = null)
    {
        if ($modules === null || $action === null)
        {
            $result = null;
        }
        else
        {
            $session_id = $this->CI->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
            $this->CI->load->model(array(
                'Ultimate/authentication_model',
                'Ultimate/authentication_meta_by_user_model'
            ));
            // Fully Permission
            $auth_fully_permission = $this->CI->authentication_model->info_by_modules('fully', 'all');
            if ($auth_fully_permission === null)
            {
                $fully_permission_id = null;
            }
            else
            {
                $fully_permission_id = $auth_fully_permission->id;
            }
            if ($fully_permission_id === null)
            {
                $this->user_fully_permission = null;
            }
            else
            {
                $this->user_fully_permission = $this->CI->authentication_meta_by_user_model->check_exists_auth($session_id, $fully_permission_id);
            }
            // All Modules Permission
            $auth_all_modules_permission = $this->CI->authentication_model->info_by_modules($modules, 'all');
            if ($auth_all_modules_permission === null)
            {
                $all_modules_permission_id = null;
            }
            else
            {
                $all_modules_permission_id = $auth_all_modules_permission->id;
            }
            if ($all_modules_permission_id === null)
            {
                $this->user_modules_all_permission = null;
            }
            else
            {
                $this->user_modules_all_permission = $this->CI->authentication_meta_by_user_model->check_exists_auth($session_id, $all_modules_permission_id);
            }
            // Action Modules Permission
            $auth_action_modules_permission = $this->CI->authentication_model->info_by_modules($modules, $action);
            if ($auth_action_modules_permission === null)
            {
                $action_modules_permission_id = null;
            }
            else
            {
                $action_modules_permission_id = $auth_action_modules_permission->id;
            }
            if ($action_modules_permission_id === null)
            {
                $this->user_modules_action_permission = null;
            }
            else
            {
                $this->user_modules_action_permission = $this->CI->authentication_meta_by_user_model->check_exists_auth($session_id, $action_modules_permission_id);
            }
            // Return Result
            if ($this->user_fully_permission || $this->user_modules_all_permission || $this->user_modules_action_permission)
            {
                $result = true;
            }
            else
            {
                $result = false;
            }
        }
        return $result;
    }
}
/* End of file Roles.php */
/* Location: ./based_core_apps_thudo/libraries/Roles.php */
 