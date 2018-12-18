<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @Author: thaodt97
 * @Date:   2018-06-14 09:07:30
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-14 11:33:26
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Comments_model extends TD_VAS_Based_model
{
	public function __construct()
	{
		parent::__construct();
		$this->db               = $this->load->database('default', TRUE, TRUE);
		$this->tableName        = 'comments';
		$this->primary_key      = 'id';
		$this->field_name       = 'name';
		$this->field_email      = 'email';
		$this->field_website    = 'website';
		$this->field_message    = 'message';
		$this->field_created_at = 'created_at';
		$this->field_post_id    = 'post_id';
		$this->field_status     = 'status';
		$this->field_photo		= 'photo';
		$this->is_not           = ' !=';
		$this->or_higher        = ' >=';
		$this->is_higher        = ' >';
		$this->or_smaller       = ' <=';
		$this->is_smaller       = ' <';

	}
	public function get_result($count,$post_id,$status = true, $count_result = false)
	{
		$this->db->select('
			name,
			email,
			website,
			message,
			photo
		');
		$this->db->from($this->tableName);
		$this->db->where($this->field_post_id, $post_id);
		$this->db->where($this->field_status, 1);
		$this->db->order_by($this->primary_key, 'DESC');

		if ($count_result === false)
        {
            return $this->db->get()->result();
        }
        else
        {
            return $this->db->count_all_results();
        }
	}
}
