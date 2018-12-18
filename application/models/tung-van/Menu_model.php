<?php

/**
 * @Author: thaodt97
 * @Date:   2018-06-14 16:28:46
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-25 16:29:39
 */
require_once APPPATH . 'core/TD_VAS_Based_model.php';
class Menu_model extends TD_VAS_Based_model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE, TRUE);
		$this->tableName       = 'menu';
		$this->primary_key     = 'id';
		$this->field_title     = 'title';
		$this->field_alias     = 'alias';
		$this->field_link      = 'link';
		$this->field_parent    = 'parent';
		$this->field_status    = 'status';
		$this->field_id_lang   = 'id_lang';
		$this->field_sort      = 'sort';
		$this->field_slugs      = 'slugs';
		$this->field_position  = 'position';
		$this->field_type      = 'type';
		$this->field_icon_font = 'icon_font';
		$this->field_css_class = 'css_class';
		$this->is_not            = ' !=';
		$this->or_higher         = ' >=';
		$this->is_higher         = ' >';
		$this->or_smaller        = ' <=';
		$this->is_smaller        = ' <'; 
	}
	public function get_all_array()
    {
        $this->db->from($this->tableName);
        return $this->db->get()->result_array();
    }
    public function get_data_menu($position = null)
    {
        $this->db->where($this->field_position,$position);
        $this->db->from($this->tableName);
        return $this->db->get()->result();
    }
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
    //get menu id by slug
    public function get_menu_id($slugs='')
    {
        $this->db->select('*');
        $this->db->where('slugs',$slugs);
        $this->db->from($this->tableName);
        $query = $this->db->get();
        return $query->row();
    }

}