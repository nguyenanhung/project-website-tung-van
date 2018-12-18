<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 4/3/17
 * Time: 15:34
 */

class Dashboard_recently_action
{
    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
    }

    public function add_recently_action($module, $controller, $action, $data_input)
    {
        // load model
        $this->CI->load->model('tung-van/recently_action_model');
        // get data to add db
        $data = array();
        // get user_id, modules, action
        $user_id = $this->CI->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
        $data['user_id'] = $user_id;
        $data['module'] = $module;
        $data['controller'] = $controller;
        $data['action'] = $action;
        $dataConnect = array(
            'method' => $this->CI->input->method(true),
            'ip_address' => $this->CI->input->ip_address(),
            'user_agent' => $this->CI->input->user_agent(true),
            'request_headers' => $this->CI->input->request_headers(true)
        );
        $data_params = array_merge($data_input, $dataConnect);
        $data['params'] = json_encode($data_params, JSON_PRETTY_PRINT);
        $data['created_at'] = date('Y-m-d H-i-s');
        $data_id = $this->CI->recently_action_model->add($data);
    }
}

/* End of file Dashboard_recently_action.php */
/* Location: ./application/libraries/Dashboard_recently_action.php */