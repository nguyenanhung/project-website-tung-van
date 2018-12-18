<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 12/06/2018
 * Time: 3:39 CH
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';

class Option_model extends TD_VAS_Based_model{
    public function __construct()
    {
        parent::__construct();
        $this->db                = $this->load->database('default', TRUE, TRUE);
        $this->tableName         = 'option';
        $this->primary_key       = 'id';
        $this->field_name        = 'name';
        $this->field_value       = 'value';
        $this->field_order_stt   = 'order_stt';
        $this->field_type        = 'type';
        $this->field_icon_font   = 'icon_font';
        $this->is_not            = ' !=';
        $this->or_higher         = ' >=';
        $this->is_higher         = ' >';
        $this->or_smaller        = ' <=';
        $this->is_smaller        = ' <';
    }

    /**
     * Get Results
     *
     * @param int $size
     * @param int $page
     * @param string $begin_date
     * @param string $end_date
     * @param null $username
     * @param null $level
     * @param bool $count_result
     * @param bool $random
     * @return mixed
     */
    public function get_result($size = 5, $page = 0, $name = null, $type = null, $count_result = false, $random = false)
    {
        $this->db->from($this->tableName);
        // Filter $name
        if ($name !== null) {
            $this->db->like($this->field_label, $name);
        }
        if ($type !== null) {
            $this->db->where($this->field_type, $type);
        }
        /** @var Filter count result */
        if ($count_result === false) {
            // Limit Result
            self::_page_limit($size, $page);
            // Order Result
            if ($random === true) {
                $this->db->order_by($this->tableName . '.' . $this->primary_key, 'RANDOM');
            } else {
                $this->db->order_by($this->tableName . '.' . $this->primary_key, 'DESC');
            }
            // Genarate result
            return $this->db->get()->result();
        } else {
            return $this->db->count_all_results();
        }
    }
    public function get_result_distinct($field = null)
    {
        $this->db->distinct();
        $this->db->select($field);
        $this->db->from($this->tableName);
        return $this->db->get()->result();
    }

    public function get_data_option($type = null,$order_stt = null)
    {
        $this->db->where($this->field_type,$type);
        $this->db->where($this->field_order_stt,$order_stt);
        $this->db->from($this->tableName);
//        $this->db->order_by($this->field_order_stt,'asc');
        return $this->db->get()->result();
    }
}