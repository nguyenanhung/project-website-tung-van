<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-02 17:33:13
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-07-07 09:34:33
 */
class Info extends MX_Controller
{
    /**
     * Info constructor.
     */
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array(
			'html'
		));
		$this->load->library(array(
			'Db_config',
			'Db_photo'
		));
	}

    /**
     *
     */
	public function index()
	{
		$this->load->model(array(
			'option_model'
		));
		$data = array();
		$data['title_info'] = $this->option_model->get_data_option('title',4);
		$data['list_info'] = $this->option_model->get_data_option('info',4);
		$this->load->view('info',$data);
	}
}