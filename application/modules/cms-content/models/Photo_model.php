<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 14/06/2018
 * Time: 3:02 CH
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Photo_model extends TD_VAS_Based_model {
    public function __construct()
    {
        parent::__construct();
        $this->db                = $this->load->database('default', TRUE, TRUE);
        $this->tableName         = 'photos';
        $this->primary_key       = 'id';
        $this->field_name        = 'name';
        $this->field_photo       = 'photo';
        $this->field_type        = 'type';
        $this->is_not            = ' !=';
        $this->or_higher         = ' >=';
        $this->is_higher         = ' >';
        $this->or_smaller        = ' <=';
        $this->is_smaller        = ' <';
    }
    public function get_result($size = 5, $page = 0, $name = null, $type = null, $count_result = false, $random = false)
    {
        $this->db->select('photos.name as photos_name, photos.id as photos_id, photo,photos.type as photos_type');
        $this->db->from($this->tableName);
        // Filter name
        if ($name) {
            $this->db->like($this->field_name, $name);
        }
        // Filter $type
        if ($type) {
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

}