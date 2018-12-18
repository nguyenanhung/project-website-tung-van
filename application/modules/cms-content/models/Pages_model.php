<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 08/06/2018
 * Time: 2:54 CH
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Pages_model extends TD_VAS_Based_model {
    public function __construct()
    {
        parent::__construct();
        $this->db                = $this->load->database('default', TRUE, TRUE);
        $this->tableName         = 'pages';
        $this->primary_key       = 'id';
        $this->field_type        = 'type';
        $this->field_uuid        = 'uuid';
        $this->field_status      = 'status';
        $this->field_language    = 'language';
        $this->field_name        = 'name';
        $this->field_slugs       = 'slugs';
        $this->field_photo       = 'photo';
        $this->field_thumb       = 'thumb';
        $this->field_summary     = 'summary';
        $this->field_content     = 'content';
        $this->field_title       = 'title';
        $this->field_description = 'description';
        $this->field_tags        = 'tags';
        $this->field_source      = 'source';
        $this->field_viewed      = 'viewed';
        $this->field_created_by  = 'created_by';
        $this->field_created_at  = 'created_at';
        $this->field_updated_at  = 'updated_at';
        $this->is_not            = ' !=';
        $this->or_higher         = ' >=';
        $this->is_higher         = ' >';
        $this->or_smaller        = ' <=';
        $this->is_smaller        = ' <';
    }
    public function get_result($size = 5, $page = 0, $name = null, $status = null, $type = null, $count_result = false, $random = false)
    {
        $this->db->select('pages.name as pages_name, pages.id as pages_id, pages.status as pages_status, pages.title as pages_title,pages.menu as pages_menu, thumb, pages.type as pages_type, pages.created_at as pages_created_at');
        $this->db->from($this->tableName);
        //        $this->db->join('categories', 'categories.id = posts.categories');

        // Filter name
        if ($name) {
            $this->db->like($this->field_name, $name);
        }
        // Filter $status
        if ($status) {
            $this->db->where($this->field_status, $status);
        } elseif ($status === 0) {
            $this->db->where($this->field_status, 0);
        }
        // Filter type
        if ($type) {
            $this->db->where($this->field_type, $type);
        } elseif ($type === 0) {
            $this->db->where($this->field_type, 0);
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