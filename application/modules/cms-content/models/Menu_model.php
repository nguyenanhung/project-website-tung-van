<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HongLT
 * Date: 4/07/2017
 * Time: 9:55 AM
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Menu_model extends TD_VAS_Based_model
{
    public function __construct()
    {
        parent::__construct();
        $this->db                   = $this->load->database('default', TRUE, TRUE);
        $this->tableName            = 'menu';
        $this->primary_key          = 'id';
        $this->field_status         = 'status';
        $this->field_language       = 'lang';
        $this->field_name           = 'name';
        $this->field_slugs          = 'slugs';
        $this->field_title          = 'title';
        $this->field_description    = 'description';
        $this->field_keywords       = 'keywords';
        $this->field_parent         = 'parent';
        $this->field_cat_id         = 'cat_id';
        $this->field_created_at     = 'created_at';
        $this->field_updated_at     = 'updated_at';
        $this->field_language       = 'language';
        $this->is_not               = ' !=';
        $this->or_higher            = ' >=';
        $this->is_higher            = ' >';
        $this->or_smaller           = ' <=';
        $this->is_smaller           = ' <';
    }


    /**
     * Get Results
     * @param int $size
     * @param int $page
     * @param string $begin_date
     * @param string $end_date
     * @param null $name
     * @param null $status
     * @param bool $count_result
     * @param bool $random
     * @return
     */
    public function get_result($size = 5, $page = 0, $begin_date = '', $end_date = '', $name = null, $status = null, $count_result = false, $random = false)
    {
        $this->db->from($this->tableName);
        // Filter Date
        if ($begin_date != '' && $end_date != '')
        {
            $this->db->where($this->field_created_at . $this->or_higher, $begin_date);
            $this->db->where($this->field_created_at . $this->or_smaller, $end_date);
        }
        // Filter name
        if ($name)
        {
            $this->db->like($this->field_name, $name);
        }
        // Filter $status
        if ($status)
        {
            $this->db->where($this->field_status, $status);
        }
        elseif ($status === 0)
        {
            $this->db->where($this->field_status, 0);
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

    public function get_result_distinct($field = null)
    {
        $this->db->distinct();
        $this->db->select($field);
        $this->db->from($this->tableName);
        return $this->db->get()->result();
    }
}
