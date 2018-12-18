<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HongLT
 * Date: 4/07/2017
 * Time: 9:55 AM
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Posts_model extends TD_VAS_Based_model
{
    public function __construct()
    {
        parent::__construct();
        $this->db                = $this->load->database('default', TRUE, TRUE);
        $this->tableName         = 'posts';
        $this->primary_key       = 'id';
        $this->field_status      = 'status';
        $this->field_name        = 'name';
        $this->field_type        = 'type';
        $this->field_categories  = 'categories';
        $this->field_slugs       = 'slugs';
        $this->field_photo       = 'photo';
        $this->field_show_slider = 'show_slider';
        $this->field_thumb       = 'thumb';
        $this->field_summary     = 'summary';
        $this->field_content     = 'content';
        $this->field_title       = 'title';
        $this->field_description = 'description';
        $this->field_viewed      = 'viewed';
        $this->field_source      = 'source';
        $this->field_created_at  = 'created_at';
        $this->field_updated_at  = 'updated_at';
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
    public function get_result($size = 5, $page = 0, $begin_date = '', $end_date = '', $name = null, $status = null, $type = null, $show_silder, $categories = null, $count_result = false, $random = false)
    {
        $this->db->select('posts.name as posts_name, posts.id as posts_id, posts.status as posts_status, posts.title as posts_title, thumb, categories.name as categories_name, posts.type as posts_type, posts.topics as posts_topics, posts.created_at as posts_created_at, posts.show_slider as posts_show_slider');
        $this->db->from($this->tableName);
        $this->db->join('categories', 'categories.id = posts.categories');
        // Filter Date
        if ($begin_date != '' && $end_date != '') {
            $this->db->where("posts." .$this->field_created_at . $this->or_higher, $begin_date);
            $this->db->where("posts." .$this->field_created_at . $this->or_smaller, $end_date);
        }
        // Filter name
        if ($name) {
            $this->db->like("posts." . $this->field_name, $name);
        }
        // Filter $status
        if ($status) {
            $this->db->where("posts." . $this->field_status, $status);
        } elseif ($status === 0) {
            $this->db->where("posts." . $this->field_status, 0);
        }
        // Filter $categories
        if ($categories) {
            $this->db->where("posts." . $this->field_categories, $categories);
        }
        // Filter type
        if ($type) {
            $this->db->where("posts." . $this->field_type, $type);
        } elseif ($type === 0) {
            $this->db->where("posts." . $this->field_type, 0);
        }
        // Filter show slider
        if ($type) {
            $this->db->where("posts." . $this->field_show_slider, $show_silder);
        } elseif ($type === 0) {
            $this->db->where("posts." . $this->field_show_slider, 0);
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
