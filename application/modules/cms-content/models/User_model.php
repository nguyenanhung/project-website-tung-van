<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 3/31/17
 * Time: 08:48
 */

require_once APPPATH.'core/TD_VAS_Based_model.php';
class User_model extends TD_VAS_Based_model
{
    public function __construct()
    {
        parent::__construct();
        $this->db               = $this->load->database('default', TRUE, TRUE);
        $this->tableName        = 'users';
        $this->primary_key          = 'id';
        $this->field_status         = 'status'; // 1 = Active, 0 = Deactive, 2 = Wait active
        $this->field_group_id       = 'group_id';
        $this->field_username       = 'username';
        $this->field_password       = 'password';
        $this->field_salt           = 'salt';
        $this->field_token          = 'token';
        $this->field_activation_key = 'activation_key';
        $this->field_fullname       = 'fullname';
        $this->field_email          = 'email';
        $this->field_phone          = 'phone';
        $this->field_photo          = 'photo';
        $this->field_thumb          = 'thumb';
        $this->field_note           = 'note';
        $this->field_created_at     = 'created_at';
        $this->field_updated_at     = 'updated_at';
        $this->is_not               = ' !=';
        $this->or_higher            = ' >=';
        $this->is_higher            = ' >';
        $this->or_smaller           = ' <=';
        $this->is_smaller           = ' <';
    }

    public function get_result($size = 5, $page = 0, $begin_date = '', $end_date = '', $username = null, $level = null, $count_result = false, $random = false)
    {
        $this->db->select('users.id as user_id,group_id, users.username as username, users.status as user_status, users.photo as user_photo, users.thumb as user_thumb, users.created_at as user_created_at');
        $this->db->from($this->tableName);
        // Filter Date
        if ($begin_date != '' && $end_date != '')
        {
            $this->db->where('td_user.' . $this->field_created_at . $this->or_higher, $begin_date);
            $this->db->where('td_user.' . $this->field_created_at . $this->or_smaller, $end_date);
        }
        // Filter Username
        if ($username)
        {
            $this->db->like($this->field_username, $username);
        }
        // Filter Level
        if ($level)
        {
            $this->db->where($this->field_group_id, $level);
        }
        /** @var Filter count result */
        if ($count_result === false)
        {
            // Limit Result
            self::_page_limit($size, $page);
            // Order Result
            if ($random === true)
            {
                $this->db->order_by($this->tableName . '.' . $this->primary_key, 'RANDOM');
            }
            else
            {
                $this->db->order_by($this->tableName . '.' . $this->primary_key, 'DESC');
            }
            // Genarate result
            return $this->db->get()->result();
        }
        else
        {
            return $this->db->count_all_results();
        }
    }
    public function get_list_user($field = null)
    {
        $this->db->select($field);
        $this->db->from($this->tableName);
        return $this->db->get()->result();
    }
}

