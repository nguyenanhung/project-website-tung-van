<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 14/06/2018
 * Time: 11:03 SA
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Staff_model extends TD_VAS_Based_model {
    public function __construct()
    {
        parent::__construct();
        $this->db                = $this->load->database('default', TRUE, TRUE);
        $this->tableName         = 'staff';
        $this->primary_key       = 'id';
        $this->field_name        = 'name';
        $this->field_photo       = 'photo';
        $this->field_position    = 'position';
        $this->field_link_fb     = 'link_fb';
        $this->field_link_twitter= 'link_twitter';
        $this->field_link_google = 'link_google';
        $this->is_not            = ' !=';
        $this->or_higher         = ' >=';
        $this->is_higher         = ' >';
        $this->or_smaller        = ' <=';
        $this->is_smaller        = ' <';
    }
    public function get_result($size = 5, $page = 0, $name = null, $position = null,  $count_result = false, $random = false)
    {
        $this->db->select('staff.name as staff_name, staff.id as staff_id, photo,staff.position as staff_position,staff.link_fb as staff_link_fb, staff.link_twitter as staff_link_twitter, staff.link_google as staff_link_google');
        $this->db->from($this->tableName);
        // Filter name
        if ($name) {
            $this->db->like($this->field_name, $name);
        }
        // Filter $position
        if ($position) {
            $this->db->where($this->field_position, $position);
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

}